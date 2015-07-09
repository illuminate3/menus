<?php

namespace App\Modules\Menus\Http\Controllers;

use App\Modules\Menus\Http\Models\Menu;
use App\Modules\Menus\Http\Repositories\MenuRepository;
use App\Modules\Menus\Http\Models\MenuLink;
use App\Modules\Menus\Http\Repositories\MenuLinkRepository;

use Illuminate\Http\Request;
use App\Modules\Menus\Http\Requests\DeleteRequest;
use App\Modules\Menus\Http\Requests\MenuLinkCreateRequest;
use App\Modules\Menus\Http\Requests\MenuLinkUpdateRequest;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

//use Datatables;
use Flash;
use Lang;
use Session;
use Theme;


class MenuLinksController extends MenuController {


	/**
	 * MenuLink Repository
	 *
	 * @var Menu
	 */
	protected $menulink;

	public function __construct(
			MenuLinkRepository $menulink_repo,
			MenuRepository $menu
		)
	{
		$this->menulink_repo= $menulink_repo;
		$this->menu = $menu;
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
//		$menulinks = $this->menulink_repo->all();
//		return Theme::View('menus::menulinks.index', compact('links', 'lang'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$lang = Session::get('locale');

		$return_id = 1;

		$all_menus = $this->menu->all()->lists('name', 'id');
		$menu = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::cms.menu', 1));
		$menu = new Collection($menu);
		$menus = $menu->merge($all_menus);

		return Theme::View('menus::menulinks.create',
			compact(
				'lang',
				'menus',
				'return_id'
			));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		MenuLinkCreateRequest $request
		)
	{
//dd($request);
//dd($request->menu_id);
		$this->menulink_repo->store($request->all());

		Flash::success( trans('kotoba::cms.success.menulink_create') );
		return redirect('admin/menulinks/' . $request->menu_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Theme::View('menus::menulinks.index',  $this->menulink_repo->show($id));
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
		$modal_route = 'admin.menulinks.destroy';
		$modal_id = $id;
		$model = '$menulink';
//dd($id);

		$return_id = $id;

		$all_menus = $this->menu->all()->lists('name', 'id');
		$menu = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::cms.menu', 1));
		$menu = new Collection($menu);
		$menus = $menu->merge($all_menus);
//dd($menus);

//		return Theme::View('menus::menulinks.edit',
		return View('menus::menulinks.edit',
			$this->menulink_repo->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model',
					'menus',
					'return_id'
			));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		MenuLinkUpdateRequest $request,
		$id
		)
	{
//dd($request->menu_id);
		$this->menulink_repo->update($request->all(), $id);

		Flash::success( trans('kotoba::cms.success.menulink_update') );
		return redirect('admin/menulinks/' . $request->menu_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->menulink_repo->find($id)->delete();


		Flash::success( trans('kotoba::cms.success.menulink_delete') );
		return redirect('admin/menus');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Menu::select(array('menulinks.id','menus.name','menus.description'))
//			->orderBy('menus.name', 'ASC');
//		$query = Menu::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = MenuLink::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/menulinks/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}

	public function save()
	{
//dd(Input::get('json'));
		$this->menulink_repo->changeParentById($this->menulink_repo->parseJsonArray(json_decode(Input::get('json'), true)));
		return Response::json(array('result' => 'success'));
	}



}
