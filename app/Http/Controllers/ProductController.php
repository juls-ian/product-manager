<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkUpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Laravel\Prompts\search;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static $wrap = null;

    public function index()
    {
        // FETCH products of authenticated user 
        $products = auth()->user()
            ->products()
            ->with('category')
            ->where(function ($query) {
                // if search query is not empty
                if ($search = request()->search) {
                    // search product by name 
                    $query->where('name', 'like', '%' . $search . '%')
                        // relationship
                        ->orWhereHas('category', function ($query) use ($search) {
                            // search by category
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                }
            })
            // DEFAULT SORT
            ->when(!request()->query('sort_by'), function ($query) {
                $query->latest();
            })
            // CUSTOM SORT
            ->when(in_array(request()->query('sort_by'), ['name', 'price', 'weight']), function ($query) {
                $sortBy = request()->query('sort_by');
                //    remove '-' in sortBy value
                $field = ltrim($sortBy, '-');
                $direction = substr($sortBy, 0, 1) === '-' ? 'desc' : 'asc';
                $query->orderBy($field, $direction);
            })
            ->paginate(10)
            ->withQueryString();
        // return ProductResource::collection($products);
        //                               folder/ vue component
        return Inertia::render('Product/index', [
            'products' => ProductResource::collection($products),
            'categories' => CategoryResource::collection(Category::orderBy('name')->get()),
            'query' => (object) request()->query()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Product/CreateProduct', [
            // populate prop with => Resource          Model retrieves collection of categ 
            'categories' => CategoryResource::collection(Category::orderBy('name')->get())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    //                 illuminate\http\Req
    public function store(StoreProductRequest $request)
    {
        //                relation method from User.php
        $request->user()->products()->create($request->validated());
        //after product creation 
        return redirect()
            ->route('products.index')
            ->with('message', 'Product has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return inertia('Product/ShowProduct', [
            'product' => ProductResource::make($product)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // POPULATING THE FORM
    public function edit(Product $product)
    {
        return inertia('Product/EditProduct', [
            // populate prop with => Resource          Model retrieves collection of categ 
            'categories' => CategoryResource::collection(Category::orderBy('name')->get()),
            'product' => ProductResource::make($product)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // SAVING THE EDIT THROUGH UPDATE
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        // after update
        return redirect()->route('products.index')
            ->with('message', 'Product has been updated successfully');
    }
    public function bulkUpdate(BulkUpdateProductRequest $request)
    {
        Product::whereIn('id', $request->product_ids)
            ->update(['category_id' => $request->category_id]);
        // after update
        return redirect()->route('products.index')
            ->with('message', 'Selected products updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->with('message', 'Product has been deleted');
    }
    public function bulkDestroy(string $ids)
    {
        $ids = explode(',', $ids);
        Product::destroy($ids);
        return redirect()
            ->route('products.index')
            ->with('message', 'Selected products deleted successfully');
    }
}
