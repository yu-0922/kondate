@extends('layouts.app')
@section('title', '具材新規登録')

@section('content')
    <h2>以下の欄を入力し送信してください</h2>
    <form method="POST" action="{{ route('ingredient.store') }}">
    {{ csrf_field() }}
        <label>具材名<input type="text" name="ingredient_name"></label>
        <button>送信</button>
    </form>
@endsection
