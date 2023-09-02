<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**Product List */
    public function index()
    {
        $product = Product::select(
            "product.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.status', '1')
            ->where('product.quantity', '>', '0')
            ->paginate(3);
        return view('product.product')
            ->with('product', $product);
    }

    public function insert()
    {
        $category = Category::where('status', '1')
            ->where('type', 'product')->get();
        return view('product.sub_screen.insert_product')
            ->with('category', $category);
    }

    public function store(Request $request)
    {
        //Handle Photo
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/product_image'), $imageName);
        } else {
            $imageName = 'no_product.png';
        }

        // Create product
        $addProduct = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'status' => "1",
            'image' => $imageName,
            'cat_id' => $request->category_id
        ]);

        if ($addProduct->exists) {
            return redirect()->route('product.index');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->name;
        $product = Product::select(
            "product.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.name', 'like', "%$keyword%")
            ->where('product.quantity', '>', '0')
            ->where('product.status', '1')
            ->paginate(3);
        return view('product.product')
            ->with('product', $product);;
    }

    public function edit($id)
    {
        $category = Category::where('status', '1')
            ->where('type', 'product')->get();
        $product = Product::select(
            "product.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.id', $id)
            ->get();
        return view('product.sub_screen.edit_product')
            ->with('product', $product)
            ->with('category', $category);;
    }

    public function update(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

        //Check image file
        if ($request->file('image') != '') {
            if ($request->file('image') == $product->image) {
                $imageName = $product->image;
            } else {
                $image = $request->file('image');
                $image->move('product_image', $image->getClientOriginalName());
                $imageName = $image->getClientOriginalName();
                $product->image = $imageName;

                // Handle data URI scheme
                $imageData = base64_decode($imageName);
                // Store the image with the retrieved image name
                Storage::disk('public')->put($imageName,  base64_decode($imageData));
                // $imageUrl = asset('plant_image/' . $imageName);
                $imageName = "product_image/" . $imageName;
            }
        } else {
            $imageName = "product_image/no_product.png";
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->status = "1";
        $product->image = $imageName;
        $product->cat_id = $request->category_id;
        $product->save();

        return redirect()->route('product.index');
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        $product->status = "0";
        $product->save();
        return redirect()->route('product.index');
    }
}
