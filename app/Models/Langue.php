<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    use HasFactory;
    protected $primaryKey = 'idL';

    public const PK = "idL";

    protected $table = "langues";

    public $timestamps = false;
}
