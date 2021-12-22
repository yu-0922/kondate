@extends('layouts.app')
@section('title', 'カテゴリ詳細')

@section('content')
    <div class="container mb-5">
        <div class="row">
            @foreach ($categories as $category)
            <h2 class="w-25 text-center bg-light my-3 ml-3 py-1 category-list category-item slide-in">
                {{ $category->category_name }}
            </h2>
            <div class="item-list d-flex flex-wrap">
                @foreach($category->menus()->get() as $menu)
                <div class="item col-12 col-md-6">
                    <div class="row">
                        <div class="col-4 img-wrap">
                            <div class="cover1"></div>
                            <div class="cover2"></div>
                            <div class="cover3"></div>
                            <a href="{{ route('menu.show', ['theMenu' => $menu]) }}">
                                <img src="{{ Storage::disk('s3')->url($menu->image_path) }}" class="img-fluid img-thumbnail h-75 w-100" alt="メニュー画像">
                            </a>
                        </div>
                        <div class="col-8 slide-in">
                            <a class="menu-name font-weight-bold" href="{{ route('menu.show', ['theMenu' => $menu]) }}">{{ $menu->menu_name }}</a><br>
                            <a href="{{ route('menu.show', ['theMenu' => $menu]) }}">
                                @foreach ($ingredients as $ingredient)
                                    <p class="text-left ml-5 mb-0">{{ $ingredient->ingredient_name }}：{{ $ingredient->unit }}</p>
                                @endforeach
                            </a>
                            @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                            <a class="btn btn-outline-dark btn-sm slide-in mb-1" href="{{ route('recipe.createMenu', ['theMenu' => $menu]) }}"><i class="far fa-calendar-alt pr-1"></i>カレンダー登録</a><br>
                            @endif
                            <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('menu.show', ['theMenu' => $menu]) }}"><i class="fab fa-elementor pr-1"></i>詳細</a>
                            @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                            <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('menu.edit', ['theMenu' => $menu]) }}"><i class="fas fa-wrench pr-1"></i>編集</a>
                            <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('menu.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt pr-1"></i>削除</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
            <div class="m-3">
                <button type="button" class="btn btn-outline-dark text-center" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
            </div>
        </div>
    </div>
        @if (0 < count($menus))
        {{ $menus->links('pagination.bootstrap-4') }}
        @endif
@endsection
