<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Back-end разработка
        DB::table('workers')->updateOrInsert([
            'name' => 'junior-разработчик',
            'departments_id' => 1
            ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'middle-разработчик',
            'departments_id' => 1
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'senior-разработчик',
            'departments_id' => 1
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'team-lead',
            'departments_id' => 1
        ]);
        // Front-end разработка
        DB::table('workers')->updateOrInsert([
            'name' => 'Разработчик интерфейсов',
            'departments_id' => 2
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'junior-разработчик',
            'departments_id' => 2
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'middle-разработчик',
            'departments_id' => 2
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'senior-разработчик',
            'departments_id' => 2
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'Главный дизайнер',
            'departments_id' => 3
        ]);
        // Дизайн
        DB::table('workers')->updateOrInsert([
            'name' => 'Дизайнер-1',
            'departments_id' => 3
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'Дизайнер-2',
            'departments_id' => 3
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'Дизайнер-3',
            'departments_id' => 3
        ]);
        // Unit тестирование
        DB::table('workers')->updateOrInsert([
            'name' => 'Главный тестировщик',
            'departments_id' => 4
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'Тестировщик-1',
            'departments_id' => 4
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'Тестировщик-2',
            'departments_id' => 4
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'Тестировщик-3',
            'departments_id' => 4
        ]);
        // Ничего не делания
        DB::table('workers')->updateOrInsert([
            'name' => 'Главный по лени',
            'departments_id' => 5
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'Ничего не делающий-1',
            'departments_id' => 5
        ]);
        DB::table('workers')->updateOrInsert([
            'name' => 'Ничего не делающий-2',
            'departments_id' => 5
        ]);
    }
}
