<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualite extends Model
{
    use HasFactory;
    public $table = 'qualites';
    protected $primaryKey = 'idQ';
    public $timestamps = false;
    public const PK = 'idQ';

}
