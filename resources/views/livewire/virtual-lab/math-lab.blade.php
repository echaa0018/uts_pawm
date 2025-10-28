<div>
    {{-- Math Virtual Lab --}}
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        {{-- Sidebar with Tools --}}
        <div class="card bg-base-100 shadow-xl lg:col-span-1">
            <div class="card-body">
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Math Tools
                </h2>

                <div class="menu text-sm space-y-1">
                    <button 
                        class="menu-item {{ $selectedTool === 'quadratic' ? 'active' : '' }}"
                        wire:click="selectTool('quadratic')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        Quadratic Equation
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedTool === 'matrix' ? 'active' : '' }}"
                        wire:click="selectTool('matrix')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Matrix Calculator
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedTool === 'statistics' ? 'active' : '' }}"
                        wire:click="selectTool('statistics')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Statistics
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedTool === 'derivative' ? 'active' : '' }}"
                        wire:click="selectTool('derivative')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Derivative Calculator
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedTool === 'converter' ? 'active' : '' }}"
                        wire:click="selectTool('converter')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        Unit Converter
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedTool === 'graphing' ? 'active' : '' }}"
                        wire:click="selectTool('graphing')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Graphing Calculator
                    </button>
                </div>
            </div>
        </div>

        {{-- Main Content Area --}}
        <div class="card bg-base-300 shadow-xl lg:col-span-3">
            <div class="card-body">
            @if($selectedTool === 'quadratic')
                {{-- Quadratic Equation Solver --}}
                    <h2 class="card-title text-base-content">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        Quadratic Equation Solver
                    </h2>

                <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Solve: ax² + bx + c = 0</h3>
                                <div class="text-xs">Enter the coefficients a, b, and c to find the roots using the quadratic formula.</div>
                            </div>
                        </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Coefficient a</span>
                                </label>
                                <input 
                                type="number"
                                step="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="a"
                                    placeholder="Enter coefficient a" />
                                <label class="label">
                                    <span class="label-text-alt">a ≠ 0</span>
                                </label>
                        </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Coefficient b</span>
                                </label>
                                <input 
                                type="number"
                                step="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="b"
                                    placeholder="Enter coefficient b" />
                        </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Coefficient c</span>
                                </label>
                                <input 
                                type="number"
                                step="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="c"
                                    placeholder="Enter coefficient c" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="solveQuadratic">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Solve Equation
                            </button>
                    </div>

                    @if($discriminant !== null)
                            <div class="card bg-base-100">
                                <div class="card-body">
                                    <h3 class="card-title">Results</h3>
                            <div class="space-y-3">
                                <div class="stat bg-base-100 rounded-lg">
                                    <div class="stat-title">Discriminant (Δ)</div>
                                    <div class="stat-value text-sm">{{ number_format($discriminant, 4) }}</div>
                                    <div class="stat-desc">
                                        @if($discriminant > 0)
                                            Two distinct real roots
                                        @elseif($discriminant == 0)
                                            One repeated real root
                                        @else
                                            Two complex conjugate roots
                                        @endif
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div class="stat bg-base-100 rounded-lg">
                                        <div class="stat-title">Root 1 (x₁)</div>
                                        <div class="stat-value text-primary text-lg">
                                            @if(is_numeric($root1))
                                                {{ number_format($root1, 4) }}
                                            @else
                                                {{ $root1 }}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="stat bg-base-100 rounded-lg">
                                        <div class="stat-title">Root 2 (x₂)</div>
                                        <div class="stat-value text-secondary text-lg">
                                            @if(is_numeric($root2))
                                                {{ number_format($root2, 4) }}
                                            @else
                                                {{ $root2 }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                    @endif
                </div>

            @elseif($selectedTool === 'matrix')
                {{-- Matrix Calculator --}}
                    <h2 class="card-title text-base-content">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Matrix Calculator (2×2)
                    </h2>

                <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Matrix Operations</h3>
                                <div class="text-xs">Perform addition, subtraction, or multiplication on 2×2 matrices.</div>
                            </div>
                        </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Matrix 1 --}}
                        <div>
                            <label class="label">
                                <span class="label-text font-bold">Matrix A</span>
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                    <input type="number" step="0.1" class="input input-bordered input-sm" wire:model="matrix1.0.0" />
                                    <input type="number" step="0.1" class="input input-bordered input-sm" wire:model="matrix1.0.1" />
                                    <input type="number" step="0.1" class="input input-bordered input-sm" wire:model="matrix1.1.0" />
                                    <input type="number" step="0.1" class="input input-bordered input-sm" wire:model="matrix1.1.1" />
                            </div>
                        </div>

                        {{-- Matrix 2 --}}
                        <div>
                            <label class="label">
                                <span class="label-text font-bold">Matrix B</span>
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                    <input type="number" step="0.1" class="input input-bordered input-sm" wire:model="matrix2.0.0" />
                                    <input type="number" step="0.1" class="input input-bordered input-sm" wire:model="matrix2.0.1" />
                                    <input type="number" step="0.1" class="input input-bordered input-sm" wire:model="matrix2.1.0" />
                                    <input type="number" step="0.1" class="input input-bordered input-sm" wire:model="matrix2.1.1" />
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 items-end">
                        <div class="flex-1">
                                <label class="label">
                                    <span class="label-text">Operation</span>
                                </label>
                                <select class="select select-bordered w-full" wire:model="matrixOperation">
                                    <option value="add">Addition (A + B)</option>
                                    <option value="subtract">Subtraction (A - B)</option>
                                    <option value="multiply">Multiplication (A × B)</option>
                                </select>
                        </div>
                            <button 
                                class="btn btn-primary"
                                wire:click="calculateMatrix">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate
                            </button>
                    </div>

                    @if($matrixResult !== null)
                            <div class="card bg-base-100">
                                <div class="card-body">
                                    <h3 class="card-title">Result Matrix</h3>
                            <div class="flex justify-center">
                                <div class="grid grid-cols-2 gap-3 max-w-xs">
                                    @foreach($matrixResult as $row)
                                        @foreach($row as $value)
                                            <div class="stat bg-base-100 rounded-lg p-3">
                                                <div class="stat-value text-primary text-center text-xl">
                                                    {{ number_format($value, 2) }}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                                </div>
                            </div>
                    @endif
                </div>

            @elseif($selectedTool === 'statistics')
                {{-- Statistics Calculator --}}
                    <h2 class="card-title text-base-content">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Statistics Calculator
                    </h2>

                <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                    <div>
                                <h3 class="font-bold">Statistical Analysis</h3>
                                <div class="text-xs">Enter a comma-separated list of numbers to calculate mean, median, and standard deviation.</div>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Data Set (comma-separated)</span>
                            </label>
                            <textarea 
                                class="textarea textarea-bordered h-24" 
                            wire:model="dataSet" 
                                placeholder="Enter numbers separated by commas (e.g., 1, 2, 3, 4, 5)"></textarea>
                            <label class="label">
                                <span class="label-text-alt">Example: 1, 2, 3, 4, 5</span>
                            </label>
                    </div>

                    <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="calculateStatistics">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Statistics
                            </button>
                    </div>

                    @if($mean !== null)
                            <div class="card bg-base-100">
                                <div class="card-body">
                                    <h3 class="card-title">Statistical Results</h3>
                            <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                                <div class="stat">
                                    <div class="stat-figure text-primary">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>
                                    </div>
                                    <div class="stat-title">Mean (μ)</div>
                                    <div class="stat-value text-primary text-2xl">{{ number_format($mean, 4) }}</div>
                                    <div class="stat-desc">Average value</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-figure text-secondary">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                                </svg>
                                    </div>
                                    <div class="stat-title">Median</div>
                                    <div class="stat-value text-secondary text-2xl">{{ number_format($median, 4) }}</div>
                                    <div class="stat-desc">Middle value</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-figure text-accent">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                                </svg>
                                    </div>
                                    <div class="stat-title">Std Dev (σ)</div>
                                    <div class="stat-value text-accent text-2xl">{{ number_format($stdDev, 4) }}</div>
                                    <div class="stat-desc">Dispersion</div>
                                </div>
                            </div>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($selectedTool === 'derivative')
                    {{-- Derivative Calculator --}}
                    <h2 class="card-title text-base-content">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Derivative Calculator
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Calculate Derivatives</h3>
                                <div class="text-xs">Find the derivative of basic functions using calculus rules.<br>Supported: x^n, sin(x), cos(x), sqrt(x), constants</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Function</span>
                                </label>
                                <select class="select select-bordered w-full" wire:model="derivativeFunction">
                                    <option value="x^2">x²</option>
                                    <option value="x^3">x³</option>
                                    <option value="x">x</option>
                                    <option value="sin(x)">sin(x)</option>
                                    <option value="cos(x)">cos(x)</option>
                                    <option value="sqrt(x)">√x</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="calculateDerivative">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Derivative
                            </button>
                        </div>

                        @if($derivativeResult)
                            <div class="card bg-base-100">
                                <div class="card-body">
                                    <h3 class="card-title">Derivative Result</h3>
                                    <div class="space-y-3">
                                        <div class="stat bg-base-100 rounded-lg">
                                            <div class="stat-title">f'(x) =</div>
                                            <div class="stat-value text-primary text-2xl">{{ $derivativeResult }}</div>
                                        </div>
                                        
                                        @if(count($derivativeSteps) > 0)
                                            <div class="collapse collapse-arrow bg-base-100">
                                                <input type="checkbox" />
                                                <div class="collapse-title text-sm font-medium">
                                                    Show Steps
                                                </div>
                                                <div class="collapse-content">
                                                    <div class="space-y-2 text-sm">
                                                        @foreach($derivativeSteps as $step)
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                <span>{{ $step }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($selectedTool === 'converter')
                    {{-- Unit Converter --}}
                    <h2 class="card-title text-base-content">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        Unit Converter
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Convert Units</h3>
                                <div class="text-xs">Convert between different units of measurement for length, weight, and temperature.</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Category</span>
                                </label>
                                <select class="select select-bordered w-full" wire:model="converterCategory">
                                    <option value="length">Length</option>
                                    <option value="weight">Weight</option>
                                    <option value="temperature">Temperature</option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Value</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.01"
                                    class="input input-bordered w-full" 
                                    wire:model="converterValue"
                                    placeholder="Enter value to convert" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">From Unit</span>
                                </label>
                                <select class="select select-bordered w-full" wire:model="converterFrom">
                                    <option value="meter">Meter</option>
                                    <option value="kilometer">Kilometer</option>
                                    <option value="centimeter">Centimeter</option>
                                    <option value="millimeter">Millimeter</option>
                                    <option value="inch">Inch</option>
                                    <option value="foot">Foot</option>
                                    <option value="yard">Yard</option>
                                    <option value="mile">Mile</option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">To Unit</span>
                                </label>
                                <select class="select select-bordered w-full" wire:model="converterTo">
                                    <option value="meter">Meter</option>
                                    <option value="kilometer">Kilometer</option>
                                    <option value="centimeter">Centimeter</option>
                                    <option value="millimeter">Millimeter</option>
                                    <option value="inch">Inch</option>
                                    <option value="foot">Foot</option>
                                    <option value="yard">Yard</option>
                                    <option value="mile">Mile</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="convertUnits">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                Convert
                            </button>
                        </div>

                        @if($converterResult > 0)
                            <div class="card bg-base-100">
                                <div class="card-body">
                                    <h3 class="card-title">Conversion Result</h3>
                                    <div class="stat bg-base-100 rounded-lg">
                                        <div class="stat-title">{{ number_format($converterValue, 2) }} {{ ucfirst($converterFrom) }}</div>
                                        <div class="stat-value text-primary text-2xl">=</div>
                                        <div class="stat-title">{{ number_format($converterResult, 4) }} {{ ucfirst($converterTo) }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($selectedTool === 'graphing')
                    {{-- Graphing Calculator --}}
                    <h2 class="card-title text-base-content">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Graphing Calculator
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Function Graphing</h3>
                                <div class="text-xs">Generate graphs for mathematical functions. Adjust the range to explore different domains.</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Function</span>
                                </label>
                                <select class="select select-bordered w-full" wire:model="graphFunction">
                                    <option value="x^2">f(x) = x²</option>
                                    <option value="x^3">f(x) = x³</option>
                                    <option value="x">f(x) = x</option>
                                    <option value="sin(x)">f(x) = sin(x)</option>
                                    <option value="cos(x)">f(x) = cos(x)</option>
                                    <option value="sqrt(x)">f(x) = √x</option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Min X</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="1"
                                    class="input input-bordered w-full" 
                                    wire:model="graphMinX"
                                    placeholder="Minimum X value" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Max X</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="1"
                                    class="input input-bordered w-full" 
                                    wire:model="graphMaxX"
                                    placeholder="Maximum X value" />
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="generateGraph">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Generate Graph
                            </button>
                        </div>

                        @if(count($graphPoints) > 0)
                            <div class="card bg-base-100">
                                <div class="card-body">
                                    <h3 class="card-title">Function Graph: {{ $graphFunction }}</h3>
                                    <div class="space-y-4">
                                        {{-- Simple ASCII-style graph representation --}}
                                        <div class="bg-base-100 p-4 rounded-lg">
                                            <div class="text-center text-sm font-mono">
                                                <div class="mb-2">Graph Points (first 20):</div>
                                                <div class="grid grid-cols-5 gap-2 text-xs">
                                                    @foreach(array_slice($graphPoints, 0, 20) as $point)
                                                        <div class="bg-primary/10 p-1 rounded">
                                                            ({{ $point['x'] }}, {{ $point['y'] }})
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if(count($graphPoints) > 20)
                                                    <div class="mt-2 text-base-content/70">
                                                        ... and {{ count($graphPoints) - 20 }} more points
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="stats shadow w-full">
                                            <div class="stat">
                                                <div class="stat-title">Total Points</div>
                                                <div class="stat-value text-primary">{{ count($graphPoints) }}</div>
                                                <div class="stat-desc">Generated</div>
                                            </div>
                                            <div class="stat">
                                                <div class="stat-title">Domain</div>
                                                <div class="stat-value text-secondary">{{ $graphMinX }} to {{ $graphMaxX }}</div>
                                                <div class="stat-desc">X Range</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            @endif
            </div>
        </div>
    </div>
</div>