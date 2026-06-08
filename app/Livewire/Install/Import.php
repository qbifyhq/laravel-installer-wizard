<?php

namespace App\Livewire\Install;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class Import extends Component
{
    public bool $migrated = false;
    public bool $running = false;

    public function mount()
    {
        $isInstalled = file_exists(storage_path('app/installed.json'));

        if ($isInstalled) {
            return $this->redirect(url('/'), navigate: true);
        }

        $this->checkMigrationStatus();
    }

    public function checkMigrationStatus()
    {
        try {
            $this->migrated = Schema::hasTable('migrations');
        } catch (\Throwable) {
            $this->migrated = false;
        }
    }

    public function runMigrations()
    {
        $this->running = true;

        try {
            Artisan::call('migrate', [
                '--force' => true,
            ]);

            File::put(
                storage_path('app/installed.json'),
                json_encode([
                    'installed'   => true,
                    'installed_at' => now()->toDateTimeString()
                ], JSON_PRETTY_PRINT)
            );

            $this->migrated = true;
        } catch (\Throwable $e) {
            $this->addError('migration', $e->getMessage());
        }

        $this->running = false;
    }

    public function render()
    {
        return view('livewire.install.import')->layout('layouts.install', ['title' => 'Import Data - Installation']);
    }
}
