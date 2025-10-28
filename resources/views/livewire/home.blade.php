<div class="">

    {{-- Replaced placeholder stats with relevant Virtual Lab metrics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat
            title="Total Experiments"
            description="Across all labs"
            value="19"
            icon="o-variable"
            tooltip-bottom="Total number of available tools and experiments" />

        <x-stat
            title="Math"
            description="Tools Available"   
            value="6"
            icon="o-calculator"
            class="text-red-500"
            color="text-red-500"
            tooltip-bottom="-" />

        <x-stat
            title="Physics"
            description="Experiments available"
            value="6"
            icon="o-bolt"
            class="text-blue-500"
            color="text-blue-500"
            tooltip-bottom="Simple Pendulum, Projectile Motion, and more" />

        <x-stat
            title="Chemistry"
            description="Calculators available"
            value="7"
            icon="o-beaker"
            class="text-green-500"
            color="text-green-500"
            tooltip-bottom="Molarity, pH, Ideal Gas Law, and more" />
    </div>

    {{-- Virtual Lab Quick Access --}}
    <x-card class="mt-4">
        <x-slot:title>
            <div class="flex items-center gap-2">
                <x-icon name="o-beaker" class="w-5 h-5" />
                Virtual Laboratory
            </div>
        </x-slot:title>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Overview Card --}}
            <a href="{{ route('virtual-lab.index') }}" wire:navigate class="block">
                <div class="stat bg-base-200 hover:bg-base-300 transition-colors cursor-pointer rounded-lg">
                    <div class="stat-figure text-primary">
                        <x-icon name="o-home" class="w-8 h-8" />
                    </div>
                    <div class="stat-title">Overview</div>
                    <div class="stat-value text-primary text-xl">3</div> {{-- This was correct --}}
                    <div class="stat-desc">Available Labs</div>
                </div>
            </a>

            {{-- Physics Lab Card --}}
            <a href="{{ route('virtual-lab.physics') }}" wire:navigate class="block">
                <div class="stat bg-base-200 hover:bg-base-300 transition-colors cursor-pointer rounded-lg">
                    <div class="stat-figure text-secondary">
                        <x-icon name="o-bolt" class="w-8 h-8" />
                    </div>
                    <div class="stat-title">Physics</div>
                    <div class="stat-value text-secondary text-xl">6</div>
                    <div class="stat-desc">Experiments</div>
                </div>
            </a>

            {{-- Math Lab Card --}}
            <a href="{{ route('virtual-lab.math') }}" wire:navigate class="block">
                <div class="stat bg-base-200 hover:bg-base-300 transition-colors cursor-pointer rounded-lg">
                    <div class="stat-figure text-accent">
                        <x-icon name="o-calculator" class="w-8 h-8" />
                    </div>
                    <div class="stat-title">Math</div>
                    <div class="stat-value text-accent text-xl">6</div>
                    <div class="stat-desc">Tools</div>
                </div>
            </a>

            {{-- Chemistry Lab Card --}}
            <a href="{{ route('virtual-lab.chemistry') }}" wire:navigate class="block">
                <div class="stat bg-base-200 hover:bg-base-300 transition-colors cursor-pointer rounded-lg">
                    <div class="stat-figure text-info">
                        <x-icon name="o-beaker" class="w-8 h-8" />
                    </div>
                    <div class="stat-title">Chemistry</div>
                    <div class="stat-value text-info text-xl">7</div>
                    <div class="stat-desc">Calculators</div>
                </div>
            </a>
        </div>
    </x-card>

    {{-- <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }} --}}
    
</div>
