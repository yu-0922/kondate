@extends('layouts.app')
@section('title', '買い物リスト')

@section('content')
<div class="text-right">
    <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('home.create') }}">追加</a>
    <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('ingredient.destroy') }}"><i class="far fa-trash-alt pr-1"></i>リスト削除</a>
</div>
<div class="container mb-5">
    <div class="row">
        <div class="col-6 offset-3 d-flex flex-wrap bg-white slide-in">
            <ul>
                @foreach ($ingredients as $ingredient)
                    <div class="d-flex">
                        <li>
                            <div class="d-flex">
                                {{-- 非表示にするためのチェックボックス --}}
                                <form method="POST" action="">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn bg-white btn-sm" value="□">
                                </form>
                                {{-- 材料名：量 --}}
                                {{ $ingredient->ingredient_name }}：{{ $ingredient->unit }}<br>
                            </div>
                        </li>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="m-3">
            <button type="button" class="btn btn-outline-dark text-center" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
        </div>
    </div>
</div>
@endsection
