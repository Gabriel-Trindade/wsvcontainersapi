<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('container_id')->constrained('containers')->onDelete('cascade'); // Relaciona com containers
            $table->date('inspection_date'); // Data da inspeção
            $table->string('status'); // Status da inspeção (ex: aprovado, reprovado)
            $table->text('notes')->nullable(); // Observações adicionais
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspections');
    }
}
