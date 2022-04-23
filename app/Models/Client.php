<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class Client extends Model
{
    use HasFactory;

    protected $table = 'Client';

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'State');
    }
}
