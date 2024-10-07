<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.product', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            if($request->hasFile('photo')){
                $image = time() . '_' . uniqid() . '.' . $request->photo->extension();
                $request->photo->move(public_path('uploads/product_images'),$image);
                $request->merge(['image'=>$image]);
            }
            $product = Product::create($request->all());
            if($request->hasFile('photos')){
                foreach($request->photos as $photo){
                    $image = time() . '_' . uniqid() . '.' . $photo->extension();
                    $photo->move(public_path('uploads/product_images'),$image);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $image
                    ]);
                }
            }
            flash()->success('Thêm sản phẩm mới thành công');
            return redirect()->route('admin.product.index');
        } catch (\Throwable $th) {
            flash()->error('Thêm sản phẩm mới thất bại');
            return redirect()->back();
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit()
    {
        return view('admin.product.edit');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }

    public function trash() {
        return view('admin.product.trash');
    }

    public function updateHidden(Request $request) {
        $product = Product::find($request->id);
        if ($product) {
            $product->is_hidden = $request->is_hidden;
            $product->save();
            return response()->json(['message' => 'Cập nhật thành công!']);
        }
        return response()->json(['message' => 'Không tìm thấy danh mục!']);
    }
}
