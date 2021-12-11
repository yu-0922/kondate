@extends('layouts.app')
@section('title', '買い物リスト')

@section('content')
<div class="text-right">
    <a class="btn original-button slide-in" href="{{ route('home.create') }}">追加</a>
    {{-- <a class="btn btn-outline-dark btn-sm slide-in" href="{{ route('list.confirmDelete', ['theMenu' => $menu]) }}"><i class="far fa-trash-alt pr-1"></i>リスト削除</a> --}}
</div>
<div class="container mb-5">
    <div class="row">
        <div class="item-list d-flex flex-wrap">
            @foreach($recipes->menus()->get() as $menu)
            <div class="item col-12 col-md-6">
                <div class="row">
                    <div class="col-8 slide-in">
                        <div>
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
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="m-3">
            <button type="button" class="btn btn-outline-dark text-center" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
        </div>
    </div>
</div>
@endsection
