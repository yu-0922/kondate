@extends('layouts.app')
@section('title', 'カテゴリ一覧')

@section('content')
    {{-- <form method="GET" action="{{ route('category.index') }}" class="text-right">
        <input type="text" name="menu_name" class="search-form">
        <button>検索</button>
    </form> --}}
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
            <h2 class="w-100 text-center bg-light border border-3 border-dark mb-3 py-1">
                {{ $category->recipe_category_name }}
            </h2>
            <div class="d-flex flex-wrap">
                @foreach($menus as $menu)
                    @if( $category->id == $menu->recipe_category_id)
                        <div class="item col-6 inline-block w-25">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <a href="{{ route('menu.show', ['theMenu' => $menu]) }}"><img src="{{ $menu->image_path }}" class="img-fluid img-thumbnail h-75 w-100" alt="メニュー画像"></a>
                                </div>
                                <div class="col-6">
                                    <a class="menu-name" href="{{ route('menu.show', ['theMenu' => $menu]) }}" style="color:black">{{ $menu->menu_name }}</a><br>
                                    <a class="d-inline-block text-truncate" href="{{ route('menu.show', ['theMenu' => $menu]) }}" style="max-width:150px; color:black" >{{ $menu->ingredient }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
        {{-- @if (0 < count($categories))
            {{ $categories->onEachSide(5)->links() }}
        @endif --}}
@endsection
