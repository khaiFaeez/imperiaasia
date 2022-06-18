<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePortfolios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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
            'db_connection' => 'maryamgold',
            'created_at' => Carbon::now()
        ]);


        $users = User::get();

        foreach ($users as $user) {
            User::where('id', $user->id)->update(['current_portfolio_id' => $insert->id]);
            $user->portfolios()->attach($insert->id);
        }
    }
}
