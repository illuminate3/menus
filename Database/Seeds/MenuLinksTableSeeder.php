<?php

namespace App\Modules\Menus\Database\Seeds;

use Illuminate\Database\Seeder;

Use Auth;
use Config;
use DB;
use Eloquent;
use Model;


class MenuLinksTableSeeder extends Seeder {


/*
	public function __construct(
			Menu $menu,
			MenuTranslation $menu_trans
		)
	{
		$this->menu = $menu;
		$this->menu_trans = $menu_trans;
	}
*/

	public function run()
	{

		$link_names = array(
// admin
		[
			'id'					=> 1,
			'menu_id'				=> 1,
			'position'				=> 0,
		],
// footer
		[
			'id'					=> 3,
			'menu_id'				=> 2,
			'position'				=> 0,
		]
		);
		$ink_name_trans = array(
// admin
		[
			'status'				=> 1,
			'title'					=> 'Menus',
			'url'					=> '/admin/menus',
			'menulink_id'			=> 1,
			'locale_id'				=> 63
		],
		[
			'status'				=> 1,
			'title'					=> 'Menús',
			'url'					=> '/admin/menus',
			'menulink_id'			=> 1,
			'locale_id'				=> 68
		],
// footer
		[
			'status'				=> 1,
			'title'					=> 'Welcome',
			'url'					=> '/welcome',
			'menulink_id'			=> 3,
			'locale_id'				=> 63
		],
		[
			'status'				=> 1,
			'title'					=> 'bienvenida',
			'url'					=> '/welcome',
			'menulink_id'			=> 3,
			'locale_id'				=> 68
		]

		);

// Create Link
		DB::table('menulinks')->delete();
			$statement = "ALTER TABLE menulinks AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('menulinks')->insert( $link_names );

// Create Link Translation
		DB::table('menulink_translations')->delete();
			$statement = "ALTER TABLE menulink_translations AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('menulink_translations')->insert( $ink_name_trans );

	} // run


}
