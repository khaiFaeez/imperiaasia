<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Product';

    protected $connection = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->connection = \Auth::user()->current_portfolio->db_connection;
    }
}
