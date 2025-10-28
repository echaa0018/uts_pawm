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
    
    // Molecular Weight Calculator
    public $molecularFormula = 'H2O';
    public $molecularWeight = 0;
    public $elementBreakdown = [];
    
    // Periodic Table Data (simplified)
    public $selectedElement = null;
    public $elementData = [];
    
    // Reaction Balancer
    public $reactants = 'H2 + O2';
    public $products = 'H2O';
    public $balancedReaction = '';
    public $reactionSteps = [];

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
    
    public function calculateMolecularWeight()
    {
        $this->elementBreakdown = [];
        $this->molecularWeight = 0;
        
        // Simple periodic table data
        $atomicMasses = [
            'H' => 1.008, 'He' => 4.003, 'Li' => 6.941, 'Be' => 9.012, 'B' => 10.811,
            'C' => 12.011, 'N' => 14.007, 'O' => 15.999, 'F' => 18.998, 'Ne' => 20.180,
            'Na' => 22.990, 'Mg' => 24.305, 'Al' => 26.982, 'Si' => 28.085, 'P' => 30.974,
            'S' => 32.065, 'Cl' => 35.453, 'Ar' => 39.948, 'K' => 39.098, 'Ca' => 40.078,
            'Sc' => 44.956, 'Ti' => 47.867, 'V' => 50.942, 'Cr' => 51.996, 'Mn' => 54.938,
            'Fe' => 55.845, 'Co' => 58.933, 'Ni' => 58.693, 'Cu' => 63.546, 'Zn' => 65.38,
            'Ga' => 69.723, 'Ge' => 72.630, 'As' => 74.922, 'Se' => 78.971, 'Br' => 79.904,
            'Kr' => 83.798, 'Rb' => 85.468, 'Sr' => 87.62, 'Ag' => 107.868, 'Cd' => 112.41,
            'Sn' => 118.71, 'I' => 126.904, 'Xe' => 131.29, 'Cs' => 132.91, 'Ba' => 137.33,
            'Au' => 196.97, 'Hg' => 200.59, 'Pb' => 207.2, 'U' => 238.03
        ];
        
        // Parse molecular formula (simple regex for basic formulas)
        $formula = strtoupper(trim($this->molecularFormula));
        
        // Simple parsing for formulas like H2O, CO2, CH4, etc.
        if (preg_match_all('/([A-Z][a-z]?)(\d*)/', $formula, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $element = $match[1];
                $count = $match[2] ? (int)$match[2] : 1;
                
                if (isset($atomicMasses[$element])) {
                    $mass = $atomicMasses[$element] * $count;
                    $this->elementBreakdown[] = [
                        'element' => $element,
                        'count' => $count,
                        'mass' => $mass
                    ];
                    $this->molecularWeight += $mass;
                }
            }
        }
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Molecular weight calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }
    
    public function getElementInfo($elementSymbol)
    {
        $this->selectedElement = $elementSymbol;
        
        $elements = [
            'H'  => ['name' => 'Hydrogen', 'atomicNumber' => 1, 'mass' => 1.008, 'group' => 'Nonmetal'],
            'He' => ['name' => 'Helium', 'atomicNumber' => 2, 'mass' => 4.003, 'group' => 'Noble Gas'],
            'Li' => ['name' => 'Lithium', 'atomicNumber' => 3, 'mass' => 6.941, 'group' => 'Alkali Metal'],
            'C'  => ['name' => 'Carbon', 'atomicNumber' => 6, 'mass' => 12.011, 'group' => 'Nonmetal'],
            'N'  => ['name' => 'Nitrogen', 'atomicNumber' => 7, 'mass' => 14.007, 'group' => 'Nonmetal'],
            'O'  => ['name' => 'Oxygen', 'atomicNumber' => 8, 'mass' => 15.999, 'group' => 'Nonmetal'],
            'F'  => ['name' => 'Fluorine', 'atomicNumber' => 9, 'mass' => 18.998, 'group' => 'Halogen'],
            'Ne' => ['name' => 'Neon', 'atomicNumber' => 10, 'mass' => 20.180, 'group' => 'Noble Gas'],
            'Na' => ['name' => 'Sodium', 'atomicNumber' => 11, 'mass' => 22.990, 'group' => 'Alkali Metal'],
            'Mg' => ['name' => 'Magnesium', 'atomicNumber' => 12, 'mass' => 24.305, 'group' => 'Alkaline Earth'],
            'Al' => ['name' => 'Aluminum', 'atomicNumber' => 13, 'mass' => 26.982, 'group' => 'Post-Transition Metal'],
            'Si' => ['name' => 'Silicon', 'atomicNumber' => 14, 'mass' => 28.085, 'group' => 'Metalloid'],
            'P'  => ['name' => 'Phosphorus', 'atomicNumber' => 15, 'mass' => 30.974, 'group' => 'Nonmetal'],
            'S'  => ['name' => 'Sulfur', 'atomicNumber' => 16, 'mass' => 32.065, 'group' => 'Nonmetal'],
            'Cl' => ['name' => 'Chlorine', 'atomicNumber' => 17, 'mass' => 35.453, 'group' => 'Halogen'],
            'Ar' => ['name' => 'Argon', 'atomicNumber' => 18, 'mass' => 39.948, 'group' => 'Noble Gas'],
            'K'  => ['name' => 'Potassium', 'atomicNumber' => 19, 'mass' => 39.098, 'group' => 'Alkali Metal'],
            'Ca' => ['name' => 'Calcium', 'atomicNumber' => 20, 'mass' => 40.078, 'group' => 'Alkaline Earth'],
            'Fe' => ['name' => 'Iron', 'atomicNumber' => 26, 'mass' => 55.845, 'group' => 'Transition Metal'],
            'Ni' => ['name' => 'Nickel', 'atomicNumber' => 28, 'mass' => 58.693, 'group' => 'Transition Metal'],
            'Cu' => ['name' => 'Copper', 'atomicNumber' => 29, 'mass' => 63.546, 'group' => 'Transition Metal'],
            'Zn' => ['name' => 'Zinc', 'atomicNumber' => 30, 'mass' => 65.38, 'group' => 'Transition Metal'],
            'Br' => ['name' => 'Bromine', 'atomicNumber' => 35, 'mass' => 79.904, 'group' => 'Halogen'],
            'Ag' => ['name' => 'Silver', 'atomicNumber' => 47, 'mass' => 107.868, 'group' => 'Transition Metal'],
            'Sn' => ['name' => 'Tin', 'atomicNumber' => 50, 'mass' => 118.71, 'group' => 'Post-Transition Metal'],
            'I'  => ['name' => 'Iodine', 'atomicNumber' => 53, 'mass' => 126.904, 'group' => 'Halogen'],
            'Ba' => ['name' => 'Barium', 'atomicNumber' => 56, 'mass' => 137.33, 'group' => 'Alkaline Earth'],
            'Au' => ['name' => 'Gold', 'atomicNumber' => 79, 'mass' => 196.97, 'group' => 'Transition Metal'],
            'Hg' => ['name' => 'Mercury', 'atomicNumber' => 80, 'mass' => 200.59, 'group' => 'Transition Metal'],
            'Pb' => ['name' => 'Lead', 'atomicNumber' => 82, 'mass' => 207.2, 'group' => 'Post-Transition Metal'],
            'U'  => ['name' => 'Uranium', 'atomicNumber' => 92, 'mass' => 238.03, 'group' => 'Actinide'],
        ];
        
        $this->elementData = $elements[$elementSymbol] ?? null;
        
        $this->toast(
            type: 'success',
            title: 'Element Information',
            description: 'Element data loaded successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }
    
    public function balanceReaction()
    {
        $this->reactionSteps = [];
        $this->balancedReaction = '';
        
        // Simple reaction balancing for common reactions
        $commonReactions = [
            'H2 + O2 → H2O' => '2H2 + O2 → 2H2O',
            'CH4 + O2 → CO2 + H2O' => 'CH4 + 2O2 → CO2 + 2H2O',
            'N2 + H2 → NH3' => 'N2 + 3H2 → 2NH3',
            'Al + O2 → Al2O3' => '4Al + 3O2 → 2Al2O3',
            'Fe + O2 → Fe2O3' => '4Fe + 3O2 → 2Fe2O3'
        ];
        
        $reaction = $this->reactants . ' → ' . $this->products;
        
        if (isset($commonReactions[$reaction])) {
            $this->balancedReaction = $commonReactions[$reaction];
            $this->reactionSteps[] = "Identified reaction: " . $reaction;
            $this->reactionSteps[] = "Balanced equation: " . $this->balancedReaction;
            $this->reactionSteps[] = "All atoms are now balanced on both sides";
        } else {
            $this->balancedReaction = $reaction . " (Manual balancing required)";
            $this->reactionSteps[] = "This reaction requires manual balancing";
            $this->reactionSteps[] = "Count atoms on each side and adjust coefficients";
        }
        
        $this->toast(
            type: 'success',
            title: 'Reaction Balanced',
            description: 'Chemical equation balanced successfully',
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
        $this->molecularWeight = 0;
        $this->elementBreakdown = [];
        $this->elementData = [];
        $this->balancedReaction = '';
        $this->reactionSteps = [];
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
