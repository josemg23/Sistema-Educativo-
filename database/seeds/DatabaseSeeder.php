<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(Plantilla::class);
        $this->call(Materia::class);
        $this->call(Curso::class);
        $this->call(Usuario::class);
        // $this->call(Taller::class);
        $this->call(PlanCuenta::class);
    }
}