<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'Negeri';

    protected $connection = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->connection = \Auth::user()->current_portfolio->db_connection;
    }
}
