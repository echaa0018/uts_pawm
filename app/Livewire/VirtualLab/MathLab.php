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
    
    // Statistics Calculator
    public $dataSet = '1, 2, 3, 4, 5';
    public $mean = null;
    public $median = null;
    public $mode = null;
    public $stdDev = null;
    
    // Derivative Calculator
    public $derivativeFunction = 'x^2';
    public $derivativeResult = '';
    public $derivativeSteps = [];
    
    // Unit Converter
    public $converterCategory = 'length';
    public $converterFrom = 'meter';
    public $converterTo = 'kilometer';
    public $converterValue = 1;
    public $converterResult = 0;
    
    // Graphing Calculator
    public $graphFunction = 'x^2';
    public $graphMinX = -10;
    public $graphMaxX = 10;
    public $graphPoints = [];

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

    public function calculateDerivative()
    {
        $function = strtolower(trim($this->derivativeFunction));
        $this->derivativeSteps = [];
        
        // Simple derivative rules
        if (preg_match('/x\^(\d+)/', $function, $matches)) {
            $power = (int)$matches[1];
            $this->derivativeResult = $power . 'x^' . ($power - 1);
            $this->derivativeSteps[] = "Using power rule: d/dx(x^n) = nx^(n-1)";
            $this->derivativeSteps[] = "d/dx(x^$power) = {$power}x^" . ($power - 1);
        } elseif ($function === 'x') {
            $this->derivativeResult = '1';
            $this->derivativeSteps[] = "d/dx(x) = 1";
        } elseif (preg_match('/(\d+)x/', $function, $matches)) {
            $coeff = (int)$matches[1];
            $this->derivativeResult = $coeff;
            $this->derivativeSteps[] = "d/dx($coeff x) = $coeff";
        } else {
            $this->derivativeResult = '0';
            $this->derivativeSteps[] = "d/dx(constant) = 0";
        }
        
        $this->toast(
            type: 'success',
            title: 'Derivative Calculated',
            description: 'Derivative found successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }
    
    public function convertUnits()
    {
        $conversions = [
            'length' => [
                'meter' => 1,
                'kilometer' => 1000,
                'centimeter' => 0.01,
                'millimeter' => 0.001,
                'inch' => 0.0254,
                'foot' => 0.3048,
                'yard' => 0.9144,
                'mile' => 1609.34
            ],
            'weight' => [
                'gram' => 1,
                'kilogram' => 1000,
                'pound' => 453.592,
                'ounce' => 28.3495,
                'ton' => 1000000
            ],
            'temperature' => [
                'celsius' => 1,
                'fahrenheit' => 1,
                'kelvin' => 1
            ]
        ];
        
        if ($this->converterCategory === 'temperature') {
            // Special handling for temperature
            if ($this->converterFrom === 'celsius' && $this->converterTo === 'fahrenheit') {
                $this->converterResult = ($this->converterValue * 9/5) + 32;
            } elseif ($this->converterFrom === 'fahrenheit' && $this->converterTo === 'celsius') {
                $this->converterResult = ($this->converterValue - 32) * 5/9;
            } elseif ($this->converterFrom === 'celsius' && $this->converterTo === 'kelvin') {
                $this->converterResult = $this->converterValue + 273.15;
            } elseif ($this->converterFrom === 'kelvin' && $this->converterTo === 'celsius') {
                $this->converterResult = $this->converterValue - 273.15;
            } else {
                $this->converterResult = $this->converterValue;
            }
        } else {
            // Standard unit conversion
            $fromFactor = $conversions[$this->converterCategory][$this->converterFrom];
            $toFactor = $conversions[$this->converterCategory][$this->converterTo];
            $this->converterResult = ($this->converterValue * $fromFactor) / $toFactor;
        }
        
        $this->toast(
            type: 'success',
            title: 'Conversion Complete',
            description: 'Unit conversion completed',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }
    
    public function generateGraph()
    {
        $this->graphPoints = [];
        $step = ($this->graphMaxX - $this->graphMinX) / 100;
        
        for ($x = $this->graphMinX; $x <= $this->graphMaxX; $x += $step) {
            // Simple function evaluation for x^2, x^3, sin(x), etc.
            if ($this->graphFunction === 'x^2') {
                $y = $x * $x;
            } elseif ($this->graphFunction === 'x^3') {
                $y = $x * $x * $x;
            } elseif ($this->graphFunction === 'sin(x)') {
                $y = sin($x);
            } elseif ($this->graphFunction === 'cos(x)') {
                $y = cos($x);
            } elseif ($this->graphFunction === 'sqrt(x)') {
                $y = $x >= 0 ? sqrt($x) : null;
            } else {
                $y = $x; // Default to linear
            }
            
            if ($y !== null && abs($y) <= 100) { // Limit y values for display
                $this->graphPoints[] = ['x' => round($x, 2), 'y' => round($y, 2)];
            }
        }
        
        $this->toast(
            type: 'success',
            title: 'Graph Generated',
            description: 'Function graph created successfully',
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
        $this->derivativeResult = '';
        $this->derivativeSteps = [];
        $this->converterResult = 0;
        $this->graphPoints = [];
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
