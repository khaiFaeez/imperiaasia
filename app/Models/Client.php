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

    public function getAllInvoice()
    {
        $portfolios = Portfolio::pluck('db_connection');

        $first = $portfolios->shift();

        $invoices = DB::table($first . '.Invoice')->leftJoin($first . '.Client', 'Invoice.MyKad_SSM', '=', 'Client.Id')->select('Invoice.*')->where('Client.MyKad_SSM', $this->MyKad_SSM);

        if ($invoices->count() > 0) {
            foreach ($portfolios as $portfolio) {
                $q = DB::table($portfolio . '.Invoice')->leftJoin($portfolio . '.Client', 'Invoice.MyKad_SSM', '=', 'Client.Id')->select('Invoice.*')->where('Client.MyKad_SSM', $this->MyKad_SSM);
                $invoices->union($q);
            }
        }
        return $invoices->get();
    }
}
