@extends('adminlte::page')

@section('title', "Detalhes do {$product->name}")

@section('content_header')
    <h1>Detalhes do <b>{{ $product->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            <ul>
                <img src="{{ url("storage/$product->image") }}" alt="{{ $product->title }}" style="max-width:200px;">
                <li><strong>Título: </strong> {{ $product->title }}</li>
                <li><strong>Flag: </strong> {{ $product->flag }}</li>
                <li><strong>Descrição: </strong> {{ $product->description }}</li>
            </ul>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{ $product->titleS }}</button>
            </form>
        </div>
    </div>
@stop
