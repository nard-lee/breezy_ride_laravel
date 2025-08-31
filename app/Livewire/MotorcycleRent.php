<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Motorcycle;
use Illuminate\Support\Str;

class MotorcycleRent extends Component
{
    public $id;      
    public $slug;    
    public $motorcycle;

    public function mount($id, $slug)
    {
        $this->id = $id;
        $this->slug = $slug;

        $this->motorcycle = Motorcycle::findOrFail($id);
    }

    public function rent()
    {
        if ($this->motorcycle->status !== 'available') {
            session()->flash('error', 'Sorry, this motorcycle is already rented.');
            return;
        }

        $this->motorcycle->update(['status' => 'rented']);
        session()->flash('success', "You rented {$this->motorcycle->brand} {$this->motorcycle->model}!");
    }

    public function render()
    {
        return view('livewire.motorcycle-rent')
            ->layout('layouts.app');
    }
}
