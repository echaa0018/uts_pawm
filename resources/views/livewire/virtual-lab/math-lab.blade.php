<div>
    {{-- Math Virtual Lab --}}
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        {{-- Sidebar with Tools --}}
        <x-card class="lg:col-span-1">
            <x-slot:title>
                <div class="flex items-center gap-2">
                    <x-icon name="o-calculator" class="w-5 h-5" />
                    Math Tools
                </div>
            </x-slot:title>

            <x-menu class="text-xs space-y-1">
                <x-menu-item 
                    title="Quadratic Equation" 
                    icon="o-variable"
                    wire:click="selectTool('quadratic')"
                    :active="$selectedTool === 'quadratic'" />
                
                <x-menu-item 
                    title="Matrix Calculator" 
                    icon="o-table-cells"
                    wire:click="selectTool('matrix')"
                    :active="$selectedTool === 'matrix'" />
                
                <x-menu-item 
                    title="Statistics" 
                    icon="o-chart-bar"
                    wire:click="selectTool('statistics')"
                    :active="$selectedTool === 'statistics'" />
            </x-menu>
        </x-card>

        {{-- Main Content Area --}}
        <x-card class="lg:col-span-3">
            @if($selectedTool === 'quadratic')
                {{-- Quadratic Equation Solver --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-variable" class="w-5 h-5" />
                        Quadratic Equation Solver
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Solve: ax² + bx + c = 0</x-slot:title>
                        Enter the coefficients a, b, and c to find the roots using the quadratic formula.
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-input 
                                label="Coefficient a" 
                                wire:model="a" 
                                type="number"
                                step="0.1"
                                icon="o-variable"
                                hint="a ≠ 0" />
                        </div>

                        <div>
                            <x-input 
                                label="Coefficient b" 
                                wire:model="b" 
                                type="number"
                                step="0.1"
                                icon="o-variable" />
                        </div>

                        <div>
                            <x-input 
                                label="Coefficient c" 
                                wire:model="c" 
                                type="number"
                                step="0.1"
                                icon="o-variable" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Solve Equation" 
                            icon="o-calculator"
                            wire:click="solveQuadratic" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($discriminant !== null)
                        <x-card class="bg-base-200">
                            <x-slot:title>Results</x-slot:title>
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
                        </x-card>
                    @endif
                </div>

            @elseif($selectedTool === 'matrix')
                {{-- Matrix Calculator --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-table-cells" class="w-5 h-5" />
                        Matrix Calculator (2×2)
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Matrix Operations</x-slot:title>
                        Perform addition, subtraction, or multiplication on 2×2 matrices.
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Matrix 1 --}}
                        <div>
                            <label class="label">
                                <span class="label-text font-bold">Matrix A</span>
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                <x-input wire:model="matrix1.0.0" type="number" step="0.1" />
                                <x-input wire:model="matrix1.0.1" type="number" step="0.1" />
                                <x-input wire:model="matrix1.1.0" type="number" step="0.1" />
                                <x-input wire:model="matrix1.1.1" type="number" step="0.1" />
                            </div>
                        </div>

                        {{-- Matrix 2 --}}
                        <div>
                            <label class="label">
                                <span class="label-text font-bold">Matrix B</span>
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                <x-input wire:model="matrix2.0.0" type="number" step="0.1" />
                                <x-input wire:model="matrix2.0.1" type="number" step="0.1" />
                                <x-input wire:model="matrix2.1.0" type="number" step="0.1" />
                                <x-input wire:model="matrix2.1.1" type="number" step="0.1" />
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 items-end">
                        <div class="flex-1">
                            <x-select 
                                label="Operation"
                                wire:model="matrixOperation"
                                :options="[
                                    ['id' => 'add', 'name' => 'Addition (A + B)'],
                                    ['id' => 'subtract', 'name' => 'Subtraction (A - B)'],
                                    ['id' => 'multiply', 'name' => 'Multiplication (A × B)']
                                ]"
                                option-value="id"
                                option-label="name" />
                        </div>
                        <x-button 
                            label="Calculate" 
                            icon="o-calculator"
                            wire:click="calculateMatrix" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($matrixResult !== null)
                        <x-card class="bg-base-200">
                            <x-slot:title>Result Matrix</x-slot:title>
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
                        </x-card>
                    @endif
                </div>

            @elseif($selectedTool === 'statistics')
                {{-- Statistics Calculator --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-chart-bar" class="w-5 h-5" />
                        Statistics Calculator
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Statistical Analysis</x-slot:title>
                        Enter a comma-separated list of numbers to calculate mean, median, and standard deviation.
                    </x-alert>

                    <div>
                        <x-textarea 
                            label="Data Set (comma-separated)" 
                            wire:model="dataSet" 
                            rows="3"
                            hint="Example: 1, 2, 3, 4, 5"
                            placeholder="Enter numbers separated by commas" />
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate Statistics" 
                            icon="o-calculator"
                            wire:click="calculateStatistics" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($mean !== null)
                        <x-card class="bg-base-200">
                            <x-slot:title>Statistical Results</x-slot:title>
                            <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                                <div class="stat">
                                    <div class="stat-figure text-primary">
                                        <x-icon name="o-chart-bar" class="w-8 h-8" />
                                    </div>
                                    <div class="stat-title">Mean (μ)</div>
                                    <div class="stat-value text-primary text-2xl">{{ number_format($mean, 4) }}</div>
                                    <div class="stat-desc">Average value</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-figure text-secondary">
                                        <x-icon name="o-arrows-up-down" class="w-8 h-8" />
                                    </div>
                                    <div class="stat-title">Median</div>
                                    <div class="stat-value text-secondary text-2xl">{{ number_format($median, 4) }}</div>
                                    <div class="stat-desc">Middle value</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-figure text-accent">
                                        <x-icon name="o-arrows-pointing-out" class="w-8 h-8" />
                                    </div>
                                    <div class="stat-title">Std Dev (σ)</div>
                                    <div class="stat-value text-accent text-2xl">{{ number_format($stdDev, 4) }}</div>
                                    <div class="stat-desc">Dispersion</div>
                                </div>
                            </div>
                        </x-card>
                    @endif
                </div>
            @endif
        </x-card>
    </div>
</div>
