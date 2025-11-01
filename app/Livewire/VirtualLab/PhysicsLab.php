<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class PhysicsLab extends Component
{
    use Toast;

    public function mount()
    {
        $this->info('Welcome to Physics Lab!', position: 'toast-top toast-end');
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
