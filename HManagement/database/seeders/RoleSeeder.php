<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\TypeRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientTypeRole = TypeRole::where('type', 'Client')->first();
        $adminTypeRole = TypeRole::where('type', 'Administrateur')->first();
        $superAdminTypeRole = TypeRole::where('type', 'Super Admin')->first();
        $servicePersonnalTypeRole = TypeRole::where('type', 'Personnel de Service')->first();
        $receptionPersonnalTypeRole = TypeRole::where('type', 'Personnel de Réception')->first();

        Role::create([
            'name' => 'Client',
            'type_role_id' => $clientTypeRole->id
        ]);

        Role::create([
            'name' => 'Administrateur',
            'type_role_id' => $adminTypeRole->id
        ]);

        Role::create([
            'name' => 'Super Admin',
            'type_role_id' => $superAdminTypeRole->id
        ]);

        Role::create([
            'name' => 'Personnel de Service',
            'type_role_id' => $servicePersonnalTypeRole->id
        ]);

        Role::create([
            'name' => 'Personnel de Réception',
            'type_role_id' => $receptionPersonnalTypeRole->id
        ]);
    }
}
