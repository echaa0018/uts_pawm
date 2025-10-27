<div>
    {{-- Virtual Lab Index --}}
    
    <div class="space-y-6">
        {{-- Header Section --}}
        <x-card>
            <div class="text-center space-y-4">
                <div class="flex justify-center">
                    <x-icon name="o-beaker" class="w-20 h-20 text-primary" />
                </div>
                <h1 class="text-3xl font-bold">Virtual Laboratory</h1>
                <p class="text-lg text-base-content/70">
                    Explore interactive simulations and calculators for Physics, Mathematics, and Chemistry
                </p>
            </div>
        </x-card>

        {{-- Lab Categories --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Physics Lab Card --}}
            <x-card class="hover:shadow-xl transition-shadow cursor-pointer" 
                    wire:click="$dispatch('mary-navigate', { url: '{{ route('virtual-lab.physics') }}' })">
                <div class="space-y-4">
                    <div class="flex justify-center">
                        <div class="bg-primary/10 p-6 rounded-full">
                            <x-icon name="o-bolt" class="w-12 h-12 text-primary" />
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-2">Physics Lab</h2>
                        <p class="text-sm text-base-content/70 mb-4">
                            Interactive physics experiments and simulations
                        </p>
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Simple Pendulum</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Projectile Motion</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Free Fall</span>
                        </div>
                    </div>

                    <x-button 
                        label="Enter Lab" 
                        icon="o-arrow-right"
                        link="{{ route('virtual-lab.physics') }}"
                        class="btn-primary w-full" 
                        wire:navigate />
                </div>
            </x-card>

            {{-- Math Lab Card --}}
            <x-card class="hover:shadow-xl transition-shadow cursor-pointer"
                    wire:click="$dispatch('mary-navigate', { url: '{{ route('virtual-lab.math') }}' })">
                <div class="space-y-4">
                    <div class="flex justify-center">
                        <div class="bg-secondary/10 p-6 rounded-full">
                            <x-icon name="o-calculator" class="w-12 h-12 text-secondary" />
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-2">Math Lab</h2>
                        <p class="text-sm text-base-content/70 mb-4">
                            Advanced mathematical calculators and tools
                        </p>
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Quadratic Equation Solver</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Matrix Calculator</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Statistics Calculator</span>
                        </div>
                    </div>

                    <x-button 
                        label="Enter Lab" 
                        icon="o-arrow-right"
                        link="{{ route('virtual-lab.math') }}"
                        class="btn-secondary w-full" 
                        wire:navigate />
                </div>
            </x-card>

            {{-- Chemistry Lab Card --}}
            <x-card class="hover:shadow-xl transition-shadow cursor-pointer"
                    wire:click="$dispatch('mary-navigate', { url: '{{ route('virtual-lab.chemistry') }}' })">
                <div class="space-y-4">
                    <div class="flex justify-center">
                        <div class="bg-accent/10 p-6 rounded-full">
                            <x-icon name="o-beaker" class="w-12 h-12 text-accent" />
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-2">Chemistry Lab</h2>
                        <p class="text-sm text-base-content/70 mb-4">
                            Chemical calculations and laboratory tools
                        </p>
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Molarity Calculator</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>pH Calculator</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Ideal Gas Law</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                            <span>Stoichiometry</span>
                        </div>
                    </div>

                    <x-button 
                        label="Enter Lab" 
                        icon="o-arrow-right"
                        link="{{ route('virtual-lab.chemistry') }}"
                        class="btn-accent w-full" 
                        wire:navigate />
                </div>
            </x-card>
        </div>

        {{-- Features Section --}}
        <x-card>
            <x-slot:title>
                <div class="flex items-center gap-2">
                    <x-icon name="o-star" class="w-5 h-5" />
                    Features
                </div>
            </x-slot:title>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="text-center p-4">
                    <x-icon name="o-academic-cap" class="w-8 h-8 mx-auto mb-2 text-primary" />
                    <h3 class="font-bold mb-1">Interactive Learning</h3>
                    <p class="text-xs text-base-content/70">Hands-on experience with scientific concepts</p>
                </div>

                <div class="text-center p-4">
                    <x-icon name="o-calculator" class="w-8 h-8 mx-auto mb-2 text-secondary" />
                    <h3 class="font-bold mb-1">Real-time Calculations</h3>
                    <p class="text-xs text-base-content/70">Instant results with detailed explanations</p>
                </div>

                <div class="text-center p-4">
                    <x-icon name="o-chart-bar" class="w-8 h-8 mx-auto mb-2 text-accent" />
                    <h3 class="font-bold mb-1">Visual Representations</h3>
                    <p class="text-xs text-base-content/70">Graphs and charts for better understanding</p>
                </div>

                <div class="text-center p-4">
                    <x-icon name="o-clipboard-document-check" class="w-8 h-8 mx-auto mb-2 text-info" />
                    <h3 class="font-bold mb-1">Step-by-step Solutions</h3>
                    <p class="text-xs text-base-content/70">Learn the methodology behind each calculation</p>
                </div>
            </div>
        </x-card>
    </div>
</div>
