<?php

namespace App\Http\Controllers;

use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Pest\Laravel\session;

class CategoryController extends Controller
{
    public function add_category()
    {
        return view('categories.add_category');
    }

    public function store_category(Request $request)
    {
        $v = $request->validate([
            'name' => 'required|string',
            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('imagepath')) {
            $path = $request->file('imagepath')->store('images', 'public');
            $v['imagepath'] = $path;
        }
        Category::create($v);
        return redirect('add_category');
    }

    public function all_categories()
    {
        if (Auth::user()) {
            Session::put('usname', Auth::user()->name);
            Session::forget(
                'usname'
            );
        }
        $categories = Category::all();
        return view('categories.categories', ['categories' => $categories]);
    }
}
