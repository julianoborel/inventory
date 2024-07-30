@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Produto</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text"><strong>Preço de Custo:</strong> {{ $product->cost_price }}</p>
                <p class="card-text"><strong>Preço de Venda:</strong> {{ $product->sale_price }}</p>
                <p class="card-text"><strong>Tipo:</strong> {{ $product->type === 'simple' ? 'Simples' : 'Composto' }}</p>
                @if($product->type === 'composed')
                    <p class="card-text"><strong>Componentes:</strong> {{ json_encode($product->components) }}</p>
                @endif
                <a href="{{ route('products.index') }}" class="btn btn-primary">Voltar para a Lista</a>
            </div>
        </div>
    </div>
@endsection
