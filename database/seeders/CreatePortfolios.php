<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePortfolios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('portfolios')->truncate();
        Schema::enableForeignKeyConstraints();

        $insert  =  Portfolio::create([
            'name' => 'Platinum',
            'db_connection' => 'platinum',
            'status' => 1,
            'created_at' => Carbon::now()
        ]);

        Portfolio::create([
            'name' => 'Dresella',
            'db_connection' => 'dresella',
            'status' => 0,
            'created_at' => Carbon::now()
        ]);

        Portfolio::create([
            'name' => 'Cili Kering',
            'db_connection' => 'cilikering',
            'status' => 0,
            'created_at' => Carbon::now()
        ]);

        Portfolio::create([
            'name' => 'Agri',
            'db_connection' => 'agri',
            'status' => 0,
            'created_at' => Carbon::now()
        ]);

        Portfolio::create([
            'name' => 'Maryam Gold',
            'status' => 0,
            'db_connection' => 'maryam',
            'created_at' => Carbon::now()
        ]);


        $user = User::first();
        $portfolio = Portfolio::pluck('id')->toArray();

        User::where('id', $user->id)->update(['current_portfolio_id' => $insert->id]);
        $user->portfolios()->attach($portfolio);
    }
}
