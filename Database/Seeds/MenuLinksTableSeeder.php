<?php

namespace App\Modules\Menus\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB;
use Schema;


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

// Menus
		$link_names = array([
			'menu_id'				=> 1, // admin menu
			'position'				=> 7
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulinks')->insert( $link_names );
		}

		$last_insert_id = DB::getPdo()->lastInsertId();
		$locale_id = DB::table('locales')
			->where('name', '=', 'English')
			->where('locale', '=', 'en', 'AND')
			->pluck('id');

		$ink_name_trans = array([
			'status'				=> 1,
			'title'					=> 'Menus',
			'url'					=> '/admin/menus',
			'menulink_id'			=> $last_insert_id,
			'locale_id'				=> $locale_id // English ID
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulink_translations')->insert( $ink_name_trans );
		}

	} // run


}
