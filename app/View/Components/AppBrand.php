<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppBrand extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'HTML'
                <a href="/" wire:navigate>
                    <!-- Hidden when collapsed -->
                    <div {{ $attributes->class(["hidden-when-collapsed"]) }}>
                        <div class="flex text-justify gap-2 items-center">
                            <img src="/image/houshou_icon.jpg" alt="Houshou Icon" class="w-8 h-8 rounded-lg object-cover">
                            <span class="font-bold text-3xl me-2 bg-gradient-to-r from-red-500 to-gray-500 bg-clip-text text-transparent">
                                Houshou
                            </span>
                        </div>
                    </div>

                    <!-- Display when collapsed -->
                    <div class="display-when-collapsed hidden mx-5 mt-2 mb-2 h-[28px]">
                        <img src="/image/houshou_icon.jpg" alt="Houshou Icon" class="w-6 h-6 rounded-lg object-cover">
                    </div>
                </a>

        HTML;
    }
    
}
