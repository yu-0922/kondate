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
        <a href="/menus/{{ $theMenu->id }}/favorite" class="btn favorite-button  mt-2">
            <i class="fa fa-heart"></i>
            お気に入りに追加
        </a>
    @endif
</div>
<div class="container text-center w-70 bg-light p-5 my-3 border border-3">
    <div class="mb-5 text-left">
        <h3>{{ $theMenu->menu_name }}</h3>
    </div>
    <div>
        <img src="{{ $theMenu->image_path }}" class="text-center img-fluid img-thumbnail item-image" alt="メニュー画像">
    </div>
    <div>
        <p>{{ $theMenu->description }}</p>
    </div>
    <div class="my-5 text-left">
        <h3>材料<span>（〇人分）</span></h3>
        <div class="m-3">
            @if(is_array(json_decode($theMenu->ingredient, true)))
            @php
                $ingredient = "";
                foreach (json_decode($theMenu->ingredient, true) as $key => $value) {
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
                <p>{{ $theMenu->ingredient }}</p>
            @endif
        </div>
    </div>
    <div class="my-5 text-left">
        <h3>手順</h3>
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
                <p>{!! nl2br(e($step)) !!}</p>
            @else
                <p>{{ $theMenu->step }}</p>
            @endif
        </div>
    </div>
    <div class="my-5 text-left" >
        <h3>カテゴリー</h3>
        <div class="ml-3">
            @foreach ($categories as $category)
                @if(($theMenu->recipe_category_id)===$category->id)
                    {{ $category->recipe_category_name }}
                @endif
            @endforeach
        </div>
    </div>
    @if ((\Auth::user() && $theMenu->user_id == \Auth::id())|| \Auth::id() == 1)
    <div class="my-5 text-left">
        <h3>投稿の有無</h3>
        <div class="ml-3">
            {{ $theMenu->menu_release == '投稿しない' ? '投稿する' : '' }}
        </div>
    </div>
    <div class="my-5 text-left">
        <h3>マイメニュー登録の有無</h3>
        <div class="ml-3">
            {{ $theMenu->my_menu_register == '登録しない' ? '登録する' : '' }}
        </div>
    </div>

    <a class="btn btn-outline-dark" href="{{ route('menu.edit', ['theMenu' => $theMenu]) }}"><i class="fas fa-wrench mr-1"></i>編集</a>
    <a class="btn btn-outline-dark" href="{{ route('menu.confirmDelete', ['theMenu' => $theMenu]) }}"><i class="far fa-trash-alt mr-1"></i>削除</a>
    @endif
    <button type="button"  class="btn btn-outline-dark" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
</div>
@endsection
