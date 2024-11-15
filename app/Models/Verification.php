<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verification extends Model
{
    protected $fillable = ['code','user_id', 'type','verified_at','end_at'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}