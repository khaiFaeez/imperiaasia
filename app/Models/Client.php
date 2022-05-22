<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use Illuminate\Support\Facades\Session;

class Client extends Model
{
    use HasFactory;

    protected $table = 'Client';
    public $timestamps = false;

    protected $fillable = [
        'MyKad_SSM',
        'Name',
        'Mobile_No',
        'Phone',
        'Off_Phone',
        'Address',
        'Address_2',
        'Poscode',
        'City',
        'State',
        'Country',
        'updated_at'
    ];

    protected $connection = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->connection = Session::get("portfolio_db");
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'State');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'MyKad_SSM', 'id');
    }

    public function getLastInvoice(Client $client)
    {
        return DB::connection("platinum")->table("Invoice")->where("MyKad_SSM", $client->id)->orderBy('id', 'desc')->pluck('Inv_No')->first();
    }
}
