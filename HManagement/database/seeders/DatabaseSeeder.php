<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Chambre;
use App\Models\Commune;
use App\Models\Service;
use App\Models\Quartier;
use App\Models\TypeRole;
use App\Models\Permission;
use App\Models\Departement;
use App\Models\TypeChambre;
use App\Models\TypeService;
use App\Models\Arrondissement;
use App\Models\MoyenPaiement;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $typesChambres = TypeChambre::factory()->count(2)->create();

        foreach ($typesChambres as $typeChambre) {
            $ids[] = $typeChambre->id;
        }

        Departement::factory()->count(20)->create()->each(function ($departement) use ($ids) {
            Commune::factory()->count(2)->create([
                'departement_id' => $departement->id
            ])->each(function ($commune) use ($ids) {
                Arrondissement::factory()->count(1)->create([
                    'commune_id' => $commune->id
                ])->each(function ($arrondissement) use ($ids) {
                    Quartier::factory()->count(rand(1, 2))->create([
                        'arrondissement_id' => $arrondissement->id
                    ])->each(function ($quartier) use ($ids) {
                        Hotel::factory()->count(1)->create([
                            'quartier_id' => $quartier->id
                        ])->each(function ($hotel) use ($ids) {
                            Chambre::factory()->count(3)->create([
                                'hotel_id' => $hotel->id,
                                'type_chambre_id' => fake()->randomElement($ids),
                            ]);
                        });
                    });
                });
            });
        });

        MoyenPaiement::factory()->count(4)->create();

        TypeService::factory()->count(3)->create()->each(function ($typeService) {
            Service::factory()->count(10)->create([
                'type_service_id' => $typeService->id
            ]);
        });

        TypeRole::factory()->count(5)->create();

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);

        \App\Models\User::factory()->create([
            'nom' => 'Doe',
            'sexe' => 'Masculin',
            'prenoms' => 'Jonh',
            'email' => 'jonh@doe.fr',
            'password' => Hash::make('123456789'),
            'telephone' => fake()->phoneNumber(),
            'nationnalite' => fake()->country(),
            'date_naissance' => fake()->date()
        ])->assignRole([Role::all()])->permissions()->sync(Permission::all());

        \App\Models\User::factory()->create([
            'nom' => 'Lawson',
            'sexe' => 'Masculin',
            'prenoms' => 'Tony',
            'email' => 'tony@lawson.fr',
            'password' => Hash::make('123456789'),
            'telephone' => fake()->phoneNumber(),
            'nationnalite' => fake()->country(),
            'date_naissance' => fake()->date()
        ])->assignRole(['Administrateur'])->permissions()->sync([
            /* Permission::where('type_role_id', TypeRole::where('type', 'Administrateur')->first()->id)->get() */
            Permission::where('name', 'Gérer les Utilisateurs')->first()->id,
            Permission::where('name', 'Gérer les Chambres')->first()->id,
        ]);

        \App\Models\User::factory()->create([
            'nom' => 'Lossin',
            'sexe' => 'Masculin',
            'prenoms' => 'lobert',
            'email' => 'lossin@lobert.fr',
            'password' => Hash::make('123456789'),
            'telephone' => fake()->phoneNumber(),
            'nationnalite' => fake()->country(),
            'date_naissance' => fake()->date()
        ])->assignRole(['Personnel de Réception'])->permissions()->sync([
            Permission::where('name', 'Gérer les Réservations')->first()->id
        ]);

        \App\Models\User::factory()->create([
            'nom' => 'Jackson',
            'sexe' => 'Masculin',
            'prenoms' => 'jinard',
            'email' => 'jin@jack.fr',
            'password' => Hash::make('123456789'),
            'telephone' => fake()->phoneNumber(),
            'nationnalite' => fake()->country(),
            'date_naissance' => fake()->date()
        ])->assignRole(['Personnel de Service'])->permissions()->sync([
            Permission::where('name', 'Gérer les Demandes de Services')->first()->id
        ]);

        /* User::factory()->count(15)->create(); */
    }
}
