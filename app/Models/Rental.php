<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'rentals';

    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = [
        'customer_id',
        'container_id',
        'rental_date',
        'return_date',
        'price',
    ];

    // Relação com Customer (um aluguel pertence a um cliente)
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relação com Container (um aluguel pertence a um container)
    public function container()
    {
        return $this->belongsTo(Container::class);
    }
}
