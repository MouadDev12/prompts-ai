<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    protected $fillable = [ 'titre', 'type']; 

     public function prompts()
    {
        return $this->hasMany(Prompt::class);
    }
}



