<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Home extends Component
{
    use Toast;

    // public $chart;

    public function mount()
    {
        $this->info('Home', position: 'toast-top toast-end');
    }

    public function render()
    {
        $breadcrumbs = [
            [
                'link' => route("home"), // route('home') = nama route yang ada di web.php
                'label' => 'Home', // label yang ditampilkan di breadcrumb
                'icon' => 's-home',
            ],
            [
                // 'link' => route("home"), // route('home') = nama route yang ada di web.php
                'label' => 'Dashboard', // label yang ditampilkan di breadcrumb
                // 'icon' => 's-dashboard',
            ],
        ];

        // $chart = null;
        // $chart = (new LarapexChart)->lineChart()
        //         ->setTitle('Sales during 2021.')
        //         ->setSubtitle('Physical sales vs Digital sales.')
        //         ->addData('Published posts', [4, 9, 5, 2, 1, 8])
        //         ->addData('Unpublished posts', [7, 2, 7, 2, 5, 4])
        //         ->setColors(['#ffc63b', '#ff6384'])
        //         ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
        //         ->setFontFamily('DM Sans');
 

        // dd($chart);

        return view('livewire.home', [
            // 'chart' => $chart,
        ])
            ->layout('components.layouts.app', [
                'breadcrumbs' => $breadcrumbs,
                'title' => 'Home',
                
            ]);
    }
}
