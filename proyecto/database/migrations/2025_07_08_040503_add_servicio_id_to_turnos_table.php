<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->unsignedBigInteger('servicio_id')->nullable()->after('usuario_id');

            //Relación con la tabla servicios
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        
            $table->dropColumn('servicio');    
        });

    }

    public function down(): void
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropForeign(['servicio_id']);
            $table->dropColumn('servicio');

            // En caso de rollback, restaurar columna anterior.
            $table->string('servicio')->nullable();
        });
    }
};
