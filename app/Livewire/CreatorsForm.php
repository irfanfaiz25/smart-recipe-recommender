<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CreatorsForm extends Component
{
    public $phoneNumber;
    public $city;


    public function save()
    {
        $this->validate([
            'phoneNumber' => 'required|unique:creators,phone_number',
            'city' => 'required|string',
        ]);

        if (Auth::user()->creators()->exists()) {
            Toaster::error('Anda sudah menjadi creators');
        } else {
            Auth::user()->creators()->create([
                'phone_number' => $this->phoneNumber,
                'city' => $this->city,
            ]);

            // assign role
            Auth::user()->assignRole('creators');

            Toaster::success('Anda berhasil menjadi creators');

            $this->reset('phoneNumber', 'city');
            $this->redirect(route('creators.index'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.user.creators-form');
    }
}
