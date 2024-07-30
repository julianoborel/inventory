@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar Novo Produto</h1>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="cost_price">Preço de Custo</label>
                <input type="text" class="form-control" id="cost_price" name="cost_price" value="{{ old('cost_price') }}">
            </div>
            <div class="form-group">
                <label for="sale_price">Preço de Venda</label>
                <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
            </div>
            <div class="form-group">
                <label for="type">Tipo</label>
                <select class="form-control" id="type" name="type">
                    <option value="simple" {{ old('type') == 'simple' ? 'selected' : '' }}>Simples</option>
                    <option value="composed" {{ old('type') == 'composed' ? 'selected' : '' }}>Composto</option>
                </select>
            </div>
            <div class="form-group" id="components-field" style="display: none;">
                <label for="components">Componentes</label>
                <textarea class="form-control" id="components" name="components">{{ old('components') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </div>

    <script src="{{ asset('js/validation.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const componentsField = document.getElementById('components-field');

            function toggleComponentsField() {
                if (typeSelect.value === 'composed') {
                    componentsField.style.display = 'block';
                } else {
                    componentsField.style.display = 'none';
                }
            }

            toggleComponentsField();
            typeSelect.addEventListener('change', toggleComponentsField);
        });
    </script>
@endsection
