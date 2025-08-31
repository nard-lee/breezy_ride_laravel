<?php

namespace App\Livewire; // use App\Http\Livewire; if you're on v2

use Livewire\Component;
use App\Models\Motorcycle;

class RecommendedMotorcycles extends Component
{
    public function render()
    {
        $motorcycles = Motorcycle::where('status', 'available')
            ->orderBy('rental_price')
            ->limit(3)
            ->get();

        return view('livewire.recommended-motorcycles', compact('motorcycles'));
    }
}
