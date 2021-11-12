@extends('layouts.app')
@section('title', 'カテゴリ詳細')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <button type="button" class="btn btn-outline-dark" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
            @foreach ($categories as $category)
            <h2 class="w-100 text-center bg-light border border-3 border-dark my-3 py-1">
                {{ $category->recipe_category_name }}
            </h2>
            <div class="item-list d-flex flex-wrap">
                @foreach($category->menus()->get() as $menu)
                <div class="item col-12 col-md-6">
                    <div class="row">
                        <div class="col-4">
                            <a href="{{ route('menu.show', ['theMenu' => $menu]) }}"><img src="{{ $menu->image_path }}" class="img-fluid img-thumbnail h-75 w-100" alt="メニュー画像"></a>
                        </div>
                        <div class="col-8">
                            <a class="menu-name font-weight-bold" href="{{ route('menu.show', ['theMenu' => $menu]) }}">{{ $menu->menu_name }}</a><br>
                            <a href="{{ route('menu.show', ['theMenu' => $menu]) }}">
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
                                    <p class="text-truncate mb-1" style="max-width:175px; color:#555;">{{ $ingredient }}</p>
                                @else
                                    <p class="text-truncate mb-1" style="max-width:175px; color:#555;">{{ $menu->ingredient }}</p>
                                @endif
                            </a>
                            <div class="mb-1">
                                @if($menu->favorites()->where('user_id', Auth::id())->first())
                                    <a href="/menus/{{ $menu->id }}/favorite" class="btn btn-sm favorited-button">
                                        <i class="fa fa-heart"></i>
                                        お気に入り解除
                                    </a>
                                @else
                                    <a href="/menus/{{ $menu->id }}/favorite" class="btn btn-sm favorite-button">
                                        <i class="fa fa-heart"></i>
                                        お気に入りに追加
                                    </a>
                                @endif
                            </div>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('menu.show', ['theMenu' => $menu]) }}"><i class="fab fa-elementor pr-1"></i>詳細</a>
                            @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('menu.edit', ['theMenu' => $menu]) }}"><i class="fas fa-wrench pr-1"></i>編集</a>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('menu.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt pr-1"></i>削除</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
        @if (0 < count($menus))
        {{ $menus->links('pagination.bootstrap-4') }}
        @endif
@endsection
