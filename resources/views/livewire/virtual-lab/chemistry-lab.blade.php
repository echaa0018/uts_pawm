<div>
    {{-- Chemistry Lab - Interactive Calculators --}}
    
    <div class="space-y-6">
        {{-- Header --}}
        <x-card>
            <div class="text-center space-y-4">
                <div class="flex justify-center">
                    <div class="bg-accent/10 p-6 rounded-full">
                        <x-icon name="o-beaker" class="w-20 h-20 text-accent" />
                    </div>
                </div>
                <h1 class="text-3xl font-bold">Chemistry Lab - Chemical Calculators</h1>
                <p class="text-lg text-base-content/70">
                    Interactive chemistry tools with real-time visualizations
                </p>
            </div>
        </x-card>

        {{-- Calculator Selection and Formulas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                {{-- Calculator Selection --}}
                <x-card class="h-fit">
                    <h2 class="text-xl font-semibold mb-4">Select a Calculator</h2>
                    <div class="flex flex-col gap-2">
                        <button 
                            wire:click="setCalculator('molarity')"
                            class="btn {{ $activeCalculator === 'molarity' ? 'btn-accent' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-beaker" class="w-5 h-5 mr-2" />
                            Molarity Calculator
                        </button>
                        <button 
                            wire:click="setCalculator('ph')"
                            class="btn {{ $activeCalculator === 'ph' ? 'btn-accent' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-chart-bar" class="w-5 h-5 mr-2" />
                            pH Calculator
                        </button>
                        <button 
                            wire:click="setCalculator('stoichiometry')"
                            class="btn {{ $activeCalculator === 'stoichiometry' ? 'btn-accent' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-arrow-path" class="w-5 h-5 mr-2" />
                            Stoichiometry
                        </button>
                        <button 
                            wire:click="setCalculator('gas-law')"
                            class="btn {{ $activeCalculator === 'gas-law' ? 'btn-accent' : 'btn-outline' }} justify-start"
                        >
                            <x-icon name="o-arrow-trending-up" class="w-5 h-5 mr-2" />
                            Gas Law
                        </button>
                    </div>
                </x-card>

                {{-- Calculator Description --}}
                <x-card class="h-fit">
                    <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
                        <x-icon name="o-information-circle" class="w-5 h-5" />
                        About This Calculator
                    </h2>
                    <div class="text-sm text-base-content/80">
                        @if($activeCalculator === 'molarity')
                        <p class="mb-2"><strong>Molarity Calculator</strong> calculates the concentration of a solution in moles per liter (M).</p>
                        <p>You can calculate molarity from moles and volume, or from mass and molar mass. The calculator also shows how concentration changes with volume.</p>
                        
                        @elseif($activeCalculator === 'ph')
                        <p class="mb-2"><strong>pH Calculator</strong> computes the pH and pOH of acidic or basic solutions.</p>
                        <p>For strong acids and bases, pH is calculated using the concentration of H⁺ or OH⁻ ions. The calculator shows the pH scale and how concentration affects pH.</p>
                        
                        @elseif($activeCalculator === 'stoichiometry')
                        <p class="mb-2"><strong>Stoichiometry Calculator</strong> calculates the amounts of reactants and products in a chemical reaction.</p>
                        <p>This tool helps you determine the limiting reactant, calculate moles of products, and visualize the reaction progress over time.</p>
                        
                        @elseif($activeCalculator === 'gas-law')
                        <p class="mb-2"><strong>Gas Law Calculator</strong> applies the ideal gas law and other gas laws to calculate pressure, volume, temperature, or moles.</p>
                        <p>You can visualize relationships like Boyle's law (P-V), Charles' law (V-T), and the ideal gas law (PV = nRT).</p>
                        @endif
                    </div>
                </x-card>
            </div>
            
            {{-- Chemistry Formulas --}}
            <x-card>
                <h2 class="text-xl font-semibold mb-4">📚 Chemistry Formulas</h2>
                <div class="text-sm space-y-4">
                    @if($activeCalculator === 'molarity')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Molarity</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• Molarity: M = n / V</li>
                            <li>• From mass: M = (m / MW) / V</li>
                            <li>• Moles: n = M × V</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• M = Molarity (mol/L or M)</li>
                                <li>• n = Moles (mol)</li>
                                <li>• V = Volume (L)</li>
                                <li>• m = Mass (g)</li>
                                <li>• MW = Molar mass (g/mol)</li>
                            </ul>
                        </div>
                    </div>
                    
                    {{-- Calculated Results --}}
                    @php
                        $calcMolarity = $molarityMoles / $molarityVolume;
                        $calcMolarityFromMass = ($molarityMass / $molarityMolarMass) / $molarityVolume;
                    @endphp
                    <div class="bg-accent/10 border border-accent/30 p-4 rounded-lg">
                        <h3 class="font-semibold mb-3 text-accent flex items-center gap-2">
                            <x-icon name="o-calculator" class="w-4 h-4" />
                            Calculated Results
                        </h3>
                        <div class="space-y-3 text-xs">
                            <div class="bg-base-100/50 p-2 rounded border border-accent/20">
                                <div class="font-semibold text-accent mb-1">Input Variables:</div>
                                <div class="space-y-1">
                                    <div>n = {{ $molarityMoles }} mol</div>
                                    <div>V = {{ $molarityVolume }} L</div>
                                    <div>m = {{ $molarityMass }} g</div>
                                    <div>MW = {{ $molarityMolarMass }} g/mol</div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Molarity (M):</span>
                                    <span class="font-bold">{{ number_format($calcMolarity, 4) }} M</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Molarity (from mass):</span>
                                    <span class="font-bold">{{ number_format($calcMolarityFromMass, 4) }} M</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @elseif($activeCalculator === 'ph')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">pH Calculation</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• pH = -log₁₀[H⁺]</li>
                            <li>• pOH = -log₁₀[OH⁻]</li>
                            <li>• pH + pOH = 14</li>
                            <li>• [H⁺] = 10^(-pH)</li>
                            <li>• [OH⁻] = 10^(-pOH)</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• pH = -log of H⁺ concentration</li>
                                <li>• pOH = -log of OH⁻ concentration</li>
                                <li>• [H⁺] = Hydrogen ion concentration (M)</li>
                                <li>• [OH⁻] = Hydroxide ion concentration (M)</li>
                            </ul>
                        </div>
                    </div>
                    
                    {{-- Calculated Results --}}
                    @php
                        if ($pHType === 'acid') {
                            $HPlus = $pHConcentration * $pHDissociation;
                            $calcPH = -log10($HPlus);
                            $calcPOH = 14 - $calcPH;
                        } else {
                            $OHMinus = $pHConcentration * $pHDissociation;
                            $calcPOH = -log10($OHMinus);
                            $calcPH = 14 - $calcPOH;
                        }
                    @endphp
                    <div class="bg-accent/10 border border-accent/30 p-4 rounded-lg">
                        <h3 class="font-semibold mb-3 text-accent flex items-center gap-2">
                            <x-icon name="o-calculator" class="w-4 h-4" />
                            Calculated Results
                        </h3>
                        <div class="space-y-3 text-xs">
                            <div class="bg-base-100/50 p-2 rounded border border-accent/20">
                                <div class="font-semibold text-accent mb-1">Input Variables:</div>
                                <div class="space-y-1">
                                    <div>Type: {{ ucfirst($pHType) }}</div>
                                    <div>Concentration: {{ $pHConcentration }} M</div>
                                    <div>Dissociation: {{ $pHDissociation }}</div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">pH:</span>
                                    <span class="font-bold">{{ number_format($calcPH, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">pOH:</span>
                                    <span class="font-bold">{{ number_format($calcPOH, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @elseif($activeCalculator === 'stoichiometry')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Stoichiometry</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• Balanced equation: aA + bB → cC</li>
                            <li>• Mole ratio: n_A / a = n_B / b = n_C / c</li>
                            <li>• Product moles: n_C = (n_A / a) × c</li>
                            <li>• Limiting reactant: smallest ratio</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• a, b, c = Stoichiometric coefficients</li>
                                <li>• n = Moles of substance</li>
                                <li>• A, B = Reactants</li>
                                <li>• C = Product</li>
                            </ul>
                        </div>
                    </div>
                    
                    {{-- Calculated Results --}}
                    @php
                        $molesReactant1 = $stoichiometryAmount;
                        $molesReactant2 = ($stoichiometryAmount / $stoichiometryCoefficient1) * $stoichiometryCoefficient2;
                        $molesProduct = ($stoichiometryAmount / $stoichiometryCoefficient1) * $stoichiometryCoefficient3;
                    @endphp
                    <div class="bg-accent/10 border border-accent/30 p-4 rounded-lg">
                        <h3 class="font-semibold mb-3 text-accent flex items-center gap-2">
                            <x-icon name="o-calculator" class="w-4 h-4" />
                            Calculated Results
                        </h3>
                        <div class="space-y-3 text-xs">
                            <div class="bg-base-100/50 p-2 rounded border border-accent/20">
                                <div class="font-semibold text-accent mb-1">Input Variables:</div>
                                <div class="space-y-1">
                                    <div>{{ $stoichiometryReactant1 }}: {{ $stoichiometryAmount }} mol</div>
                                    <div>Coefficients: {{ $stoichiometryCoefficient1 }}:{{ $stoichiometryCoefficient2 }}:{{ $stoichiometryCoefficient3 }}</div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">{{ $stoichiometryReactant2 }}:</span>
                                    <span class="font-bold">{{ number_format($molesReactant2, 2) }} mol</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">{{ $stoichiometryProduct }}:</span>
                                    <span class="font-bold">{{ number_format($molesProduct, 2) }} mol</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @elseif($activeCalculator === 'gas-law')
                    <div class="bg-base-200 p-4 rounded-lg">
                        <h3 class="font-semibold mb-2">Gas Laws</h3>
                        <ul class="space-y-1 mb-3">
                            <li>• Ideal Gas Law: PV = nRT</li>
                            <li>• Boyle's Law: P₁V₁ = P₂V₂ (constant T)</li>
                            <li>• Charles' Law: V₁/T₁ = V₂/T₂ (constant P)</li>
                            <li>• R = 0.0821 L·atm/(mol·K)</li>
                        </ul>
                        <div class="text-xs border-t border-base-300 pt-2 mt-2">
                            <div class="font-semibold mb-1">Variables:</div>
                            <ul class="space-y-0.5 text-base-content/70">
                                <li>• P = Pressure (atm)</li>
                                <li>• V = Volume (L)</li>
                                <li>• n = Moles (mol)</li>
                                <li>• T = Temperature (K)</li>
                                <li>• R = Gas constant</li>
                            </ul>
                        </div>
                    </div>
                    
                    {{-- Calculated Results --}}
                    @php
                        $R = 0.0821;
                        if ($gasLawMoles > 0 && $gasLawTemperature > 0) {
                            $calcGasPressure = ($gasLawMoles * $R * $gasLawTemperature) / $gasLawVolume;
                            $calcGasVolume = ($gasLawMoles * $R * $gasLawTemperature) / $gasLawPressure;
                        }
                    @endphp
                    <div class="bg-accent/10 border border-accent/30 p-4 rounded-lg">
                        <h3 class="font-semibold mb-3 text-accent flex items-center gap-2">
                            <x-icon name="o-calculator" class="w-4 h-4" />
                            Calculated Results
                        </h3>
                        <div class="space-y-3 text-xs">
                            <div class="bg-base-100/50 p-2 rounded border border-accent/20">
                                <div class="font-semibold text-accent mb-1">Input Variables:</div>
                                <div class="space-y-1">
                                    <div>P = {{ $gasLawPressure }} atm</div>
                                    <div>V = {{ $gasLawVolume }} L</div>
                                    <div>T = {{ $gasLawTemperature }} K</div>
                                    <div>n = {{ $gasLawMoles }} mol</div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                @if(isset($calcGasPressure))
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Calculated P:</span>
                                    <span class="font-bold">{{ number_format($calcGasPressure, 4) }} atm</span>
                                </div>
                                @endif
                                @if(isset($calcGasVolume))
                                <div class="flex justify-between items-center">
                                    <span class="text-base-content/70">Calculated V:</span>
                                    <span class="font-bold">{{ number_format($calcGasVolume, 4) }} L</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </x-card>
        </div>

        {{-- Molarity Calculator --}}
        @if($activeCalculator === 'molarity')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">Molarity Calculator</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-input 
                        wire:model="molarityMoles" 
                        label="Moles (mol)" 
                        type="number"
                        step="0.1"
                        min="0"
                    />
                    <x-input 
                        wire:model="molarityVolume" 
                        label="Volume (L)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-input 
                        wire:model="molarityMass" 
                        label="Mass (g)" 
                        type="number"
                        step="0.1"
                        min="0"
                    />
                    <x-input 
                        wire:model="molarityMolarMass" 
                        label="Molar Mass (g/mol)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-button 
                        wire:click="calculateMolarity" 
                        class="btn-accent w-full"
                        icon="o-play"
                        spinner="calculateMolarity"
                    >
                        <span wire:loading.remove wire:target="calculateMolarity">Calculate Molarity</span>
                        <span wire:loading wire:target="calculateMolarity">Calculating...</span>
                    </x-button>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="molarityCanvas" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- pH Calculator --}}
        @if($activeCalculator === 'ph')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">pH Calculator</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-select 
                        wire:model="pHType" 
                        label="Type" 
                        :options="[
                            ['id' => 'acid', 'name' => 'Acid'],
                            ['id' => 'base', 'name' => 'Base'],
                        ]"
                    />
                    <x-input 
                        wire:model="pHConcentration" 
                        label="Concentration (M)" 
                        type="number"
                        step="0.001"
                        min="0.0001"
                    />
                    <x-input 
                        wire:model="pHDissociation" 
                        label="Dissociation Factor" 
                        type="number"
                        step="0.1"
                        min="0.1"
                        max="10"
                        hint="1 for strong acids/bases"
                    />
                    <x-button 
                        wire:click="calculatepH" 
                        class="btn-accent w-full"
                        icon="o-play"
                        spinner="calculatepH"
                    >
                        <span wire:loading.remove wire:target="calculatepH">Calculate pH</span>
                        <span wire:loading wire:target="calculatepH">Calculating...</span>
                    </x-button>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="phCanvas" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- Stoichiometry Calculator --}}
        @if($activeCalculator === 'stoichiometry')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">Stoichiometry Calculator</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-input 
                        wire:model="stoichiometryReactant1" 
                        label="Reactant 1 (e.g., H2)" 
                    />
                    <x-input 
                        wire:model="stoichiometryReactant2" 
                        label="Reactant 2 (e.g., O2)" 
                    />
                    <x-input 
                        wire:model="stoichiometryProduct" 
                        label="Product (e.g., H2O)" 
                    />
                    <x-input 
                        wire:model="stoichiometryCoefficient1" 
                        label="Coefficient 1" 
                        type="number"
                        step="1"
                        min="1"
                    />
                    <x-input 
                        wire:model="stoichiometryCoefficient2" 
                        label="Coefficient 2" 
                        type="number"
                        step="1"
                        min="1"
                    />
                    <x-input 
                        wire:model="stoichiometryCoefficient3" 
                        label="Coefficient 3 (Product)" 
                        type="number"
                        step="1"
                        min="1"
                    />
                    <x-input 
                        wire:model="stoichiometryAmount" 
                        label="Moles of Reactant 1" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-button 
                        wire:click="calculateStoichiometry" 
                        class="btn-accent w-full"
                        icon="o-play"
                        spinner="calculateStoichiometry"
                    >
                        <span wire:loading.remove wire:target="calculateStoichiometry">Calculate</span>
                        <span wire:loading wire:target="calculateStoichiometry">Calculating...</span>
                    </x-button>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="stoichiometryCanvas" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif

        {{-- Gas Law Calculator --}}
        @if($activeCalculator === 'gas-law')
        <x-card>
            <h2 class="text-2xl font-semibold mb-4">Gas Law Calculator</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <x-select 
                        wire:model="gasLawType" 
                        label="Gas Law Type" 
                        :options="[
                            ['id' => 'ideal', 'name' => 'Ideal Gas Law (PV = nRT)'],
                            ['id' => 'boyle', 'name' => 'Boyle\'s Law (P₁V₁ = P₂V₂)'],
                            ['id' => 'charles', 'name' => 'Charles\' Law (V₁/T₁ = V₂/T₂)'],
                        ]"
                    />
                    <x-input 
                        wire:model="gasLawPressure" 
                        label="Pressure (atm)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-input 
                        wire:model="gasLawVolume" 
                        label="Volume (L)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-input 
                        wire:model="gasLawTemperature" 
                        label="Temperature (K)" 
                        type="number"
                        step="1"
                        min="1"
                    />
                    <x-input 
                        wire:model="gasLawMoles" 
                        label="Moles (mol)" 
                        type="number"
                        step="0.1"
                        min="0.1"
                    />
                    <x-button 
                        wire:click="calculateGasLaw" 
                        class="btn-accent w-full"
                        icon="o-play"
                        spinner="calculateGasLaw"
                    >
                        <span wire:loading.remove wire:target="calculateGasLaw">Calculate</span>
                        <span wire:loading wire:target="calculateGasLaw">Calculating...</span>
                    </x-button>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-base-200 rounded-lg p-4" style="height: 400px; position: relative;">
                        <canvas id="gasLawCanvas" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </x-card>
        @endif
    </div>

    {{-- Load Chart.js from CDN --}}
    @push('scripts')
    <script>
        // Wait for Chart.js from app.js, then load chemistry-lab.js
        (function loadChemistryLabScript() {
            if (typeof Chart !== 'undefined' || typeof window.Chart !== 'undefined') {
                var script = document.createElement('script');
                script.src = '/js/chemistry-lab.js';
                script.onerror = function() {
                    console.error('Failed to load chemistry-lab.js');
                };
                script.onload = function() {
                    console.log('Chemistry lab script loaded successfully');
                };
                document.body.appendChild(script);
            } else {
                setTimeout(loadChemistryLabScript, 100);
            }
        })();
    </script>
    @endpush

    @script
    <script>
        // Listen to Livewire events and dispatch browser events for the chemistry-lab.js file
        $wire.on('updateMolarity', (data) => {
            console.log('Livewire updateMolarity event:', data);
            if (typeof initChemistryLab === 'function' || typeof Chart !== 'undefined') {
                window.dispatchEvent(new CustomEvent('updateMolarity', { detail: data }));
            } else {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('updateMolarity', { detail: data }));
                }, 500);
            }
        });

        $wire.on('updatepH', (data) => {
            console.log('Livewire updatepH event:', data);
            if (typeof initChemistryLab === 'function' || typeof Chart !== 'undefined') {
                window.dispatchEvent(new CustomEvent('updatepH', { detail: data }));
            } else {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('updatepH', { detail: data }));
                }, 500);
            }
        });

        $wire.on('updateStoichiometry', (data) => {
            console.log('Livewire updateStoichiometry event:', data);
            if (typeof initChemistryLab === 'function' || typeof Chart !== 'undefined') {
                window.dispatchEvent(new CustomEvent('updateStoichiometry', { detail: data }));
            } else {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('updateStoichiometry', { detail: data }));
                }, 500);
            }
        });

        $wire.on('updateGasLaw', (data) => {
            console.log('Livewire updateGasLaw event:', data);
            if (typeof initChemistryLab === 'function' || typeof Chart !== 'undefined') {
                window.dispatchEvent(new CustomEvent('updateGasLaw', { detail: data }));
            } else {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('updateGasLaw', { detail: data }));
                }, 500);
            }
        });
    </script>
    @endscript
</div>
