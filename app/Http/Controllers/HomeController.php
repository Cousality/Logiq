<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Providers\DailyPuzzleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $puzzleService;

    public function __construct(DailyPuzzleService $puzzleService)
    {
        $this->puzzleService = $puzzleService;
    }

    public function index()
    {
        $puzzle = $this->puzzleService->getDailyPuzzle();

        $topProducts = Product::where('productStatus', 'active')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->orderByDesc('reviews_count')
            ->take(10)
            ->get();

        return view('Frontend.home', compact('puzzle', 'topProducts'));
    }

    public function validatePuzzle(Request $request)
    {
        $request->validate([
            'answer' => 'required|integer',
        ]);

        $isCorrect = $this->puzzleService->checkAnswer($request->answer);

        if ($isCorrect) {
            $this->updateUserStreak();

            return response()->json([
                'status' => 'success',
                'message' => 'Correct. Logic sound.',
                'color' => 'green',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Incorrect. Recalculate.',
            'color' => '#4A2C2A',
        ]);
    }

    private function updateUserStreak()
    {
        if (! Auth::check()) {
            return;
        }

        $userId = Auth::id();
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        $streakData = DB::table('user_streak')->where('userID', $userId)->first();

        if (! $streakData) {
            DB::table('user_streak')->insert([
                'userID' => $userId,
                'current_streak' => 1,
                'max_streak' => 1,
                'last_solved_date' => $today,
                'total_solved' => 1,
            ]);

            return;
        }

        if ($streakData->last_solved_date === $today) {
            return;
        }

        $isConsecutive = ($streakData->last_solved_date === $yesterday);
        $newStreak = $isConsecutive ? $streakData->current_streak + 1 : 1;
        $newMax = max($newStreak, $streakData->max_streak);

        DB::table('user_streak')->where('userID', $userId)->update([
            'current_streak' => $newStreak,
            'max_streak' => $newMax,
            'last_solved_date' => $today,
            'total_solved' => DB::raw('total_solved + 1'),
        ]);
    }
}
