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
        <h1>Lista de Requisições</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('requests.create') }}" class="btn btn-primary">Criar Requisição</a>
        <br/>
        <br/>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Data da Requisição</th>
                <th>Data da Retirada</th>
                <th>Funcionário</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->request_date }}</td>
                    <td>{{ $request->withdrawal_date }}</td>
                    <td>{{ $request->employee_name }}</td>
                    <td>{{ $statusMap[$request->status] ?? 'Desconhecido' }}</td>
                    <td>
                        <a href="{{ route('requests.show', $request->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $requests->links() }}
    </div>
@endsection
