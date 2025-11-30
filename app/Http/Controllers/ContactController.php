<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('Frontend.customer_service');
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
