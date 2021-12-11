@extends('layouts.app')
@section('title', 'マイページ')

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="slide-in">
                @if (session('status'))
                    <div class="alert alert-dark" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="text-right slide-in">
                <a class="btn btn-dark btn-sm my-2 mr-2" href="{{ route('home.create') }}">カレンダー登録</a>
            </div>
            <div class="card text-center slide-in">
                <div class="my-3 d-flex flex-nowrap justify-content-around">
                    {{-- 前の週をクリックするとw=-1となり、1週間前に遷移する --}}
                    <a class="btn btn-outline-dark btn-sm" href="{{ url('/home?w=' . $before) }}">前の週</a>
                    <div class="d-flex flex-nowrap">
                        {{-- <h3>{{ $carbon->year. "年". $carbon->month. "月（". $carbon->weekOfMonth. "週目）"}}</h3> --}}
                        <h3>{{ $carbon->month. "月（". $carbon->weekOfMonth. "週目）"}}</h3>
                        <a class="btn btn-outline-dark btn-sm" href="{{ url('/home?w=0') }}">今週に戻る</a>
                    </div>
                    <a class="btn btn-outline-dark btn-sm" href="{{ url('/home?w=' . $after) }}">次の週</a>
                </div>
                <div class="table-responsive px-3 pb-3">
                    <table class="table table-bordered">
                        <thead class="card-header">
                            <tr>
                                @foreach ($week_names as $week_name)
                                    <td class="col-1">{{ $week_name }}</td>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="card-body">
                            <tr>
                                @foreach ($w_day as $day)
                                    <td>
                                        @if($day[0] == $today)
                                        <a href="{{ url('/recipes/create?d='.$day[0]) }}" style="color:red">
                                            {!! nl2br(e($day[1])) !!}
                                        </a>
                                        @else
                                        <a href="{{ url('/recipes/create?d='.$day[0]) }}" style="color:black">
                                            {!! nl2br(e($day[1])) !!}
                                        </a>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                @for($i=0; $i<7; $i++)
                                    <td>
                                        <div class="d-flex">
                                            @foreach($w_day[$i][2] as $recipe)
                                                ({{ $recipe->recipe_time }}) {{ $recipe->menu->menu_name }}
                                                <form method="POST" action="{{ route('home.show') }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <input type="submit" class="btn bg-white btn-sm slide-in" value="×">
                                                </form>
                                            @endforeach
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <a class="btn btn-dark my-3 slide-in" href="{{ route('shoppingList.show') }}">買い物リスト作成</a>
        </div>
    </div>
    <div class="row slide-in">
        <h2 class="ml-5">カテゴリー</h2>
        <div class="col-12">
            <div class="item-list d-flex flex-wrap p-2 mb-3">
            @foreach ($categories as $category)
                <ul class="list-unstyled category-list">
                    <li class="category-item text-center">
                        <a href="{{ route('category.show', ['category' => $category]) }}" class="category-name">{{ $category->category_name }}</a>
                    </li>
                </ul>
            @endforeach
            </div>
        </div>
        <h2 class="ml-5 pt-1">メニュー</h2>
        @if (\Auth::user())
        <a class="btn btn-dark ml-3 mb-3" href="{{ route('menu.create') }}"><i class="fas fa-magic pr-1"></i>メニュー新規登録</a>
        @endif
        <div class="col-12">
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
{{-- </div> --}}
@endsection
