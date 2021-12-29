@extends('layouts.app')
@section('title', 'マイページ')

@section('content')
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
            <a class="btn original-button btn-sm my-2 mr-2" href="{{ route('recipe.create') }}"><i class="far fa-calendar-alt pr-1"></i>カレンダー登録</a>
        </div>
        <div class="card text-center slide-in">
            <div class="my-3 d-flex flex-nowrap justify-content-around">
                {{-- 前の週をクリックするとw=-1となり、1週間前に遷移する --}}
                <a class="btn original-button btn-sm" href="{{ url('/home?w=' . $before) }}">前の週</a>
                <div class="d-flex flex-nowrap">
                    <h3>{{ $carbon->month. "月（". $carbon->weekOfMonth. "週目）"}}</h3>
                    <a class="btn original-button btn-sm" href="{{ url('/home?w=0') }}">今週に戻る</a>
                </div>
                <a class="btn original-button btn-sm" href="{{ url('/home?w=' . $after) }}">次の週</a>
            </div>
            <div class="px-3 pb-3 table-responsive">
                <table class="table table-bordered text-nowrap text-center">
                    <thead class="card-header">
                        <tr>
                            @foreach ($week_names as $week_name)
                                <td class="table-size">{{ $week_name }}</td>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="card-body">
                        <tr>
                            @foreach ($w_day as $day)
                                <td class="table-size">
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
                            <td class="table-size">
                                @foreach($w_day[$i][2] as $recipe)
                                @if ((\Auth::user() && $recipe->user_id == \Auth::id()))
                                    <div class="d-flex">
                                        <a style="color:black" href="{{ route('recipe.show', ['theMenu' => $recipe->menu]) }}">{{ $recipe->recipe_time }}：{{ optional($recipe->menu)->menu_name }}</a>
                                        <form method="POST" action="{{ route('recipe.destroy') }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $recipe->id }}">
                                            <input type="submit" class="btn bg-white btn-sm pt-0" value="×">
                                        </form>
                                    </div>
                                @endif
                                @endforeach
                            </td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        <a class="btn original-button my-3 slide-in" href="{{ route('ingredient.show') }}"><i class="far fa-list-alt pr-1"></i>買い物リスト作成</a>
    </div>
</div>
<div class="row slide-in">
    <h2 class="ml-5">カテゴリー</h2>
    <div class="col-12">
        <div class="bg-white d-flex flex-wrap p-2 mb-3">
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
    <a class="btn original-button btn-sm ml-3 mb-3 mt-1" href="{{ route('menu.create') }}"><i class="fas fa-magic pr-1"></i>メニュー新規登録</a>
    @endif
    <div class="col-12">
        <div class="bg-white d-flex flex-wrap">
            @foreach($menus as $menu)
            <div class="item col-12 col-lg-6 my-2">
                <div class="row">
                    <div class="col-4 zoom-animation img-wrap text-center">
                        <div class="cover1"></div>
                        <div class="cover2"></div>
                        <div class="cover3"></div>
                        <img src="{{ $menu->image_path ?: asset('images/no_image.png') }}" class="image" alt="メニュー画像">
                    </div>
                    <div class="col-8">
                        <h3 class="menu-name slide-in mb-1">{{ $menu->menu_name }}</h3>
                        @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                        <a class="btn original-button btn-sm slide-in mb-1" href="{{ route('recipe.createMenu', ['theMenu' => $menu]) }}"><i class="far fa-calendar-alt pr-1"></i>カレンダー登録</a><br>
                        @endif
                        <a class="btn original-button btn-sm slide-in" href="{{ route('menu.show', ['theMenu' => $menu]) }}"><i class="fab fa-elementor pr-1"></i>詳細</a>
                        @if ((\Auth::user() && $menu->user_id == \Auth::id())|| \Auth::id() == 1)
                        <a class="btn original-button btn-sm slide-in" href="{{ route('menu.edit', ['theMenu' => $menu]) }}"><i class="fas fa-wrench pr-1"></i>編集</a>
                        <a class="btn original-button btn-sm slide-in" href="{{ route('menu.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt pr-1"></i>削除</a>
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
