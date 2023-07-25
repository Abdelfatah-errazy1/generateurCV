<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periodes';
    public $primaryKey = "idP";

    public $timestamps = false;
    public const  PK = 'idP';
}
