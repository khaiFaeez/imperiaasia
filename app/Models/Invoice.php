<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Product;
use App\Models\Channel;

class Invoice extends Model
{
    use HasFactory;

    // protected $connection = 'platinum';
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

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'Ship_State');
    }

    public function channel()
    {
        return $this->hasOne(Channel::class, 'id', 'Channel');
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
