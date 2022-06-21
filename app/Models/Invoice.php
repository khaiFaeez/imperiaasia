<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Product;
use App\Models\Channel;
use App\Models\Delivery;
use App\Models\Consultant;
use App\Models\Collector;
use Illuminate\Support\Facades\Session;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'Invoice';
    protected $primaryKey  = "Id";
    protected $guarded = [];
    public $timestamps = false;

    protected $connection = 'default';

    const ONLINE = 'Online';
    const DISTRIBUTOR = 'Distributor';
    const OFFLINE = 'Offline';
    const  SPECIAL = 'Special Order';

    public function __construct()
    {
        parent::__construct();
        $this->connection = \Auth::user()->current_portfolio->db_connection;
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'MyKad_SSM');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'Product');
    }

    public function product2()
    {
        return $this->hasOne(Product::class, 'id', 'Product_2');
    }

    public function product3()
    {
        return $this->hasOne(Product::class, 'id', 'Product_3');
    }

    public function product4()
    {
        return $this->hasOne(Product::class, 'id', 'Product_4');
    }

    public function product5()
    {
        return $this->hasOne(Product::class, 'id', 'Product_5');
    }


    public function state()
    {
        return $this->hasOne(State::class, 'id', 'Ship_State');
    }

    public function channel()
    {
        return $this->hasOne(Channel::class, 'id', 'Channel');
    }

    public function consultant()
    {
        return $this->hasOne(Consultant::class, 'id', 'Consultant');
    }

    public function collector()
    {
        return $this->hasOne(Collector::class, 'id', 'Cmd');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'Inv_No', 'Id');
    }

    public function notes()
    {
        return $this->hasMany(InvoiceNote::class, 'Inv_No', 'Id');
    }



    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $number = Invoice::max('id') + 1;
            $model->Inv_No = config('portfolio.invoice_prefix.' . \Auth::user()->current_portfolio->db_connection) . str_pad($number, 7, 0, STR_PAD_LEFT);
        });
    }
}
