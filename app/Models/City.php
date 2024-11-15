<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en'];

    public function poses()
    {
        return $this->hasMany(POS::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}