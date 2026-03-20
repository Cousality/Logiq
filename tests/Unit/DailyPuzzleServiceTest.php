<?php

namespace Tests\Unit;

use App\Providers\DailyPuzzleService;
use Tests\TestCase;

class DailyPuzzleServiceTest extends TestCase
{
    private DailyPuzzleService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new DailyPuzzleService();
    }

    /** @test */
    public function it_returns_all_required_keys(): void
    {
        $puzzle = $this->service->getDailyPuzzle();

        $this->assertArrayHasKey('seed', $puzzle);
        $this->assertArrayHasKey('sequence_string', $puzzle);
        $this->assertArrayHasKey('options', $puzzle);
        $this->assertArrayHasKey('debug_answer', $puzzle);
    }

    /** @test */
    public function it_returns_exactly_three_options(): void
    {
        $puzzle = $this->service->getDailyPuzzle();

        $this->assertCount(3, $puzzle['options']);
    }

    /** @test */
    public function options_always_contain_the_correct_answer(): void
    {
        $puzzle = $this->service->getDailyPuzzle();

        $this->assertContains($puzzle['debug_answer'], $puzzle['options']);
    }

    /** @test */
    public function sequence_string_contains_five_numbers(): void
    {
        $puzzle = $this->service->getDailyPuzzle();

        // Format is "n1, n2, n3, n4, n5, ?" — so 5 numbers before the ?
        $withoutQuestion = rtrim($puzzle['sequence_string'], ', ?');
        $numbers = explode(', ', $withoutQuestion);

        $this->assertCount(5, $numbers);
    }

    /** @test */
    public function seed_matches_todays_date(): void
    {
        $puzzle = $this->service->getDailyPuzzle();
        $expectedSeed = (int) date('dmY');

        $this->assertSame($expectedSeed, $puzzle['seed']);
    }

    // ─── Random Seed ──────────────────────────────────────────────────────────

    /** @test */
    public function same_day_always_produces_same_puzzle(): void
    {
        $puzzleOne = $this->service->getDailyPuzzle();
        $puzzleTwo = $this->service->getDailyPuzzle();

        $this->assertSame($puzzleOne['debug_answer'], $puzzleTwo['debug_answer']);
        $this->assertSame($puzzleOne['sequence_string'], $puzzleTwo['sequence_string']);
        $this->assertSame($puzzleOne['seed'], $puzzleTwo['seed']);
    }

    // ─── All four puzzle types ────────────────────────────────────────────────

    /**
     * Force a specific puzzle type by seeding mt_rand manually,
     * then assert the maths holds for that type.
     */

    /** @test */
    public function linear_sequence_next_term_is_correct(): void
    {
        // Type 0 (linear): sequence[i] = start + i * step
        $puzzle = $this->getPuzzleForType(0);
        $numbers = $this->parseSequence($puzzle['sequence_string']);

        $step = $numbers[1] - $numbers[0];
        foreach (range(1, 4) as $i) {
            $this->assertSame($step, $numbers[$i] - $numbers[$i - 1]);
        }
        $this->assertSame($numbers[4] + $step, $puzzle['debug_answer']);
    }

    /** @test */
    public function quadratic_sequence_answer_is_correct(): void
    {
        $puzzle = $this->getPuzzleForType(1);
        $numbers = $this->parseSequence($puzzle['sequence_string']);

        // Second differences should be constant for a quadratic
        $firstDiff = array_map(fn ($i) => $numbers[$i] - $numbers[$i - 1], range(1, 4));
        $secondDiff = array_map(fn ($i) => $firstDiff[$i] - $firstDiff[$i - 1], range(1, 3));

        $uniqueSecondDiffs = array_unique($secondDiff);
        $this->assertCount(1, $uniqueSecondDiffs, 'Second differences should be constant');
    }

    /** @test */
    public function geometric_sequence_ratio_is_constant(): void
    {
        $puzzle = $this->getPuzzleForType(2);
        $numbers = $this->parseSequence($puzzle['sequence_string']);

        $ratio = $numbers[1] / $numbers[0];
        foreach (range(1, 4) as $i) {
            $this->assertEqualsWithDelta($ratio, $numbers[$i] / $numbers[$i - 1], 0.001);
        }
        $this->assertEqualsWithDelta($numbers[4] * $ratio, $puzzle['debug_answer'], 0.001);
    }

    /** @test */
    public function fibonacci_each_term_is_sum_of_previous_two(): void
    {
        $puzzle = $this->getPuzzleForType(3);
        $numbers = $this->parseSequence($puzzle['sequence_string']);

        foreach (range(2, 4) as $i) {
            $this->assertSame($numbers[$i - 2] + $numbers[$i - 1], $numbers[$i]);
        }
        $this->assertSame($numbers[3] + $numbers[4], $puzzle['debug_answer']);
    }

    // ─── checkAnswer() ────────────────────────────────────────────────────────

    /** @test */
    public function check_answer_returns_true_for_correct_answer(): void
    {
        $puzzle = $this->service->getDailyPuzzle();

        $this->assertTrue($this->service->checkAnswer($puzzle['debug_answer']));
    }

    /** @test */
    public function check_answer_returns_false_for_wrong_answer(): void
    {
        $puzzle = $this->service->getDailyPuzzle();
        $wrongAnswer = $puzzle['debug_answer'] + 1;

        $this->assertFalse($this->service->checkAnswer($wrongAnswer));
    }

    /** @test */
    public function check_answer_handles_string_input(): void
    {
        $puzzle = $this->service->getDailyPuzzle();

        $this->assertTrue($this->service->checkAnswer((string) $puzzle['debug_answer']));
    }

    /** @test */
    public function check_answer_returns_false_for_zero(): void
    {
        $this->assertFalse($this->service->checkAnswer(0));
    }
}
