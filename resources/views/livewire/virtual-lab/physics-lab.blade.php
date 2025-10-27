<div>
    {{-- Physics Virtual Lab --}}
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        {{-- Sidebar with Experiments --}}
        <x-card class="lg:col-span-1">
            <x-slot:title>
                <div class="flex items-center gap-2">
                    <x-icon name="o-beaker" class="w-5 h-5" />
                    Experiments
                </div>
            </x-slot:title>

            <x-menu class="text-xs space-y-1">
                <x-menu-item 
                    title="Simple Pendulum" 
                    icon="o-arrow-path-rounded-square"
                    wire:click="selectExperiment('pendulum')"
                    :active="$selectedExperiment === 'pendulum'" />
                
                <x-menu-item 
                    title="Projectile Motion" 
                    icon="o-arrow-up-right"
                    wire:click="selectExperiment('projectile')"
                    :active="$selectedExperiment === 'projectile'" />
                
                <x-menu-item 
                    title="Free Fall" 
                    icon="o-arrow-down"
                    wire:click="selectExperiment('freefall')"
                    :active="$selectedExperiment === 'freefall'" />
            </x-menu>
        </x-card>

        {{-- Main Content Area --}}
        <x-card class="lg:col-span-3">
            @if($selectedExperiment === 'pendulum')
                {{-- Simple Pendulum Experiment --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-arrow-path-rounded-square" class="w-5 h-5" />
                        Simple Pendulum
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Experiment Description</x-slot:title>
                        Calculate the period of a simple pendulum using the formula: T = 2π√(L/g)
                        <br>where L is the length and g = 9.81 m/s²
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input 
                                label="Pendulum Length (m)" 
                                wire:model="pendulumLength" 
                                type="number"
                                step="0.1"
                                min="0.1"
                                icon="o-arrow-down-circle"
                                hint="Length in meters" />
                        </div>

                        <div>
                            <x-input 
                                label="Initial Angle (degrees)" 
                                wire:model="pendulumAngle" 
                                type="number"
                                step="1"
                                min="1"
                                max="90"
                                icon="o-arrow-trending-up"
                                hint="Angle from vertical" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate Period" 
                            icon="o-calculator"
                            wire:click="calculatePendulum" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($pendulumPeriod > 0)
                        <x-card class="bg-base-200">
                            <x-slot:title>Results</x-slot:title>
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
                        </x-card>
                    @endif
                </div>

            @elseif($selectedExperiment === 'projectile')
                {{-- Projectile Motion Experiment --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-arrow-up-right" class="w-5 h-5" />
                        Projectile Motion
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Experiment Description</x-slot:title>
                        Calculate the trajectory of a projectile launched at an angle. 
                        Uses kinematic equations to find max height, range, and time of flight.
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input 
                                label="Initial Velocity (m/s)" 
                                wire:model="initialVelocity" 
                                type="number"
                                step="1"
                                min="1"
                                icon="o-bolt"
                                hint="Speed at launch" />
                        </div>

                        <div>
                            <x-input 
                                label="Launch Angle (degrees)" 
                                wire:model="launchAngle" 
                                type="number"
                                step="1"
                                min="0"
                                max="90"
                                icon="o-arrow-trending-up"
                                hint="Angle from horizontal" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate Trajectory" 
                            icon="o-calculator"
                            wire:click="calculateProjectile" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($range > 0)
                        <x-card class="bg-base-200">
                            <x-slot:title>Results</x-slot:title>
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
                        </x-card>
                    @endif
                </div>

            @elseif($selectedExperiment === 'freefall')
                {{-- Free Fall Experiment --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-arrow-down" class="w-5 h-5" />
                        Free Fall
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Experiment Description</x-slot:title>
                        Calculate the motion of an object falling under gravity (g = 9.81 m/s²).
                        Determines time to fall and final velocity.
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input 
                                label="Drop Height (m)" 
                                wire:model="dropHeight" 
                                type="number"
                                step="0.1"
                                min="0.1"
                                icon="o-arrow-down-circle"
                                hint="Initial height in meters" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate Fall" 
                            icon="o-calculator"
                            wire:click="calculateFreeFall" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($fallTime > 0)
                        <x-card class="bg-base-200">
                            <x-slot:title>Results</x-slot:title>
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
                        </x-card>
                    @endif
                </div>
            @endif
        </x-card>
    </div>
</div>
