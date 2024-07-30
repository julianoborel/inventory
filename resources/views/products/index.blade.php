@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Produtos</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('products.create') }}" class="btn btn-primary">Adicionar Novo Produto</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Preço de Custo</th>
                <th>Preço de Venda</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->cost_price }}</td>
                    <td>{{ $product->sale_price }}</td>
                    <td>{{ $product->type === 'simple' ? 'Simples' : 'Composto' }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
