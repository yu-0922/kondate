@extends('layouts.app')
@section('title', '買い物リスト')

@section('content')
<div class="content">
    <div class="row">
        <div class="float-right">
            <button type="button" class="js-open button-open slide-in">追加</button>
            <button type="button" class="slide-in">リスト削除</button>
        </div>
        <div>
            <h2>作成するメニュー</h2>
            <ul>
                @foreach($theMenu as $menu)
                <li>
                    {{ $menu }}
                </li>
                @endforeach
            </ul>
        </div>
        <div>
            @foreach($categories as $category)
            <h2>{{ $category }}</h2>
            <div class="my-5 col-md-6 offset-md-3 text-center">
                <ul class="m-3">
                    @if(is_array(json_decode($theMenu->ingredient, true)))
                    @php
                        $ingredient = "";
                        foreach (json_decode($theMenu->ingredient, true) as $key => $value) {
                            foreach ($value as $k => $v) {
                                if (!$k)
                                $ingredient .= $v . "：";
                                else {
                                    $ingredient .= $v . "\n";
                                }
                            }
                        }
                    @endphp
                    <li class="text-center">{!! nl2br(e($ingredient)) !!}</li>
                    @else
                    <li class="text-center">{!! nl2br(e($theMenu->ingredient)) !!}</li>
                    @endif
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
