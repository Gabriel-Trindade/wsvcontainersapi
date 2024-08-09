<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'containers';

    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = [
        'container_id',
        'type',
        'capacity',
        'status',
    ];

    // Relação com Rental (um container pode ter vários aluguéis)
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    // Relação com Inspections (um container pode ter várias inspeções)
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
