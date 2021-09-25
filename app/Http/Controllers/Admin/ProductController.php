<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function index(){
         $products   = Product::all();
        return view('Backend.Product.index',compact('products'));
    }

    public function create(){
        return view('Backend.Product.create');
    }

    public function store(Request $request){

        $imageUrl = '';
        if($request->hasFile('image')){
            $data = [];
            foreach($request->image as $img) {
                $url = imageUpload($img);
                $data[] = $url;
            }
            $imageUrl = implode(',', $data);
        }

        $product = Product::create($request->all());
        if(!$imageUrl == ''){
            $product->image()->create(['url' => $imageUrl]);
        }
        Toastr::Success('Product create successfully','Success');
        return redirect()->route('product.index');
    }

    public function edit($id){
        $product = Product::find($id);
        return view('Backend.Product.create',compact('product'));
    }

    public function update(Request $request,$id){

        $imageUrl = '';
        $slug = Str::slug($request->title);
        if($request->hasFile('image')){
            $imageUrl = imageUpload($slug, $request->file('image'));
        }

        $product = Product::find($id)->update($request->all());
        if(!$imageUrl == ''){

            $product->image()->updateOrCreate(['url' => $imageUrl]);

        }
        Toastr::Success('Product Updated successfully','Success');
        return redirect()->route('product.index');
    }

    public function destroy($id){
        // return $id;
        Product::find($id)->delete();
        Toastr::Success('Deleted Successfully','Success');
        return redirect()->back();
    }
}