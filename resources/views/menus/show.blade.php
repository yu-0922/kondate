@extends('layouts.app')
@section('title', 'メニュー詳細')

@section('content')
<div class="text-right">
    @if (\Auth::user())
    <a class="btn original-button slide-in" href="{{ route('recipe.createMenu', ['theMenu' => $theMenu]) }}">カレンダー登録</a>
    @endif
</div>
<div class="container text-center w-60 bg-white p-5 my-3 border border-3 slide-in">
    <div class="col-md-6 offset-md-3 mb-5 text-left">
        <h3 class="stitch d-inline-block">{{ $theMenu->menu_name }}</h3>
    </div>
    <div>
        <img src="{{ $theMenu->image_path ? Storage::disk('s3')->url($theMenu->image_path) : asset('images/no_image.png') }}" class="image" alt="メニュー画像">
    </div>
    <div class="my-5 col-md-6 offset-md-3">
        <p class="text-center">{{ $theMenu->description }}</p>
    </div>
    <div class="my-5 col-md-6 offset-md-3 text-left">
        <h3 class="side-border d-inline-block">材料</h3>
        @foreach ($ingredients as $ingredient)
            <p class="text-left ml-5 mb-0">{{ $ingredient->ingredient_name }}：{{ $ingredient->unit }}</p>
        @endforeach
    </div>
    <div class="my-5 col-md-6 offset-md-3 text-left">
        <h3 class="side-border d-inline-block">手順</h3>
        <p class="text-left ml-5">{!! nl2br(e($theMenu->step)) !!}</p>
    </div>
    <div class="my-5 col-md-6 offset-md-3 text-left">
        <h3 class="side-border d-inline-block">カテゴリー</h3>
        <div>
            @foreach ($categories as $category)
                @if(($theMenu->category_id)===$category->id)
                    <p class="text-left ml-5">{{ $category->category_name }}</p>
                @endif
            @endforeach
        </div>
    </div>
    @if ((\Auth::user() && $theMenu->user_id == \Auth::id())|| \Auth::id() == 4)
    <a class="btn original-button" href="{{ route('menu.edit', ['theMenu' => $theMenu]) }}"><i class="fas fa-wrench mr-1"></i>編集</a>
    <a class="btn original-button" href="{{ route('menu.confirmDelete', ['theMenu' => $theMenu]) }}"><i class="far fa-trash-alt mr-1"></i>削除</a>
    @endif
    <button type="button" class="btn original-button" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
</div>

@endsection
