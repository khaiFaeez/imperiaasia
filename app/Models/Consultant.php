<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Consultant extends Model
{
    use HasFactory;

    protected $table = 'Consultant';
    protected $connection = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->connection = Session::get("portfolio_db");
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function (Builder $builder) {

            $builder->orderBy('Status', 'asc');
        });
    }
}
