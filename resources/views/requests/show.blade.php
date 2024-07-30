@extends('layouts.app')

@php
    $statusMap = [
        'pending' => 'Pendente',
        'approved' => 'Aprovado',
        'rejected' => 'Rejeitado',
    ];
@endphp

@section('content')
    <div class="container">
        <h1>Detalhes da Requisição</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data da Requisição: {{ $request->request_date }}</h5>
                <h5 class="card-title">Data da Retirada: {{ $request->withdrawal_date }}</h5>
                <h5 class="card-title">Funcionário: {{ $request->employee_name }}</h5>
                <h5 class="card-title">Status: {{ $statusMap[$request->status] ?? 'Desconhecido' }}</h5>

                <h5 class="card-title">Itens</h5>
                <ul>
                    @foreach($request->items as $item)
                        <li>{{ $item->product->name }} - Quantidade: {{ $item->quantity }}</li>
                    @endforeach
                </ul>

                <a href="{{ route('requests.index') }}" class="btn btn-primary">Voltar para a Lista</a>
                <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar?')">Excluir</button>
                </form>
            </div>
        </div>
    </div>
@endsection
