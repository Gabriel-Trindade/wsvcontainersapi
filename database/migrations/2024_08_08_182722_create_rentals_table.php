<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Relaciona com customers
            $table->foreignId('container_id')->constrained('containers')->onDelete('cascade'); // Relaciona com containers
            $table->date('rental_date'); // Data de início do aluguel
            $table->date('return_date')->nullable(); // Data de retorno (nulo se ainda não devolvido)
            $table->decimal('price', 8, 2); // Preço do aluguel
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
        Schema::dropIfExists('rentals');
    }
}
