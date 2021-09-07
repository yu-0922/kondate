@extends('layouts.app')
@section('title', 'メニュー削除確認')

@section('content')
    <h2>以下のデータを削除してよろしいですか？</h2>
    <form method="POST" action="{{ route('menu.destroy', ['theMenu' => $theMenu]) }}">
    <input type="hidden" name="_method" value="DELETE">
    {{ csrf_field() }}
    <div>
        <h3>メニュー名</h3>
        {{ $theMenu->menu_name }}
    </div>
    <div>
        <h3>特徴</h3>
        {{ $theMenu->tokuchou }}
    </div>
    <div>
        <button>実行</button>
    </div>
    </form>
@endsection
