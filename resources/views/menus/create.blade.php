@extends('layouts.app')
@section('title', 'メニュー新規登録')

@section('content')
    <h2>以下の欄を全て入力し送信してください</h2>
    <form method="POST" action="{{ route('menu.store') }}" enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div>
            @error('menu_name')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label>メニュー名<input type="text" name="menu_name" value="{{ old('menu_name') }}"></label>
        </div>
        <div>
            @error('tokuchou')
            <span class="input-error">{{ $message }}</span>
            @enderror
            <label>特徴<textarea name="tokuchou">{{ old('tokuchou') }}</textarea></label>
        </div>
        <div>
            <input type="file" name="kondate_image">
        </div>
        <div>
            <button>送信</button>
        </div>
    </form>
@endsection
