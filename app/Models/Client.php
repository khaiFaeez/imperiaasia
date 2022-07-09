<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        'updated_at',
    ];

    protected $connection = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->connection = Auth::user()->current_portfolio->db_connection;
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
        $portfolios = Portfolio::where('status', 1)->pluck('db_connection');

        $first = $portfolios->shift();

        $select = ['Invoice.Id', 'Invoice.Aging', 'Invoice.Date', 'Invoice.Status_Inv', 'Invoice.Inv_No', 'Invoice.Created_Date'];

        $invoices = DB::table(config('database.connections.'.$first.'.database').'.Invoice')->leftJoin(config('database.connections.'.$first.'.database').'.Client', 'Invoice.MyKad_SSM', '=', 'Client.Id')->select($select)->where('Client.MyKad_SSM', $this->MyKad_SSM);

        if ($portfolios->count() > 0) {
            foreach ($portfolios as $portfolio) {
                if ($portfolio !== '') {
                    $q = DB::table(config('database.connections.'.$portfolio.'.database').'.Invoice')->leftJoin(config('database.connections.'.$portfolio.'.database').'.Client', 'Invoice.MyKad_SSM', '=', 'Client.Id')->select($select)->where('Client.MyKad_SSM', $this->MyKad_SSM);
                    $invoices->union($q);
                }
            }
        }

        return $invoices->get();
    }
}
