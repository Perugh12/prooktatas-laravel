<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class InstallController extends Controller
{
    public function index()
    {
        # Migrálja az adatbázisokat első telepítéskor
        $dbConnectionStatus = $this->checkDatabaseConnection();
        $migrationStatus = false;
        $seederStatus = false;

        # Ha van kapcsolat akkor mehet a migráció
        if ($dbConnectionStatus) {
            $migrationStatus = $this->runMigrations();
        }

        # Ha sikeres a migráció akkor mehet a seeder
        if ($migrationStatus) {
            $seederStatus = $this->runSeeders();
        }

        return response()->json([
            'database_connection_status' => $dbConnectionStatus,
            'migration_status' => $migrationStatus,
            'seeder_status' => $seederStatus,
        ]);
    }

    private function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function runMigrations()
    {
        try {
            Artisan::call('migrate');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function runSeeders()
    {
        try {
            Artisan::call('db:seed');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
