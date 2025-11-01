<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class PhysicsLab extends Component
{
    use Toast;

    public $activeExperiment = 'projectile';

    // Projectile Motion
    public $velocity = 30;
    public $angle = 45;
    public $gravity = 9.8;

    // Pendulum
    public $pendulumLength = 2;
    public $pendulumAngle = 30;
    public $pendulumGravity = 9.8;

    // Spring-Mass System
    public $mass = 1;
    public $springConstant = 10;
    public $displacement = 0.5;

    // Free Fall
    public $height = 50;
    public $freeFallGravity = 9.8;

    public function mount()
    {
        $this->info('Welcome to Physics Lab! Select an experiment to begin.', position: 'toast-top toast-end');
    }

    public function setExperiment($experiment)
    {
        $this->activeExperiment = $experiment;
        $this->info('Switched to ' . ucfirst(str_replace('-', ' ', $experiment)) . ' experiment', position: 'toast-top toast-end');
    }

    public function calculateProjectile()
    {
        try {
            $angleRad = deg2rad($this->angle);
            $vx = $this->velocity * cos($angleRad);
            $vy = $this->velocity * sin($angleRad);
            
            $timeOfFlight = (2 * $vy) / $this->gravity;
            $maxHeight = ($vy ** 2) / (2 * $this->gravity);
            $range = $vx * $timeOfFlight;
            
            $trajectory = [];
            $steps = 50;
            for ($i = 0; $i <= $steps; $i++) {
                $t = ($timeOfFlight / $steps) * $i;
                $x = $vx * $t;
                $y = $vy * $t - (0.5 * $this->gravity * $t ** 2);
                if ($y >= 0) {
                    $trajectory[] = ['x' => round($x, 2), 'y' => round($y, 2)];
                }
            }
            
            $this->dispatch('updateProjectile', 
                trajectory: $trajectory,
                maxHeight: round($maxHeight, 2),
                range: round($range, 2),
                timeOfFlight: round($timeOfFlight, 2)
            );
            
            $this->success('Projectile motion calculated!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function startPendulum()
    {
        try {
            $period = 2 * pi() * sqrt($this->pendulumLength / $this->pendulumGravity);
            $frequency = 1 / $period;
            $omega = sqrt($this->pendulumGravity / $this->pendulumLength);
            
            // Calculate realistic damping based on air resistance and friction
            // Typical damping for a pendulum in air: b ≈ 0.05 to 0.2 depending on size
            // We'll calculate it based on pendulum properties
            $bobMass = 0.5; // Assume 500g bob
            $dragCoefficient = 0.47; // Sphere drag coefficient
            $airDensity = 1.225; // kg/m³ at sea level
            $bobRadius = 0.05; // 5cm radius
            $bobArea = pi() * $bobRadius ** 2;
            
            // Damping coefficient from air resistance: b ≈ 0.5 * ρ * Cd * A * v / m
            // For small oscillations, we use a simplified model
            $damping = 0.1 * sqrt($this->pendulumLength); // Proportional to length
            
            $dampingRatio = $damping / (2 * $omega);
            $dampedOmega = $omega * sqrt(abs(1 - $dampingRatio ** 2));
            
            $this->dispatch('startPendulumAnimation',
                length: $this->pendulumLength,
                angle: $this->pendulumAngle,
                period: round($period, 2),
                frequency: round($frequency, 2),
                omega: $omega,
                damping: $damping,
                dampingRatio: $dampingRatio,
                dampedOmega: $dampedOmega
            );
            
            $this->success('Pendulum started!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function startSpring()
    {
        try {
            $angularFrequency = sqrt($this->springConstant / $this->mass);
            $period = (2 * pi()) / $angularFrequency;
            $frequency = 1 / $period;
            
            // Calculate realistic damping from material properties
            // Damping in spring systems comes from internal friction and air resistance
            // Typical damping coefficient c ≈ 0.1 to 0.5 for mechanical springs
            // We'll calculate based on mass and spring constant
            $criticalDamping = 2 * sqrt($this->springConstant * $this->mass);
            $damping = 0.1 * $criticalDamping; // 10% of critical damping (underdamped system)
            
            $dampingRatio = $damping / (2 * sqrt($this->springConstant * $this->mass));
            $dampedOmega = $angularFrequency * sqrt(abs(1 - $dampingRatio ** 2));
            
            $this->dispatch('startSpringAnimation',
                mass: $this->mass,
                k: $this->springConstant,
                displacement: $this->displacement,
                period: round($period, 2),
                frequency: round($frequency, 2),
                omega: $angularFrequency,
                damping: $damping,
                dampingRatio: $dampingRatio,
                dampedOmega: $dampedOmega
            );
            
            $this->success('Spring-mass system started!', position: 'toast-top toast-end');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage(), position: 'toast-top toast-end');
        }
    }

    public function calculateFreeFall()
    {
        try {
            $timeToFall = sqrt((2 * $this->height) / $this->freeFallGravity);
            $finalVelocity = $this->freeFallGravity * $timeToFall;
            
            $trajectory = [];
            $steps = 50;
            for ($i = 0; $i <= $steps; $i++) {
                $t = ($timeToFall / $steps) * $i;
                $y = $this->height - (0.5 * $this->freeFallGravity * $t ** 2);
                $v = $this->freeFallGravity * $t;
                if ($y >= 0) {
                    $trajectory[] = [
                        't' => round($t, 2),
                        'y' => round($y, 2),
                        'v' => round($v, 2)
                    ];
                }
            }
            
            $this->dispatch('updateFreeFall',
                trajectory: $trajectory,
                timeToFall: round($timeToFall, 2),
                finalVelocity: round($finalVelocity, 2)
            );
            
            $this->success('Free fall calculated!', position: 'toast-top toast-end');
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
                'link' => route("virtual-lab.physics"),
                'label' => 'Physics Lab',
            ],
        ];

        return view('livewire.virtual-lab.physics-lab')
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Physics Lab',
            ]);
    }
}
