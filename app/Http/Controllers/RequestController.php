<?php

namespace App\Http\Controllers;

use App\Http\Models\Product;
use App\Http\Models\Request;
use App\Http\Models\RequestItem;
use App\Http\Models\Stock;
use App\Http\Models\User;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    public function index()
    {
        $requests = Request::paginate(10);
        return view('requests.index', compact('requests'));
    }


    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('requests.create', compact('products', 'users'));
    }

    public function store(HttpRequest $request)
    {
        $request->validate([
            'request_date' => 'required|date',
            'withdrawal_date' => 'required|date',
            'employee_name' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $newRequest = Request::create($request->only(['request_date', 'withdrawal_date', 'employee_name', 'status']));

        foreach ($request->items as $item) {
            $newRequest->items()->create($item);
        }

        return redirect()->route('requests.index')->with('success', 'Requisição criada com sucesso.');
    }

    public function show($id)
    {
        $request = Request::with('items.product')->findOrFail($id);
        return view('requests.show', compact('request'));
    }

    public function edit($id)
    {
        $request = Request::findOrFail($id);
        $products = Product::all();
        $users = User::all();
        return view('requests.edit', compact('request', 'products', 'users'));
    }

    public function update(HttpRequest $request, $id)
    {
        $request->validate([
            'request_date' => 'required|date',
            'withdrawal_date' => 'required|date',
            'employee_name' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $existingRequest = Request::findOrFail($id);
        $existingRequest->update($request->only(['request_date', 'withdrawal_date', 'employee_name', 'status']));

        $existingRequest->items()->delete();
        foreach ($request->items as $item) {
            $existingRequest->items()->create($item);
        }

        return redirect()->route('requests.index')->with('success', 'Requisição atualizada com sucesso.');
    }


    public function destroy($id)
    {
        $request = Request::find($id);
        if ($request) {
            foreach ($request->items as $item) {
                $stock = Stock::where('product_id', $item->product_id)->first();

                if ($stock) {
                    $stock->quantity += $item->quantity;
                    $stock->save();
                }
            }

            RequestItem::where('request_id', $id)->delete();

            $request->delete();

            return redirect()->route('requests.index')->with('success', 'Requisição deletada com sucesso.');
        } else {
            return redirect()->route('requests.index')->with('error', 'Requisição não encontrada.');
        }
    }

}
