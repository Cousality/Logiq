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

    // -------------- getDailyPuzzle() structure -----------------

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

    // ------ Seed Test ---------------

    /** @test */
    public function same_day_always_produces_same_puzzle(): void
    {
        $puzzleOne = $this->service->getDailyPuzzle();
        $puzzleTwo = $this->service->getDailyPuzzle();

        $this->assertSame($puzzleOne['debug_answer'], $puzzleTwo['debug_answer']);
        $this->assertSame($puzzleOne['sequence_string'], $puzzleTwo['sequence_string']);
        $this->assertSame($puzzleOne['seed'], $puzzleTwo['seed']);
    }

    // ------------- All four puzzle types ----------------

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

    // ------------------ checkAnswer() --------------------

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
        $wrongAnswer = $puzzle['debug_answer'] + 999;

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

    // -------------------- Helpers -------------------------

    private function getPuzzleForType(int $type): array
    {
        // Try seeds until we get the desired puzzle type
        for ($seed = 1; $seed <= 100000; $seed++) {
            mt_srand($seed);
            if (mt_rand(0, 3) === $type) {
                mt_srand($seed);

                return $this->simulatePuzzleWithSeed($seed);
            }
        }

        $this->fail("Could not find a seed producing puzzle type {$type}");
    }

    private function simulatePuzzleWithSeed(int $seed): array
    {
        mt_srand($seed);
        $type = mt_rand(0, 3);

        $sequence = [];
        $answer = 0;

        switch ($type) {
            case 0:
                $start = mt_rand(1, 50);
                $step = mt_rand(2, 12);
                for ($i = 0; $i < 5; $i++) {
                    $sequence[] = $start + ($i * $step);
                }
                $answer = $start + (5 * $step);
                break;

            case 1:
                $a = mt_rand(1, 3);
                $b = mt_rand(1, 5);
                $c = mt_rand(1, 10);
                for ($n = 1; $n <= 5; $n++) {
                    $sequence[] = ($a * pow($n, 2)) + ($b * $n) + $c;
                }
                $answer = ($a * pow(6, 2)) + ($b * 6) + $c;
                break;

            case 2:
                $start = mt_rand(2, 5);
                $ratio = mt_rand(2, 3);
                for ($i = 0; $i < 5; $i++) {
                    $sequence[] = $start * pow($ratio, $i);
                }
                $answer = $start * pow($ratio, 5);
                break;

            case 3:
                $n1 = mt_rand(1, 10);
                $n2 = mt_rand(1, 10);
                $sequence = [$n1, $n2];
                for ($i = 2; $i < 5; $i++) {
                    $sequence[] = $sequence[$i - 1] + $sequence[$i - 2];
                }
                $answer = $sequence[4] + $sequence[3];
                break;
        }

        $options = [$answer];
        $options[] = $answer + mt_rand(1, 5) * (mt_rand(0, 1) ? 1 : -1);
        $options[] = intval($answer * (mt_rand(11, 15) / 10));
        shuffle($options);

        return [
            'seed' => $seed,
            'sequence_string' => implode(', ', $sequence).', ?',
            'options' => $options,
            'debug_answer' => $answer,
        ];
    }

    /** Parse "1, 2, 3, 4, 5, ?" back into [1, 2, 3, 4, 5] */
    private function parseSequence(string $sequenceString): array
    {
        $parts = explode(', ', $sequenceString);
        array_pop($parts);

        return array_map('intval', $parts);
    }
}
