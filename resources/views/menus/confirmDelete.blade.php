@extends('layouts.app')
@section('title', 'メニュー削除確認')

@section('content')
    <div class="container text-center w-70 bg-light p-5 border border-3">
        <h2 class="mb-5">以下のデータを削除してよろしいですか？</h2>
        <form method="POST" action="{{ route('menu.destroy', ['theMenu' => $theMenu]) }}">
        <input type="hidden" name="_method" value="DELETE">
        {{ csrf_field() }}
        <div class="mb-3 text-left">
            <h3>メニュー名</h3>
            <div class="ml-3">
                {{ $theMenu->menu_name }}
            </div>
        </div>
        <div class="mb-3 text-left">
            <h3>写真</h3>
            <div class="ml-3">
                {{ $theMenu->image_path }}
            </div>
        </div>
        <div class="mb-3 text-left">
            <h3>説明</h3>
            <div class="ml-3">
                {{ $theMenu->description }}
            </div>
        </div>
        <div class="mb-3 text-left">
            <h3>材料</h3>
            <div class="ml-3">
                @foreach ((array)$datas as $key => $data)
                    {{ old('ing-name', $data) }}
                @endforeach
                @foreach ((array)$datas as $key => $size)
                    {{ old('ing-name.$key', $size) }}
                @endforeach
            </div>
        </div>
        <div class="mb-3 text-left">
            <h3>手順</h3>
            <div class="ml-3">
                {{ $theMenu->step }}
            </div>
        </div>
        <div class="mb-3 text-left">
            <h3>カテゴリー</h3>
            <div class="ml-3">
            @foreach ($categories as $category)
                @if(($theMenu->recipe_category_id)===$category->id)
                    {{ $category->recipe_category_name }}
                @endif
            @endforeach
            </div>
        </div>
        <div class="mb-3 text-left">
            <h3>投稿の有無</h3>
            <div class="ml-3">
                {{ $theMenu->menu_release == '投稿しない' ? '投稿する' : '' }}
            </div>
        </div>
        <div>
            <input type="submit" class="btn btn-outline-dark" value="削除">
            <button type="button" class="btn btn-outline-dark" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
        </div>
        </form>
    </div>
@endsection
