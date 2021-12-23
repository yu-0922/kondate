@extends('layouts.app')
@section('title', 'カレンダー登録')

@section('content')
<h2 class="my-5 text-center slide-in">以下の欄を入力し登録してください</h2>
<div class="container text-center w-70 p-3 bg-white border border-3 slide-in">
    <form method="POST" action="{{ route('home.store') }}">
    {{ csrf_field() }}
    <label for="create-date" class="col-8 text-left">{{ __('調理日') }}
        <div class="form-group text-center">
            <input type="date" name="cooking_day" id="date" class="p-2 w-100 text-center">
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
            <div class="item col-12 col-md-6">
                <div class="row">
                    <input type="radio" name="menu_id" class="form-check-input" id="menu" value="{{ $theMenu->id }}" {{ old ('menu_id') == $theMenu->id ? 'checked' : '' }} checked>
                    <label for="menu" class="form-check-label"></label>
                    <div class="col-4 zoom-animation img-wrap">
                        <div class="cover1"></div>
                        <div class="cover2"></div>
                        <div class="cover3"></div>
                        <img src="{{ $theMenu->image_path }}" class="img-fluid img-thumbnail text-center h-75 w-100" alt="メニュー画像">
                    </div>
                    <div class="col-8">
                        <h3>{{ $theMenu->menu_name }}</h3>
                        <h4>
                        @foreach ($theMenu->ingredients as $ingredient)
                            <p class="text-center">{{ $ingredient->ingredient_name }}：{{ $ingredient->unit }}</p>
                        @endforeach
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center form-group mb-5">
            <input type="submit" class="btn btn-outline-dark mr-3" value="登録">
        </div>
    </label>
    </form>
</div>
@endsection
