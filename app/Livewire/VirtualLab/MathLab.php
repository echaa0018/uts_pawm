<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class MathLab extends Component
{
    use Toast;

    public $activeCalculator = 'function';

    public $functionType = 'polynomial';
    public $coefficientA = 1;
    public $coefficientB = 0;
    public $coefficientC = 0;
    public $xMin = -10;
    public $xMax = 10;

    public $derivativeFunction = 'x^2';
    public $derivativePoint = 2;

    public $integralFunction = 'x';
    public $integralLower = 0;
    public $integralUpper = 5;

    public $matrixA11 = 1;
    public $matrixA12 = 2;
    public $matrixA21 = 3;
    public $matrixA22 = 4;
    public $matrixB11 = 5;
    public $matrixB12 = 6;
    public $matrixB21 = 7;
    public $matrixB22 = 8;
    public $matrixOperation = 'add';

    public $functionResults = null;
    public $derivativeResults = null;
    public $integralResults = null;
    public $matrixResults = null;

    public function mount()
    {
        $this->info('Welcome to Math Lab! Select a calculator to begin.', position: 'toast-top toast-end');
    }

    public function setCalculator($calculator)
    {
        $this->activeCalculator = $calculator;
        $this->info('Switched to ' . ucfirst(str_replace('-', ' ', $calculator)) . ' calculator', position: 'toast-top toast-end');
    }

    public function calculateFunction()
    {
        try {
            $dataPoints = [];
            $steps = 100;
            
            for ($i = 0; $i <= $steps; $i++) {
                $x = $this->xMin + (($this->xMax - $this->xMin) / $steps) * $i;
                
                switch ($this->functionType) {
                    case 'polynomial':
                        $y = $this->coefficientA * $x ** 2 + $this->coefficientB * $x + $this->coefficientC;
                        break;
                    case 'sin':
                        $y = $this->coefficientA * sin($x) + $this->coefficientC;
                        break;
                    case 'cos':
                        $y = $this->coefficientA * cos($x) + $this->coefficientC;
                        break;
                    case 'exp':
                        $y = $this->coefficientA * exp($this->coefficientB * $x) + $this->coefficientC;
                        break;
                    case 'log':
                        $y = $x > 0 ? $this->coefficientA * log($x) + $this->coefficientC : null;
                        break;
                    default:
                        $y = $x;
                }
                
                if ($y !== null && is_finite($y)) {
                    $dataPoints[] = ['x' => round($x, 2), 'y' => round($y, 4)];
                }
            }
            
            $this->functionResults = [
                'dataPoints' => $dataPoints,
                'functionType' => $this->functionType,
                'coefficients' => [
                    'a' => $this->coefficientA,
                    'b' => $this->coefficientB,
                    'c' => $this->coefficientC
                ]
            ];
            
            $this->dispatch('updateFunctionGraph',
                dataPoints: $dataPoints,
                functionType: $this->functionType,
                coefficients: [
                    'a' => $this->coefficientA,
                    'b' => $this->coefficientB,
                    'c' => $this->coefficientC
                ]
            );
            
            $this->success('Function graph calculated!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function calculateDerivative()
    {
        try {
            $h = 0.0001;
            $x = $this->derivativePoint;
            
            $function = strtolower(trim($this->derivativeFunction));
            
            $fx = $this->evaluateFunction($function, $x);
            $fxh = $this->evaluateFunction($function, $x + $h);
            
            $derivative = ($fxh - $fx) / $h;
            
            $fxh2 = $this->evaluateFunction($function, $x + 2 * $h);
            $secondDerivative = ($fxh2 - 2 * $fxh + $fx) / ($h ** 2);
            
            $this->derivativeResults = [
                'point' => $x,
                'derivative' => round($derivative, 4),
                'secondDerivative' => round($secondDerivative, 4),
                'function' => $function
            ];
            
            $this->dispatch('updateDerivative',
                point: $x,
                derivative: round($derivative, 4),
                secondDerivative: round($secondDerivative, 4),
                function: $function
            );
            
            $this->success('Derivative calculated!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    private function evaluateFunction($function, $x)
    {
        try {
            $function = trim($function);
            
            if (preg_match('/^x\^(\d+)$/', $function, $matches)) {
                $power = (int)$matches[1];
                return pow($x, $power);
            }
            
            if (preg_match('/^(\d+\.?\d*)\*?x$/', $function, $matches)) {
                $coeff = (float)$matches[1];
                return $coeff * $x;
            }
            
            if (preg_match('/^x\*(\d+\.?\d*)$/', $function, $matches)) {
                $coeff = (float)$matches[1];
                return $x * $coeff;
            }
            
            if (preg_match('/^sin\(x\)$/', $function)) {
                return sin($x);
            }
            
            if (preg_match('/^cos\(x\)$/', $function)) {
                return cos($x);
            }
            
            if (preg_match('/^exp\(x\)$/', $function)) {
                return exp($x);
            }
            
            if (preg_match('/^log\(x\)$/', $function)) {
                return $x > 0 ? log($x) : 0;
            }
            
            return $x;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function calculateIntegral()
    {
        try {
            $n = 1000;
            $a = $this->integralLower;
            $b = $this->integralUpper;
            
            if ($b <= $a) {
                throw new \Exception('Upper limit must be greater than lower limit');
            }
            
            $h = ($b - $a) / $n;
            
            $sum = 0;
            $dataPoints = [];
            
            for ($i = 0; $i <= $n; $i++) {
                $x = $a + $i * $h;
                $y = $this->evaluateFunction($this->integralFunction, $x);
                
                if ($i === 0 || $i === $n) {
                    $sum += $y;
                } elseif ($i % 2 === 0) {
                    $sum += 2 * $y;
                } else {
                    $sum += 4 * $y;
                }
                
                if ($i % 10 === 0) {
                    $dataPoints[] = ['x' => round($x, 2), 'y' => round($y, 4)];
                }
            }
            
            $integral = ($h / 3) * $sum;
            
            $this->integralResults = [
                'integral' => round($integral, 4),
                'lower' => $a,
                'upper' => $b,
                'dataPoints' => $dataPoints,
                'function' => $this->integralFunction
            ];
            
            $this->dispatch('updateIntegral',
                integral: round($integral, 4),
                lower: $a,
                upper: $b,
                dataPoints: $dataPoints,
                function: $this->integralFunction
            );
            
            $this->success('Integral calculated!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function calculateMatrix()
    {
        try {
            $matrixA = [
                [$this->matrixA11, $this->matrixA12],
                [$this->matrixA21, $this->matrixA22]
            ];
            
            $matrixB = [
                [$this->matrixB11, $this->matrixB12],
                [$this->matrixB21, $this->matrixB22]
            ];
            
            $result = [];
            
            switch ($this->matrixOperation) {
                case 'add':
                    $result = [
                        [$matrixA[0][0] + $matrixB[0][0], $matrixA[0][1] + $matrixB[0][1]],
                        [$matrixA[1][0] + $matrixB[1][0], $matrixA[1][1] + $matrixB[1][1]]
                    ];
                    break;
                case 'multiply':
                    $result = [
                        [
                            $matrixA[0][0] * $matrixB[0][0] + $matrixA[0][1] * $matrixB[1][0],
                            $matrixA[0][0] * $matrixB[0][1] + $matrixA[0][1] * $matrixB[1][1]
                        ],
                        [
                            $matrixA[1][0] * $matrixB[0][0] + $matrixA[1][1] * $matrixB[1][0],
                            $matrixA[1][0] * $matrixB[0][1] + $matrixA[1][1] * $matrixB[1][1]
                        ]
                    ];
                    break;
                case 'subtract':
                    $result = [
                        [$matrixA[0][0] - $matrixB[0][0], $matrixA[0][1] - $matrixB[0][1]],
                        [$matrixA[1][0] - $matrixB[1][0], $matrixA[1][1] - $matrixB[1][1]]
                    ];
                    break;
            }
            
            $detA = $matrixA[0][0] * $matrixA[1][1] - $matrixA[0][1] * $matrixA[1][0];
            
            $detB = $matrixB[0][0] * $matrixB[1][1] - $matrixB[0][1] * $matrixB[1][0];
            
            $this->matrixResults = [
                'matrixA' => $matrixA,
                'matrixB' => $matrixB,
                'result' => $result,
                'operation' => $this->matrixOperation,
                'detA' => $detA,
                'detB' => $detB
            ];
            
            $this->dispatch('updateMatrix',
                matrixA: $matrixA,
                matrixB: $matrixB,
                result: $result,
                operation: $this->matrixOperation,
                detA: $detA,
                detB: $detB
            );
            
            $this->success('Matrix calculation completed!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
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
                'link' => route("virtual-lab.math"),
                'label' => 'Math Lab',
            ],
        ];

        return view('livewire.virtual-lab.math-lab')
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Math Lab',
            ]);
    }
}
