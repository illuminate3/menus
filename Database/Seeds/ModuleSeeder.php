<?php

namespace App\Modules\Menus\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB;
use Schema;


class ModuleSeeder extends Seeder {


	public function run()
	{


// Permissions -------------------------------------------------------------
		$permissions = array(
			[
				'name'				=> 'Manage Menus',
				'slug'				=> 'manage_menus',
				'description'		=> 'Give permission to user to manage Menus Items'
			],
		 );

		if (Schema::hasTable('permissions'))
		{
			DB::table('permissions')->insert( $permissions );
		}


// Links -------------------------------------------------------------------
		$link_names = array([
			'menu_id'				=> 1, // admin menu
			'position'				=> 7,
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
