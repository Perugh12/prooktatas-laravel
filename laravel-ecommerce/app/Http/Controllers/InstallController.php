<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class InstallController extends Controller
{
    public function index()
    {
        $dbConnectionStatus = false;
        $migrationStatus = false;
        $seederStatus = false;

        # Migrálja az adatbázisokat első telepítéskor
        $migrationStatus = $this->runMigrations();

        if ($migrationStatus) {
            $dbConnectionStatus = $this->checkDatabaseConnection();
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
            Artisan::call('db:seed', [
                '--class' => 'DatabaseSeeder',
                '--force' => 'true' # Éles rendszer esetén is fusson le
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
