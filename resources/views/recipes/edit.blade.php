@extends('layouts.app')
@section('title', 'カレンダー編集')

@section('content')
<h2 class="my-5 text-center slide-in">必要な箇所を編集し更新してください</h2>
<div class="container text-center w-70 p-3 slide-in">
    <form method="POST" action="{{ route('recipe.update') }}">
    <input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}
    <label for="create-date" class="col-8 text-left">{{ __('作成日') }}
        <div class="form-group text-center">
            <input type="date" name="cooking_day" id="date" class="p-2 w-50 text-center">
        </div>
        <div id="input_pluralBox3" class="form-group">
            @error('morning_recipe.*')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label for="inputMorning" class="col-12 text-left card p-3">{{ __('朝') }}
                <button type="button" onclick="addMorning()" class="btn btn-sm btn-outline-dark mb-2 ml-1 w-50">＋メニューを追加</button>
                <div id="input_plural3">
                    @if(old("morning_recipe"))
                        @foreach(old("morning_recipe") as $key => $mr)
                        <div class="d-flex">
                            <select class="form-control" id="inputMorning" name="morning_recipe[]">
                                <option value="">メニューを選択してください</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $mr }}" @if(old('morning_recipe') == $mr) selected @endif>{{ $menu->menu_name }}</option>
                                @endforeach
                            </select>
                            <input type="button" value="削除" onclick="del(this)">
                        </div>
                        @endforeach
                    @else
                        @if(is_array(json_decode($recipe->morning_recipe, true)))
                            @foreach (json_decode($recipe->morning_recipe, true) as $key => $value)
                            <div class="d-flex">
                                <select class="form-control" id="inputMorning" name="morning_recipe[]">
                                    <option value="">メニューを選択してください</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $value[0] }}">{{ $menu->menu_name }}</option>
                                    @endforeach
                                </select>
                                <input type="button" value="削除" onclick="del(this)">
                            </div>
                            @endforeach
                        @else
                            <div class="d-flex">
                                <select class="form-control" id="inputMorning" name="morning_recipe[]">
                                    <option value="">メニューを選択してください</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->menu_name }}</option>
                                    @endforeach
                                </select>
                                <input type="button" value="削除" onclick="del(this)">
                            </div>
                        @endif
                    @endif
                </div>
            </label>
        </div>
        <div class="text-center form-group mb-5">
            <input type="submit" class="btn btn-outline-dark mr-3" value="登録">
        </div>
    </label>
    </form>
</div>
@endsection
