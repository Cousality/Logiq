<?php

namespace Tests\Feature;

use Tests\TestCase;

class FuzzySearchTest extends TestCase
{
    public function test_exact_match(): void
    {
        $this->get("/search?query=3x3 Rubik's Cube")->assertSee("3x3 Rubik's Cube");
    }

    public function test_partial_match(): void
    {
        $this->get('/search?query=Rubik')->assertSee("3x3 Rubik's Cube");
    }

    public function test_typo_match(): void
    {
        $this->get('/search?query=Rubikss')->assertSee("3x3 Rubik's Cube");
    }

    public function test_no_match(): void
    {
        $this->get('/search?query=zzzzzzzzz')->assertDontSee("3x3 Rubik's Cube");
    }
}

