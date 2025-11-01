<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class ChemistryLab extends Component
{
    use Toast;

    public function mount()
    {
        $this->info('Welcome to Chemistry Lab!', position: 'toast-top toast-end');
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
