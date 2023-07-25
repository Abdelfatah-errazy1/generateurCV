<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecteurSpect extends Model
{
    use HasFactory;
    
   
    protected $primaryKey = 'idS';

    public const PK = "idS";

    protected $table = "secteursspects";

    public $timestamps = false;
}
