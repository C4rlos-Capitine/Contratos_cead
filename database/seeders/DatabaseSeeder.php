<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
//use App\Models\Area;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\table_representante_ativo::create([
            'id_representante' => 1
        ]);
/*
        \App\Models\User::create([
             'name' => '01.abcd.2020',
             'email' => 'carlos@gmail.com',
             'password' => Hash::make('zxcvbnm'),
             'tipo_user' => 1
         ]);

         \App\Models\User::create([
            'name' => 'Aurélio Ribeiro',
            'email' => 'Ribas@gmail.com',
            'password' => Hash::make('zxcvbnm'),
            'tipo_user' => 2
        ]);

        \App\Models\User::create([
            'name' => 'Mariza Guião',
            'email' => 'mariza@gmail.com',
            'password' => Hash::make('zxcvbnm'),
            'tipo_user' => 3
        ]);
        //Registo Niveis dos docentes
        \App\Models\Nivel::create([
            'designacao_nivel'=>'Licenciado',
            'remuneracao_hora'=>900,
        ]);
        \App\Models\Nivel::create([
            'designacao_nivel'=>'Mestrado',
            'remuneracao_hora'=>1000,
        ]);
        \App\Models\Nivel::create([
            'designacao_nivel'=>'Doutorado Auxiliar',
            'remuneracao_hora'=>1100,
        ]);
        \App\Models\Nivel::create([
            'designacao_nivel'=>'Prof. Doutor associado',
            'remuneracao_hora'=>1200,
        ]);
        \App\Models\Nivel::create([
            'designacao_nivel'=>'Prof. Catedrático',
            'remuneracao_hora'=>1300,
        ]);

        //Registo dos tipos de contratos
        \App\Models\Tipo_contrato::create([
            'designacao_tipo_contrato' => 'disciplinas normais'
        ]);

        \App\Models\Tipo_contrato::create([
            'designacao_tipo_contrato' => 'disciplinas laboratórias'
        ]);


        //registo da categoria de discplina
        \App\Models\Categoria::create([
            'designacao_categoria' => 'Tronco Comum',
        ]);

        \App\Models\Categoria::create([
            'designacao_categoria' => 'Específica',
        ]);
        \App\Models\Categoria::create([
            'designacao_categoria' => 'Laboratórial',
        ]);
        \App\Models\Categoria::create([
            'designacao_categoria' => 'Tema Tranvesal',
        ]);

        //Registo do representante da UP
        \App\Models\Representante::create([
            'nome_representante' => 'Marisa Guião',
            'apelido_representante' => 'de Mendonça',
            'genero_representante' => 'Femenino',
            'id_nivel_contrantante' => 3
        ]);
        \App\Models\Faculdade::create([
            'nome_Faculdade' => 'Faculdade de Engenharia e Tecnologia',
            'sigla_faculdade' => 'FET' 
        ]);
        

        \App\Models\Faculdade::create([
            'nome_Faculdade' => 'Faculdade de Ciências Naturais e Matemática',
            'sigla_faculdade' => 'FCNM' 
        ]);

        \App\Models\Faculdade::create([
            'nome_Faculdade' => 'Faculdade de Ciências Sociais e Filosofia',
            'sigla_faculdade' => 'FCSF' 
        ]);
        \App\Models\estagio_contrato::create([
            'etapa'=>0,
            'descricao'=>'Sem contrato ou disciplinas alocada'
        ]);

        \App\Models\estagio_contrato::create([
            'etapa'=>1,
            'descricao'=>'Fase de alocação de disciplinas'
        ]);

        \App\Models\estagio_contrato::create([
            'etapa'=>2,
            'descricao'=>'Fase de assinatura dos contratos'
        ]);

        \App\Models\estagio_contrato::create([
            'etapa'=>3,
            'descricao'=>'Contratos na Direção dos RHs'
        ]);

        \App\Models\estagio_contrato::create([
            'etapa'=>4,
            'descricao'=>'Contratos no tribunal administrativo'
        ]);

        \App\Models\estagio_contrato::create([
            'etapa'=>6,
            'descricao'=>'Processo finalizado'
        ]);
        \App\Models\Centro_recurso::create([
            'nome_centro' => "Lhanguene"
        ]);
        \App\Models\Centro_recurso::create([
            'nome_centro' => "Namaancha"
        ]);
        //area cientifica

        \App\Models\Area_cientifica::create([
            'cod_area' => "INF",
            'designacao_area' => "Informática"
        ]);

        \App\Models\Area_cientifica::create([
            'cod_area' => "MAT",
            'designacao_area' => "Matemática"
        ]);

        \App\Models\Area_cientifica::create([
            'cod_area' => "FIS",
            'designacao_area' => "Fisica"
        ]);

        \App\Models\Area_cientifica::create([
            'cod_area' => "CFG",
            'designacao_area' => "Componente de Form. Geral"
        ]);

        \App\Models\Area_cientifica::create([
            'cod_area' => "CFP",
            'designacao_area' => "Componente de Form. Pedagógica"
        ]);
        \App\Models\Area_cientifica::create([
            'cod_area' => "PsiCoG",
            'designacao_area' => "Psicologia Geral"
        ]);
        */
    
    }
}
