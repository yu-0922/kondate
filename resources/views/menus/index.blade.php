@extends('layouts.app')
@section('title', 'メニュー一覧')

@section('content')
    @if (\Auth::user())
    <a class="btn btn-dark ml-3 slide-in" href="{{ route('menu.create') }}"><i class="fas fa-magic pr-1"></i>メニュー新規登録</a>
    @endif
    <div class="container mt-3">
        <div class="row">
            <div class="item-list d-flex flex-wrap">
                @foreach($menus as $menu)
                <div class="item col-12 col-md-6">
                    <div class="row">
                        <div class="col-4 zoom-animation img-wrap">
                            <div class="cover1"></div>
                            <div class="cover2"></div>
                            <div class="cover3"></div>
                            <img src="{{ $menu->image_path }}" class="img-fluid img-thumbnail text-center h-75 w-100" alt="メニュー画像">
                        </div>
                        <div class="col-8">
                            <h3 class="menu-name slide-in">{{ $menu->menu_name }}</h3>
                            <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('menu.show', ['theMenu' => $menu]) }}"><i class="fab fa-elementor pr-1"></i>詳細</a>
                            @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                            <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('menu.edit', ['theMenu' => $menu]) }}"><i class="fas fa-wrench pr-1"></i>編集</a>
                            <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('menu.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt pr-1"></i>削除</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="pagination justify-content-center mt-3">
        @if (0 < count($menus))
            {{ $menus->links('pagination.bootstrap-4') }}
        @endif
    </div>
@endsection
