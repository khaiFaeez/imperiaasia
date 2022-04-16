<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Invoice extends Model
{
    use HasFactory;

    // protected $connection = 'platinum';
    protected $table = 'Invoice';
    protected $primaryKey  = "Id";

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'MyKad_SSM');
    }
}
