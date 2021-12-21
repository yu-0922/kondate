@extends('layouts.app')
@section('title', 'メニュー編集')

@section('content')
<h2 class="my-3 text-center slide-in">必要な箇所を編集し更新してください</h2>
    <div class="container text-center w-70 bg-light p-5 border border-3 slide-in">
        <form method="POST" action="{{ route('menu.update', ['theMenu' => $theMenu]) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-group">
            @error('menu_name')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputName" class="col-md-6 text-left">{{ __('メニュー名') }}<span class="badge badge-danger ml-2 mb-1">{{ __('必須') }}</span>
            <input type="text" name="menu_name" class="form-control" id="inputName" value="{{ old('menu_name', $theMenu->menu_name) }}"></label>
        </div>
        <div class="form-group">
            @error('image_path')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputFile" class="col-md-6 text-left">{{ __('写真') }}
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image_path" class="custom-file-input" id="inputFile" value="{{ old('image_path', isset($theMenu->image_path) ? $theMenu->image_path : '') }}">
                    <label class="custom-file-label" for="inputFile" data-browse="参照">{{ $theMenu->image_path }}</label>
                </div>
                <div class="input-group-append">
                    <button type="button" class="btn input-group-text ml-1" id="inputFileReset">取消</button>
                </div>
            </div>
            </label>
        </div>
        <div class="form-group">
            @error('description')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputDescription" class="col-md-6 text-left">{{ __('説明') }}<br>
            <textarea name="description" class="form-control" id="inputDescription">{{ old('description', $theMenu->description) }}</textarea></label>
        </div>
        <div id="input_pluralBox" class="form-group">
            @error('ing_name.*')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputIngredient" class="col-md-6 text-left">{{ __('材料') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span>
            <div id="input_plural">
                @if(old("ing_name"))
                    @foreach(old("ing_name") as $key => $ing)
                    <div class="d-flex">
                        <input type="text" class="form-control" name="ing_name[]" value="{{ $ing }}">
                        <input type="text" class="form-control" name="ing_size[]" value="{{ old("ing_size")[$key] }}">
                        <input type="button" value="削除" onclick="del(this)">
                    </div>
                    @endforeach
                @else
                    @if($theMenu->ingredients)
                    @foreach ($theMenu->ingredients as $key => $value)
                        <div class="d-flex">
                            <input type="text" class="form-control" name="ing_name[]" value="{{ $value["ingredient_name"] }}">
                            <input type="text" class="form-control" name="ing_size[]" value="{{ $value["unit"] }}">
                            <input type="button" value="削除" onclick="del(this)">
                        </div>
                        @endforeach
                    @else
                    <div class="d-flex">
                        <input type="text" class="form-control" name="ing_name[]">
                        <input type="text" class="form-control" name="ing_size[]">
                        <input type="button" value="削除" onclick="del(this)">
                    </div>
                    @endif
                @endif
            </div>
            <a onclick=add() class="btn btn-sm btn-light ml-1">＋材料を追加する</a>
            </label>
        </div>
        <div class="form-group">
            @error('step')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputStep" class="col-md-6 text-left">{{ __('手順') }}<br>
            <textarea name="step" class="form-control" id="inputStep">{{ old('step', $theMenu->step) }}</textarea></label>
        </div>
        <div class="form-group">
            @error('category_id')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="category-id" class="col-md-6 text-left">{{ __('カテゴリー') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span>
            <select class="form-control" id="category-id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(old('category_id', $theMenu->category_id) == $category->id) selected @endif>{{ $category->category_name }}</option>
                @endforeach
            </select>
            </label>
        </div>
        <div class="text-center form-group mb-5">
            <input type="submit" class="btn btn-outline-dark" value="更新">
            <button type="button" class="btn btn-outline-dark" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
        </div>
        </form>
    </div>
@endsection
