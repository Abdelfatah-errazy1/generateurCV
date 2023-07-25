<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    public $table = 'taches';
    protected $primaryKey = 'idT';
    public $timestamps = false;
    public const PK = 'idT';
}
