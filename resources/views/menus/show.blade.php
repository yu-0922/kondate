@extends('layouts.app')
@section('title', 'メニュー詳細')

@section('content')
    <div>
        <h3>{{ $theMenu->menu_name }}</h3>
    </div>
    <div>
        <img src="{{ $theMenu->image_path }}" class="text-center img-fluid img-thumbnail" alt="メニュー画像">
    </div>
    <div class="m-3">{{ $theMenu->description }}</div>
    <div>
        <h3>材料<span>（〇人分）</span></h3>
        <div>
            @foreach ((array)$datas as $key => $data)
                {{ old('ing-name', $data) }}
            @endforeach
            @foreach ((array)$datas as $key => $size)
                {{ old('ing-name.$key', $size) }}
            @endforeach
        </div>
    </div>
    <div>
        <h3>手順</h3>
        <div>{{ $theMenu->step }}</div>
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

    @if ((\Auth::user() && $theMenu->user_id == \Auth::id())|| \Auth::id() == 1)
    <a class="op" href="{{ route('menu.edit', ['theMenu' => $theMenu]) }}"><i class="fas fa-wrench"></i>編集</a>
    <a class="op" href="{{ route('menu.confirmDelete', ['theMenu' => $theMenu]) }}"><i class="far fa-trash-alt"></i>削除</a>
    @endif
    <button type="button" class="op" onclick="history.back()">戻る</button>
@endsection
