<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@waretrack.test', 'password' => Hash::make('admin'), 'role' => 'admin', 'phone' => '081100000']);
        User::create(['name' => 'Supervisor', 'email' => 'supervisor@waretrack.test', 'password' => Hash::make('supervisor'), 'role' => 'supervisor']);
        User::create(['name' => 'Staff', 'email' => 'staff@waretrack.test', 'password' => Hash::make('staff'), 'role' => 'staff']);
        $driver = User::create(['name' => 'Driver A', 'email' => 'driver@waretrack.test', 'password' => Hash::make('driver'), 'role' => 'driver', 'phone' => '0811222333']);
        Driver::create(['user_id' => $driver->id, 'license_no' => 'DR-123', 'vehicle_info' => 'Motor Yamaha', 'phone' => '0811222333']);

        $this->call([
            SampleDataSeeder::class,
        ]);
    }
}
