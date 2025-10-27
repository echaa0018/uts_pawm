<div>
    {{-- Chemistry Virtual Lab --}}
    
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
                    title="Molarity Calculator" 
                    icon="o-beaker"
                    wire:click="selectExperiment('molarity')"
                    :active="$selectedExperiment === 'molarity'" />
                
                <x-menu-item 
                    title="pH Calculator" 
                    icon="o-beaker"
                    wire:click="selectExperiment('ph')"
                    :active="$selectedExperiment === 'ph'" />
                
                <x-menu-item 
                    title="Ideal Gas Law" 
                    icon="o-cloud"
                    wire:click="selectExperiment('idealgas')"
                    :active="$selectedExperiment === 'idealgas'" />
                
                <x-menu-item 
                    title="Stoichiometry" 
                    icon="o-scale"
                    wire:click="selectExperiment('stoichiometry')"
                    :active="$selectedExperiment === 'stoichiometry'" />
            </x-menu>
        </x-card>

        {{-- Main Content Area --}}
        <x-card class="lg:col-span-3">
            @if($selectedExperiment === 'molarity')
                {{-- Molarity Calculator --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-beaker" class="w-5 h-5" />
                        Molarity Calculator
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Calculate Molarity</x-slot:title>
                        Molarity (M) = moles of solute / liters of solution
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input 
                                label="Moles of Solute (n)" 
                                wire:model="moles" 
                                type="number"
                                step="0.01"
                                min="0.01"
                                icon="o-beaker"
                                hint="Amount in moles" />
                        </div>

                        <div>
                            <x-input 
                                label="Volume (L)" 
                                wire:model="volumeLiters" 
                                type="number"
                                step="0.1"
                                min="0.1"
                                icon="o-beaker"
                                hint="Solution volume in liters" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate Molarity" 
                            icon="o-calculator"
                            wire:click="calculateMolarity" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($molarity > 0)
                        <x-card class="bg-base-200">
                            <x-slot:title>Results</x-slot:title>
                            <div class="stat bg-base-100 rounded-lg">
                                <div class="stat-title">Molarity (M)</div>
                                <div class="stat-value text-primary">{{ number_format($molarity, 4) }}</div>
                                <div class="stat-desc">mol/L or M</div>
                            </div>
                        </x-card>
                    @endif
                </div>

            @elseif($selectedExperiment === 'ph')
                {{-- pH Calculator --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-beaker" class="w-5 h-5" />
                        pH Calculator
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Calculate pH and pOH</x-slot:title>
                        pH = -log[H⁺] and pOH = 14 - pH
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input 
                                label="[H⁺] Concentration (mol/L)" 
                                wire:model="hydrogenIonConcentration" 
                                type="number"
                                step="0.0001"
                                min="0.0000001"
                                icon="o-beaker"
                                hint="Hydrogen ion concentration" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate pH" 
                            icon="o-calculator"
                            wire:click="calculatePH" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($pH > 0)
                        <x-card class="bg-base-200">
                            <x-slot:title>Results</x-slot:title>
                            <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                                <div class="stat">
                                    <div class="stat-title">pH</div>
                                    <div class="stat-value text-primary">{{ number_format($pH, 2) }}</div>
                                    <div class="stat-desc">
                                        <span class="badge 
                                            @if($solutionType === 'Acidic') badge-error
                                            @elseif($solutionType === 'Basic') badge-info
                                            @else badge-success
                                            @endif">
                                            {{ $solutionType }}
                                        </span>
                                    </div>
                                </div>

                                <div class="stat">
                                    <div class="stat-title">pOH</div>
                                    <div class="stat-value text-secondary">{{ number_format($pOH, 2) }}</div>
                                    <div class="stat-desc">14 - pH</div>
                                </div>

                                <div class="stat">
                                    <div class="stat-title">[H⁺]</div>
                                    <div class="stat-value text-accent text-xl">{{ number_format($hydrogenIonConcentration, 8) }}</div>
                                    <div class="stat-desc">mol/L</div>
                                </div>
                            </div>

                            {{-- pH Scale Visualization --}}
                            <div class="mt-4">
                                <div class="text-sm font-bold mb-2">pH Scale</div>
                                <div class="relative h-8 rounded-lg overflow-hidden" 
                                     style="background: linear-gradient(to right, 
                                        #ff0000 0%, #ff6600 14%, #ffcc00 28%, 
                                        #00ff00 50%, 
                                        #0099ff 72%, #0000ff 86%, #6600ff 100%);">
                                    <div class="absolute top-0 bottom-0 w-1 bg-black border-2 border-white"
                                         style="left: {{ ($pH / 14) * 100 }}%;">
                                    </div>
                                </div>
                                <div class="flex justify-between text-xs mt-1">
                                    <span>0 (Acidic)</span>
                                    <span>7 (Neutral)</span>
                                    <span>14 (Basic)</span>
                                </div>
                            </div>
                        </x-card>
                    @endif
                </div>

            @elseif($selectedExperiment === 'idealgas')
                {{-- Ideal Gas Law --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-cloud" class="w-5 h-5" />
                        Ideal Gas Law (PV = nRT)
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Ideal Gas Law</x-slot:title>
                        PV = nRT, where R = 0.0821 L·atm/(mol·K)
                        <br>Calculate moles (n) from pressure, volume, and temperature.
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-input 
                                label="Pressure (atm)" 
                                wire:model="pressure" 
                                type="number"
                                step="0.1"
                                min="0.1"
                                icon="o-arrow-down"
                                hint="Pressure in atmospheres" />
                        </div>

                        <div>
                            <x-input 
                                label="Volume (L)" 
                                wire:model="volume" 
                                type="number"
                                step="0.1"
                                min="0.1"
                                icon="o-cube"
                                hint="Volume in liters" />
                        </div>

                        <div>
                            <x-input 
                                label="Temperature (K)" 
                                wire:model="temperature" 
                                type="number"
                                step="1"
                                min="1"
                                icon="o-fire"
                                hint="Temperature in Kelvin" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate Moles" 
                            icon="o-calculator"
                            wire:click="calculateIdealGas" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($molesGas > 0)
                        <x-card class="bg-base-200">
                            <x-slot:title>Results</x-slot:title>
                            <div class="stat bg-base-100 rounded-lg">
                                <div class="stat-title">Number of Moles (n)</div>
                                <div class="stat-value text-primary">{{ number_format($molesGas, 4) }}</div>
                                <div class="stat-desc">moles of gas</div>
                            </div>
                        </x-card>
                    @endif
                </div>

            @elseif($selectedExperiment === 'stoichiometry')
                {{-- Stoichiometry Calculator --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-scale" class="w-5 h-5" />
                        Stoichiometry Calculator
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Stoichiometric Calculations</x-slot:title>
                        Calculate the mass of product formed from a given mass of reactant.
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input 
                                label="Reactant Mass (g)" 
                                wire:model="reactantMass" 
                                type="number"
                                step="0.01"
                                min="0.01"
                                icon="o-scale"
                                hint="Mass in grams" />
                        </div>

                        <div>
                            <x-input 
                                label="Reactant Molar Mass (g/mol)" 
                                wire:model="reactantMolarMass" 
                                type="number"
                                step="0.01"
                                min="0.01"
                                icon="o-beaker"
                                hint="e.g., H₂O = 18 g/mol" />
                        </div>

                        <div>
                            <x-input 
                                label="Product Molar Mass (g/mol)" 
                                wire:model="productMolarMass" 
                                type="number"
                                step="0.01"
                                min="0.01"
                                icon="o-beaker"
                                hint="e.g., CO₂ = 44 g/mol" />
                        </div>

                        <div>
                            <x-input 
                                label="Mole Ratio (reactant:product)" 
                                wire:model="moleRatio" 
                                type="number"
                                step="0.1"
                                min="0.1"
                                icon="o-arrows-right-left"
                                hint="e.g., 1:1 or 2:1" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate Product Mass" 
                            icon="o-calculator"
                            wire:click="calculateStoichiometry" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($productMass > 0)
                        <x-card class="bg-base-200">
                            <x-slot:title>Results</x-slot:title>
                            <div class="stats shadow w-full">
                                <div class="stat">
                                    <div class="stat-title">Reactant Moles</div>
                                    <div class="stat-value text-sm">{{ number_format($reactantMass / $reactantMolarMass, 4) }}</div>
                                    <div class="stat-desc">mol</div>
                                </div>
                                <div class="stat">
                                    <div class="stat-title">Product Mass</div>
                                    <div class="stat-value text-primary">{{ number_format($productMass, 4) }}</div>
                                    <div class="stat-desc">grams</div>
                                </div>
                            </div>
                        </x-card>
                    @endif
                </div>
            @endif
        </x-card>
    </div>
</div>
