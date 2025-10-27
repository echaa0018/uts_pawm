<div class="">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat
            class=""
            title="Messages"
            value="44"
            icon="o-envelope"
            tooltip-bottom="Hello"
            color="text-primary" />
        
        <x-stat
            title="Sales"
            description="This month"
            value="22.124"
            icon="o-arrow-trending-up"
            tooltip-bottom="There" />
        
        <x-stat
            title="Lost"
            description="This month"
            value="34"
            icon="o-arrow-trending-down"
            tooltip-bottom="Ops!" />
        
        <x-stat
            title="Sales"
            description="This month"
            value="22.124"
            icon="o-arrow-trending-down"
            class="text-orange-500"
            color="text-pink-500"
            tooltip-bottom="Gosh!" />

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
                    <div class="stat-value text-primary text-xl">3</div>
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
                    <div class="stat-value text-secondary text-xl">3</div>
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
                    <div class="stat-value text-accent text-xl">3</div>
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
                    <div class="stat-value text-info text-xl">4</div>
                    <div class="stat-desc">Calculators</div>
                </div>
            </a>
        </div>
    </x-card>

    <x-card class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- {!! $chart->container() !!} --}}
        <x-chart wire:model="myChart" />
    </x-card>


    {{-- <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }} --}}
    
</div>

{{-- Load Chart.js only when needed --}}
@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endassets
