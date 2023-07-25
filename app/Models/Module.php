<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $table = 'modules';
    public $primaryKey = "idM";

    public $timestamps = false;
    
    public $heure = 0;
    public $minute = 0;
    public const  PK = 'idM';

}
