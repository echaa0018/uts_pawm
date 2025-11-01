<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class MathLab extends Component
{
    use Toast;

    public function mount()
    {
        $this->info('Welcome to Math Lab!', position: 'toast-top toast-end');
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
                'link' => route("virtual-lab.math"),
                'label' => 'Math Lab',
            ],
        ];

        return view('livewire.virtual-lab.math-lab')
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Math Lab',
            ]);
    }
}
