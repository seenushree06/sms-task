<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\Teacher::class, 15)->create();
    }
}
