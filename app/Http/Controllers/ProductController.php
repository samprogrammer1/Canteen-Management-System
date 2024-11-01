<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('product_name', 'asc')->get();
        return view('menu.menu-list', ['products' => $products]);
    }

    public function reloadProductList()
    {
        $products = Product::orderBy('product_name', 'asc')->get();
        return view('menu.partials.product-list', ['products' => $products])->render();
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->stock = $request->input('stock');
        $product->price = $request->input('price');
        $product->cost_price = $request->input('cost_price');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/products');
            
            // Create directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $name);
            $product->image = $name;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully.');
    }

    public function excelStore(Request $request){
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'excel_file' => 'nullable'
        ]);
        if ($request->hasFile('excel_file')) {
            $import = new ProductsImport();
            $collection = Excel::toCollection($import, $request->file('excel_file'))[0];
            $data = $import->collection($collection);

            foreach ($data as $item) {
                $product = new Product();
                $product->product_name = $item["name"];
                $product->stock = $item["stock"];
                $product->cost_price = $item["cost_price"];
                $product->price = $item["price"];
                $product->save();
            }
            return redirect()->back()->with('success', 'Products added successfully.');
        }
    }

    public function updateForm($id){
        $product = Product::find($id);
        return view('menu.update-manu', ['product'=> $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $product->product_name = $request->input('product_name');
        $product->stock = $product->stock + $request->input('stock');
        $product->price = $request->input('price');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                $oldImagePath = public_path('/images/products/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload the new image
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/products');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $name);
            $product->image = $name;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully.');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        if ($product->image) {
            $imagePath = public_path('/images/products/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function excelDestroy(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'excel_file' => 'nullable'
        ]);
        if ($request->hasFile('excel_file')) {
            $import = new ProductsImport();
            $collection = Excel::toCollection($import, $request->file('excel_file'))[0];
            $data = $import->collection($collection);

            foreach ($data as $item) {
                $product = Product::where([
                    'product_name' => $item['name'], // Use 'name' if that is the column name
                    'cost_price' => $item['cost_price'],
                    'price' => $item['price']
                ])->first();
                // if (!$product) {
                //     return redirect()->back()->with('error', 'Product not found.');
                // }
                if($product){
                    if ($product->image) {
                        $imagePath = public_path('/images/products/' . $product->image);
                        if (file_exists($imagePath)) {
                            unlink($imagePath); // Delete the file
                        }
                    }
                    $product->delete();
                }
                
                
            }
        }
        
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }


    public function buyNow(Request $request)
    {
        $cart = $request->input('cart');
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'total' => $total,
        ]);

        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
    }

}
