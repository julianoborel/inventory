@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($request) ? 'Editar Requisição' : 'Criar Requisição' }}</h1>
        <form action="{{ isset($request) ? route('requests.update', $request->id) : route('requests.store') }}" method="POST">
            @csrf
            @if(isset($request))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="request_date">Data da Requisição</label>
                <input type="date" class="form-control" id="request_date" name="request_date" value="{{ old('request_date', $request->request_date ?? '') }}">
            </div>
            <div class="form-group">
                <label for="withdrawal_date">Data da Retirada</label>
                <input type="date" class="form-control" id="withdrawal_date" name="withdrawal_date" value="{{ old('withdrawal_date', $request->withdrawal_date ?? '') }}">
            </div>
            <div class="form-group">
                <label for="employee_name">Nome do Funcionário</label>
                <select class="form-control" id="employee_name" name="employee_name">
                    <option value="">Selecione um funcionário</option>
                    @foreach($users as $user)
                        <option value="{{ $user->name }}" {{ old('employee_name') == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="pending" {{ old('status', $request->status ?? '') == 'pending' ? 'selected' : '' }}>Pendente</option>
                    <option value="approved" {{ old('status', $request->status ?? '') == 'approved' ? 'selected' : '' }}>Aprovado</option>
                    <option value="rejected" {{ old('status', $request->status ?? '') == 'rejected' ? 'selected' : '' }}>Rejeitado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="items">Itens</label>
                <div id="items">
                    @foreach(old('items', isset($request) ? $request->items : []) as $index => $item)
                        <div class="item-group">
                            <select name="items[{{ $index }}][product_id]" class="form-control">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ $item['product_id'] == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="items[{{ $index }}][quantity]" class="form-control" value="{{ $item['quantity'] }}">
                            <button type="button" class="btn btn-danger remove-item">Remover</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary add-item">Adicionar Item</button>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($request) ? 'Atualizar' : 'Criar' }}</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.add-item').addEventListener('click', function() {
                const items = document.querySelector('#items');
                const index = items.children.length;
                const newItem = document.createElement('div');
                newItem.classList.add('item-group');
                newItem.innerHTML = `
                    <select name="items[${index}][product_id]" class="form-control">
                        @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                </select>
                <input type="number" name="items[${index}][quantity]" class="form-control">
                    <button type="button" class="btn btn-danger remove-item">Remover</button>
                `;
                items.appendChild(newItem);
                newItem.querySelector('.remove-item').addEventListener('click', function() {
                    newItem.remove();
                });
            });
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });
        });
    </script>
@endsection
