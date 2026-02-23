<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('Frontend.dashboard.customer_service');
    }

    public function adminIndex()
    {
        $tickets = DB::table('contact')
            ->join('users', 'contact.userID', '=', 'users.userID')
            ->select(
                'contact.supportNum',
                'contact.userID',
                'contact.problemCategory',
                'contact.problemDescription',
                'contact.created_at',
                'contact.updated_at',
                'users.firstName',
                'users.lastName',
                'users.email'
            )
            ->orderBy('contact.created_at', 'desc')
            ->get();

        return view('Frontend.dashboard.admin_customer_service', compact('tickets'));
    }

    public function resolve($supportNum)
    {
        try {
            DB::table('contact')->where('supportNum', $supportNum)->delete();

            return redirect()->back()->with('success', 'Ticket resolved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to resolve ticket.');
        }
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'orderNumber' => 'nullable|integer',
            'issueCategory' => 'required|in:delivery,refund,account,payment,other',
            'message' => 'required|string|max:5000',
        ]);

        $categoryMap = [
            'delivery' => 'Delivery',
            'refund' => 'Refund',
            'account' => 'Account',
            'payment' => 'Payment',
            'other' => 'Other',
        ];

        try {
            DB::table('contact')->insert([
                'userID' => Auth::id(),
                'problemCategory' => $categoryMap[$validated['issueCategory']],
                'problemDescription' => $validated['message'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Your support ticket has been submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error submitting your request. Please try again.');
        }
    }
}
