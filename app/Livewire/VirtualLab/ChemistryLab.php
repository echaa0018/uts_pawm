<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class ChemistryLab extends Component
{
    use Toast;

    // Selected experiment
    public $selectedExperiment = null;
    
    // Molarity Calculator Variables
    public $moles = 1.0;
    public $volumeLiters = 1.0;
    public $molarity = 0;
    
    // pH Calculator Variables
    public $hydrogenIonConcentration = 0.0001; // [H+] in mol/L
    public $pH = 0;
    public $pOH = 0;
    public $solutionType = '';
    
    // Ideal Gas Law Variables (PV = nRT)
    public $pressure = 1; // atm
    public $volume = 22.4; // L
    public $temperature = 273; // K
    public $gasConstant = 0.0821; // L·atm/(mol·K)
    public $molesGas = 0;
    
    // Stoichiometry Calculator
    public $reactantMass = 10; // grams
    public $reactantMolarMass = 18; // g/mol (e.g., H2O)
    public $productMolarMass = 44; // g/mol (e.g., CO2)
    public $moleRatio = 1; // reactant:product
    public $productMass = 0;

    public function mount()
    {
        $this->selectedExperiment = 'molarity';
    }

    public function selectExperiment($experiment)
    {
        $this->selectedExperiment = $experiment;
        $this->resetCalculations();
    }

    public function calculateMolarity()
    {
        if ($this->volumeLiters <= 0) {
            $this->toast(
                type: 'error',
                title: 'Invalid Input',
                description: 'Volume must be greater than zero',
                position: 'toast-top toast-end',
                icon: 'o-x-circle',
                timeout: 3000
            );
            return;
        }

        // M = n/V
        $this->molarity = $this->moles / $this->volumeLiters;
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Molarity calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function calculatePH()
    {
        if ($this->hydrogenIonConcentration <= 0) {
            $this->toast(
                type: 'error',
                title: 'Invalid Input',
                description: 'Concentration must be greater than zero',
                position: 'toast-top toast-end',
                icon: 'o-x-circle',
                timeout: 3000
            );
            return;
        }

        // pH = -log[H+]
        $this->pH = -log10($this->hydrogenIonConcentration);
        
        // pOH = 14 - pH
        $this->pOH = 14 - $this->pH;
        
        // Determine solution type
        if ($this->pH < 7) {
            $this->solutionType = 'Acidic';
        } elseif ($this->pH > 7) {
            $this->solutionType = 'Basic';
        } else {
            $this->solutionType = 'Neutral';
        }
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'pH calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function calculateIdealGas()
    {
        if ($this->pressure <= 0 || $this->volume <= 0 || $this->temperature <= 0) {
            $this->toast(
                type: 'error',
                title: 'Invalid Input',
                description: 'All values must be greater than zero',
                position: 'toast-top toast-end',
                icon: 'o-x-circle',
                timeout: 3000
            );
            return;
        }

        // PV = nRT, solve for n: n = PV/RT
        $this->molesGas = ($this->pressure * $this->volume) / ($this->gasConstant * $this->temperature);
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Ideal gas calculation completed',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function calculateStoichiometry()
    {
        if ($this->reactantMolarMass <= 0 || $this->productMolarMass <= 0 || $this->moleRatio <= 0) {
            $this->toast(
                type: 'error',
                title: 'Invalid Input',
                description: 'All values must be greater than zero',
                position: 'toast-top toast-end',
                icon: 'o-x-circle',
                timeout: 3000
            );
            return;
        }

        // Calculate moles of reactant
        $reactantMoles = $this->reactantMass / $this->reactantMolarMass;
        
        // Calculate moles of product using mole ratio
        $productMoles = $reactantMoles * $this->moleRatio;
        
        // Calculate mass of product
        $this->productMass = $productMoles * $this->productMolarMass;
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Stoichiometry calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function resetCalculations()
    {
        $this->molarity = 0;
        $this->pH = 0;
        $this->pOH = 0;
        $this->solutionType = '';
        $this->molesGas = 0;
        $this->productMass = 0;
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
                'label' => 'Virtual Lab',
            ],
            [
                'link' => route("virtual-lab.chemistry"),
                'label' => 'Chemistry Lab',
            ],
        ];

        return view('livewire.virtual-lab.chemistry-lab')
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Chemistry Virtual Lab',
            ]);
    }
}
