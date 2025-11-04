<div>
    {{-- Math Lab - Interactive Calculators --}}
    
    <div class="space-y-6">
        {{-- Header --}}
        <x-card>
            <div class="text-center space-y-4">
                <div class="flex justify-center">
                    <div class="bg-secondary/10 p-6 rounded-full">
                        <x-icon name="o-calculator" class="w-20 h-20 text-secondary" />
                    </div>
                </div>
                <h1 class="text-3xl font-bold">Math Lab - Mathematical Calculators</h1>
                <p class="text-lg text-base-content/70">
                    Interactive mathematical tools with real-time visualizations
                </p>
            </div>
        </x-card>

        {{-- Calculator Selection and Formulas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                {{-- Calculator Selection --}}
                <x-card class="h-fit">
                    <h2 class="text-xl font-semibold mb-4">Select a Calculator</h2>
                    <div class="flex flex-col gap-2">
                        <button 
                            wire:click="setCalculator('function')"
                            class="btn {{ $activeCalculator === 'function' ? 'btn-secondary' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-chart-bar" class="w-5 h-5 mr-2" />
                            Function & Graph
                        </button>
                        <button 
                            wire:click="setCalculator('derivative')"
                            class="btn {{ $activeCalculator === 'derivative' ? 'btn-secondary' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-arrow-trending-up" class="w-5 h-5 mr-2" />
                            Derivative
                        </button>
                        <button 
                            wire:click="setCalculator('integral')"
                            class="btn {{ $activeCalculator === 'integral' ? 'btn-secondary' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-calculator" class="w-5 h-5 mr-2" />
                            Integral
                        </button>
                        <button 
                            wire:click="setCalculator('matrix')"
                            class="btn {{ $activeCalculator === 'matrix' ? 'btn-secondary' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-table-cells" class="w-5 h-5 mr-2" />
                            Matrix Operations
                        </button>
                    </div>
                </x-card>

                {{-- Calculator Description --}}
                <x-card class="h-fit">
                    <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
                        <x-icon name="o-information-circle" class="w-5 h-5" />
                        About This Calculator
                    </h2>
                    <div class="text-sm text-base-content/80">
                        @if($activeCalculator === 'function')
                        <p class="mb-2"><strong>Function & Graph</strong> allows you to plot various mathematical functions including polynomials, trigonometric, exponential, and logarithmic functions.</p>
                        <p>You can visualize how changing coefficients affects the shape and position of the graph in real-time.</p>
                        
                        @elseif($activeCalculator === 'derivative')
                        <p class="mb-2"><strong>Derivative Calculator</strong> computes the rate of change of a function at a specific point.</p>
                        <p>This tool uses numerical differentiation to calculate first and second derivatives, helping you understand the slope and concavity of functions.</p>
                        
                        @elseif($activeCalculator === 'integral')
                        <p class="mb-2"><strong>Integral Calculator</strong> computes the area under a curve using Simpson's rule for numerical integration.</p>
                        <p>This tool helps you find the definite integral of functions over a specified interval, visualizing both the function and the accumulated area.</p>
                        
                        @elseif($activeCalculator === 'matrix')
                        <p class="mb-2"><strong>Matrix Operations</strong> performs basic matrix arithmetic including addition, subtraction, and multiplication.</p>
                        <p>This calculator also computes determinants and helps you understand how matrix operations work in linear algebra.</p>
                        @endif
                    </div>
                </x-card>
            </div>
            
            {{-- Math Formulas --}}
            <x-card>
                <h2 class="text-xl font-semibold mb-4">📚 Mathematical Formulas</h2>
                <div class="text-sm space-y-4">
                    @if($activeCalculator === 'function')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Function Types</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• Polynomial: y = ax² + bx + c</li>
                            <li>• Sin: y = a·sin(x) + c</li>
                            <li>• Cos: y = a·cos(x) + c</li>
                            <li>• Exponential: y = a·e^(bx) + c</li>
                            <li>• Logarithmic: y = a·ln(x) + c</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• a, b, c = Coefficients</li>
                                <li>• x = Independent variable</li>
                                <li>• y = Dependent variable (function value)</li>
                            </ul>
                        </div>
                    </div>
                    
                    @elseif($activeCalculator === 'derivative')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Derivative Formulas</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• First derivative: f'(x) = lim(h→0) [f(x+h) - f(x)] / h</li>
                            <li>• Second derivative: f''(x) = lim(h→0) [f'(x+h) - f'(x)] / h</li>
                            <li>• Numerical approximation: f'(x) ≈ [f(x+h) - f(x)] / h</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Common Derivatives:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• d/dx(xⁿ) = nxⁿ⁻¹</li>
                                <li>• d/dx(sin x) = cos x</li>
                                <li>• d/dx(cos x) = -sin x</li>
                                <li>• d/dx(eˣ) = eˣ</li>
                                <li>• d/dx(ln x) = 1/x</li>
                            </ul>
                        </div>
                    </div>
                    
                    @elseif($activeCalculator === 'integral')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Integration Formulas</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• Definite integral: ∫[a to b] f(x) dx</li>
                            <li>• Simpson's Rule: (h/3)[f(x₀) + 4f(x₁) + 2f(x₂) + ... + f(xₙ)]</li>
                            <li>• Where h = (b-a)/n</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Common Integrals:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• ∫xⁿ dx = xⁿ⁺¹/(n+1) + C</li>
                                <li>• ∫sin x dx = -cos x + C</li>
                                <li>• ∫cos x dx = sin x + C</li>
                                <li>• ∫eˣ dx = eˣ + C</li>
                                <li>• ∫1/x dx = ln|x| + C</li>
                            </ul>
                        </div>
                    </div>
                    
                    @elseif($activeCalculator === 'matrix')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Matrix Operations</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• Addition: C = A + B</li>
                            <li>• Subtraction: C = A - B</li>
                            <li>• Multiplication: C = A × B</li>
                            <li>• Determinant (2×2): det = ad - bc</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Matrix Properties:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• For 2×2 matrix: [a b; c d]</li>
                                <li>• Determinant = ad - bc</li>
                                <li>• Matrix multiplication is non-commutative</li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </x-card>
        </div>

        {{-- Function & Graph Calculator --}}
        @if($activeCalculator === 'function')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">Function & Graph</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-select 
                        wire:model="functionType" 
                        label="Function Type" 
                        :options="[
                            ['id' => 'polynomial', 'name' => 'Polynomial (ax² + bx + c)'],
                            ['id' => 'sin', 'name' => 'Sine (a·sin(x) + c)'],
                            ['id' => 'cos', 'name' => 'Cosine (a·cos(x) + c)'],
                            ['id' => 'exp', 'name' => 'Exponential (a·e^(bx) + c)'],
                            ['id' => 'log', 'name' => 'Logarithmic (a·ln(x) + c)'],
                        ]"
                    />
                    <x-input 
                        wire:model="coefficientA" 
                        label="Coefficient a" 
                        type="number"
                        step="0.1"
                    />
                    <x-input 
                        wire:model="coefficientB" 
                        label="Coefficient b" 
                        type="number"
                        step="0.1"
                    />
                    <x-input 
                        wire:model="coefficientC" 
                        label="Coefficient c" 
                        type="number"
                        step="0.1"
                    />
                    <x-input 
                        wire:model="xMin" 
                        label="X Minimum" 
                        type="number"
                        step="1"
                    />
                    <x-input 
                        wire:model="xMax" 
                        label="X Maximum" 
                        type="number"
                        step="1"
                    />
                    <x-button 
                        wire:click="calculateFunction" 
                        class="btn-secondary w-full"
                        icon="o-play"
                        spinner="calculateFunction"
                    >
                        <span wire:loading.remove wire:target="calculateFunction">Plot Function</span>
                        <span wire:loading wire:target="calculateFunction">Calculating...</span>
                    </x-button>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="functionCanvas" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- Derivative Calculator --}}
        @if($activeCalculator === 'derivative')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">Derivative Calculator</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-input 
                        wire:model="derivativeFunction" 
                        label="Function (e.g., x^2, sin(x), exp(x))" 
                        hint="Use x as variable"
                    />
                    <x-input 
                        wire:model="derivativePoint" 
                        label="Point to Evaluate" 
                        type="number"
                        step="0.1"
                    />
                    <x-button 
                        wire:click="calculateDerivative" 
                        class="btn-secondary w-full"
                        icon="o-play"
                        spinner="calculateDerivative"
                    >
                        <span wire:loading.remove wire:target="calculateDerivative">Calculate Derivative</span>
                        <span wire:loading wire:target="calculateDerivative">Calculating...</span>
                    </x-button>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="derivativeCanvas" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- Integral Calculator --}}
        @if($activeCalculator === 'integral')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">Integral Calculator</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-input 
                        wire:model="integralFunction" 
                        label="Function (e.g., x, x^2, sin(x))" 
                        hint="Use x as variable"
                    />
                    <x-input 
                        wire:model="integralLower" 
                        label="Lower Limit" 
                        type="number"
                        step="0.1"
                    />
                    <x-input 
                        wire:model="integralUpper" 
                        label="Upper Limit" 
                        type="number"
                        step="0.1"
                    />
                    <x-button 
                        wire:click="calculateIntegral" 
                        class="btn-secondary w-full"
                        icon="o-play"
                        spinner="calculateIntegral"
                    >
                        <span wire:loading.remove wire:target="calculateIntegral">Calculate Integral</span>
                        <span wire:loading wire:target="calculateIntegral">Calculating...</span>
                    </x-button>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="integralCanvas" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- Matrix Calculator --}}
        @if($activeCalculator === 'matrix')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">Matrix Operations</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-2">
                        <x-input wire:model="matrixA11" label="A[1,1]" type="number" step="0.1" />
                        <x-input wire:model="matrixA12" label="A[1,2]" type="number" step="0.1" />
                        <x-input wire:model="matrixA21" label="A[2,1]" type="number" step="0.1" />
                        <x-input wire:model="matrixA22" label="A[2,2]" type="number" step="0.1" />
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <x-input wire:model="matrixB11" label="B[1,1]" type="number" step="0.1" />
                        <x-input wire:model="matrixB12" label="B[1,2]" type="number" step="0.1" />
                        <x-input wire:model="matrixB21" label="B[2,1]" type="number" step="0.1" />
                        <x-input wire:model="matrixB22" label="B[2,2]" type="number" step="0.1" />
                    </div>
                    <x-select 
                        wire:model="matrixOperation" 
                        label="Operation" 
                        :options="[
                            ['id' => 'add', 'name' => 'Addition (A + B)'],
                            ['id' => 'subtract', 'name' => 'Subtraction (A - B)'],
                            ['id' => 'multiply', 'name' => 'Multiplication (A × B)'],
                        ]"
                    />
                    <x-button 
                        wire:click="calculateMatrix" 
                        class="btn-secondary w-full"
                        icon="o-play"
                        spinner="calculateMatrix"
                    >
                        <span wire:loading.remove wire:target="calculateMatrix">Calculate</span>
                        <span wire:loading wire:target="calculateMatrix">Calculating...</span>
                    </x-button>
                </div>
                <div class="lg:col-span-2">
                    <div id="matrixDisplay" class="bg-base-200 rounded-lg p-6 text-center">
                        @if($matrixResults)
                        <div class="space-y-4">
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <div class="text-center">
                                    <p class="text-sm font-semibold mb-2">Matrix A</p>
                                    <div class="bg-base-100 p-3 rounded">
                                        <table class="mx-auto">
                                            <tr>
                                                <td class="px-2 py-1">{{ $matrixResults['matrixA'][0][0] }}</td>
                                                <td class="px-2 py-1">{{ $matrixResults['matrixA'][0][1] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-2 py-1">{{ $matrixResults['matrixA'][1][0] }}</td>
                                                <td class="px-2 py-1">{{ $matrixResults['matrixA'][1][1] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-center text-2xl font-bold">
                                    @if($matrixResults['operation'] === 'add') + @elseif($matrixResults['operation'] === 'subtract') − @else × @endif
                                </div>
                                <div class="text-center">
                                    <p class="text-sm font-semibold mb-2">Matrix B</p>
                                    <div class="bg-base-100 p-3 rounded">
                                        <table class="mx-auto">
                                            <tr>
                                                <td class="px-2 py-1">{{ $matrixResults['matrixB'][0][0] }}</td>
                                                <td class="px-2 py-1">{{ $matrixResults['matrixB'][0][1] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-2 py-1">{{ $matrixResults['matrixB'][1][0] }}</td>
                                                <td class="px-2 py-1">{{ $matrixResults['matrixB'][1][1] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-base-300 pt-4">
                                <p class="text-sm font-semibold mb-2">Result</p>
                                <div class="bg-accent/10 p-3 rounded">
                                    <table class="mx-auto">
                                        <tr>
                                            <td class="px-2 py-1">{{ $matrixResults['result'][0][0] }}</td>
                                            <td class="px-2 py-1">{{ $matrixResults['result'][0][1] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-2 py-1">{{ $matrixResults['result'][1][0] }}</td>
                                            <td class="px-2 py-1">{{ $matrixResults['result'][1][1] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="text-base-content/70">Click "Calculate" to see matrix operations</p>
                        @endif
                    </div>
                </div>
            </div>
        </x-card>
        @endif
    </div>

    {{-- Load Chart.js from CDN --}}
    @push('scripts')
    <script>
        // Wait for Chart.js from app.js, then load math-lab.js
        (function loadMathLabScript() {
            if (typeof Chart !== 'undefined' || typeof window.Chart !== 'undefined') {
                var script = document.createElement('script');
                script.src = '/js/math-lab.js';
                script.onerror = function() {
                    console.error('Failed to load math-lab.js');
                };
                script.onload = function() {
                    console.log('Math lab script loaded successfully');
                };
                document.body.appendChild(script);
            } else {
                setTimeout(loadMathLabScript, 100);
            }
        })();
    </script>
    @endpush

    @script
    <script>
        // Listen to Livewire events and dispatch browser events for the math-lab.js file
        $wire.on('updateFunctionGraph', (data) => {
            console.log('Livewire updateFunctionGraph event:', data);
            if (typeof initMathLab === 'function' || typeof Chart !== 'undefined') {
                window.dispatchEvent(new CustomEvent('updateFunctionGraph', { detail: data }));
            } else {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('updateFunctionGraph', { detail: data }));
                }, 500);
            }
        });

        $wire.on('updateDerivative', (data) => {
            console.log('Livewire updateDerivative event:', data);
            if (typeof initMathLab === 'function' || typeof Chart !== 'undefined') {
                window.dispatchEvent(new CustomEvent('updateDerivative', { detail: data }));
            } else {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('updateDerivative', { detail: data }));
                }, 500);
            }
        });

        $wire.on('updateIntegral', (data) => {
            console.log('Livewire updateIntegral event:', data);
            if (typeof initMathLab === 'function' || typeof Chart !== 'undefined') {
                window.dispatchEvent(new CustomEvent('updateIntegral', { detail: data }));
            } else {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('updateIntegral', { detail: data }));
                }, 500);
            }
        });

        $wire.on('updateMatrix', (data) => {
            console.log('Livewire updateMatrix event:', data);
            if (typeof initMathLab === 'function' || typeof Chart !== 'undefined') {
                window.dispatchEvent(new CustomEvent('updateMatrix', { detail: data }));
            } else {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('updateMatrix', { detail: data }));
                }, 500);
            }
        });
    </script>
    @endscript
</div>
