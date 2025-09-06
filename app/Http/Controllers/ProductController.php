<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorHTML;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    public function add_product()
    {
        $categories = Category::all();
        return view('products.add_product', ['categories' => $categories]);
    }

    public function store_product(Request $request)
    {
        $v = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($request->hasFile('imagepath')) {
            $path = $request->file('imagepath')->store('images', 'public');
            $v['imagepath'] = $path;
        }

        Product::create($v);
        return redirect('add_product');
    }

    public function index($id = null)
    {
        if ($id) {
            $category = Category::with('products')->find($id);
            $products = $category->products()->paginate(5);
        } else {
            $products = Product::paginate(5);
        }

        return view('products.products', ['products' => $products]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $qrCode = QrCode::size(100)->generate(
            url('product/' . $product->id)
        );
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode(12345, $generator::TYPE_CODE_128);
        return view('products.edit_product', compact('product', 'categories', 'qrCode', 'barcode'));
    }

    public function updated(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $v = $request->validate([
            'name' => 'sometimes|string',
            'price' => 'sometimes|integer',
            'imagepath' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'sometimes|exists:categories,id'
        ]);
        if ($request->hasFile('imagepath')) {
            Storage::disk('public')->delete($product->imagepath);
            $path = $request->file('imagepath')->store('images', 'public');
            $v['imagepath'] = $path;
        }
        $product->update($v);
        return redirect()->route('all_products');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('all_products');
    }

    public function search_product(Request $request)
    {
        $product = Product::where('name', 'like', '%' . $request->name . '%')->get();
        return view('products.search', ['product' => $product]);
    }

    public function product_table()
    {
        $products = Product::all();
        return view('products.product_table', ['products' => $products]);
    }

    public function single_product($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $productimages = Product::with('productimages')->findOrFail($id);
        // بدل ما أكتب الاتنين
        // $product = Product::with(['category','productimages'])->findOrFail($id);
        return view('products.single_product', ['product' => $product, 'images' => $productimages]);
    }

    public function add_images_to_product(Request $request, $id)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                # code...
                $path = $image->store('images', 'public');
                ProductImages::create([
                    'product_id' => $id,
                    'images' => $path
                ]);
            }
        }
        return redirect()->back();
    }
}
