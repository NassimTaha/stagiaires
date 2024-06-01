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
        Schema::create('structures_affectations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Direction', 'Sous-direction', 'Departement']);
            $table->integer('quota_pfe')->unsigned();
            $table->integer('quota_im')->unsigned();
            $table->unsignedInteger('year')->default(date('Y'));
            $table->unsignedBigInteger('structuresIAP_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('structuresIAP_id')->references('id')->on('structures_i_a_p_s');
            $table->foreign('parent_id')->references('id')->on('structures_affectations');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structures_affectations');
    }
};
