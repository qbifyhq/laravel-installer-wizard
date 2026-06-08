<?php

namespace App\Livewire\Install;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Throwable;

class Database extends Component
{
    public string $db_driver = 'mysql';

    public string $db_host = 'localhost';
    public string $db_port = '3306';
    public string $db_name = '';
    public string $db_user = '';
    public string $db_pass = '';

    public string $sqlite_path = '';

    public function mount()
    {
        $isInstalled = file_exists(storage_path('app/installed.json'));

        if ($isInstalled) {
            return $this->redirect(url('/'), navigate: true);
        }
    }

    public function updatedDbDriver()
    {
        $this->db_port = match ($this->db_driver) {
            'mysql' => '3306',
            'pgsql' => '5432',
            'sqlsrv' => '1433',
            default => $this->db_port,
        };
    }

    public function submit()
    {
        $this->validate($this->rules());

        $this->testDatabaseConnection();

        if ($this->getErrorBag()->isNotEmpty()) {
            return $this->dispatch(
                'toastMagic',
                status: 'error',
                title: 'Database Connection Failed',
                message: 'Please check your database credentials and try again.'
            );
        }

        $this->updateEnvFile();

        // clear config cache so Laravel picks new DB config
        if (function_exists('artisan')) {
            artisan('config:clear');
        }

        return $this->redirect(route('install.import'), navigate: true);
    }

    private function rules()
    {
        return [
            'db_driver' => ['required'],
            'db_name'   => ['required_if:db_driver,mysql,pgsql,sqlsrv'],
            'db_user'   => ['required_if:db_driver,mysql,pgsql,sqlsrv'],
        ];
    }

    private function testDatabaseConnection()
    {
        try {
            $config = $this->getDatabaseConfig();

            Config::set('database.connections.install_test', $config);

            DB::connection('install_test')->getPdo();

        } catch (Throwable $e) {
            $this->addError('db_connection', 'Database connection failed: ' . $e->getMessage());
            return;
        }
    }

    private function getDatabaseConfig()
    {
        return match ($this->db_driver) {
            'sqlite' => [
                'driver'   => 'sqlite',
                'database' => $this->sqlite_path ?: database_path('database.sqlite'),
                'prefix'   => '',
            ],

            'mysql' => [
                'driver'   => 'mysql',
                'host'     => $this->db_host,
                'port'     => $this->db_port,
                'database' => $this->db_name,
                'username' => $this->db_user,
                'password' => $this->db_pass,
                'charset'  => 'utf8mb4',
                'collation'=> 'utf8mb4_unicode_ci',
            ],

            'pgsql' => [
                'driver'   => 'pgsql',
                'host'     => $this->db_host,
                'port'     => $this->db_port,
                'database' => $this->db_name,
                'username' => $this->db_user,
                'password' => $this->db_pass,
                'charset'  => 'utf8',
            ],

            'sqlsrv' => [
                'driver'   => 'sqlsrv',
                'host'     => $this->db_host,
                'port'     => $this->db_port,
                'database' => $this->db_name,
                'username' => $this->db_user,
                'password' => $this->db_pass,
            ],

            default => [],
        };
    }

    private function updateEnvFile()
    {
        $envPath = base_path('.env');

        $env = File::exists($envPath)
            ? File::get($envPath)
            : '';

        $data = $this->buildEnvData();

        foreach ($data as $key => $value) {
            $env = preg_replace(
                "/^{$key}=.*$/m",
                "{$key}={$value}",
                $env
            ) ?? $env;
        }

        File::put($envPath, $env);
    }

    private function buildEnvData()
    {
        $base = [
            'DB_CONNECTION' => $this->db_driver,
        ];

        return match ($this->db_driver) {
            'sqlite' => array_merge($base, [
                'DB_DATABASE' => $this->sqlite_path ?: database_path('database.sqlite'),
                'DB_HOST'     => '',
                'DB_PORT'     => '',
                'DB_USERNAME' => '',
                'DB_PASSWORD' => '',
            ]),

            'mysql', 'pgsql', 'sqlsrv' => array_merge($base, [
                'DB_HOST'     => $this->db_host,
                'DB_PORT'     => $this->db_port,
                'DB_DATABASE' => $this->db_name,
                'DB_USERNAME' => $this->db_user,
                'DB_PASSWORD' => $this->db_pass,
            ]),

            default => $base,
        };
    }

    public function render()
    {
        return view('livewire.install.database')->layout('layouts.install', ['title' => 'Database - Installation']);
    }
}
