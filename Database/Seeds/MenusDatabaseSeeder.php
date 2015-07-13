<?php

namespace App\Modules\Menus\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class MenusDatabaseSeeder extends Seeder
{


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

//		$this->call('App\Modules\Menus\Database\Seeds\MenusTableSeeder');
		$this->call('App\Modules\Menus\Database\Seeds\ModuleSeeder');
//		$this->call('App\Modules\Menus\Database\Seeds\MenuLinksTableSeeder');
	}


}
