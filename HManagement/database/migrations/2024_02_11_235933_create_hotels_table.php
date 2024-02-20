<?php

use App\Models\Arrondissement;
use App\Models\Commune;
use App\Models\Departement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->float('longitude');
            $table->float('lattitude');
            $table->string('adresse_postale');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('directeur');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('quartier_id');
            $table->foreign('quartier_id')->references('id')->on('quartiers');
            $table->foreignIdFor(Arrondissement::class)->nullable();
            $table->foreignIdFor(Commune::class)->nullable();
            $table->foreignIdFor(Departement::class)->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
