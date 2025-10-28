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
                
                <x-menu-item 
                    title="Molecular Weight" 
                    icon="o-calculator"
                    wire:click="selectExperiment('molecular')"
                    :active="$selectedExperiment === 'molecular'" />
                
                <x-menu-item 
                    title="Periodic Table" 
                    icon="o-table-cells"
                    wire:click="selectExperiment('periodic')"
                    :active="$selectedExperiment === 'periodic'" />
                
                <x-menu-item 
                    title="Reaction Balancer" 
                    icon="o-arrows-right-left"
                    wire:click="selectExperiment('reaction')"
                    :active="$selectedExperiment === 'reaction'" />
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

            @elseif($selectedExperiment === 'molecular')
                {{-- Molecular Weight Calculator --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-calculator" class="w-5 h-5" />
                        Molecular Weight Calculator
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Calculate Molecular Weight</x-slot:title>
                        Enter a molecular formula to calculate its molecular weight.
                        <br>Supported: H2O, CO2, CH4, NaCl, etc.
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input 
                                label="Molecular Formula" 
                                wire:model="molecularFormula" 
                                placeholder="e.g., H2O, CO2, CH4"
                                icon="o-beaker"
                                hint="Enter chemical formula" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Calculate Weight" 
                            icon="o-calculator"
                            wire:click="calculateMolecularWeight" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($molecularWeight > 0)
                        <x-card class="bg-base-200">
                            <x-slot:title>Molecular Weight Results</x-slot:title>
                            <div class="space-y-4">
                                <div class="stat bg-base-100 rounded-lg">
                                    <div class="stat-title">Formula: {{ $molecularFormula }}</div>
                                    <div class="stat-value text-primary text-2xl">{{ number_format($molecularWeight, 3) }}</div>
                                    <div class="stat-desc">g/mol</div>
                                </div>
                                
                                @if(count($elementBreakdown) > 0)
                                    <div class="collapse collapse-arrow bg-base-100">
                                        <input type="checkbox" />
                                        <div class="collapse-title text-sm font-medium">
                                            Element Breakdown
                                        </div>
                                        <div class="collapse-content">
                                            <div class="space-y-2 text-sm">
                                                @foreach($elementBreakdown as $element)
                                                    <div class="flex justify-between items-center p-2 bg-base-200 rounded">
                                                        <span class="font-bold">{{ $element['element'] }}{{ $element['count'] > 1 ? $element['count'] : '' }}</span>
                                                        <span class="text-primary">{{ number_format($element['mass'], 3) }} g/mol</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </x-card>
                    @endif
                </div>

            @elseif($selectedExperiment === 'periodic')
                {{-- Periodic Table --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-table-cells" class="w-5 h-5" />
                        Periodic Table
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Element Information</x-slot:title>
                        Click on an element to view its properties and information.
                    </x-alert>

                    {{-- Simplified Periodic Table Grid --}}
                    <div class="bg-base-100 p-4 rounded-lg">
                        <div class="text-sm font-bold mb-3">Common Elements</div>
                        <div class="grid grid-cols-6 sm:grid-cols-8 md:grid-cols-10 gap-2">
                            @foreach(['H', 'He', 'Li', 'C', 'N', 'O', 'F', 'Ne', 'Na', 'Mg', 'Al', 'Si', 'P', 'S', 'Cl', 'Ar', 'K', 'Ca', 'Fe', 'Ni', 'Cu', 'Zn', 'Br', 'Ag', 'Sn', 'I', 'Ba', 'Au', 'Hg', 'Pb', 'U'] as $element)
                                <button 
                                    class="btn btn-sm btn-outline hover:btn-primary"
                                    wire:click="getElementInfo('{{ $element }}')">
                                    {{ $element }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    @if($elementData)
                        <x-card class="bg-base-200">
                            <x-slot:title>Element: {{ $selectedElement }}</x-slot:title>
                            <div class="stats shadow w-full">
                                <div class="stat">
                                    <div class="stat-title">Name</div>
                                    <div class="stat-value text-primary text-lg">{{ $elementData['name'] }}</div>
                                </div>
                                <div class="stat">
                                    <div class="stat-title">Atomic Number</div>
                                    <div class="stat-value text-secondary text-lg">{{ $elementData['atomicNumber'] }}</div>
                                </div>
                                <div class="stat">
                                    <div class="stat-title">Atomic Mass</div>
                                    <div class="stat-value text-accent text-lg">{{ $elementData['mass'] }}</div>
                                    <div class="stat-desc">u</div>
                                </div>
                                <div class="stat">
                                    <div class="stat-title">Group</div>
                                    <div class="stat-value text-info text-lg">{{ $elementData['group'] }}</div>
                                </div>
                            </div>
                        </x-card>
                    @endif
                </div>

            @elseif($selectedExperiment === 'reaction')
                {{-- Reaction Balancer --}}
                <x-slot:title>
                    <div class="flex items-center gap-2">
                        <x-icon name="o-arrows-right-left" class="w-5 h-5" />
                        Reaction Balancer
                    </div>
                </x-slot:title>

                <div class="space-y-4">
                    <x-alert icon="o-information-circle" class="alert-info">
                        <x-slot:title>Balance Chemical Equations</x-slot:title>
                        Enter reactants and products to balance the chemical equation.
                        <br>Example: H2 + O2 → H2O
                    </x-alert>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input 
                                label="Reactants" 
                                wire:model="reactants" 
                                placeholder="e.g., H2 + O2"
                                icon="o-arrow-left"
                                hint="Enter reactants separated by +" />
                        </div>

                        <div>
                            <x-input 
                                label="Products" 
                                wire:model="products" 
                                placeholder="e.g., H2O"
                                icon="o-arrow-right"
                                hint="Enter products separated by +" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <x-button 
                            label="Balance Reaction" 
                            icon="o-arrows-right-left"
                            wire:click="balanceReaction" 
                            class="btn-primary" 
                            spinner />
                    </div>

                    @if($balancedReaction)
                        <x-card class="bg-base-200">
                            <x-slot:title>Balanced Reaction</x-slot:title>
                            <div class="space-y-4">
                                <div class="stat bg-base-100 rounded-lg">
                                    <div class="stat-title">Balanced Equation</div>
                                    <div class="stat-value text-primary text-lg">{{ $balancedReaction }}</div>
                                </div>
                                
                                @if(count($reactionSteps) > 0)
                                    <div class="collapse collapse-arrow bg-base-100">
                                        <input type="checkbox" />
                                        <div class="collapse-title text-sm font-medium">
                                            Balancing Steps
                                        </div>
                                        <div class="collapse-content">
                                            <div class="space-y-2 text-sm">
                                                @foreach($reactionSteps as $step)
                                                    <div class="flex items-center gap-2">
                                                        <x-icon name="o-check-circle" class="w-4 h-4 text-success" />
                                                        <span>{{ $step }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </x-card>
                    @endif
                </div>
            @endif
        </x-card>
    </div>
</div>
