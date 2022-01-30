<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('split_options')->insert([
            'name' => 'EQUAL',
        ]);
        DB::table('split_options')->insert([
            'name' => 'EXACT',
        ]);
        DB::table('split_options')->insert([
            'name' => 'PERCENT',
        ]);
    }
}
