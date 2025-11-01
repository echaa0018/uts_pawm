<div>
    {{-- Physics Lab - Interactive Simulations --}}
    
    <div class="space-y-6">
        {{-- Header--}}
        <x-card>
            <div class="text-center space-y-4">
                <div class="flex justify-center">
                    <div class="bg-primary/10 p-6 rounded-full">
                        <x-icon name="o-bolt" class="w-20 h-20 text-primary" />
                    </div>
                </div>
                <h1 class="text-3xl font-bold">Physics Lab - Virtual Experiments</h1>
                <p class="text-lg text-base-content/70">
                    Interactive physics experiments with real-time visualizations
                </p>
            </div>
        </x-card>

        {{-- Experiment Selection and Formulas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                {{-- Experiment Selection --}}
                <x-card class="h-fit">
                    <h2 class="text-xl font-semibold mb-4">Select an Experiment</h2>
                    <div class="flex flex-col gap-2">
                        <button 
                            wire:click="setExperiment('projectile')"
                            class="btn {{ $activeExperiment === 'projectile' ? 'btn-primary' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-arrow-trending-up" class="w-5 h-5 mr-2" />
                            Projectile Motion
                        </button>
                        <button 
                            wire:click="setExperiment('pendulum')"
                            class="btn {{ $activeExperiment === 'pendulum' ? 'btn-primary' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-arrow-path" class="w-5 h-5 mr-2" />
                            Pendulum
                        </button>
                        <button 
                            wire:click="setExperiment('spring')"
                            class="btn {{ $activeExperiment === 'spring' ? 'btn-primary' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-arrows-up-down" class="w-5 h-5 mr-2" />
                            Spring-Mass
                        </button>
                        <button 
                            wire:click="setExperiment('freefall')"
                            class="btn {{ $activeExperiment === 'freefall' ? 'btn-primary' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-arrow-down" class="w-5 h-5 mr-2" />
                            Free Fall
                        </button>
                    </div>
                </x-card>

                {{-- Experiment Description --}}
                <x-card class="h-fit">
                    <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
                        <x-icon name="o-information-circle" class="w-5 h-5" />
                        About This Experiment
                    </h2>
                    <div class="text-sm text-base-content/80">
                        @if($activeExperiment === 'projectile')
                        <p class="mb-2"><strong>Projectile Motion</strong> describes the motion of an object thrown or projected into the air, subject only to acceleration due to gravity.</p>
                        <p>This experiment simulates the parabolic trajectory of a projectile launched at an angle. You can adjust the initial velocity, launch angle, and gravity to see how they affect the range, maximum height, and time of flight.</p>
                        
                        @elseif($activeExperiment === 'pendulum')
                        <p class="mb-2"><strong>Pendulum Motion</strong> demonstrates periodic oscillation under the influence of gravity with air resistance damping.</p>
                        <p>This experiment simulates a simple pendulum with realistic damping effects. The pendulum gradually loses energy due to air resistance, causing the amplitude to decrease over time until it comes to rest. The damping coefficient is automatically calculated based on the pendulum length.</p>
                        
                        @elseif($activeExperiment === 'spring')
                        <p class="mb-2"><strong>Spring-Mass System</strong> demonstrates harmonic oscillation with friction-based damping following Hooke's Law.</p>
                        <p>This experiment simulates a mass attached to a spring with realistic friction damping. The system oscillates back and forth, gradually losing energy due to friction until it reaches equilibrium. The damping is set to 10% of critical damping for realistic behavior.</p>
                        
                        @elseif($activeExperiment === 'freefall')
                        <p class="mb-2"><strong>Free Fall</strong> demonstrates motion under the sole influence of gravity, starting from rest.</p>
                        <p>This experiment simulates an object dropped from a height with no initial velocity. You can observe how the object accelerates uniformly under gravity, and see both the position and velocity change over time as it falls.</p>
                        @endif
                    </div>
                </x-card>
            </div>
            
            {{-- Physics Formulas --}}
            <x-card>
                <h2 class="text-xl font-semibold mb-4">📚 Physics Formulas</h2>
                <div class="text-sm space-y-4">
                    @if($activeExperiment === 'projectile')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Projectile Motion</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• Range: R = (v₀² × sin(2θ)) / g</li>
                            <li>• Max Height: H = (v₀² × sin²(θ)) / (2g)</li>
                            <li>• Time of Flight: T = (2v₀ × sin(θ)) / g</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• v₀ = Initial velocity (m/s)</li>
                                <li>• θ = Launch angle (degrees)</li>
                                <li>• g = Gravitational acceleration (m/s²)</li>
                                <li>• R = Horizontal range (m)</li>
                                <li>• H = Maximum height (m)</li>
                                <li>• T = Time of flight (s)</li>
                            </ul>
                        </div>
                    </div>
                    
                    {{-- Calculated Results --}}
                    @php
                        $angleRad = deg2rad($angle);
                        $vx = $velocity * cos($angleRad);
                        $vy = $velocity * sin($angleRad);
                        $calcRange = ($velocity ** 2 * sin(2 * $angleRad)) / $gravity;
                        $calcMaxHeight = ($vy ** 2) / (2 * $gravity);
                        $calcTimeOfFlight = (2 * $vy) / $gravity;
                    @endphp
                    <div class="bg-primary/10 border border-primary/30 p-4 rounded-lg">
                        <h3 class="font-semibold mb-3 text-primary flex items-center gap-2">
                            <x-icon name="o-calculator" class="w-4 h-4" />
                            Calculated Results
                        </h3>
                        <div class="space-y-3 text-xs">
                            {{-- Input Variables --}}
                            <div class="bg-base-100/50 p-2 rounded border border-primary/20">
                                <div class="font-semibold text-primary mb-1">Input Variables:</div>
                                <div class="space-y-1">
                                    <div>v₀ = {{ $velocity }} m/s</div>
                                    <div>θ = {{ $angle }}°</div>
                                    <div>g = {{ $gravity }} m/s²</div>
                                </div>
                            </div>
                            {{-- Results --}}
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Range (R):</span>
                                    <span class="font-bold">{{ number_format($calcRange, 2) }} m</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Max Height (H):</span>
                                    <span class="font-bold">{{ number_format($calcMaxHeight, 2) }} m</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Time of Flight (T):</span>
                                    <span class="font-bold">{{ number_format($calcTimeOfFlight, 2) }} s</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @elseif($activeExperiment === 'pendulum')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Damped Pendulum (Air Resistance)</h3>
                        <ul class="space-y-1 text-xs mb-3">
                            <li>• Period (undamped): T = 2π√(L/g)</li>
                            <li>• Angular Frequency: ω = √(g/L)</li>
                            <li>• Damping: b = 0.1√L (from air resistance)</li>
                            <li>• Damping Ratio: ζ = b/(2ω)</li>
                            <li>• Damped Frequency: ω_d = ω√(1-ζ²)</li>
                            <li>• Position: θ(t) = θ₀e^(-bt)cos(ω_d·t)</li>
                            <li>• Energy decreases exponentially</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• L = Length of pendulum (m)</li>
                                <li>• θ₀ = Initial angle (degrees)</li>
                                <li>• g = Gravitational acceleration (m/s²)</li>
                                <li>• T = Period of oscillation (s)</li>
                                <li>• ω = Angular frequency (rad/s)</li>
                                <li>• b = Damping coefficient</li>
                                <li>• ζ = Damping ratio</li>
                                <li>• ω_d = Damped frequency (rad/s)</li>
                            </ul>
                        </div>
                    </div>
                    
                    {{-- Calculated Results --}}
                    @php
                        $calcPeriod = 2 * pi() * sqrt($pendulumLength / $pendulumGravity);
                        $calcOmega = sqrt($pendulumGravity / $pendulumLength);
                        $calcDamping = 0.1 * sqrt($pendulumLength);
                        $calcDampingRatio = $calcDamping / (2 * $calcOmega);
                        $calcDampedOmega = $calcOmega * sqrt(abs(1 - $calcDampingRatio ** 2));
                        $calcFrequency = 1 / $calcPeriod;
                    @endphp
                    <div class="bg-secondary/10 border border-secondary/30 p-4 rounded-lg">
                        <h3 class="font-semibold mb-3 text-secondary flex items-center gap-2">
                            <x-icon name="o-calculator" class="w-4 h-4" />
                            Calculated Results
                        </h3>
                        <div class="space-y-3 text-xs">
                            {{-- Input Variables --}}
                            <div class="bg-base-100/50 p-2 rounded border border-secondary/20">
                                <div class="font-semibold text-secondary mb-1">Input Variables:</div>
                                <div class="space-y-1">
                                    <div>L = {{ $pendulumLength }} m</div>
                                    <div>θ₀ = {{ $pendulumAngle }}°</div>
                                    <div>g = {{ $pendulumGravity }} m/s²</div>
                                </div>
                            </div>
                            {{-- Results --}}
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Period (T):</span>
                                    <span class="font-bold">{{ number_format($calcPeriod, 3) }} s</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Frequency (f):</span>
                                    <span class="font-bold">{{ number_format($calcFrequency, 3) }} Hz</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Angular Freq (ω):</span>
                                    <span class="font-bold">{{ number_format($calcOmega, 3) }} rad/s</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Damping (b):</span>
                                    <span class="font-bold">{{ number_format($calcDamping, 3) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Damping Ratio (ζ):</span>
                                    <span class="font-bold">{{ number_format($calcDampingRatio, 3) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @elseif($activeExperiment === 'spring')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Damped Spring-Mass (Friction)</h3>
                        <ul class="space-y-1 text-xs mb-3">
                            <li>• Period (undamped): T = 2π√(m/k)</li>
                            <li>• Angular Frequency: ω = √(k/m)</li>
                            <li>• Critical Damping: c_c = 2√(km)</li>
                            <li>• Damping: c = 0.1c_c (10% of critical)</li>
                            <li>• Damping Ratio: ζ = c/(2√(km))</li>
                            <li>• Damped Frequency: ω_d = ω√(1-ζ²)</li>
                            <li>• Position: x(t) = Ae^(-ct/2m)cos(ω_d·t)</li>
                            <li>• Energy decreases exponentially</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• m = Mass (kg)</li>
                                <li>• k = Spring constant (N/m)</li>
                                <li>• x₀ = Initial displacement (m)</li>
                                <li>• T = Period of oscillation (s)</li>
                                <li>• ω = Angular frequency (rad/s)</li>
                                <li>• c_c = Critical damping coefficient (Ns/m)</li>
                                <li>• c = Damping coefficient (Ns/m)</li>
                                <li>• ζ = Damping ratio</li>
                                <li>• ω_d = Damped frequency (rad/s)</li>
                            </ul>
                        </div>
                    </div>
                    
                    {{-- Calculated Results --}}
                    @php
                        $calcAngularFreq = sqrt($springConstant / $mass);
                        $calcSpringPeriod = (2 * pi()) / $calcAngularFreq;
                        $calcSpringFrequency = 1 / $calcSpringPeriod;
                        $calcCriticalDamping = 2 * sqrt($springConstant * $mass);
                        $calcSpringDamping = 0.1 * $calcCriticalDamping;
                        $calcSpringDampingRatio = $calcSpringDamping / (2 * sqrt($springConstant * $mass));
                        $calcSpringDampedOmega = $calcAngularFreq * sqrt(abs(1 - $calcSpringDampingRatio ** 2));
                    @endphp
                    <div class="bg-accent/10 border border-accent/30 p-4 rounded-lg">
                        <h3 class="font-semibold mb-3 text-accent flex items-center gap-2">
                            <x-icon name="o-calculator" class="w-4 h-4" />
                            Calculated Results
                        </h3>
                        <div class="space-y-3 text-xs">
                            {{-- Input Variables --}}
                            <div class="bg-base-100/50 p-2 rounded border border-accent/20">
                                <div class="font-semibold text-accent mb-1">Input Variables:</div>
                                <div class="space-y-1">
                                    <div>m = {{ $mass }} kg</div>
                                    <div>k = {{ $springConstant }} N/m</div>
                                    <div>x₀ = {{ $displacement }} m</div>
                                </div>
                            </div>
                            {{-- Results --}}
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Period (T):</span>
                                    <span class="font-bold">{{ number_format($calcSpringPeriod, 3) }} s</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Frequency (f):</span>
                                    <span class="font-bold">{{ number_format($calcSpringFrequency, 3) }} Hz</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Angular Freq (ω):</span>
                                    <span class="font-bold">{{ number_format($calcAngularFreq, 3) }} rad/s</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Critical Damp (c_c):</span>
                                    <span class="font-bold">{{ number_format($calcCriticalDamping, 3) }} Ns/m</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Damping (c):</span>
                                    <span class="font-bold">{{ number_format($calcSpringDamping, 3) }} Ns/m</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Damping Ratio (ζ):</span>
                                    <span class="font-bold">{{ number_format($calcSpringDampingRatio, 3) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @elseif($activeExperiment === 'freefall')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Free Fall</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• Position: y = h - ½gt²</li>
                            <li>• Velocity: v = gt</li>
                            <li>• Final Velocity: v = √(2gh)</li>
                            <li>• Time to Fall: t = √(2h/g)</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• h = Initial height (m)</li>
                                <li>• g = Gravitational acceleration (m/s²)</li>
                                <li>• y = Position/height at time t (m)</li>
                                <li>• v = Velocity (m/s)</li>
                                <li>• t = Time (s)</li>
                            </ul>
                        </div>
                    </div>
                    
                    {{-- Calculated Results --}}
                    @php
                        $calcTimeToFall = sqrt((2 * $height) / $freeFallGravity);
                        $calcFinalVelocity = $freeFallGravity * $calcTimeToFall;
                        $calcFinalVelocityAlt = sqrt(2 * $freeFallGravity * $height);
                    @endphp
                    <div class="bg-info/10 border border-info/30 p-4 rounded-lg">
                        <h3 class="font-semibold mb-3 text-info flex items-center gap-2">
                            <x-icon name="o-calculator" class="w-4 h-4" />
                            Calculated Results
                        </h3>
                        <div class="space-y-3 text-xs">
                            {{-- Input Variables --}}
                            <div class="bg-base-100/50 p-2 rounded border border-info/20">
                                <div class="font-semibold text-info mb-1">Input Variables:</div>
                                <div class="space-y-1">
                                    <div>h = {{ $height }} m</div>
                                    <div>g = {{ $freeFallGravity }} m/s²</div>
                                </div>
                            </div>
                            {{-- Results --}}
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Time to Fall (t):</span>
                                    <span class="font-bold">{{ number_format($calcTimeToFall, 3) }} s</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Final Velocity (v):</span>
                                    <span class="font-bold">{{ number_format($calcFinalVelocity, 2) }} m/s</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Impact Energy:</span>
                                    <span class="font-bold">{{ number_format($freeFallGravity * $height, 2) }} J/kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </x-card>
        </div>

        {{-- Projectile Motion Experiment --}}
        @if($activeExperiment === 'projectile')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">🎯 Projectile Motion</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-input 
                        wire:model="velocity" 
                        label="Initial Velocity (m/s)" 
                        type="number"
                        step="0.1"
                        min="0"
                    />
                    <x-input 
                        wire:model="angle" 
                        label="Launch Angle (degrees)" 
                        type="number"
                        step="1"
                        min="0"
                        max="90"
                    />
                    <x-input 
                        wire:model="gravity" 
                        label="Gravity (m/s²)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-button 
                        wire:click="calculateProjectile" 
                        class="btn-primary w-full"
                        icon="o-play"
                        spinner="calculateProjectile"
                    >
                        <span wire:loading.remove wire:target="calculateProjectile">Launch Projectile</span>
                        <span wire:loading wire:target="calculateProjectile">Calculating...</span>
                    </x-button>
                    <div id="projectileResults" class="bg-base-200 p-4 rounded-lg space-y-2 hidden">
                        <p><strong>Max Height:</strong> <span id="maxHeight">-</span> m</p>
                        <p><strong>Range:</strong> <span id="range">-</span> m</p>
                        <p><strong>Time of Flight:</strong> <span id="timeOfFlight">-</span> s</p>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="projectileCanvas" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- Pendulum Experiment --}}
        @if($activeExperiment === 'pendulum')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">⏰ Simple Pendulum (with Air Resistance)</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-input 
                        wire:model="pendulumLength" 
                        label="Length (m)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                        hint="Longer pendulums have less damping"
                    />
                    <x-input 
                        wire:model="pendulumAngle" 
                        label="Initial Angle (degrees)" 
                        type="number"
                        step="1"
                        min="1"
                        max="89"
                    />
                    <x-input 
                        wire:model="pendulumGravity" 
                        label="Gravity (m/s²)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-button 
                        wire:click="startPendulum" 
                        class="btn-primary w-full"
                        icon="o-play"
                        spinner="startPendulum"
                    >
                        <span wire:loading.remove wire:target="startPendulum">Start Pendulum</span>
                        <span wire:loading wire:target="startPendulum">Starting...</span>
                    </x-button>
                    <div id="pendulumResults" class="bg-base-200 p-4 rounded-lg space-y-2 hidden">
                        <p><strong>Period:</strong> <span id="pendulumPeriod">-</span> s</p>
                        <p><strong>Frequency:</strong> <span id="pendulumFrequency">-</span> Hz</p>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4 flex items-center justify-center" style="height: 400px;">
                        <canvas id="pendulumCanvas" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- Spring-Mass System --}}
        @if($activeExperiment === 'spring')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">🔃 Spring-Mass System (with Friction)</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-input 
                        wire:model="mass" 
                        label="Mass (kg)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                        hint="Heavier masses oscillate longer"
                    />
                    <x-input 
                        wire:model="springConstant" 
                        label="Spring Constant k (N/m)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-input 
                        wire:model="displacement" 
                        label="Initial Displacement (m)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-button 
                        wire:click="startSpring" 
                        class="btn-primary w-full"
                        icon="o-play"
                        spinner="startSpring"
                    >
                        <span wire:loading.remove wire:target="startSpring">Start Oscillation</span>
                        <span wire:loading wire:target="startSpring">Starting...</span>
                    </x-button>
                    <div id="springResults" class="bg-base-200 p-4 rounded-lg space-y-2 hidden">
                        <p><strong>Period:</strong> <span id="springPeriod">-</span> s</p>
                        <p><strong>Frequency:</strong> <span id="springFrequency">-</span> Hz</p>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4 flex items-center justify-center" style="height: 400px;">
                        <canvas id="springCanvas" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- Free Fall Experiment --}}
        @if($activeExperiment === 'freefall')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">⬇️ Free Fall Motion</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-input 
                        wire:model="height" 
                        label="Initial Height (m)" 
                        type="number"
                        step="1"
                        min="1"
                    />
                    <x-input 
                        wire:model="freeFallGravity" 
                        label="Gravity (m/s²)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-button 
                        wire:click="calculateFreeFall" 
                        class="btn-primary w-full"
                        icon="o-play"
                        spinner="calculateFreeFall"
                    >
                        <span wire:loading.remove wire:target="calculateFreeFall">Drop Object</span>
                        <span wire:loading wire:target="calculateFreeFall">Calculating...</span>
                    </x-button>
                    <div id="freeFallResults" class="bg-base-200 p-4 rounded-lg space-y-2 hidden">
                        <p><strong>Time to Fall:</strong> <span id="timeToFall">-</span> s</p>
                        <p><strong>Final Velocity:</strong> <span id="finalVelocity">-</span> m/s</p>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="freeFallCanvas" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let projectileChart = null;
        let pendulumAnimation = null;
        let springAnimation = null;
        let freeFallChart = null;

        document.addEventListener('livewire:initialized', () => {
            
            // Projectile Motion Visualization
            Livewire.on('updateProjectile', (event) => {
                console.log('Projectile event received:', event);
                const data = event;
                const ctx = document.getElementById('projectileCanvas');
                
                if (!ctx) {
                    console.error('Canvas element not found');
                    return;
                }
                
                const context = ctx.getContext('2d');
                
                if (projectileChart) {
                    projectileChart.destroy();
                }
                
                projectileChart = new Chart(context, {
                    type: 'line',
                    data: {
                        datasets: [{
                            label: 'Trajectory',
                            data: data.trajectory,
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 3,
                            pointRadius: 2,
                            tension: 0.4,
                            parsing: {
                                xAxisKey: 'x',
                                yAxisKey: 'y'
                            }
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                type: 'linear',
                                title: { display: true, text: 'Distance (m)' }
                            },
                            y: {
                                title: { display: true, text: 'Height (m)' },
                                min: 0
                            }
                        },
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });

                document.getElementById('projectileResults').classList.remove('hidden');
                document.getElementById('maxHeight').textContent = data.maxHeight;
                document.getElementById('range').textContent = data.range;
                document.getElementById('timeOfFlight').textContent = data.timeOfFlight;
            });

            // Pendulum Animation
            Livewire.on('startPendulumAnimation', (event) => {
                console.log('Pendulum event received:', event);
                const data = event;
                const canvas = document.getElementById('pendulumCanvas');
                
                if (!canvas) {
                    console.error('Pendulum canvas not found');
                    return;
                }
                
                const ctx = canvas.getContext('2d');
                
                if (pendulumAnimation) {
                    cancelAnimationFrame(pendulumAnimation);
                }

                const centerX = canvas.width / 2;
                const centerY = 50;
                const length = data.length * 80;
                const maxAngle = data.angle * Math.PI / 180;
                const damping = data.damping || 0;
                const dampedOmega = data.dampedOmega || data.omega;
                let time = 0;
                const maxTime = damping > 0 ? 30 : 60; // Stop after 30s if damped, 60s if not

                function animate() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    // Calculate current angle with damping
                    // θ(t) = θ₀ * e^(-bt) * cos(ω_d * t)
                    const dampingFactor = Math.exp(-damping * time);
                    const currentAngle = maxAngle * dampingFactor * Math.cos(dampedOmega * time);
                    
                    // Calculate bob position
                    const bobX = centerX + length * Math.sin(currentAngle);
                    const bobY = centerY + length * Math.cos(currentAngle);
                    
                    // Draw pivot
                    ctx.fillStyle = '#333';
                    ctx.fillRect(centerX - 5, centerY - 5, 10, 10);
                    
                    // Draw string
                    ctx.strokeStyle = '#666';
                    ctx.lineWidth = 2;
                    ctx.beginPath();
                    ctx.moveTo(centerX, centerY);
                    ctx.lineTo(bobX, bobY);
                    ctx.stroke();
                    
                    // Draw bob with opacity based on energy (damping effect visualization)
                    const energyFactor = dampingFactor;
                    ctx.fillStyle = `rgba(59, 130, 246, ${0.3 + 0.7 * energyFactor})`;
                    ctx.beginPath();
                    ctx.arc(bobX, bobY, 15, 0, Math.PI * 2);
                    ctx.fill();
                    
                    // Draw bob outline
                    ctx.strokeStyle = '#2563eb';
                    ctx.lineWidth = 2;
                    ctx.stroke();
                    
                    time += 0.02;
                    
                    // Continue animation if there's still significant motion or no damping
                    if (time < maxTime && (dampingFactor > 0.01 || damping === 0)) {
                        pendulumAnimation = requestAnimationFrame(animate);
                    } else {
                        console.log('Pendulum stopped due to damping');
                    }
                }
                
                animate();
                
                document.getElementById('pendulumResults').classList.remove('hidden');
                document.getElementById('pendulumPeriod').textContent = data.period;
                document.getElementById('pendulumFrequency').textContent = data.frequency;
            });

            // Spring-Mass Animation
            Livewire.on('startSpringAnimation', (event) => {
                console.log('Spring event received:', event);
                const data = event;
                const canvas = document.getElementById('springCanvas');
                
                if (!canvas) {
                    console.error('Spring canvas not found');
                    return;
                }
                
                const ctx = canvas.getContext('2d');
                
                if (springAnimation) {
                    cancelAnimationFrame(springAnimation);
                }

                const centerX = canvas.width / 2;
                const equilibriumY = canvas.height / 2;
                const amplitude = data.displacement * 100;
                const damping = data.damping || 0;
                const dampingRatio = data.dampingRatio || 0;
                const dampedOmega = data.dampedOmega || data.omega;
                let time = 0;
                const maxTime = damping > 0 ? 30 : 60; // Stop after 30s if damped, 60s if not

                function animate() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    // Calculate current position with damping
                    // x(t) = A * e^(-ct/2m) * cos(ω_d * t)
                    const dampingFactor = Math.exp(-(damping / (2 * data.mass)) * time);
                    const displacement = amplitude * dampingFactor * Math.cos(dampedOmega * time);
                    const currentY = equilibriumY + displacement;
                    
                    // Draw ceiling
                    ctx.fillStyle = '#333';
                    ctx.fillRect(0, 50, canvas.width, 10);
                    
                    // Draw spring
                    ctx.strokeStyle = '#666';
                    ctx.lineWidth = 2;
                    ctx.beginPath();
                    const springCoils = 15;
                    const springWidth = 30;
                    for (let i = 0; i <= springCoils; i++) {
                        const y = 60 + (currentY - 60 - 30) * (i / springCoils);
                        const x = centerX + (i % 2 === 0 ? -springWidth : springWidth);
                        if (i === 0) {
                            ctx.moveTo(centerX, 60);
                        } else {
                            ctx.lineTo(x, y);
                        }
                    }
                    ctx.lineTo(centerX, currentY - 30);
                    ctx.stroke();
                    
                    // Draw mass with opacity based on energy (damping effect visualization)
                    const energyFactor = dampingFactor;
                    ctx.fillStyle = `rgba(59, 130, 246, ${0.3 + 0.7 * energyFactor})`;
                    ctx.fillRect(centerX - 30, currentY - 30, 60, 60);
                    
                    // Draw mass outline
                    ctx.strokeStyle = '#2563eb';
                    ctx.lineWidth = 2;
                    ctx.strokeRect(centerX - 30, currentY - 30, 60, 60);
                    
                    // Draw mass label
                    ctx.fillStyle = '#fff';
                    ctx.font = '14px Arial';
                    ctx.textAlign = 'center';
                    ctx.fillText(data.mass + ' kg', centerX, currentY + 5);
                    
                    // Draw equilibrium line
                    ctx.strokeStyle = '#ef4444';
                    ctx.setLineDash([5, 5]);
                    ctx.beginPath();
                    ctx.moveTo(centerX - 60, equilibriumY);
                    ctx.lineTo(centerX + 60, equilibriumY);
                    ctx.stroke();
                    ctx.setLineDash([]);
                    
                    time += 0.02;
                    
                    // Continue animation if there's still significant motion or no damping
                    if (time < maxTime && (dampingFactor > 0.01 || damping === 0)) {
                        springAnimation = requestAnimationFrame(animate);
                    } else {
                        console.log('Spring stopped due to damping');
                    }
                }
                
                animate();
                
                document.getElementById('springResults').classList.remove('hidden');
                document.getElementById('springPeriod').textContent = data.period;
                document.getElementById('springFrequency').textContent = data.frequency;
            });

            // Free Fall Visualization
            Livewire.on('updateFreeFall', (event) => {
                console.log('FreeFall event received:', event);
                const data = event;
                const ctx = document.getElementById('freeFallCanvas');
                
                if (!ctx) {
                    console.error('FreeFall canvas not found');
                    return;
                }
                
                const context = ctx.getContext('2d');
                
                if (freeFallChart) {
                    freeFallChart.destroy();
                }
                
                freeFallChart = new Chart(context, {
                    type: 'line',
                    data: {
                        datasets: [
                            {
                                label: 'Height (m)',
                                data: data.trajectory.map(p => ({ x: p.t, y: p.y })),
                                borderColor: 'rgb(59, 130, 246)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 2,
                                yAxisID: 'y',
                                parsing: {
                                    xAxisKey: 'x',
                                    yAxisKey: 'y'
                                }
                            },
                            {
                                label: 'Velocity (m/s)',
                                data: data.trajectory.map(p => ({ x: p.t, y: p.v })),
                                borderColor: 'rgb(239, 68, 68)',
                                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                borderWidth: 2,
                                yAxisID: 'y1',
                                parsing: {
                                    xAxisKey: 'x',
                                    yAxisKey: 'y'
                                }
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        scales: {
                            x: {
                                type: 'linear',
                                title: { display: true, text: 'Time (s)' }
                            },
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'left',
                                title: { display: true, text: 'Height (m)' }
                            },
                            y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                title: { display: true, text: 'Velocity (m/s)' },
                                grid: {
                                    drawOnChartArea: false,
                                }
                            }
                        }
                    }
                });

                document.getElementById('freeFallResults').classList.remove('hidden');
                document.getElementById('timeToFall').textContent = data.timeToFall;
                document.getElementById('finalVelocity').textContent = data.finalVelocity;
            });
        });
    </script>
    @endpush
</div>
