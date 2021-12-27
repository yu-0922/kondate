@extends('layouts.app')
@section('title', 'メニュー新規登録')

@section('content')
<h2 class="my-3 text-center slide-in">以下の欄を入力し登録してください</h2>
<div class="container text-center w-70 bg-light p-5 border border-3 slide-in">
    <form method="POST" action="{{ route('menu.store') }}" enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class="form-group">
            @error('menu_name')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputName" class="col-md-6 text-left">{{ __('メニュー名') }}<span class="badge badge-danger ml-2 mb-1">{{ __('必須') }}</span>
            <input type="text" name="menu_name" class="form-control" id="inputName" value="{{ old('menu_name') }}"></label>
        </div>
        <div class="form-group">
            @error('image_path')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputFile" class="col-md-6 text-left">{{ __('写真') }}
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image_path" class="custom-file-input" id="inputFile">
                    <label class="custom-file-label" for="inputFile" data-browse="参照">ファイル選択...</label>
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
            <textarea name="description" class="form-control" id="inputDescription">{{ old('description') }}</textarea></label>
        </div>
        <div id="input_pluralBox" class="form-group">
            @error('ing_name.*')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputIngredient" class="col-md-6 text-left">{{ __('材料') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span>
                <p class="my-1">※左の入力欄に「材料名」、右の入力欄に「量」を記載してください。</p>
                <div id="input_plural">
                    @if(old("ing_name"))
                    @foreach(old("ing_name") as $key => $ingredient)
                    <div class="d-flex">
                        <input type="text" class="form-control" name="ing_name[]" value="{{ $ingredient }}">
                        <input type="text" class="form-control" name="ing_size[]" value="{{ old("ing_size")[$key] }}">
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
                </div>
                <button type="button" onclick="add()" class="btn btn-sm btn-outline-dark ml-1">＋材料を追加する</button>
            </label>
        </div>
        <div class="form-group">
            @error('step')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputStep" class="col-md-6 text-left">{{ __('手順') }}<br>
            <textarea name="step" class="form-control" id="inputStep">{{ old('step') }}</textarea></label>
        </div>
        <div class="form-group">
            @error('category_id')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="category-id" class="col-md-6 text-left">{{ __('カテゴリー') }}<span class="badge badge-danger mr-3 mt-1 ml-1 h-50">{{ __('必須') }}</span>
            <select class="form-control" id="category-id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->category_name }}</option>
                @endforeach
            </select>
            </label>
        </div>
        <div class="text-center form-group mb-5">
            <input type="submit" class="btn original-button mr-3" value="登録">
            <button type="button" class="btn original-button" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
        </div>
    </form>
</div>
@endsection
