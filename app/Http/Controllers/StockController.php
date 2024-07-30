<?php

namespace App\Http\Controllers;

use App\Http\Models\Product;
use App\Http\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('product')->get();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::where('type', 'simple')->get();
        return view('stocks.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        Stock::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Estoque atualizado com sucesso.');
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $products = Product::where('type', 'simple')->get();
        return view('stocks.edit', compact('stock', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Estoque atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Estoque removido com sucesso.');
    }
}
