@extends('layouts.app')
@section('title', 'メニュー削除画面')

@section('content')
<h2 class="my-3 text-center slide-in">以下のメニューを削除してよろしいですか？</h2>
    <div class="container text-center w-60 bg-white p-5 border border-3 slide-in">
        <form method="POST" action="{{ route('menu.destroy', ['theMenu' => $theMenu]) }}">
        <input type="hidden" name="_method" value="DELETE">
        {{ csrf_field() }}
        <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 mb-3 text-left border-bottom">
            <h3>メニュー名</h3>
            <p class="text-center">{{ $theMenu->menu_name }}</p>
        </div>
        <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 mb-3 text-left border-bottom">
            <h3>写真</h3>
            <div class="text-center">
                <img src="{{ Storage::disk('s3')->url($theMenu->image_path) }}" class="img-fluid img-thumbnail h-25 w-25" alt="メニュー画像">
            </div>
        </div>
        <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 mb-3 text-left border-bottom">
            <h3>説明</h3>
            <p class="text-center">{{ $theMenu->description }}</p>
        </div>
        <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 mb-3 text-left border-bottom">
            <h3>材料</h3>
            @foreach ($theMenu->ingredients as $ingredient)
                <p class="text-center mb-0">{{ $ingredient->ingredient_name }}：{{ $ingredient->unit }}</p>
            @endforeach
        </div>
        <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 mb-3 text-left border-bottom">
            <h3>手順</h3>
            <p class="text-center">{!! nl2br(e($theMenu->step)) !!}</p>
        </div>
        <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 mb-3 text-left border-bottom">
            <h3>カテゴリー</h3>
            <div class="text-center">
            @foreach ($categories as $category)
                @if(($theMenu->category_id)===$category->id)
                    <p>{{ $category->category_name }}</p>
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
