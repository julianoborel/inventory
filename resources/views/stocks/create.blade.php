@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Adicionar Estoque</h1>
        <form action="{{ route('stocks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_id">Produto</label>
                <select class="form-control" id="product_id" name="product_id">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantidade</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection
