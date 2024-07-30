@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Usuário</h1>
        <table class="table">
            <tr>
                <th>Nome:</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
        </table>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
