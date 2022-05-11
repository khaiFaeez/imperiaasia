<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Product;
use App\Models\Channel;
use App\Models\Delivery;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'Invoice';
    protected $primaryKey  = "Id";
    protected $guarded = [];
    public $timestamps = false;

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

    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'id', 'Inv_No');
    }



    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $number = Invoice::max('id') + 1;
            $model->Inv_No = config('portfolio.invoice_prefix.platinum') . str_pad($number, 7, 0, STR_PAD_LEFT);
        });
    }
}
