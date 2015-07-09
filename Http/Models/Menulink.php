<?php
namespace App\Modules\Menus\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;
use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;


class Menulink extends Model implements TranslatableContract {

	use Translatable;
	use PresentableTrait;

	protected $table = 'menulinks';



// Presenter ---------------------------------------------------------------
	protected $presenter = 'App\Modules\Menus\Http\Presenters\Menus';


// Translation Model -------------------------------------------------------
	protected $translator = 'App\Modules\Menus\Http\Domain\Models\MenulinkTranslation';


// Hidden ------------------------------------------------------------------
	protected $hidden = [
		'created_at',
		'updated_at'
		];


// Fillable ----------------------------------------------------------------
	protected $fillable = [
		'menu_id',
		'page_id',
		'parent_id',
		'position',
		'target',
		'restricted_to',
		'class',
		'icon_class',
		'link_type',
		'has_categories',
		// Translatable columns
		'title',
		'status',
		'url'
		];


// Translated Columns ------------------------------------------------------
	protected $translatedAttributes = [
		'title',
		'status',
		'url'
		];

// 	protected $appends = [
// 		'title',
// 		'status',
// 		'url'
// 		];


// Relationships -----------------------------------------------------------
// Functions ---------------------------------------------------------------
	public function getStatusAttribute()
	{
		return $this->status;
	}

	public function getTitleAttribute()
	{
		return $this->title;
	}

	public function getUrlAttribute()
	{
		return $this->url;
	}


}
