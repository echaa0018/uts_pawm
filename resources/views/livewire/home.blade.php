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
