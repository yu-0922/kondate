@extends('layouts.app')
@section('title', 'メニュー詳細')

@section('content')
<!-- オーバーレイ -->
<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ -->
<!-- 開くボタン -->
<button class="js-open button-open">カレンダー登録</button>
<div class="modal-window">
    <label for="create-date" class="col-md-12 text-left">{{ __('作成日') }}
    <select class="form-control" id="create-date" name="recipe_category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if(old('recipe_category_id') == $category->id) selected @endif>{{ $category->recipe_category_name }}</option>
        @endforeach
    </select>
    </label>
    <button class="button-register">登録</button>
    <!-- 閉じるボタン -->
    <button class="js-close button-close">Close</button>
</div>
<div class="my-3 text-right">
    @if($theMenu->favorites()->where('user_id', Auth::id())->first())
        <a href="/menus/{{ $theMenu->id }}/favorite" class="btn favorited-button mt-2">
            <i class="fa fa-heart"></i>
            お気に入り解除
        </a>
    @else
        <a href="/menus/{{ $theMenu->id }}/favorite" class="btn favorite-button mt-2">
            <i class="fa fa-heart"></i>
            お気に入りに追加
        </a>
    @endif
</div>
<div class="container text-center w-60 bg-light p-5 my-3 border border-3">
    <div class="col-md-6 offset-md-3 mb-5 text-left">
        <h3 class="stitch d-inline-block">{{ $theMenu->menu_name }}</h3>
    </div>
    <div>
        <img src="{{ $theMenu->image_path }}" class="text-center img-fluid img-thumbnail h-25 w-25" alt="メニュー画像">
    </div>
    <div class="my-5 col-md-6 offset-md-3">
        <p class="text-center">{{ $theMenu->description }}</p>
    </div>
    <div class="my-5 col-md-6 offset-md-3 text-left">
        <h3 class="side-border d-inline-block">材料</h3>
        <div class="m-3">
            @if(is_array(json_decode($theMenu->ingredient, true)))
            @php
                $ingredient = "";
                foreach (json_decode($theMenu->ingredient, true) as $key => $value) {
                    foreach ($value as $k => $v) {
                        if (!$k)
                            $ingredient .= $v . "：";
                        else {
                            $ingredient .= $v . "\n";
                        }
                    }
                }
            @endphp
                <p class="text-center">{!! nl2br(e($ingredient)) !!}</p>
            @else
                <p class="text-center">{!! nl2br(e($theMenu->ingredient)) !!}</p>
            @endif
        </div>
    </div>
    <div class="my-5 col-md-6 offset-md-3 text-left">
        <h3 class="side-border d-inline-block">手順</h3>
        <div class="m-3">
            @if(is_array(json_decode($theMenu->step, true)))
            @php
                $step = "";
                foreach (json_decode($theMenu->step, true) as $key => $value) {
                    foreach ($value as $k => $v) {
                        if (!$k)
                            $step .= $v . "\n";
                        else {
                            $step .= $v . "　";
                        }
                    }
                }
            @endphp
                <p class="text-center">{!! nl2br(e($step)) !!}</p>
            @else
                <p class="text-center">{!! nl2br(e($theMenu->step)) !!}</p>
            @endif
        </div>
    </div>
    <div class="my-5 col-md-6 offset-md-3 text-left">
        <h3 class="side-border d-inline-block">カテゴリー</h3>
        <div>
            @foreach ($categories as $category)
                @if(($theMenu->recipe_category_id)===$category->id)
                    <p class="text-center">{{ $category->recipe_category_name }}</p>
                @endif
            @endforeach
        </div>
    </div>
    @if ((\Auth::user() && $theMenu->user_id == \Auth::id())|| \Auth::id() == 1)
    <a class="btn btn-outline-dark" href="{{ route('menu.edit', ['theMenu' => $theMenu]) }}"><i class="fas fa-wrench mr-1"></i>編集</a>
    <a class="btn btn-outline-dark" href="{{ route('menu.confirmDelete', ['theMenu' => $theMenu]) }}"><i class="far fa-trash-alt mr-1"></i>削除</a>
    @endif
    <button type="button" class="btn btn-outline-dark" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
</div>

@endsection
