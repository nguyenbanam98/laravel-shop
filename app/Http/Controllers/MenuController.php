<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menuRecusive;
    private $menu;

    public function __construct(MenuRecusive $menuRecusive, Menu $menu)
    {
        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = Menu::latest()->paginate(5);

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $optionSelect = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menus.add', compact('optionSelect'));
    }

    public function store(Request $request)
    {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-'),
        ]);

        return redirect()->route('admin.menus.index');
    }

    public function edit($id)
    {
        $menu = $this->menu->findOrFail($id);
        $optionSelect = $this->menuRecusive->menuRecusiveEdit($menu->parent_id);

        return view('admin.menus.edit', compact('menu', 'optionSelect'));
    }

    public function update(Request $request, $id)
    {
        $menu = $this->menu->findOrFail($id);

        $menu->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-'),
        ]);

        return redirect()->route('admin.menus.index');

    }

    public function delete($id)
    {
        $menu = $this->menu->findOrFail($id);

        $menu->delete();

        return redirect()->route('admin.menus.index');
    }
}
