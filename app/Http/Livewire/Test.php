<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component{

    public $number = 78496366;
    public $message = "Hola como estas";

    public function render(){
        return view('livewire.test')
        ->layout('layouts.app', ['title' => 'Test']);
    }
}
