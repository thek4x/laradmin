<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\adminSeed;
use Database\Seeders\permseed;
use App\Models\dataTable;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();
        $this->call([permseed::class]);
//        $faker = \Faker\Factory::create();
//        for ($i = 0; $i < 100; $i++) {
//            $data[] = [
//                'admins_id' => 1,
//                'type' => 'info',
//                'category' => $faker->name,
//                'key' => $faker->name,
//                'title' => $faker->name,
//                'data' => $faker->name,
//                'route' => $faker->name
//            ];
//        }
//        $load = dataTable::insert($data);
    }

}
