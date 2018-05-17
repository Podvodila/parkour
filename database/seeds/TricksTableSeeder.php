<?php

use Illuminate\Database\Seeder;

class TricksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$elements = ['Precision', 'Kong', 'Monkey'];

    	for($i = 0; $i < count($elements); $i++) {
    		DB::table('tricks')->insert([
		      'name' => $elements[$i],
		    ]);
    	}
    }
}
