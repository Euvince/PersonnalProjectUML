<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\TypeRole;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdminPermissions = [
            'Gérer les Départements',
            'Gérer les Communes',
            'Gérer les Arrondissements',
            'Gérer les Quartiers',
            'Gérer les Hôtels',
            'Gérer les Types de Chambres',
            'Gérer les Types de Services',
            'Gérer les Moyens de Paiement',
            'Gérer les Rôles',
        ];

        $clientPermissions = [
            'Consulter une Chambre',
            'Réserver une Chambre',
            'Demander un Service',
        ];

        $adminPermissions = [
            'Gérer les Utilisateurs',
            'Gérer les Chambres',
        ];

        $receptionPersonnalPermissions = [
            'Gérer les Réservations',
        ];

        $servicePersonnalPermissions = [
            'Gérer les Demandes de Services',
        ];

        $clientRole = Role::where('name', 'Client')->first();
        $adminRole = Role::where('name', 'Administrateur')->first();
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $servicePersonnalRole = Role::where('name', 'Personnel de Service')->first();
        $receptionPersonnalRole = Role::where('name', 'Personnel de Réception')->first();
        $clientTypeRole = TypeRole::where('type', 'Client')->first();
        $adminTypeRole = TypeRole::where('type', 'Administrateur')->first();
        $superAdminTypeRole = TypeRole::where('type', 'Super Admin')->first();
        $servicePersonnalTypeRole = TypeRole::where('type', 'Personnel de Service')->first();
        $receptionPersonnalTypeRole = TypeRole::where('type', 'Personnel de Réception')->first();


        foreach($superAdminPermissions as $permission){
            Permission::create([
                'name' => $permission,
                'type_role_id' => $superAdminTypeRole->id,
            ]);
            $superAdminRole->givePermissionTo($permission);
        }

        foreach($clientPermissions as $permission){
            Permission::create([
                'name' => $permission,
                'type_role_id' => $clientTypeRole->id,
            ]);
            $clientRole->givePermissionTo($permission);
        }

        foreach($adminPermissions as $permission){
            Permission::create([
                'name' => $permission,
                'type_role_id' => $adminTypeRole->id,
            ]);
            $adminRole->givePermissionTo($permission);
        }

        foreach($servicePersonnalPermissions as $permission){
            Permission::create([
                'name' => $permission,
                'type_role_id' => $servicePersonnalTypeRole->id,
            ]);
            $servicePersonnalRole->givePermissionTo($permission);
        }

        foreach($receptionPersonnalPermissions as $permission){
            Permission::create([
                'name' => $permission,
                'type_role_id' => $receptionPersonnalTypeRole->id,
            ]);
            $receptionPersonnalRole->givePermissionTo($permission);
        }
    }
}
