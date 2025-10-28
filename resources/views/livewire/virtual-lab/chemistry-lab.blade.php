<div>
    {{-- Chemistry Virtual Lab --}}
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        {{-- Sidebar with Experiments --}}
        <div class="card bg-base-100 shadow-xl lg:col-span-1">
            <div class="card-body">
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    Experiments
                </h2>

                <div class="menu text-sm space-y-1">
                    <button 
                        class="menu-item {{ $selectedExperiment === 'molarity' ? 'active' : '' }}"
                        wire:click="selectExperiment('molarity')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        Molarity Calculator
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'ph' ? 'active' : '' }}"
                        wire:click="selectExperiment('ph')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        pH Calculator
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'idealgas' ? 'active' : '' }}"
                        wire:click="selectExperiment('idealgas')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                        </svg>
                        Ideal Gas Law
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'stoichiometry' ? 'active' : '' }}"
                        wire:click="selectExperiment('stoichiometry')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                        Stoichiometry
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'molecular' ? 'active' : '' }}"
                        wire:click="selectExperiment('molecular')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Molecular Weight
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'periodic' ? 'active' : '' }}"
                        wire:click="selectExperiment('periodic')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Periodic Table
                    </button>
                    
                    <button 
                        class="menu-item {{ $selectedExperiment === 'reaction' ? 'active' : '' }}"
                        wire:click="selectExperiment('reaction')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        Reaction Balancer
                    </button>
                </div>
            </div>
        </div>

        {{-- Main Content Area --}}
        <div class="card bg-base-300 shadow-xl lg:col-span-3">
            <div class="card-body">
            @if($selectedExperiment === 'molarity')
                {{-- Molarity Calculator --}}
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                        Molarity Calculator
                </h2>

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
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                        pH Calculator
                </h2>

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
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                    </svg>
                        Ideal Gas Law (PV = nRT)
                </h2>

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
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                    </svg>
                    Stoichiometry Calculator
                </h2>

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
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Molecular Weight Calculator
                </h2>

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
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    Periodic Table
                </h2>

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
                <h2 class="card-title text-base-content">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Reaction Balancer
                </h2>

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
            </div>
        </div>
    </div>
</div>
