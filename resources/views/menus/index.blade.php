@extends('layouts.app')
@section('title', 'メニュー一覧')

@section('content')
    @if (\Auth::user())
    <a class="op" href="{{ route('menu.create') }}"><i class="fas fa-magic pr-1"></i>メニュー新規登録</a>
    @endif
    <div class="item-list">
        @foreach($menus as $menu)
        <div class="item">
            <img src="{{ $menu->image_path }}" class="img-fluid img-thumbnail text-center item-image" alt="メニュー画像">
            <h3 class="menu-name">{{ $menu->menu_name }}</h3>
            @if(is_array(json_decode($menu->ingredient, true)))
                @php
                    $ingredient = "";
                    foreach (json_decode($menu->ingredient, true) as $key => $value) {
                        foreach ($value as $k => $v) {
                            if (!$k)
                                $ingredient .= $v . "：";
                            else {
                                $ingredient .= $v . "　";
                            }
                        }
                    }
                @endphp
                <p>{{ $ingredient }}</p>
            @else
                <p>{{ $menu->ingredient }}</p>
            @endif
            <a class="op" href="{{ route('menu.show', ['theMenu' => $menu]) }}"><i class="fab fa-elementor pr-1"></i>詳細</a>
            @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                <a class="op" href="{{ route('menu.edit', ['theMenu' => $menu]) }}"><i class="fas fa-wrench pr-1"></i>編集</a>
                <a class="op" href="{{ route('menu.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt pr-1"></i>削除</a>
            @endif
        </div>
        @endforeach
        <div class="pagination justify-content-center">
            @if (0 < count($menus))
                {{-- {{ $menus->onEachSide(10)->links() }} --}}
                {{ $menus->links('pagination.bootstrap-4') }}
            @endif
        </div>
    </div>
@endsection
