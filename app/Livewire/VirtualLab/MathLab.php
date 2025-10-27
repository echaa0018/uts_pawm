<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class MathLab extends Component
{
    use Toast;

    // Selected tool
    public $selectedTool = null;
    
    // Quadratic Equation Variables (ax² + bx + c = 0)
    public $a = 1;
    public $b = 0;
    public $c = 0;
    public $root1 = null;
    public $root2 = null;
    public $discriminant = null;
    
    // Matrix Calculator Variables (2x2 matrices)
    public $matrix1 = [[1, 0], [0, 1]];
    public $matrix2 = [[1, 0], [0, 1]];
    public $matrixResult = null;
    public $matrixOperation = 'add';
    
    // Derivative Calculator
    public $function = 'x^2';
    public $derivativeResult = '';
    
    // Statistics Calculator
    public $dataSet = '1, 2, 3, 4, 5';
    public $mean = null;
    public $median = null;
    public $mode = null;
    public $stdDev = null;

    public function mount()
    {
        $this->selectedTool = 'quadratic';
    }

    public function selectTool($tool)
    {
        $this->selectedTool = $tool;
        $this->resetCalculations();
    }

    public function solveQuadratic()
    {
        if ($this->a == 0) {
            $this->toast(
                type: 'error',
                title: 'Invalid Input',
                description: 'Coefficient a cannot be zero',
                position: 'toast-top toast-end',
                icon: 'o-x-circle',
                timeout: 3000
            );
            return;
        }

        // Calculate discriminant: b² - 4ac
        $this->discriminant = pow($this->b, 2) - (4 * $this->a * $this->c);
        
        if ($this->discriminant > 0) {
            // Two real roots
            $this->root1 = (-$this->b + sqrt($this->discriminant)) / (2 * $this->a);
            $this->root2 = (-$this->b - sqrt($this->discriminant)) / (2 * $this->a);
        } elseif ($this->discriminant == 0) {
            // One real root
            $this->root1 = -$this->b / (2 * $this->a);
            $this->root2 = $this->root1;
        } else {
            // Complex roots
            $realPart = -$this->b / (2 * $this->a);
            $imagPart = sqrt(abs($this->discriminant)) / (2 * $this->a);
            $this->root1 = round($realPart, 4) . ' + ' . round($imagPart, 4) . 'i';
            $this->root2 = round($realPart, 4) . ' - ' . round($imagPart, 4) . 'i';
        }

        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Quadratic equation solved',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function calculateMatrix()
    {
        $m1 = $this->matrix1;
        $m2 = $this->matrix2;
        
        switch ($this->matrixOperation) {
            case 'add':
                $this->matrixResult = [
                    [$m1[0][0] + $m2[0][0], $m1[0][1] + $m2[0][1]],
                    [$m1[1][0] + $m2[1][0], $m1[1][1] + $m2[1][1]]
                ];
                break;
            case 'subtract':
                $this->matrixResult = [
                    [$m1[0][0] - $m2[0][0], $m1[0][1] - $m2[0][1]],
                    [$m1[1][0] - $m2[1][0], $m1[1][1] - $m2[1][1]]
                ];
                break;
            case 'multiply':
                $this->matrixResult = [
                    [
                        $m1[0][0] * $m2[0][0] + $m1[0][1] * $m2[1][0],
                        $m1[0][0] * $m2[0][1] + $m1[0][1] * $m2[1][1]
                    ],
                    [
                        $m1[1][0] * $m2[0][0] + $m1[1][1] * $m2[1][0],
                        $m1[1][0] * $m2[0][1] + $m1[1][1] * $m2[1][1]
                    ]
                ];
                break;
        }

        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Matrix operation completed',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function calculateStatistics()
    {
        // Parse data set
        $data = array_map('trim', explode(',', $this->dataSet));
        $data = array_map('floatval', $data);
        
        if (empty($data)) {
            $this->toast(
                type: 'error',
                title: 'Invalid Input',
                description: 'Please enter valid numbers',
                position: 'toast-top toast-end',
                icon: 'o-x-circle',
                timeout: 3000
            );
            return;
        }

        // Mean
        $this->mean = array_sum($data) / count($data);
        
        // Median
        sort($data);
        $count = count($data);
        $middle = floor($count / 2);
        if ($count % 2 == 0) {
            $this->median = ($data[$middle - 1] + $data[$middle]) / 2;
        } else {
            $this->median = $data[$middle];
        }
        
        // Standard Deviation
        $variance = array_sum(array_map(function($x) {
            return pow($x - $this->mean, 2);
        }, $data)) / count($data);
        $this->stdDev = sqrt($variance);

        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Statistics calculated',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function resetCalculations()
    {
        $this->root1 = null;
        $this->root2 = null;
        $this->discriminant = null;
        $this->matrixResult = null;
        $this->mean = null;
        $this->median = null;
        $this->stdDev = null;
    }

    public function render()
    {
        $breadcrumbs = [
            [
                'link' => route("home"),
                'label' => 'Home',
                'icon' => 's-home',
            ],
            [
                'label' => 'Virtual Lab',
            ],
            [
                'link' => route("virtual-lab.math"),
                'label' => 'Math Lab',
            ],
        ];

        return view('livewire.virtual-lab.math-lab')
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Math Virtual Lab',
            ]);
    }
}
