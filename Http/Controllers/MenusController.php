<?php

namespace App\Modules\Menus\Http\Controllers;

use App\Modules\Menus\Http\Models\Menu;
use App\Modules\Menus\Http\Repositories\MenuRepository;

use Illuminate\Http\Request;
use App\Modules\Menus\Http\Requests\DeleteRequest;
use App\Modules\Menus\Http\Requests\MenuCreateRequest;
use App\Modules\Menus\Http\Requests\MenuUpdateRequest;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

//use Datatables;
use Flash;
use Theme;


class MenusController extends MenuController {


	/**
	 * Menu Repository
	 *
	 * @var Menu
	 */
	protected $menu;

	public function __construct(
			MenuRepository $menu_repo
		)
	{
		$this->menu_repo = $menu_repo;
// middleware
//		$this->middleware('admin');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$menus = $this->menu_repo->all();

		return Theme::View('menus::menus.index', compact('menus'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('menus::menus.create',  $this->menu_repo->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		MenuCreateRequest $request
		)
	{
//dd($request);

		$this->menu_repo->store($request->all());

		Flash::success( trans('kotoba::cms.success.menu_create') );
		return redirect('admin/menus');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$menu = $this->menu_repo->findOrFail($id);
//
// 		return View::make('HR::menus.show', compact('menu'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.menus.destroy';
		$modal_id = $id;
		$model = '$menu';
//		$model = 'menu';
//dd($model);

//		return Theme::View('menus::menus.edit',
		return View('menus::menus.edit',
			$this->menu_repo->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		MenuUpdateRequest $request,
		$id
		)
	{
//dd($request);

		$this->menu_repo->update($request->all(), $id);

		Flash::success( trans('kotoba::cms.success.menu_update') );
		return redirect('admin/menus');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
//dd($id);
		Menu::find($id)->delete();

		Flash::success( trans('kotoba::cms.success.menu_delete') );
		return redirect('admin/menus');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Menu::select(array('menus.id','menus.name','menus.description'))
//			->orderBy('menus.name', 'ASC');
//		$query = Menu::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Menu::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/menus/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
