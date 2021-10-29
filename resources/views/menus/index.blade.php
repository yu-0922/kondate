@extends('layouts.app')
@section('title', 'メニュー一覧')

@section('content')
    <form method="GET" action="{{ route('menu.index') }}" class="text-right">
        <input type="text" name="menu_name" class="search-form">
        <button>検索</button>
    </form>
    @if (\Auth::user())
    <a class="op" href="{{ route('menu.create') }}"><i class="fas fa-magic pr-1"></i>メニュー新規登録</a>
    @endif
    <div class="item-list">
        @foreach($menus as $menu)
        <div class="item">
            <img src="{{ $menu->image_path }}" class="img-fluid img-thumbnail text-center" alt="メニュー画像">
            <h3 class="menu-name">{{ $menu->menu_name }}</h3>
            <p>{{ $menu->ingredient }}</p>
            <a class="op" href="{{ route('menu.show', ['theMenu' => $menu]) }}"><i class="fab fa-elementor pr-1"></i>詳細</a>
            @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
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
