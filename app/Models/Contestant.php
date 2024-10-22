<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    protected $fillable = [ 'seasson', 'name', 'avtar', 'voting_phone', 'status'];
    protected $table = 'contestants';

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function contestants()
    {
        return $this->hasMany(Contestant::class);
    }

    
}

