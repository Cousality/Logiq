<?php

namespace App\Providers;

class DailyPuzzleService
{
    public function getDailyPuzzle()
    {
        // Seed Generator day month year
        $seed = (int) date('dmY');
        mt_srand($seed);

        // Determine Puzzle Type Linear,Quadratic,Geometric,Fibonacci
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

        // Generate Incorrect Options
        $options = [$answer];
        $options[] = $answer + mt_rand(1, 5) * (mt_rand(0, 1) ? 1 : -1);
        $options[] = intval($answer * (mt_rand(11, 15) / 10));

        // Randomise options
        shuffle($options);

        return [
            'seed' => $seed,
            'sequence_string' => implode(', ', $sequence).', ?',
            'options' => $options,
            'debug_answer' => $answer,
        ];
    }

    public function checkAnswer($inputAnswer)
    {
        $puzzle = $this->getDailyPuzzle();

        return (int) $inputAnswer === (int) $puzzle['debug_answer'];
    }
}
