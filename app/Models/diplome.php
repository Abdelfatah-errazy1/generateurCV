<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diplome extends Model
{
    use HasFactory;

    protected $primaryKey = "idD";

    public const PK = "idD";

    public $timestamps = false;
}
