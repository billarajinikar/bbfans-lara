<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start_at', 'end_at'];  // Add any other fields you want to be mass-assignable

    // Define a relationship to contestants
    public function contestants()
    {
        return $this->belongsToMany(Contestant::class, 'poll_contestants');
    }
}
