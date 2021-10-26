<?php

use Illuminate\Database\Seeder;

class PlanCuenta extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pcuentas')->insert([
				'nombre'     => 'CAJA',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

             DB::table('pcuentas')->insert([
				'nombre'     => 'CAJA CHICA',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'BANCOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
            DB::table('pcuentas')->insert([
				'nombre'     => 'DEPOSITOS EN CUENTAS DE AHORRO',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'INVERSIONES - ACCIONES',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'INVERSIONES - BONOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'INVERSIONES CERTIFICADOS DE DEPOSITOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'INVENTARIO DE MERCADERIA',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'INVENTARIO DE MATERIALES DE OFICINA',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'DOCUMENTOS POR COBRAR',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'CUENTAS POR COBRAR',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'PESTAMO A EMPLEADOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
            DB::table('pcuentas')->insert([
				'nombre'     => 'ACCIONES SUSCRITAS POR COBRAR',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'ARRIENDOS POR COBRAR',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
            DB::table('pcuentas')->insert([
				'nombre'     => 'COMISIONES POR COBRAR',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

            DB::table('pcuentas')->insert([
				'nombre'     => 'INTERESES POR COBRAR',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

           DB::table('pcuentas')->insert([
				'nombre'     => 'INTERESES PAGADOS POR ANTICIPADO',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

          DB::table('pcuentas')->insert([
				'nombre'     => 'ARRIENDOS PAGADOS POR ANTICIPADO',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

        DB::table('pcuentas')->insert([
				'nombre'     => 'PUBLICIDAD PAGADA POR ANTICIPADO',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

        DB::table('pcuentas')->insert([
				'nombre'     => 'MUEBLES DE OFICINA',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
         DB::table('pcuentas')->insert([
				'nombre'     => 'EQUIPOS DE OFICINA',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
           DB::table('pcuentas')->insert([
				'nombre'     => 'EQUIPOS DE COMPUTACION',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
             DB::table('pcuentas')->insert([
				'nombre'     => 'EDIFICIOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
               DB::table('pcuentas')->insert([
				'nombre'     => 'VEHICULOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                 DB::table('pcuentas')->insert([
				'nombre'     => 'MAQUINARIAS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                   DB::table('pcuentas')->insert([
				'nombre'     => 'TERRENOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                     DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION ACUMULADA MUEBLE DE OFICINA',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION ACUMULADA EQUIPOS DE OFICINA',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION ACUMULADA EQUIPOS DE COMPUTACION',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION ACUMULADA DE EDIFICIOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
				DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION ACUMULADA DE VEHICULOS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

                DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION ACUMULADA DE MAQUINARIAS',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
               DB::table('pcuentas')->insert([
				'nombre'     => 'DOC. POR COBRAR A LARGO PLAZO',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
               DB::table('pcuentas')->insert([
				'nombre'     => 'INVERSIONES A LARGO PLAZO',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
               DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE CONSTITUCION',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
               DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE INVESTIGACION',
				'tpcuenta'   => 'activos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

             DB::table('pcuentas')->insert([
				'nombre'     => 'DOCUMENTOS POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
      DB::table('pcuentas')->insert([
				'nombre'     => 'CUENTAS POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
      DB::table('pcuentas')->insert([
				'nombre'     => 'APORTE IESS POR PAGAR 9,45%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 9.45,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         

     DB::table('pcuentas')->insert([
				'nombre'     => 'APORTES PATRONALES POR PAGAR 11,15%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 11.15,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'BENEFICIOS SOCIALES POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'SUELDOS POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'ARRIENDOS POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'INTERESES POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'DIVIDENDOS POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDAD DE EMPLEADOS POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'IMPUESTOS Y RETENCIONES POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'IVA 12 %',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 12,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'RET. IVA 10%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 10,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'RET. IVA 20%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 20,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'RET. IVA 30%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 30,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'RET. IVA 70%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 70,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
     DB::table('pcuentas')->insert([
				'nombre'     => 'RET. IVA 100%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 100,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
     DB::table('pcuentas')->insert([
				'nombre'     => 'RFIR. 1%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 1,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
     DB::table('pcuentas')->insert([
				'nombre'     => 'RFIR 2%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 2,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);             

     DB::table('pcuentas')->insert([
				'nombre'     => 'RFIR 8%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 8,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
    DB::table('pcuentas')->insert([
				'nombre'     => 'RFIR 10%',
				'tpcuenta'   => 'pasivos',
				'porcentual' => true,
				'porcentaje' => 10,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
     ]);

     DB::table('pcuentas')->insert([
				'nombre'     => 'IMPUESTO A LA RENTA',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
     DB::table('pcuentas')->insert([
				'nombre'     => 'INTERESES COBRADOS POR ANTICIPADO',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
     DB::table('pcuentas')->insert([
				'nombre'     => 'ARRIENDOS COBRADOS POR ANTICIPADO',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);         
     DB::table('pcuentas')->insert([
				'nombre'     => 'COMISIONES COBRADOS POR ANTICIPADO',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

      DB::table('pcuentas')->insert([
				'nombre'     => 'DOCUMENTOS POR PAGAR A LARGO PLAZO',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
     DB::table('pcuentas')->insert([
				'nombre'     => 'CUENTAS POR PAGAR A LARGO PLAZO',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
      DB::table('pcuentas')->insert([
				'nombre'     => 'HIPOTECAS POR PAGAR',
				'tpcuenta'   => 'pasivos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

    DB::table('pcuentas')->insert([
				'nombre'     => 'CAPITAL',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

      DB::table('pcuentas')->insert([
				'nombre'     => 'CAPITAL SOCIAL',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

        DB::table('pcuentas')->insert([
				'nombre'     => 'CAPITAL EMPRESARIAL',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'CAPITAL AUTORIZADO',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'APORTACION DE ACCIONISTAS',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'DIVIDENDO POR ACCCIONES',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDAD DE VENTA EN ACCIONES',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'PERDIDA EN VENTA DE ACCIONES',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'RESERVA LEGAL 10%',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => true,
				'porcentaje' => 10,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'RESERVA ESTATUTARIA',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'RESERVA FACULTATIVA',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDAD ANTES DE RESERVA',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDAD ANTES DE IMPUESTO A LA RENTA',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDAD NETA DE EJERCICIO',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDAD LIQUIDA DEL EJERCICIO',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDADES RETENIDAS',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'PERDIDA DEL EJERCICIO',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

  DB::table('pcuentas')->insert([
				'nombre'     => 'PERDIDAS Y GANANCIAS',
				'tpcuenta'   => 'patrimonios',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
    DB::table('pcuentas')->insert([
				'nombre'     => 'VENTAS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

      DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDAD BRUTA EN VENTAS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
          DB::table('pcuentas')->insert([
				'nombre'     => 'UTILIDAD NETA EN OPERACIONES',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
          DB::table('pcuentas')->insert([
				'nombre'     => 'PRESTACION DE SERVICIOS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
              DB::table('pcuentas')->insert([
				'nombre'     => 'COMISIONES GANADAS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                  DB::table('pcuentas')->insert([
				'nombre'     => 'ARRIENDOS RECIBIDOS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                      DB::table('pcuentas')->insert([
				'nombre'     => 'INGRESOS FINANCIEROS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                          DB::table('pcuentas')->insert([
				'nombre'     => 'INTERESES GANADOS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
  DB::table('pcuentas')->insert([
				'nombre'     => 'RENDIMIENTO FINANCIERO EN CUENTA DE AHORROS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
      DB::table('pcuentas')->insert([
				'nombre'     => 'RENDIMIENTO FINANCIERO EN ACCIONES',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
          DB::table('pcuentas')->insert([
				'nombre'     => 'RENDIMIENTO FINANCIERO EN BONOS',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
     DB::table('pcuentas')->insert([
				'nombre'     => 'RENDIMIENTO FINANCIERO EN CERTIFICADO DE DEPOSITO',
				'tpcuenta'   => 'ingresos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

    DB::table('pcuentas')->insert([
				'nombre'     => 'SUELDOS Y SALARIOS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
       DB::table('pcuentas')->insert([
				'nombre'     => 'APORTES Y PATRONALES AL IESS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
      DB::table('pcuentas')->insert([
				'nombre'     => 'FONDOS DE RESERVA',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
       DB::table('pcuentas')->insert([
				'nombre'     => 'VACACIONES',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);

       DB::table('pcuentas')->insert([
				'nombre'     => 'BENEFICIOS SOCIALES',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
          DB::table('pcuentas')->insert([
				'nombre'     => 'HONORARIOS PROFESIONALES',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
             DB::table('pcuentas')->insert([
				'nombre'     => 'ENERGIA ELECTRICA',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                DB::table('pcuentas')->insert([
				'nombre'     => 'AGUA POTABLE',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                   DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE TELEFONOS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
    DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE INTERNET',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
       DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE ARRIENDO',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
      	  DB::table('pcuentas')->insert([
				'nombre'     => 'COSTOS DE VENTAS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
          DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION DE MUEBLES DE OFICINA',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
             DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION DE EQUIPOS DE OFICINA',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
         DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION DE EQUIPOS DE COMPUTACION',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
       DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION DE EDIFICIOS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
      DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION DE MAQUINARIAS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
      DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE INTERESES',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
                      DB::table('pcuentas')->insert([
				'nombre'     => 'INTERES SOBRE PRESTAMOS BANCARIOS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
     DB::table('pcuentas')->insert([
				'nombre'     => 'INTERES POR MORA',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
         DB::table('pcuentas')->insert([
				'nombre'     => 'OTROS GASTOS FINANCIEROS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
        DB::table('pcuentas')->insert([
				'nombre'     => 'REPRESENTACIONES',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
    DB::table('pcuentas')->insert([
				'nombre'     => 'SUELDOS DE VENDEDORES',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
        DB::table('pcuentas')->insert([
				'nombre'     => 'COMISIONES DE VENDEDORES',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
        DB::table('pcuentas')->insert([
				'nombre'     => 'VIATICOS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
        DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE PUBLICIDAD',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
        DB::table('pcuentas')->insert([
				'nombre'     => 'MANTENIMIENTO Y REPARACION DE VEHICCULOS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
        DB::table('pcuentas')->insert([
				'nombre'     => 'LUBRICANTES Y COMBUSTIBLE',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
         DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE TRANSPORTE',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
          DB::table('pcuentas')->insert([
				'nombre'     => 'GASTOS DE SEGURO',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
           DB::table('pcuentas')->insert([
				'nombre'     => 'DEPRECIACION DE VEHICULOS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
         DB::table('pcuentas')->insert([
				'nombre'     => 'BAJA DE INVENTARIOS',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);
      DB::table('pcuentas')->insert([
				'nombre'     => 'CUENTAS INCOBRABLES',
				'tpcuenta'   => 'costos y gastos',
				'porcentual' => false,
				'estado' => 'on',
				'created_at' => now(),
				'updated_at' => now()
        ]);


    }
}
 