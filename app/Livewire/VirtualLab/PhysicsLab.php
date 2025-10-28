<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class PhysicsLab extends Component
{
    use Toast;

    // Selected experiment
    public $selectedExperiment = null;
    
    // Pendulum Experiment Variables
    public $pendulumLength = 1.0; // meters
    public $pendulumAngle = 15; // degrees
    public $pendulumPeriod = 0;
    public $isSimulating = false;
    
    // Projectile Motion Variables
    public $initialVelocity = 20; // m/s
    public $launchAngle = 45; // degrees
    public $maxHeight = 0;
    public $range = 0;
    public $timeOfFlight = 0;
    
    // Free Fall Variables
    public $dropHeight = 10; // meters
    public $fallTime = 0;
    public $finalVelocity = 0;
    
    // Circular Motion Variables
    public $circularRadius = 5; // meters
    public $circularVelocity = 10; // m/s
    public $circularPeriod = 0;
    public $centripetalForce = 0;
    public $angularVelocity = 0;
    
    // Wave Motion Variables
    public $waveFrequency = 2; // Hz
    public $waveAmplitude = 1; // meters
    public $waveWavelength = 2; // meters
    public $waveSpeed = 0;
    public $wavePeriod = 0;
    
    // Energy Conservation Variables
    public $mass = 1; // kg
    public $height = 10; // meters
    public $velocity = 0; // m/s
    public $potentialEnergy = 0;
    public $kineticEnergy = 0;
    public $totalEnergy = 0;
    
    public function mount()
    {
        $this->selectedExperiment = 'pendulum';
    }

    public function selectExperiment($experiment)
    {
        $this->selectedExperiment = $experiment;
        $this->resetCalculations();
    }

    public function calculatePendulum()
    {
        // T = 2π√(L/g)
        $g = 9.81; // gravity
        $this->pendulumPeriod = 2 * pi() * sqrt($this->pendulumLength / $g);
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Pendulum period calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function calculateProjectile()
    {
        $g = 9.81;
        $angleRad = deg2rad($this->launchAngle);
        $v0 = $this->initialVelocity;
        
        // Time of flight: t = 2v₀sin(θ)/g
        $this->timeOfFlight = (2 * $v0 * sin($angleRad)) / $g;
        
        // Maximum height: h = (v₀²sin²(θ))/(2g)
        $this->maxHeight = pow($v0 * sin($angleRad), 2) / (2 * $g);
        
        // Range: R = (v₀²sin(2θ))/g
        $this->range = (pow($v0, 2) * sin(2 * $angleRad)) / $g;
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Projectile motion calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function calculateFreeFall()
    {
        $g = 9.81;
        
        // t = √(2h/g)
        $this->fallTime = sqrt((2 * $this->dropHeight) / $g);
        
        // v = gt
        $this->finalVelocity = $g * $this->fallTime;
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Free fall calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function calculateCircularMotion()
    {
        $g = 9.81;
        
        // Period: T = 2πr/v
        $this->circularPeriod = (2 * pi() * $this->circularRadius) / $this->circularVelocity;
        
        // Angular velocity: ω = v/r
        $this->angularVelocity = $this->circularVelocity / $this->circularRadius;
        
        // Centripetal force: F = mv²/r (assuming mass = 1kg)
        $this->centripetalForce = ($this->circularVelocity * $this->circularVelocity) / $this->circularRadius;
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Circular motion calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }
    
    public function calculateWaveMotion()
    {
        // Wave speed: v = fλ
        $this->waveSpeed = $this->waveFrequency * $this->waveWavelength;
        
        // Wave period: T = 1/f
        $this->wavePeriod = 1 / $this->waveFrequency;
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Wave motion calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }
    
    public function calculateEnergyConservation()
    {
        $g = 9.81;
        
        // Potential Energy: PE = mgh
        $this->potentialEnergy = $this->mass * $g * $this->height;
        
        // Kinetic Energy: KE = ½mv²
        $this->kineticEnergy = 0.5 * $this->mass * $this->velocity * $this->velocity;
        
        // Total Energy: E = PE + KE
        $this->totalEnergy = $this->potentialEnergy + $this->kineticEnergy;
        
        $this->toast(
            type: 'success',
            title: 'Calculation Complete',
            description: 'Energy conservation calculated successfully',
            position: 'toast-top toast-end',
            icon: 'o-check-circle',
            timeout: 3000
        );
    }

    public function resetCalculations()
    {
        $this->pendulumPeriod = 0;
        $this->maxHeight = 0;
        $this->range = 0;
        $this->timeOfFlight = 0;
        $this->fallTime = 0;
        $this->finalVelocity = 0;
        $this->circularPeriod = 0;
        $this->centripetalForce = 0;
        $this->angularVelocity = 0;
        $this->waveSpeed = 0;
        $this->wavePeriod = 0;
        $this->potentialEnergy = 0;
        $this->kineticEnergy = 0;
        $this->totalEnergy = 0;
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
                'link' => route("virtual-lab.physics"),
                'label' => 'Physics Lab',
            ],
        ];

        return view('livewire.virtual-lab.physics-lab')
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Physics Virtual Lab',
            ]);
    }
}
