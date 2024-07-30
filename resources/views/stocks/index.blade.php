@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Estoque</h1>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Adicionar Estoque</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stocks as $stock)
                <tr>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>
                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
