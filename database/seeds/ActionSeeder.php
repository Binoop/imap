<?php

use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('actions')->truncate();
        DB::table('actions')->insert([['action' => "SEARCH"],['action' => "MAIL_DELETE"],['action' => "MAIL_FETCH"]]);
    }
}
