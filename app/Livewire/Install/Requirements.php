<?php

namespace App\Livewire\Install;

use Livewire\Component;

class Requirements extends Component
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
        return view('livewire.install.requirements', [
            'minPhpVersion'     => config('installer-info.minPhpVersion'),
            'recPhpVersion'     => config('installer-info.recPhpVersion'),
            'currentPhpVersion' => config('installer-info.currentPhpVersion'),
            'requirements'      => config('installer-info.requirements'),
            'isHttps'           => request()->isSecure(),
        ])->layout('layouts.install', ['title' => 'Requirements - Installation']);
    }
}
