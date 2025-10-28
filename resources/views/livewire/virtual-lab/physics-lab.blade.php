<div>
    {{-- Physics Virtual Lab --}}
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        {{-- Sidebar with Experiments --}}
        <div class="card bg-base-100 shadow-xl lg:col-span-1">
            <div class="card-body">
                <h2 class="card-title">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    Experiments
                </h2>

                <div class="menu text-sm space-y-1">
                    <button 
                        class="menu-item {{ $selectedExperiment === 'pendulum' ? 'active' : '' }}"
                        wire:click="selectExperiment('pendulum')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Simple Pendulum
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'projectile' ? 'active' : '' }}"
                        wire:click="selectExperiment('projectile')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"></path>
                        </svg>
                        Projectile Motion
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'freefall' ? 'active' : '' }}"
                        wire:click="selectExperiment('freefall')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        Free Fall
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'circular' ? 'active' : '' }}"
                        wire:click="selectExperiment('circular')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Circular Motion
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'wave' ? 'active' : '' }}"
                        wire:click="selectExperiment('wave')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Wave Motion
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'energy' ? 'active' : '' }}"
                        wire:click="selectExperiment('energy')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Energy Conservation
                    </button>
                </div>
            </div>
        </div>

        {{-- Main Content Area --}}
        <div class="card bg-base-100 shadow-xl lg:col-span-3">
            <div class="card-body">
                @if($selectedExperiment === 'pendulum')
                    {{-- Simple Pendulum Experiment --}}
                    <h2 class="card-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Simple Pendulum
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Experiment Description</h3>
                                <div class="text-xs">Calculate the period of a simple pendulum using the formula: T = 2π√(L/g)<br>where L is the length and g = 9.81 m/s²</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Pendulum Length (m)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="pendulumLength"
                                    placeholder="Enter length in meters" />
                                <label class="label">
                                    <span class="label-text-alt">Length in meters</span>
                                </label>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Initial Angle (degrees)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="1" 
                                    min="1" 
                                    max="90"
                                    class="input input-bordered w-full" 
                                    wire:model="pendulumAngle"
                                    placeholder="Enter angle from vertical" />
                                <label class="label">
                                    <span class="label-text-alt">Angle from vertical</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="calculatePendulum">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Period
                            </button>
                        </div>

                        @if($pendulumPeriod > 0)
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h3 class="card-title">Results</h3>
                                    <div class="stats shadow w-full">
                                        <div class="stat">
                                            <div class="stat-title">Period (T)</div>
                                            <div class="stat-value text-primary">{{ number_format($pendulumPeriod, 3) }}</div>
                                            <div class="stat-desc">seconds</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Frequency</div>
                                            <div class="stat-value text-secondary">{{ number_format(1/$pendulumPeriod, 3) }}</div>
                                            <div class="stat-desc">Hz</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($selectedExperiment === 'projectile')
                    {{-- Projectile Motion Experiment --}}
                    <h2 class="card-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"></path>
                        </svg>
                        Projectile Motion
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Experiment Description</h3>
                                <div class="text-xs">Calculate the trajectory of a projectile launched at an angle. Uses kinematic equations to find max height, range, and time of flight.</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Initial Velocity (m/s)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="1" 
                                    min="1"
                                    class="input input-bordered w-full" 
                                    wire:model="initialVelocity"
                                    placeholder="Enter speed at launch" />
                                <label class="label">
                                    <span class="label-text-alt">Speed at launch</span>
                                </label>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Launch Angle (degrees)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="1" 
                                    min="0" 
                                    max="90"
                                    class="input input-bordered w-full" 
                                    wire:model="launchAngle"
                                    placeholder="Enter angle from horizontal" />
                                <label class="label">
                                    <span class="label-text-alt">Angle from horizontal</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="calculateProjectile">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Trajectory
                            </button>
                        </div>

                        @if($range > 0)
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h3 class="card-title">Results</h3>
                                    <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                                        <div class="stat">
                                            <div class="stat-title">Max Height</div>
                                            <div class="stat-value text-primary text-2xl">{{ number_format($maxHeight, 2) }}</div>
                                            <div class="stat-desc">meters</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Range</div>
                                            <div class="stat-value text-secondary text-2xl">{{ number_format($range, 2) }}</div>
                                            <div class="stat-desc">meters</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Time of Flight</div>
                                            <div class="stat-value text-accent text-2xl">{{ number_format($timeOfFlight, 2) }}</div>
                                            <div class="stat-desc">seconds</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($selectedExperiment === 'freefall')
                    {{-- Free Fall Experiment --}}
                    <h2 class="card-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        Free Fall
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Experiment Description</h3>
                                <div class="text-xs">Calculate the motion of an object falling under gravity (g = 9.81 m/s²). Determines time to fall and final velocity.</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Drop Height (m)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="dropHeight"
                                    placeholder="Enter initial height in meters" />
                                <label class="label">
                                    <span class="label-text-alt">Initial height in meters</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="calculateFreeFall">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Fall
                            </button>
                        </div>

                        @if($fallTime > 0)
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h3 class="card-title">Results</h3>
                                    <div class="stats shadow w-full">
                                        <div class="stat">
                                            <div class="stat-title">Fall Time</div>
                                            <div class="stat-value text-primary">{{ number_format($fallTime, 3) }}</div>
                                            <div class="stat-desc">seconds</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Final Velocity</div>
                                            <div class="stat-value text-secondary">{{ number_format($finalVelocity, 2) }}</div>
                                            <div class="stat-desc">m/s</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($selectedExperiment === 'circular')
                    {{-- Circular Motion Experiment --}}
                    <h2 class="card-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Circular Motion
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Circular Motion Analysis</h3>
                                <div class="text-xs">Calculate period, angular velocity, and centripetal force for uniform circular motion.<br>Formulas: T = 2πr/v, ω = v/r, F = mv²/r</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Radius (m)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="circularRadius"
                                    placeholder="Enter distance from center" />
                                <label class="label">
                                    <span class="label-text-alt">Distance from center</span>
                                </label>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Velocity (m/s)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="circularVelocity"
                                    placeholder="Enter tangential velocity" />
                                <label class="label">
                                    <span class="label-text-alt">Tangential velocity</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="calculateCircularMotion">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Motion
                            </button>
                        </div>

                        @if($circularPeriod > 0)
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h3 class="card-title">Circular Motion Results</h3>
                                    <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                                        <div class="stat">
                                            <div class="stat-title">Period (T)</div>
                                            <div class="stat-value text-primary text-2xl">{{ number_format($circularPeriod, 3) }}</div>
                                            <div class="stat-desc">seconds</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Angular Velocity (ω)</div>
                                            <div class="stat-value text-secondary text-2xl">{{ number_format($angularVelocity, 3) }}</div>
                                            <div class="stat-desc">rad/s</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Centripetal Force</div>
                                            <div class="stat-value text-accent text-2xl">{{ number_format($centripetalForce, 2) }}</div>
                                            <div class="stat-desc">N (for 1kg mass)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($selectedExperiment === 'wave')
                    {{-- Wave Motion Experiment --}}
                    <h2 class="card-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Wave Motion
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Wave Properties</h3>
                                <div class="text-xs">Calculate wave speed and period from frequency and wavelength.<br>Formulas: v = fλ, T = 1/f</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Frequency (Hz)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="waveFrequency"
                                    placeholder="Enter oscillations per second" />
                                <label class="label">
                                    <span class="label-text-alt">Oscillations per second</span>
                                </label>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Wavelength (m)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="waveWavelength"
                                    placeholder="Enter distance between peaks" />
                                <label class="label">
                                    <span class="label-text-alt">Distance between peaks</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="calculateWaveMotion">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Wave Properties
                            </button>
                        </div>

                        @if($waveSpeed > 0)
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h3 class="card-title">Wave Motion Results</h3>
                                    <div class="stats shadow w-full">
                                        <div class="stat">
                                            <div class="stat-title">Wave Speed</div>
                                            <div class="stat-value text-primary">{{ number_format($waveSpeed, 2) }}</div>
                                            <div class="stat-desc">m/s</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Wave Period</div>
                                            <div class="stat-value text-secondary">{{ number_format($wavePeriod, 3) }}</div>
                                            <div class="stat-desc">seconds</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif($selectedExperiment === 'energy')
                    {{-- Energy Conservation Experiment --}}
                    <h2 class="card-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Energy Conservation
                    </h2>

                    <div class="space-y-4">
                        <div class="alert alert-info">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold">Energy Conservation</h3>
                                <div class="text-xs">Calculate potential energy, kinetic energy, and total energy.<br>Formulas: PE = mgh, KE = ½mv², E = PE + KE</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Mass (kg)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0.1"
                                    class="input input-bordered w-full" 
                                    wire:model="mass"
                                    placeholder="Enter object mass" />
                                <label class="label">
                                    <span class="label-text-alt">Object mass</span>
                                </label>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Height (m)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0"
                                    class="input input-bordered w-full" 
                                    wire:model="height"
                                    placeholder="Enter height above ground" />
                                <label class="label">
                                    <span class="label-text-alt">Height above ground</span>
                                </label>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Velocity (m/s)</span>
                                </label>
                                <input 
                                    type="number" 
                                    step="0.1" 
                                    min="0"
                                    class="input input-bordered w-full" 
                                    wire:model="velocity"
                                    placeholder="Enter object velocity" />
                                <label class="label">
                                    <span class="label-text-alt">Object velocity</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                class="btn btn-primary"
                                wire:click="calculateEnergyConservation">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Energy
                            </button>
                        </div>

                        @if($totalEnergy > 0)
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h3 class="card-title">Energy Analysis</h3>
                                    <div class="space-y-4">
                                        <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                                            <div class="stat">
                                                <div class="stat-title">Potential Energy</div>
                                                <div class="stat-value text-primary text-2xl">{{ number_format($potentialEnergy, 2) }}</div>
                                                <div class="stat-desc">Joules</div>
                                            </div>
                                            <div class="stat">
                                                <div class="stat-title">Kinetic Energy</div>
                                                <div class="stat-value text-secondary text-2xl">{{ number_format($kineticEnergy, 2) }}</div>
                                                <div class="stat-desc">Joules</div>
                                            </div>
                                            <div class="stat">
                                                <div class="stat-title">Total Energy</div>
                                                <div class="stat-value text-accent text-2xl">{{ number_format($totalEnergy, 2) }}</div>
                                                <div class="stat-desc">Joules</div>
                                            </div>
                                        </div>
                                        
                                        {{-- Energy Distribution Visualization --}}
                                        <div class="bg-base-100 p-4 rounded-lg">
                                            <div class="text-sm font-bold mb-2">Energy Distribution</div>
                                            <div class="flex items-center gap-2">
                                                <div class="flex-1">
                                                    <div class="text-xs mb-1">Potential Energy</div>
                                                    <div class="w-full bg-base-200 rounded-full h-4">
                                                        <div class="bg-primary h-4 rounded-full" 
                                                             style="width: {{ $potentialEnergy > 0 ? ($potentialEnergy / $totalEnergy) * 100 : 0 }}%"></div>
                                                    </div>
                                                    <div class="text-xs text-primary">{{ number_format(($potentialEnergy / $totalEnergy) * 100, 1) }}%</div>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="text-xs mb-1">Kinetic Energy</div>
                                                    <div class="w-full bg-base-200 rounded-full h-4">
                                                        <div class="bg-secondary h-4 rounded-full" 
                                                             style="width: {{ $kineticEnergy > 0 ? ($kineticEnergy / $totalEnergy) * 100 : 0 }}%"></div>
                                                    </div>
                                                    <div class="text-xs text-secondary">{{ number_format(($kineticEnergy / $totalEnergy) * 100, 1) }}%</div>
                                                </div>
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