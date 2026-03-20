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

    