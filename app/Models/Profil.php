<?php

namespace App\Models;

use App\Models\diplome;
use App\Models\Loisire;
use App\Models\Qualite;
use App\Models\Competence;
use App\Models\Experience;
use App\Models\ProfilLangue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils';
    public $primaryKey ='id';
    public const  PK = 'id';
    public $timestamps = false;

    public function experiences(){
        return $this->hasMany(Experience::class);
    }
    public function diplomes(){
        return $this->hasMany(diplome::class);
    }
    public function qualites(){
        return $this->hasMany(Qualite::class);
    }
    public function competences(){
        return $this->hasMany(Competence::class);
    }
    public function loisirs(){
        return $this->hasMany(Loisire::class);
    }
    public function profilLangues(){
        return $this->hasMany(ProfilLangue::class);
    }


}
