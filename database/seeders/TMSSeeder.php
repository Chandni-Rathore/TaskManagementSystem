<?php

namespace Database\Seeders;

use App\Models\TMSModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

class TMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i=0;$i<=10;$i++){

            $faker =  Faker::create();
            $model = new TMSModel;
            $model->title = $faker->sentence;
            $model->description = $faker->sentence;
            $model->due_date = $faker->date;
            $model->status = 1;
            $model->save();

            Log::info('===data inserted with seeder===');

        }

    }
}
