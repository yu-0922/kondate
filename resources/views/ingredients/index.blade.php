@extends('layouts.app')
@section('title', '具材一覧')

@section('content')
    @foreach($ingredients as $ingredient)
    <div>
        <h3>{{ $ingredient->ingredient_name }}</h3>
    </div>
    @endforeach
@endsection
