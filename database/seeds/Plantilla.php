<?php

use Illuminate\Database\Seeder;

class Plantilla extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                          DB::table('institutos')->insert([
                             'nombre'      => 'Unidad Educativa Generica',
                             'descripcion' => 'Esta es una unidad educativa generica',
                             'provincia'   => 'Guayas',
                             'canton'      => 'Guayaquil',
                             'direccion'   => 'Direccion Generica',
                             'telefono'    => '0987654321',
                             'email'       => 'generico@generico.com',
                             'estado'      => 'on',
                             'created_at'  => now(),
                             'updated_at'  => now()
                          ]);
                        
                          DB::table('plantillas')->insert([
                          'id' => 1,
                          'nombre' => 'Plantilla 1 - COMPLETE EL ENUNCIADO CORRECTAMENTE',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 2,
                          'nombre' => 'Plantilla 2 - PARTIDA DOBLE',
                          'descripcion' => 'Plantilla de partida doble',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 3,
                          'nombre' => 'Plantilla 3 - COMPLETAR ENUNCIADOS CORRECTAMENTE',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 4,
                          'nombre' => 'Plantilla 4 - ESCRIBIR DIFERENCIAS',
                          'descripcion' => 'Plantilla designado para escribir diferencias',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 5,
                          'nombre' => 'Plantilla 5 - SEÑALAR LA ALTERNATIVA CORRECTA',
                          'descripcion' => 'Plantilla designado para señalar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 6,
                          'nombre' => 'Plantilla 6 - IDENTIFICAR CORRECTAMENTE',
                          'descripcion' => 'Plantilla designado para identificar de manera correcta',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 7,
                          'nombre' => 'Plantilla 7 - ESCRIBIR EN GUSANILLO',
                          'descripcion' => 'Plantilla designado para escribir en gusanillo',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 8,
                          'nombre' => 'Plantilla 8 - ESCRIBIR EN CIRCULOS',
                          'descripcion' => 'Plantilla designado para escribir en circulos ',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 9,
                          'nombre' => 'Plantilla 9 - SUBRAYAR LA ALTERNATIVA',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 10,
                          'nombre' => 'Plantilla 10 - RELACIONAR ENUNCIADOS',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 11,
                          'nombre' => 'Plantilla 11 - RELACIONAR ENUNCIADOS - MODELO 2',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 12,
                          'nombre' => 'Plantilla 12 - VERDADERO & FALSO',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 13,
                          'nombre' => 'Plantilla 13 - DEFINIR ENUNCIADOS',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 14,
                          'nombre' => 'Plantilla 14 - IDENTIFICAR PERSONAS',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 15,
                          'nombre' => 'Plantilla 15 - LLENAR CHEQUE',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 16,
                          'nombre' => 'Plantilla 16 - ENDOSAR CHEQUE',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 17,
                          'nombre' => 'Plantilla 17 - CONVERTIR CHEQUES',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 18,
                          'nombre' => 'Plantilla 18 - LETRA  DE  CAMBIO',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 19,
                          'nombre' => 'Plantilla 19 - CERTIFICADO DE DEPOSITO',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 20,
                          
                          'nombre' => 'Plantilla 20 - PAGARE',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 21,
                          'nombre' => 'Plantilla 21 - VALE DE CAJA',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 22,
                          'nombre' => 'Plantilla 22 - NOTA DE PEDIDO',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 23,
                          'nombre' => 'Plantilla 23 - RECIBO',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 24,
                          'nombre' => 'Plantilla 24 - ORDEN DE PAGO',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 25,
                          'nombre' => 'Plantilla 25 - FACTURA',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 26,
                          'nombre' => 'Plantilla 26 - NOTA DE VENTA',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 27,
                          'nombre' => 'Plantilla 27 - SIGNIFICADO DE ABREVIATURA',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 28,
                          'nombre' => 'PLANTILLA PRECONFIGURADA 1 - IDENTIFIQUE LAS ABREVIATURAS COMERCIALES', 
                          'descripcion' => 'Una Plantilla PRECONFIGURADA 1',
                          'plantilla' => 'no',                     
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                           DB::table('plantillas')->insert([
                          'id' => 29,
                          'nombre' => 'PLANTILLA PRECONFIGURADA 2 - UTILIZA LAS ABREVIATURAS COMERCIALES EN LA CARTA',
                          'descripcion' => 'Una Plantilla PRECONFIGURADA 2',
                          'plantilla' => 'no',                     
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 30,
                          'nombre' => 'PLANTILLA PRECONFIGURADA 3 - LOCALIZA LAS ABREVIATURAS EN EL EDITORIAL',
                          'descripcion' => 'Una Plantilla PRECONFIGURADA 3',
                          'plantilla' => 'no',                     
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 31,
                          'nombre' => 'Plantilla 28 - COLLAGE',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                           DB::table('plantillas')->insert([
                          'id' => 32,
                          'nombre' => 'PLANTILLA PRECONFIGURADA 4 - ESCRIBA EN EL GUSANILLO ABREVIATURAS ECONÓMICAS',
                          'descripcion' => 'Una Plantilla PRECONFIGURADA 4',
                          'plantilla' => 'no',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                           DB::table('plantillas')->insert([
                          'id' => 33,
                          'nombre' => 'Plantilla 29 - SELECCIONAR EN CELDAS',
                          'descripcion' => 'Plantilla designada para seleccionar en celdas',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 34,
                          'nombre' => 'Plantilla 30 - TIPO DE SALDO',
                          'descripcion' => 'Talleres para completar ejercios',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 35,
                          'nombre' => 'PLANTILLA 31 - DESARROLLE FÓRMULAS DE LA ECUACIÓN CONTABLE',
                          'descripcion' => 'Plantilla en donde el estudiante desarrollara formulas contables',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 36,
                          'nombre' => 'Plantilla 32 - ANALIZAR  ENUNCIADOS',
                          'descripcion' => 'Talleres para Analizar Enunciados',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 37,
                          'nombre' => 'Plantilla 33 - TALLER CONTABILIDAD',
                          'descripcion' => 'Plantilla designado para completar un resultado',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 38,
                          'nombre' => 'PLANTILLA 34 - ANALIZAR LECTURA',
                          'descripcion' => 'Plnatilla para analizar lecturas y llenar respuestas',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 39,
                          'nombre' => 'PLANTILLA 35 - ARMAR PALABRA',
                          'descripcion' => 'Plantilla para crear talleres que puedan armar un aplabra en orden',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 40,
                          'nombre' => 'PLANTILLA 36 - IDENTIFICAR TRANSACCIONES',
                          'descripcion' => 'Plantilla para crear talleres que se usan para  identificar las transacciones',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 41,
                          'nombre' => 'PLANTILLA PRECONFIGURADA 5 - DESARROLLE EL MAPA CONCEPTUAL',
                          'descripcion' => 'Plantilla PRECONFIGURADA #5',
                          'plantilla' => 'no',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                           DB::table('plantillas')->insert([
                          'id' => 42,
                          'nombre' => 'PLANTILLA 37 - ORDENAR IDEAS',
                          'descripcion' => 'Plantilla designada para crear talleres que se ordenaran',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                           DB::table('plantillas')->insert([
                          'id' => 43,
                          'nombre' => 'PLANTILLA 38 - COMPLETAR MAPA CONCEPTUAL',
                          'descripcion' => 'Plantilla designada para completar el mapa concecptual',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                           DB::table('plantillas')->insert([
                          'id' => 44,
                          'nombre' => 'PLANTILLA 39 - ESCRIBIR CUENTAS',
                          'descripcion' => 'Plantilla designada para crear talleres',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                           DB::table('plantillas')->insert([
                          'id' => 45,
                          'nombre' => 'PLANTILLA 40 - SOPA DE LETRAS',
                          'descripcion' => 'Plantilla para crear talleres de sopas de letras con diferentes palabras',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 46,
                          'nombre' => 'PLANTILLA PRECONFIGURADA 6 - RELATA  LOS  ENUNCIADOS  EN  LA  SIGUIENTE  RUEDA  LÓGICA',
                          'descripcion' => 'Plantilla PRECONFIGURADA #6',
                          'plantilla' => 'no',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 47,
                          'nombre' => 'PLANTILLA 41 - RELACIONAR ALTERNATIVAS',
                          'descripcion' => 'Plantilla para crear relacionar alternativa',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 48,
                          'nombre' => 'PLANTILLA 42 - CARGAR ARCHIVOS',
                          'descripcion' => 'Plantilla para cargar Archivos ',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          DB::table('plantillas')->insert([
                          'id' => 49,
                          'nombre' => 'PLANTILLA 43 - PLAN DE CUENTAS',
                          'descripcion' => 'Plantilla para elaborar un plan de cuentas correctamente ',
                          'plantilla' => 'si',
                          'created_at' => now(),
                          'updated_at' => now(),
                          ]);
                          //  DB::table('plantillas')->insert([
                          // 'id' => 50,
                          // 'nombre' => 'PLANTILLA 43 - NOTA DE CREDITO',
                          // 'descripcion' => 'Plantilla para elaborar una nota de debito ',
                          // 'plantilla' => 'si',
                          // 'created_at' => now(),
                          // 'updated_at' => now(),
                          // ]);
  
  
    }
}