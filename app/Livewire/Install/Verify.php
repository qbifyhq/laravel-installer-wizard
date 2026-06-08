<?php

namespace App\Livewire\Install;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Verify extends Component
{
    public string $license_key = '';

    public function mount()
    {
        $isInstalled = file_exists(storage_path('app/installed.json'));

        if ($isInstalled) {
            return $this->redirect(url('/'), navigate: true);
        }
    }

    public function verifyLicense()
    {
        $this->validate([
            'license_key' => 'required|string',
        ]);

        try {
            $currentDomain = request()->getHost();

            $response = Http::timeout(10)->post(config('installer-info.license_server_url'), ['license_key' => $this->license_key, 'domain' => $currentDomain]);

            if (!$response->successful()) {
                return $this->dispatch(
                    'toastMagic',
                    status: 'error',
                    title: 'Server Error',
                    message: 'License server not reachable. Try again later.'
                );
            }

            $data = $response->json();

            if (!isset($data['status']) || $data['status'] !== 'valid') {
                return $this->dispatch(
                    'toastMagic',
                    status: 'error',
                    title: 'Invalid License',
                    message: $data['message'] ?? 'License not valid'
                );
            }

            $responseDomain = $data['activation']['domain'] ?? null;

            if ($responseDomain && $responseDomain !== $currentDomain) {
                return $this->dispatch(
                    'toastMagic',
                    status: 'error',
                    title: 'Domain Mismatch',
                    message: 'This license is already activated on another domain.'
                );
            }

            file_put_contents(storage_path('app/license.json'), json_encode(['license_key' => $this->license_key, 'domain' => $currentDomain, 'verified_at' => now()->toDateTimeString()], JSON_PRETTY_PRINT));

            return $this->redirect(route('install.requirements'), navigate: true);
        } catch (\Throwable $e) {
            return $this->dispatch(
                'toastMagic',
                status: 'error',
                title: 'Error',
                message: $e->getMessage()
            );
        }
    }

    public function render()
    {
        return view('livewire.install.verify')->layout('layouts.install', ['title' => 'Verify - Installation']);
    }
}
