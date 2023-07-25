<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilliereNiveau extends Model
{
    use HasFactory;
    protected $table = 'filliereNiveau';
    public const  PK = 'idF';
    
}
