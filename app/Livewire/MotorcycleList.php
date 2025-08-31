<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Motorcycle;

class MotorcycleList extends Component
{
    public $motorcycles = [];

    public function mount()
    {
        $this->motorcycles = Motorcycle::all(); // load all motorcycles
    }

    public function render()
    {
        return view('livewire.motorcycle-list')
            ->layout('layouts.app');
    }
}
