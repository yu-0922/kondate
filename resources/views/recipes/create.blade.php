@extends('layouts.app')
@section('title', 'カレンダー登録')

@section('content')
<h2 class="my-5 text-center zoom">以下の欄を入力し登録してください</h2>
<div class="container text-center w-70 p-3 bg-white border border-3 slide-in">
    <form method="POST" action="{{ route('home.store') }}">
    {{ csrf_field() }}
    <label for="create-date" class="col-8 text-left">{{ __('調理日') }}
        <div class="form-group text-center">
            <input type="date" name="cooking_day" id="date" class="p-2 w-100 text-center" value="{{ request()->get('d') }}">
        </div>
        <div class="d-flex">
            <div class="form-group">
                @error('recipe_time')
                <span class="input-error">{{ $message }}</span>
                @enderror
                <div class="form-check form-check-inline">
                    <input type="radio" name="recipe_time" class="form-check-input" id="recipe1" value="朝" {{ old ('recipe_time') == '朝' ? 'checked' : '' }} checked>
                    <label for="recipe1" class="form-check-label">朝</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="recipe_time" class="form-check-input" id="recipe2" value="昼" {{ old ('recipe_time') == '昼' ? 'checked' : '' }}>
                    <label for="recipe2" class="form-check-label">昼</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="recipe_time" class="form-check-input" id="recipe3" value="夜" {{ old ('recipe_time') == '夜' ? 'checked' : '' }}>
                    <label for="recipe3" class="form-check-label">夜</label>
                </div>
            </div>
        </div>
        <div class="form-group d-flex flex-wrap">
            @foreach($menus as $menu)
            <div class="item col-12 col-md-6">
                <div class="row">
                    <input type="radio" name="menu_id" class="form-check-input" id="menu" value="{{ $menu->id }}" {{ old ('menu_id') == $menu->id ? 'checked' : '' }}>
                    <label for="menu" class="form-check-label"></label>
                    <div class="col-4 zoom-animation img-wrap">
                        <div class="cover1"></div>
                        <div class="cover2"></div>
                        <div class="cover3"></div>
                        <img src="{{ $menu->image_path }}" class="img-fluid img-thumbnail text-center h-75 w-100" alt="メニュー画像">
                    </div>
                    <div class="col-8">
                        <h3 class="menu-name slide-in">{{ $menu->menu_name }}</h3>
                        @if(is_array(json_decode($menu->ingredient, true)))
                        @php
                            $ingredient = "";
                            foreach (json_decode($menu->ingredient, true) as $key => $value) {
                                foreach ($value as $k => $v) {
                                    if (!$k)
                                        $ingredient .= $v . "：";
                                    else {
                                        $ingredient .= $v . "　";
                                    }
                                }
                            }
                        @endphp
                            <p class="text-truncate mb-1 slide-in" style="max-width:175px; color:#555;">{{ $ingredient }}</p>
                        @else
                            <p class="text-truncate mb-1 slide-in" style="max-width:175px; color:#555;">{{ $menu->ingredient }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center form-group mb-5">
            <input type="submit" class="btn btn-outline-dark mr-3" value="登録">
        </div>
        {{ $menus->appends(request()->input())->links('pagination.bootstrap-4') }}
    </label>
    </form>
</div>
@endsection
