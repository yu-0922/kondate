@extends('layouts.app')
@section('title', 'メニュー削除画面')

@section('content')
<h2 class="mb-5 text-center slide-in">以下のメニューを削除してよろしいですか？</h2>
    <div class="container text-center w-60 bg-light p-5 border border-3 slide-in">
        <form method="POST" action="{{ route('menu.destroy', ['theMenu' => $theMenu]) }}">
        <input type="hidden" name="_method" value="DELETE">
        {{ csrf_field() }}
        <div class="col-6 offset-3 mb-3 text-left border-bottom">
            <h3>メニュー名</h3>
            <p class="text-center">{{ $theMenu->menu_name }}</p>
        </div>
        <div class="col-6 offset-3 mb-3 text-left border-bottom">
            <h3>写真</h3>
            <div class="text-center">
                <img src="{{ $theMenu->image_path }}" class="img-fluid img-thumbnail h-25 w-25" alt="メニュー画像">
            </div>
        </div>
        <div class="col-6 offset-3 mb-3 text-left border-bottom">
            <h3>説明</h3>
            <p class="text-center">{{ $theMenu->description }}</p>
        </div>
        <div class="col-6 offset-3 mb-3 text-left border-bottom">
            <h3>材料</h3>
            <div class="text-center">
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
        <div class="col-6 offset-3 mb-3 text-left border-bottom">
            <h3>手順</h3>
            <p class="text-center">{{ $theMenu->step }}</p>
        </div>
        <div class="col-6 offset-3 mb-3 text-left border-bottom">
            <h3>カテゴリー</h3>
            <div class="text-center">
            @foreach ($categories as $category)
                @if(($theMenu->recipe_category_id)===$category->id)
                    <p>{{ $category->recipe_category_name }}</p>
                @endif
            @endforeach
            </div>
        </div>
        <div>
            <input type="submit" class="btn btn-outline-dark mr-3" value="削除">
            <button type="button" class="btn btn-outline-dark" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
        </div>
        </form>
    </div>
@endsection
