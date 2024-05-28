<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'tip_tipo_doc';

    // Especificar el nombre de la clave primaria si no es 'id'
    protected $primaryKey = 'TIP_ID';

    // Deshabilitar la asignación masiva de atributos (si prefieres usar guarded)
    protected $guarded = [];

    // O, habilitar la asignación masiva de atributos (si prefieres usar fillable)
    // protected $fillable = ['TIP_NOMBRE', 'TIP_PREFIJO'];

    // Deshabilitar timestamps si no estás usando created_at y updated_at
    public $timestamps = true;
}
