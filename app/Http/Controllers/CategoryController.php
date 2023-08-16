<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::where('status', '1')->paginate(5);
        return view('category.category')
            ->with('category', $category);
    }

    public function insert()
    {
        return view('category.sub_screen.insert_category');
    }

    public function store(Request $request)
    {
        $addCategory = Category::create([    //step 3 bind data//add on 
            'name' => $request->name,
            'type' => $request->type,
            'status' => "1",
        ]);
        if ($addCategory) {
            return redirect()->route('category.index'); // step 5 back to last page
        }
        return null; // step 5 back to last page       
    }

    public function search(Request $request)
    {
        $keyword = $request->name;
        $category = Category::where('name', 'like', "%$keyword%")
            ->where('status', '1')
            ->paginate(5);
        return view('category.category')
            ->with('category', $category);;
    }

    public function edit($id)
    {
        $category = Category::all()->where('id', $id);
        return view('category.sub_screen.edit_category')
            ->with('category', $category);
    }

    public function update(Request $request)
    {
        $category = Category::where('id', $request->id)->first();

        //Name get from form
        $category->name = $request->name;
        $category->type = $request->type;
        $category->save();
        return redirect()->route('category.index');
    }

    public function delete($id)
    {
        $category = Category::where('id', $id)->first();
        $category->status = "0";
        $category->save();
        return redirect()->route('category.index');
    }
}
