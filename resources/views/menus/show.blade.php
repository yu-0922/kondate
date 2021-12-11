@extends('layouts.app')
@section('title', 'メニュー詳細')

@section('content')
<div class="text-right">
    <a class="btn original-button slide-in" href="{{ route('home.create') }}">カレンダー登録</a>
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
        <p class="text-center">{{ $theMenu->step }}</p>
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
