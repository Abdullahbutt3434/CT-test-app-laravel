<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class ProductController extends Controller
{

    public function index()
    {
        return view('product.index');
    }
    
    public function store(Request $request)
    {
        try {
            $product = $request->all();
            if (Storage::disk('public')->exists(Product::jsonFile)) {
                $products = json_decode(Storage::disk('public')->get(Product::jsonFile), true);
            } else {
                $products = [];
            }
            $productCollection = collect($products);
            $product = array_merge($product, ['id' => $this->getUniqueId($productCollection), 'date_time' => Carbon::now()]);
            $products[] = $product;
            if (Storage::disk('public')->put(Product::jsonFile, json_encode($products))) {
                return response()->json('Product added successfully', 200);
            }
            return response()->json('Something went wrong', 500);
        } catch (Exception $e) {
            return response()->json('Something went wrong', 500);
        }
    }
    
    public function list()
    {
        try {
            $products = Storage::disk('public')->get(Product::jsonFile);
            $productsJson = json_decode($products, true);
            $collection = collect($productsJson)->sortByDesc('date_time')->values()->all();
            return response()->json(($collection), 200);
        } catch (Exception $e) {
            return response()->json("Something went wrong", 2500);
        }
    }

    public function update(Request $request)
    {
        if (Storage::disk('public')->exists(Product::jsonFile)) {
            $products = json_decode(Storage::disk('public')->get(Product::jsonFile), true);
            $productCollection = collect($products);
            $id = $request['id'];
            $data = $request->all();
            $productCollection = $productCollection->map(function ($record) use ($id, $data) {
                if ($record["id"] == $id) {
                    foreach ($data as $key => $value) {
                        $record[$key] = $value;
                    }
                }
                return $record;
            });
            if (Storage::disk('public')->put(Product::jsonFile, json_encode($productCollection))) {
                return response()->json('Product added successfully', 200);
            }
            return response()->json('Something went wrong', 500);
        }
        return response()->json(['message' => 'File not fount'], 500);
    }

    public function getUniqueId($collection)
    {
        $id = Str::random(15);
        while ($collection->contains(function ($item) use ($id) {
            return $item['id'] === $id;
        })) {
            $id = Str::random(15);
        }
        return $id;
    }
}
