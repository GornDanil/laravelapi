<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->updateOrInsert(['department' => 'Back-end разработка']);
        DB::table('departments')->updateOrInsert(['department' => 'Front-end разработка']);
        DB::table('departments')->updateOrInsert(['department' => 'Дизайн']);
        DB::table('departments')->updateOrInsert(['department' => 'Unit тестирование']);
        DB::table('departments')->updateOrInsert(['department' => 'Ничего не делания']);
    }
}
