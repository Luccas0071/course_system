<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'unique_code' => Str::uuid(),
                'title' => 'Curso de Programação Básica',
                'description' => 'Um curso introdutório de programação.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unique_code' => Str::uuid(),
                'title' => 'Curso de Desenvolvimento Web',
                'description' => 'Aprenda a desenvolver aplicações web.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unique_code' => Str::uuid(),
                'title' => 'Curso de Análise de Dados',
                'description' => 'Introdução à análise de dados com Python.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
