<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $htmlOption;

    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {

        $htmlOption = $this->getCategory($parentId = '');

        return view('admin.category.add', compact('htmlOption'));

    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->category,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->category, '-'),
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function getCategory($parentId)
    {
        $data = Category::all();
        $recusive = new Recusive($data);

        $htmlOption = $recusive->handleRecusive($parentId);
        return $htmlOption;
    }

    public function edit($id)
    {

        $category = Category::findOrFail($id);
        $htmlOption = $this->getCategory($category->parent_id);

        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->category,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->category, '-'),
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
