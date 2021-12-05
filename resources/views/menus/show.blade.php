@extends('layouts.app')
@section('title', 'メニュー詳細')

@section('content')
<!-- オーバーレイ -->
<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ -->
<!-- 開くボタン -->
<a class="js-open button-open slide-in">カレンダー登録</a>
<div class="modal-window">
    <form method="POST" action="{{ route('menu.store') }}">
    {{ csrf_field() }}
    <label for="create-date" class="col-md-12 text-left">{{ __('作成日') }}
        <div class="form-group text-center">
            <input type="date" name="cooking_day" id="date">
        </div>
        <div class="form-group text-center">
            <div class="form-check form-check-inline">
                <input type="checkbox" name="morning_recipe" class="form-check-input" id="radioRecipe1" value="{{ $theMenu->menu_name }}" {{ old ('morning_recipe') == '朝' ? 'checked' : '' }} checked>
                <label for="checkRecipe1" class="form-check-label">朝</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" name="luncu_recipe" class="form-check-input" id="radioRecipe1" value="{{ $theMenu->menu_name }}" {{ old ('lunch_recipe') == '昼' ? 'checked' : '' }}>
                <label for="checkRecipe1" class="form-check-label">昼</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" name="dinner_recipe" class="form-check-input" id="radioRecipe1" value="{{ $theMenu->menu_name }}" {{ old ('dinner_recipe') == '夜' ? 'checked' : '' }}>
                <label for="checkRecipe1" class="form-check-label">夜</label>
            </div>
        </div>
    </label>
    <div class="text-center form-group mb-5">
        <input type="submit" class="button-register" value="登録">
    </div>
<!-- 閉じるボタン -->
    <button class="js-close button-close">Close</button>
</div>
<div class="my-3 text-right">
    @if($theMenu->favorites()->where('user_id', Auth::id())->first())
        <a href="/menus/{{ $theMenu->id }}/favorite" class="btn favorited-button mt-2 slide-in">
            <i class="fa fa-heart"></i>
            お気に入り解除
        </a>
    @else
        <a href="/menus/{{ $theMenu->id }}/favorite" class="btn favorite-button mt-2 slide-in">
            <i class="fa fa-heart"></i>
            お気に入りに追加
        </a>
    @endif
</div>
<div class="container text-center w-60 bg-light p-5 my-3 border border-3 slide-in">
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
            {{-- JSON文字列を連想配列にして配列かどうかチェック --}}
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
                        if (!$k) //
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
