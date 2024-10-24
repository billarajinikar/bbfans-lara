<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['poll_id','contestant_id', 'voter_ip'];

    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }
}
