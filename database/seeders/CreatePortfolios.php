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
            'name' => 'platinum',
            'db_connection' => 'platinum',
            'created_at' => Carbon::now()
        ]);

        Portfolio::create([
            'name' => 'dresella',
            'db_connection' => 'platinum2',
            'created_at' => Carbon::now()
        ]);


        $users = User::get();

        foreach ($users as $user) {
            User::where('id', $user->id)->update(['current_portfolio_id' => $insert->id]);
            $user->portfolios()->attach($insert->id);
        }
    }
}
