@extends('layouts.app')
@section('title', '調味料新規登録')

@section('content')
    <h2>以下の欄を入力し送信してください</h2>
    <form method="POST" action="{{ route('seasoning.store') }}">
    {{ csrf_field() }}
        <label>調味料名<input type="text" name="seasoning_name"></label>
        <button>送信</button>
    </form>
@endsection
