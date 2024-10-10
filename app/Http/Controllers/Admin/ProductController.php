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
    public function index(Request $request)
    {
        $categories = ProductCategory::all();
        $query = Product::query();
        if ($request->category > 0 && $request->status > 0){
            $query->where('product_category_id',$request->category)
                ->where('status', $request->status);
        }elseif ($request->category > 0){
            $query->where('product_category_id', $request->category);
        }elseif ($request->status > 0){
            $query->where('status', $request->status);
        }
        $products = $query->get();
        return view('admin.product.product', compact('products','categories'));
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
                $request->photo->move(public_path('uploads/images/product'),$image);
                $request->merge(['image'=>$image]);
            }
            $product = Product::create($request->all());
            if($request->hasFile('photos')){
                foreach($request->photos as $photo){
                    $image = time() . '_' . uniqid() . '.' . $photo->extension();
                    $photo->move(public_path('uploads/images/product'),$image);
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

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.detail', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.product.edit',compact('product','categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            if ($request->hasFile('photo')) {
                if ($product->image && file_exists(public_path('uploads/images/product/' . $product->image))) {
                    unlink(public_path('uploads/images/product/' . $product->image));
                }
                $image = time() . '_' . uniqid() . '.' . $request->photo->extension();
                $request->photo->move(public_path('uploads/images/product'), $image);
                $request->merge(['image' => $image]);
            }
            
            $product->update($request->all());

            if ($request->hasFile('photos')) {
                $oldImages = ProductImage::where('product_id', $product->id)->get();
                foreach ($oldImages as $oldImage) {
                    if (file_exists(public_path('uploads/images/product/' . $oldImage->image))) {
                        unlink(public_path('uploads/images/product/' . $oldImage->image));
                    }
                }
                ProductImage::where('product_id', $product->id)->delete();
                foreach ($request->photos as $photo) {
                    $image = time() . '_' . uniqid() . '.' . $photo->extension();
                    $photo->move(public_path('uploads/images/product'), $image);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $image
                    ]);
                }
            }

            flash()->success("Cập nhật $product->name thành công");
            return redirect()->route('admin.product.index');
        } catch (\Throwable $th) {
            flash()->error("Cập nhật $product->name thất bại");
            return redirect()->back();
        }
    }
    

    public function destroy(Product $product)
    {
        
    }

    public function destroyBox(Request $request)
    {
        if ($request->has('product_ids') && count($request->product_ids) > 0) {
            Product::destroy($request->product_ids);
            $count = count($request->product_ids);
            flash()->success("Xóa $count sản phẩm thành công!");
            return redirect()->back();
        } else {
            return redirect()->back()->with('no', 'Bạn chưa chọn sản phẩm nào!');
        }
    }

    public function delete(Product $product) {
        try {
            $product->delete();
            flash()->success("Xóa $product->name thành công!");
            return redirect()->back();
        } catch (\Throwable $th) {
            flash()->error("Xóa $product->name thất bại!");
            return redirect()->back();
        }
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
