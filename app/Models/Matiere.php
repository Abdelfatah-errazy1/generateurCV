<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $table = 'matieres';
    public $primaryKey = "idMat";

    public $timestamps = false;
    public const  PK = 'idMat';
}
