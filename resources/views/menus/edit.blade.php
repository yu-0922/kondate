@extends('layouts.app')
@section('title', 'メニュー編集')

@section('content')
    <h2>必要な箇所を編集して送信してください</h2>
    <form method="POST" action="{{ route('menu.edit', ['theMenu' => $theMenu]) }}">
    <input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}
    <div>
        @error('menu_name')
        <span class="input-error">{{ $message }}</span>
        @enderror
        <label>メニュー名<input type="text" name="menu_name" value="{{ $theMenu->menu_name }}"></label>
    </div>
    <div>
        @error('tokuchou')
        <span class="input-error">{{ $message }}</span>
        @enderror
        <label>特徴<textarea name="tokuchou">{{ $theMenu->tokuchou }}</textarea></label>
    </div>
    <div>
        <button>送信</button>
    </div>
    </form>
@endsection
