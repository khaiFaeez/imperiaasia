<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Collector extends Model
{
    use HasFactory;

    protected $table = "Cmd";
    protected $connection = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->connection = \Auth::user()->current_portfolio()->first()->db_connection;
    }
}
