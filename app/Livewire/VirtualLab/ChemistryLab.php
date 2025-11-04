<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class ChemistryLab extends Component
{
    use Toast;

    public $activeCalculator = 'molarity';

    public $molarityMoles = 0.5;
    public $molarityVolume = 1;
    public $molarityMass = 58.44;
    public $molarityMolarMass = 58.44;

    public $pHConcentration = 0.001;
    public $pHType = 'acid';
    public $pHDissociation = 1;

    public $stoichiometryReactant1 = 'H2';
    public $stoichiometryReactant2 = 'O2';
    public $stoichiometryProduct = 'H2O';
    public $stoichiometryCoefficient1 = 2;
    public $stoichiometryCoefficient2 = 1;
    public $stoichiometryCoefficient3 = 2;
    public $stoichiometryAmount = 1;

    public $gasLawPressure = 1;
    public $gasLawVolume = 22.4;
    public $gasLawTemperature = 273;
    public $gasLawMoles = 1;
    public $gasLawType = 'ideal';

    public function mount()
    {
        $this->info('Welcome to Chemistry Lab! Select a calculator to begin.', position: 'toast-top toast-end');
    }

    public function setCalculator($calculator)
    {
        $this->activeCalculator = $calculator;
        $this->info('Switched to ' . ucfirst(str_replace('-', ' ', $calculator)) . ' calculator', position: 'toast-top toast-end');
    }

    public function calculateMolarity()
    {
        try {
            $molarity = $this->molarityMoles / $this->molarityVolume;
            $molarityFromMass = ($this->molarityMass / $this->molarityMolarMass) / $this->molarityVolume;
            
            $concentrations = [];
            $volumes = [0.1, 0.25, 0.5, 0.75, 1.0, 1.5, 2.0];
            foreach ($volumes as $vol) {
                $conc = $this->molarityMoles / $vol;
                $concentrations[] = ['x' => $vol, 'y' => round($conc, 4)];
            }
            
            $this->dispatch('updateMolarity',
                molarity: round($molarity, 4),
                molarityFromMass: round($molarityFromMass, 4),
                moles: $this->molarityMoles,
                volume: $this->molarityVolume,
                mass: $this->molarityMass,
                molarMass: $this->molarityMolarMass,
                concentrations: $concentrations
            );
            
            $this->success('Molarity calculated!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function calculatepH()
    {
        try {
            $pH = 0;
            $pOH = 0;
            
            if ($this->pHType === 'acid') {
                $HPlus = $this->pHConcentration * $this->pHDissociation;
                $pH = -log10($HPlus);
                $pOH = 14 - $pH;
            } else {
                $OHMinus = $this->pHConcentration * $this->pHDissociation;
                $pOH = -log10($OHMinus);
                $pH = 14 - $pOH;
            }
            
            $pHCurve = [];
            $concentrations = [0.001, 0.01, 0.1, 1, 10];
            foreach ($concentrations as $conc) {
                if ($this->pHType === 'acid') {
                    $pHValue = -log10($conc * $this->pHDissociation);
                    $pHCurve[] = ['x' => -log10($conc), 'y' => round($pHValue, 2)];
                } else {
                    $pOHValue = -log10($conc * $this->pHDissociation);
                    $pHValue = 14 - $pOHValue;
                    $pHCurve[] = ['x' => -log10($conc), 'y' => round($pHValue, 2)];
                }
            }
            
            $this->dispatch('updatepH',
                pH: round($pH, 2),
                pOH: round($pOH, 2),
                concentration: $this->pHConcentration,
                type: $this->pHType,
                pHCurve: $pHCurve
            );
            
            $this->success('pH calculated!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function calculateStoichiometry()
    {
        try {
            $molesReactant1 = $this->stoichiometryAmount;
            $molesReactant2 = ($this->stoichiometryAmount / $this->stoichiometryCoefficient1) * $this->stoichiometryCoefficient2;
            $molesProduct = ($this->stoichiometryAmount / $this->stoichiometryCoefficient1) * $this->stoichiometryCoefficient3;
            
            $limitingReactant = $this->stoichiometryReactant1;
            
            $reactionProgress = [];
            for ($i = 0; $i <= 100; $i += 10) {
                $progress = $i / 100;
                $remaining1 = max(0, $molesReactant1 * (1 - $progress));
                $remaining2 = max(0, $molesReactant2 * (1 - $progress * $this->stoichiometryCoefficient2 / $this->stoichiometryCoefficient1));
                $produced = min($molesProduct * $progress, $molesProduct);
                
                $reactionProgress[] = [
                    'x' => $i,
                    'reactant1' => round($remaining1, 2),
                    'reactant2' => round($remaining2, 2),
                    'product' => round($produced, 2)
                ];
            }
            
            $this->dispatch('updateStoichiometry',
                molesReactant1: round($molesReactant1, 2),
                molesReactant2: round($molesReactant2, 2),
                molesProduct: round($molesProduct, 2),
                limitingReactant: $limitingReactant,
                reactionProgress: $reactionProgress,
                reactant1: $this->stoichiometryReactant1,
                reactant2: $this->stoichiometryReactant2,
                product: $this->stoichiometryProduct
            );
            
            $this->success('Stoichiometry calculated!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function calculateGasLaw()
    {
        try {
            $R = 0.0821;
            $dataPoints = [];
            $calculatedPressure = null;
            $calculatedVolume = null;
            
            switch ($this->gasLawType) {
                case 'ideal':
                    if ($this->gasLawMoles > 0 && $this->gasLawTemperature > 0 && $this->gasLawVolume > 0) {
                        $calculatedPressure = ($this->gasLawMoles * $R * $this->gasLawTemperature) / $this->gasLawVolume;
                    }
                    if ($this->gasLawMoles > 0 && $this->gasLawTemperature > 0 && $this->gasLawPressure > 0) {
                        $calculatedVolume = ($this->gasLawMoles * $R * $this->gasLawTemperature) / $this->gasLawPressure;
                    }
                    
                    if ($this->gasLawMoles > 0 && $this->gasLawVolume > 0) {
                        for ($temp = 200; $temp <= 400; $temp += 20) {
                            $pressure = ($this->gasLawMoles * $R * $temp) / $this->gasLawVolume;
                            $dataPoints[] = ['x' => $temp, 'y' => round($pressure, 4)];
                        }
                    }
                    break;
                    
                case 'boyle':
                    if ($this->gasLawPressure > 0 && $this->gasLawVolume > 0) {
                        $constant = $this->gasLawPressure * $this->gasLawVolume;
                        for ($vol = 1; $vol <= 50; $vol += 2) {
                            $pressure = $constant / $vol;
                            $dataPoints[] = ['x' => $vol, 'y' => round($pressure, 4)];
                        }
                    }
                    break;
                    
                case 'charles':
                    if ($this->gasLawVolume > 0 && $this->gasLawTemperature > 0) {
                        $constant = $this->gasLawVolume / $this->gasLawTemperature;
                        for ($temp = 200; $temp <= 400; $temp += 10) {
                            $volume = $constant * $temp;
                            $dataPoints[] = ['x' => $temp, 'y' => round($volume, 4)];
                        }
                    }
                    break;
            }
            
            $this->dispatch('updateGasLaw',
                pressure: $this->gasLawPressure,
                volume: $this->gasLawVolume,
                temperature: $this->gasLawTemperature,
                moles: $this->gasLawMoles,
                type: $this->gasLawType,
                dataPoints: $dataPoints,
                calculatedPressure: $calculatedPressure,
                calculatedVolume: $calculatedVolume
            );
            
            $this->success('Gas law calculated!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function render()
    {
        $breadcrumbs = [
            [
                'link' => route("home"),
                'label' => 'Home',
                'icon' => 's-home',
            ],
            [
                'link' => route("virtual-lab.chemistry"),
                'label' => 'Chemistry Lab',
            ],
        ];

        return view('livewire.virtual-lab.chemistry-lab')
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Chemistry Lab',
            ]);
    }
}
