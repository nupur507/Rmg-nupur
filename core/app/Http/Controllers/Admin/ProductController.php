<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $page_title = 'Products';
        $empty_message = 'Products not found.';
        $products = Product::orderByDesc('status')->orderBy('id')->get();
        return view('admin.product.index', compact('page_title', 'empty_message', 'products'));
    }

    public function create()
    {
        $page_title = 'New Product';
        return view('admin.product.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $validation_rule = [
            'name' => 'required|max: 60',
            'image' => [
                'required',
                'image',
                new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'mrp' => 'required|gt:0',
            'dp' => 'required',
            'bv' => 'required|gt:0',
            'pv' => 'required|gte:0',
            'gst' => 'required',
            'hsn_code' => 'required',
            'instruction' => 'max:64000'
        ];
        $request->validate($validation_rule);
        $filename = '';
        $path = imagePath()['product']['path'];
        $size = imagePath()['product']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

      

        $product = new Product();
        $product->name = $request->name;
        $product->image = $filename;
        $product->mrp = $request->mrp;
        $product->dp = $request->dp;
        $product->bv = $request->bv;
        $product->pv = $request->pv;
        $product->gst = $request->gst;
        $product->hsn_code = $request->hsn_code;
        $product->description = $request->instruction;
        $product->save();
        $notify[] = ['success', $product->name . ' has been added.'];
        return redirect()->route('admin.product.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = 'Update Product';
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('page_title', 'product'));
    }

    public function update(Request $request, $id)
    {

        $validation_rule = [
            'name' => 'required|max: 60',
            'image' => [
                'image',
                new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'mrp' => 'required|gt:0',
            'dp' => 'required',
            'bv' => 'required|gt:0',
            'pv' => 'required|gte:0',
            'gst' => 'required',
            'hsn_code' => 'required',
            'instruction' => 'max:64000'
        ];


        $request->validate($validation_rule);
        $product = Product::findOrFail($id);
        $filename = $product->image;

        $path = imagePath()['product']['path'];
        $size = imagePath()['product']['size'];

        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image,$path, $size, $method->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }



        $product->name = $request->name;
        $product->image = $filename;
        $product->mrp = $request->mrp;
        $product->dp = $request->dp;
        $product->bv = $request->bv;
        $product->pv = $request->pv;
        $product->gst = $request->gst;
        $product->hsn_code = $request->hsn_code;
        $product->description = $request->instruction;
        $product->save();

        $notify[] = ['success', $product->name . ' has been updated.'];
        return back()->withNotify($notify);
    }


}