<?php

use Illuminate\Database\Seeder;

class Materia extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          DB::table('materias')->insert([
          'nombre'       => 'Contabilidad',
          'instituto_id' => 1,
          'slug'         => 'contabilidad',
          'descripcion'  => 'Materia de contabilidad',
          'estado'       => 'on',
        ]);
         DB::table('materias')->insert([
          'nombre'       => 'Matematica',
          'instituto_id' => 1,
          'slug'         => 'matematica',
          'descripcion'  => 'Materia de matematicas',
          'estado'       => 'on',
        ]);
       
        DB::table('materias')->insert([
          'nombre'       => 'Lenguaje',
          'instituto_id' => 1,
          'slug'         => 'lenguaje',
          'descripcion'  => 'Materia de lenguaje',
          'estado'       => 'on',
        ]);
          DB::table('contenidos')->insert([
          'materia_id'  => 1,
          'nombre'      => 'UNIDAD 1',
         
          'descripcion' => 'Unidad # 1',
          'estado'      => 'on',
        ]);
          DB::table('archivos')->insert([
          'url'              => 'prueba',
          'archivoable_type' => 'App\Contenido',
          'archivoable_id'   => 1,
        ]);


    }
}