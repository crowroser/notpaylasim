<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    protected $fillable = ['name'];

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
} 