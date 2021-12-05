@extends('layouts.app')
@section('title', 'マイページ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="slide-in">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="text-right slide-in">
                <a class="btn btn-dark my-2 mr-2" href="{{ route('recipe.create') }}">カレンダー登録</a>
            </div>
            <div class="card text-center slide-in">
                <div class="mt-5 mx-5 mb-1">
                    {{-- 前の週をクリックするとw=-1となり、1週間前に遷移する --}}
                    <a class="btn btn-outline-dark btn-sm float-left" href="{{ url('/home?w=' . $before) }}">前の週</a>
                    <a class="btn btn-outline-dark btn-sm float-right" href="{{ url('/home?w=' . $after) }}">次の週</a>
                    <h3>{{ $carbon->year. "年". $carbon->month. "月（". $carbon->weekOfMonth. "週目）"}}</h3>
                    <a class="btn btn-dark btn-sm mt-2" href="{{ url('/home?w=0') }}">今週に戻る</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table table-bordered">
                        <thead class="card-header">
                            <tr>
                                <td class="col-1"></td>
                                @foreach ($week_names as $week_name)
                                    <th class="col-1">{{ $week_name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="card-body">
                            <tr>
                                <td class="col-1"></td>
                                @foreach ($w_day as $day)
                                    <th class="col-1">
                                        <a href="{{ url('/recipes/create?d='.$day[0]) }}">
                                            {!! nl2br(e($day[1])) !!}
                                        </a>
                                    </th>
                                @endforeach
                            </tr>
                            <tr>
                                <td>朝</td>
                                @for($i=0; $i<7; $i++)
                                    <th class="col-1">
                                        @if(isset($cooking_day))
                                            @if($cooking_day == $day[0])
                                            <div>
                                                {{ $menu_id }}
                                            </div>
                                            @endif
                                        @endif
                                        <div class="d-flex">
                                            {{-- <a class="btn btn-outline-dark btn-sm slide-in ml-1 mr-3" href="#"></i>編集</a> --}}
                                            <form method="POST" action="{{ route('home.show') }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn bg-white btn-sm slide-in" value="×">
                                            </form>
                                        </div>
                                    </th>
                                @endfor
                            </tr>
                            <tr>
                                <td>昼</td>
                                @for($i=0; $i<7; $i++)
                                    <th class="col-1">
                                        <div class="d-flex">
                                            {{-- <a class="btn btn-outline-dark btn-sm slide-in ml-1 mr-3" href=""></i>編集</a> --}}
                                            <form method="POST" action="{{ route('home.show') }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn bg-white btn-sm slide-in" value="×">
                                            </form>
                                        </div>
                                    </th>
                                @endfor
                            </tr>
                            <tr>
                                <td>夜</td>
                                @for($i=0; $i<7; $i++)
                                    <th class="col-1">
                                        <div class="d-flex">
                                            {{-- <a class="btn btn-outline-dark btn-sm slide-in ml-1 mr-3" href=""></i>編集</a> --}}
                                            <form method="POST" action="{{ route('home.show') }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn bg-white btn-sm slide-in" value="×">
                                            </form>
                                        </div>
                                    </th>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <a class="btn btn-dark btn-lg my-3 slide-in" href="">買い物リスト作成</a>
        </div>
    </div>
    <div class="row m-3">
        <div class="col-6 card slide-in">
            <h2 class="text-center mt-3 zoom">お気に入り</h2>
            <div class="mb-3">
                @foreach($favorites as $favorite)
                <div class="slide-in">
                    {{ $favorite }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
