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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('wilaya', [
                'Adrar', 'Chlef', 'Laghouat', 'Oum El Bouaghi', 'Batna', 'Bejaia', 'Biskra', 'Bechar', 'Blida',
                'Bouira', 'Tamanrasset', 'Tebessa', 'Tlemcen', 'Tiaret', 'Tizi Ouzou', 'Alger', 'Djelfa', 'Jijel',
                'Setif', 'Saida', 'Skikda', 'Sidi Bel Abbes', 'Annaba', 'Guelma', 'Constantine', 'Medea', 'Mostaganem',
                'MSila', 'Mascara', 'Ouargla', 'Oran', 'El Bayadh', 'Illizi', 'Bordj Bou Arreridj', 'Boumerdes',
                'El Tarf', 'Tindouf', 'Tissemsilt', 'El Oued', 'Khenchela', 'Souk Ahras', 'Tipaza', 'Mila', 'Ain Defla',
                'Naama', 'Ain Temouchent', 'Ghardaia', 'Relizane', 'El MGhair', 'Timimoun', 'Ouled Djellal',
                'Bordj Baji Mokhtar', 'Beni Abbes', 'In Salah', 'In Guezzam', 'Touggourt', 'Djanet', 'El Meniaa',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
