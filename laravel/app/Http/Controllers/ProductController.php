<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:191',
            'category_id'=>'required|exists:categories,id',
            'images'=>'image'
        ]);

        $product=Product::create($request->all());
        if($request->images)
        {
            $file=$request->images;
            if ($file->isValid()) {
                $file_name = time().'-'.mt_rand(). '.' . $file->getClientOriginalExtension();
                $pathname = 'uploads/' . date("Y") . '/' . date("m").'/'. date("d").'/';
                if (!is_dir($pathname)) {
                    mkdir($pathname, 0755, true);
                }

                $file->move($pathname, $file_name);
                   ProductImage::create(['product_id'=>$product->id,'image'=>$pathname.$file_name]);
            }
        }
        return response()->json(Product::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
