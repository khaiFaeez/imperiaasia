<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $table = 'Client';

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'State');
    }

    public function getLastInvoice(Client $client)
    {
        return DB::connection("platinum")->table("Invoice")->where("MyKad_SSM", $client->id)->orderBy('id', 'desc')->pluck('Inv_No')->first();
    }
}
