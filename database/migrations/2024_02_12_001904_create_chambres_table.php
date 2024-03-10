<?php

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
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('numero')/* ->unique() */;
            $table->string('libelle');
            $table->integer('etage');
            $table->text('description');
            $table->string('capacite');
            /* $table->string('statut')->default('Disponible'); */
            $table->boolean('disponible')->default(1);
            $table->boolean('reserve')->default(0);
            $table->boolean('occupe')->default(0);
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('type_chambre_id')->nullable();
            $table->foreign('type_chambre_id')->references('id')->on('types_chambres');
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels');
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
        Schema::dropIfExists('chambres');
    }
};
