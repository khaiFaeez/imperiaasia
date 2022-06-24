<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'Inv_No',
        'Notes',
        'Created_By',
        'Created_On',
    ];

    protected $table = 'Inv_Notes';
    public $timestamps = false;

    public function __construct()
    {
        parent::__construct();
        $this->connection = \Auth::user()->current_portfolio->db_connection;
    }
}
