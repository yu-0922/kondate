@extends('layouts.app')
@section('title', 'メニュー削除確認')

@section('content')
    <h2>以下のデータを削除してよろしいですか？</h2>
    <form method="POST" action="{{ route('menu.destroy', ['theMenu' => $theMenu]) }}">
    <input type="hidden" name="_method" value="DELETE">
    {{ csrf_field() }}
    <div>
        <h3>メニュー名</h3>
        {{ $theMenu->menu_name }}
    </div>
    <div>
        <h3>写真</h3>
        {{ $theMenu->image_path }}
    </div>
    <div>
        <h3>説明</h3>
        {{ $theMenu->description }}
    </div>
    <div>
        <h3>材料</h3>
        @foreach ((array)$datas as $key => $data)
            {{ old('ing-name', $data) }}
        @endforeach
        @foreach ((array)$datas as $key => $size)
            {{ old('ing-name.$key', $size) }}
        @endforeach
    </div>
    <div>
        <h3>手順</h3>
        {{ $theMenu->step }}
    </div>
    <div>
        <h3>カテゴリー</h3>
        <div>
        @foreach ($categories as $category)
            @if(($theMenu->recipe_category_id)===$category->id)
                {{ $category->recipe_category_name }}
            @endif
        @endforeach
        </div>
    </div>
    <div>
        <input type="submit" class="btn btn-secondary" value="削除">
        <button type="button" onclick="history.back()">戻る</button>
    </div>
    </form>
@endsection
