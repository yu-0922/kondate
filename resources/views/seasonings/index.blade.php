@extends('layouts.app')
@section('title', '調味料一覧')

@section('content')
    @foreach($seasonings as $seasoning)
    <div>
        <h3>{{ $seasoning->seasoning_name }}</h3>
    </div>
    @endforeach
@endsection
