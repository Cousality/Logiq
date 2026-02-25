<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('query');

        if ($searchQuery) {
            $users = $this->fuzzySearch($searchQuery);
        } else {
            $users = User::query()->paginate(20)->appends($request->except('page'));
        }

        return view('Frontend.dashboard.user_management', compact('users', 'searchQuery'));
    }

    private function fuzzySearch($searchQuery)
    {
        $allUsers = User::all();
        $results = [];
        $search     = strtolower(trim($searchQuery));
        $searchNorm = preg_replace('/[^a-z0-9 ]/', '', $search);
        $searchWords = array_filter(explode(' ', $searchNorm));

        foreach ($allUsers as $user) {
            $score = 0;
            $name     = strtolower($user->firstName . ' ' . $user->lastName);
            $nameNorm = preg_replace('/[^a-z0-9 ]/', '', $name);
            $email    = strtolower($user->email ?? '');

            // Name: substring match (normalised)
            if (str_contains($nameNorm, $searchNorm)) {
                $score += 100;
            }

            // Name: per-word fuzzy (normalised)
            $nameWords = array_filter(explode(' ', $nameNorm));
            foreach ($searchWords as $sw) {
                $bestWord = 0;
                foreach ($nameWords as $nw) {
                    similar_text($sw, $nw, $pct);
                    $bestWord = max($bestWord, $pct);
                }
                if ($bestWord >= 70) {
                    $score += $bestWord;
                }
            }

            // Email: substring match
            if (str_contains($email, $search)) {
                $score += 100;
            }

            // Email: similar_text on full email
            similar_text($search, $email, $percent);
            if ($percent > 70) {
                $score += $percent;
            }

            if ($score > 0) {
                $results[] = ['user' => $user, 'score' => $score];
            }
        }

        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return collect(array_map(fn ($item) => $item['user'], $results));
    }

    public function makeAdmin($id)
    {
        $user = User::where('userID', $id)->firstOrFail();

        $user->update(['admin' => true]);

        return back()->with('success', "{$user->firstName} {$user->lastName} has been granted Admin privileges.");
    }

    public function removeAdmin($id)
    {
        $user = User::where('userID', $id)->firstOrFail();

        $user->update(['admin' => false]);

        return back()->with('success', "{$user->firstName} {$user->lastName} has had Admin privileges removed.");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', "User {$user->email} has been deleted.");
    }
}
