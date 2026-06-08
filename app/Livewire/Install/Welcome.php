<?php

namespace App\Livewire\Install;

use Livewire\Component;

class Welcome extends Component
{
    public function mount()
    {
        $isInstalled = file_exists(storage_path('app/installed.json'));

        if ($isInstalled) {
            return $this->redirect(url('/'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.install.welcome')->layout('layouts.install', ['title' => 'Welcome - Installation']);
    }
}
