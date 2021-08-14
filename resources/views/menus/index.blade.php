@extends('layouts.app')
@section('title', 'メニュー一覧')

@section('content')
    <a class="op" href="{{ route('menu.create') }}"><i class="fas fa-magic"></i>メニュー新規登録</a>
    <div class="item-list">
        @foreach($menus as $menu)
        <div class="item">
            <h3>{{ $menu->menu_name }}</h3>
            <a class="op" href="{{ route('menu.edit', ['theMenu' => $menu]) }}"><i class="fas fa-wrench"></i>編集</a>
            <a class="op" href="{{ route('menu.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt"></i>削除</a>
        </div>
        @endforeach
    </div>
@endsection
