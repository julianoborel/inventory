<?php

namespace App\Http\Controllers;

use App\Http\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'type' => 'required|in:simple,composed',
            'components' => 'nullable|string',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->cost_price = $request->cost_price;
        $product->sale_price = $request->sale_price;
        $product->type = $request->type;

        if ($request->type === 'composed') {
            $product->components = $request->components;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'type' => 'required|in:simple,composed',
            'components' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->cost_price = $request->cost_price;
        $product->sale_price = $request->sale_price;
        $product->type = $request->type;

        if ($request->type === 'composed') {
            $product->components = $request->components;
        } else {
            $product->components = null;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }



    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso.');
    }
}
