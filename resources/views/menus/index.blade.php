@extends('layouts.app')
@section('title', 'メニュー一覧')

@section('content')
    <form method="GET" action="{{ route('menu.index') }}">
        <input type="text" name="menu_name" class="search-form">
        <button>検索</button>
    </form>
    @if (\Auth::user())
    <a class="op" href="{{ route('menu.create') }}"><i class="fas fa-magic pr-1"></i>メニュー新規登録</a>
    @endif
    <div class="item-list">
        @foreach($menus as $menu)
        <div class="item">
            <h3>{{ $menu->menu_name }}</h3>
            <a class="op" href="{{ route('menu.show', ['theMenu' => $menu]) }}"><i class="fab fa-elementor pr-1"></i>詳細</a>
            @if (\Auth::user() && $menu->user_id == \Auth::id())
            <a class="op" href="{{ route('menu.edit', ['theMenu' => $menu]) }}"><i class="fas fa-wrench pr-1"></i>編集</a>
            <a class="op" href="{{ route('menu.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt pr-1"></i>削除</a>
            @endif
        </div>
        @endforeach
        @if (0 < count($menus))
            {{ $menus->onEachSide(5)->links() }}
        @endif
    </div>
@endsection
