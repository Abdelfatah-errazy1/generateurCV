<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilLangue extends Model
{
    use HasFactory;
    public $table='profillangues';
    protected $primaryKey = "idP";

    public const PK = "idP";

    public $timestamps = false;
}
