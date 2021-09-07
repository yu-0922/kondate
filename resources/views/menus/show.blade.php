@extends('layouts.app')
@section('title', 'メニュー詳細')

@section('content')
    <div>
        <h3>メニュー名</h3>
        {{ $theMenu->menu_name }}
    </div>
    <div>
        <h3>特徴</h3>
        {{ $theMenu->tokuchou }}
    </div>
    @if (\Auth::user() && $theMenu->user_id == \Auth::id())
    <a class="op" href="{{ route('menu.edit', ['theMenu' => $theMenu]) }}"><i class="fas fa-wrench"></i>編集</a>
    <a class="op" href="{{ route('menu.confirmDelete', ['theMenu' => $theMenu]) }}"><i class="far fa-trash-alt"></i>削除</a>
    @endif
@endsection
