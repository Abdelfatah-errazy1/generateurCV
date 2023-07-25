<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loisire extends Model
{
    use HasFactory;
    public $table = 'loisirs';
    protected $primaryKey = 'idL';
    public $timestamps = false;
    public const PK = 'idL';
}
