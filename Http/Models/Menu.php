<?php
namespace App\Modules\Menus\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;
use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;


class Menu extends Model implements TranslatableContract {

	use Translatable;
	use PresentableTrait;

	protected $table = 'menus';


// Presenter ---------------------------------------------------------------
	protected $presenter = 'App\Modules\Menus\Http\Presenters\Menus';


// Translation Model -------------------------------------------------------
	protected $translator = 'App\Modules\Menus\Http\Models\MenuTranslation';


// Hidden ------------------------------------------------------------------
	protected $hidden = [
		'created_at',
		'updated_at'
		];


// Fillable ----------------------------------------------------------------
	protected $fillable = [
		'class',
		'name',
		// Translatable columns
		'status',
		'title'
		];


// Translated Columns ------------------------------------------------------
	protected $translatedAttributes = [
		'status',
		'title'
		];

// 	protected $appends = [
// 		'status',
// 		'title'
// 		];


// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany

// Functions ---------------------------------------------------------------

	public function getStatusAttribute()
	{
		return $this->status;
	}

	public function getTitleAttribute()
	{
		return $this->title;
	}


}
