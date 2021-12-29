@extends('layouts.app')
@section('title')

@section('content')
    <div class="row">
        @foreach ($categories as $category)
        <h2 class="col-12 text-center bg-white mb-3 mx-0 py-1 category-list category-item slide-in">
            {{ $category->category_name }}
        </h2>
        <div class="col-12 bg-white d-flex flex-wrap">
            @foreach($category->menus()->get() as $menu)
            <div class="row col-md-12 col-lg-6">
                <div class="col-12 d-flex flex-wrap my-2">
                    <div class="col-5 slide-in p-0">
                        <img src="{{ $menu->image_path ? Storage::disk('s3')->url($menu->image_path) : asset('images/no_image.png') }}" class="image" alt="メニュー画像">
                    </div>
                    <div class="col-7 slide-in">
                        <h3 class="menu-name slide-in">{{ $menu->menu_name }}</h3>
                        @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                        <a class="btn original-button btn-sm slide-in mb-1" href="{{ route('recipe.createMenu', ['theMenu' => $menu]) }}"><i class="far fa-calendar-alt pr-1"></i>カレンダー登録</a><br>
                        @endif
                        <a class="btn original-button btn-sm slide-in" href="{{ route('menu.show', ['theMenu' => $menu]) }}"><i class="fab fa-elementor pr-1"></i>詳細</a>
                        @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                        <a class="btn original-button btn-sm slide-in" href="{{ route('menu.edit', ['theMenu' => $menu]) }}"><i class="fas fa-wrench pr-1"></i>編集</a>
                        <a class="btn original-button btn-sm slide-in" href="{{ route('menu.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt pr-1"></i>削除</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    <div class="slide-in text-right my-3">
        <button type="button" class="btn original-button" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
    </div>
    @if (0 < count($menus))
    {{ $menus->links('pagination.bootstrap-4') }}
    @endif
@endsection
