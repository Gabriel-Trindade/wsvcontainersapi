<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'customers';

    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    // Relação com Rental (um cliente pode ter vários aluguéis)
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
