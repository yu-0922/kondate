@extends('layouts.app')
@section('title', 'メニュー新規登録')

@section('content')
<h2 class="my-5 text-center slide-in">材料を登録してください</h2>
<div class="text-center w-70 bg-light p-5 border border-3 slide-in">
    <div class="row">
        <div class="col-6">
            <form method="POST" action="{{ route('menu.store') }}" enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="form-group">
                    @error('menu_id')
                    <span class="input-error">{{ $message }}</span>
                    @enderror
                    <label for="create-date" class="col-8 text-left">{{ __('メニュー') }}
                        <div class="form-group text-center">
                            <input type="text" name="menu_id" class="p-2 w-100 text-center" value="{{ request()->get('m') }}">
                        </div>
                    </label>
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
                <div class="text-center form-group mb-5">
                    <input type="submit" class="btn btn-outline-dark mr-3" value="登録">
                    <button type="button" class="btn btn-outline-dark" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
