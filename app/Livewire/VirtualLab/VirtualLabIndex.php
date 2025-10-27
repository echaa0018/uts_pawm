<?php

namespace App\Livewire\VirtualLab;

use Livewire\Component;
use Mary\Traits\Toast;

class VirtualLabIndex extends Component
{
    use Toast;

    public function render()
    {
        $breadcrumbs = [
            [
                'link' => route("home"),
                'label' => 'Home',
                'icon' => 's-home',
            ],
            [
                'link' => route("virtual-lab.index"),
                'label' => 'Virtual Lab',
            ],
        ];

        return view('livewire.virtual-lab.virtual-lab-index')
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Virtual Laboratory',
            ]);
    }
}
