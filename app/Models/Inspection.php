<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'inspections';

    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = [
        'container_id',
        'inspection_date',
        'status',
        'notes',
    ];

    // Relação com Container (uma inspeção pertence a um container)
    public function container()
    {
        return $this->belongsTo(Container::class);
    }
}
