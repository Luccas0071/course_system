<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            [
                'course_id' => 1,
                'title' => 'Módulo 1: Introdução',
                'description' => 'Introdução à programação.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Módulo 2: Estruturas de Controle',
                'description' => 'Aprenda sobre estruturas de controle.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Módulo 3: Funções',
                'description' => 'Introdução às funções em programação.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Módulo 4: Estruturas de Dados',
                'description' => 'Estruturas de dados básicas.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Módulo 5: Projeto Final',
                'description' => 'Desenvolvimento de um projeto final.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
            
        DB::table('modules')->insert([
            [
                'course_id' => 2,
                'title' => 'Módulo 1: HTML e CSS',
                'description' => 'Introdução ao HTML e CSS.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'title' => 'Módulo 2: JavaScript',
                'description' => 'Aprendendo JavaScript.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'title' => 'Módulo 3: Projeto Web',
                'description' => 'Desenvolvimento de um projeto web.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('modules')->insert([
            [
                'course_id' => 3,
                'title' => 'Módulo 1: Coleta de Dados',
                'description' => 'Coletando dados para análise.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 3,
                'title' => 'Módulo 2: Análise Estatística',
                'description' => 'Introdução à análise estatística.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
