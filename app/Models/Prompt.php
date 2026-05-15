<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    protected $fillable = ['titre', 'description', 'prompt_text', 'famille_id'];

    public function famille() {
        return $this->belongsTo(Famille::class);
    }
}
