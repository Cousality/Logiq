<?php

namespace App\Http\Controllers;

use App\Providers\DailyPuzzleService;
use Illuminate\Http\Request;

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

        return view('Frontend.home', compact('puzzle'));
    }

    public function validatePuzzle(Request $request)
    {
        $request->validate([
            'answer' => 'required|integer',
        ]);

        $isCorrect = $this->puzzleService->checkAnswer($request->answer);

        if ($isCorrect) {
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
}
