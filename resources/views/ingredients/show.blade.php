@extends('layouts.app')
@section('title', '買い物リスト')

@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-6 offset-3 d-flex flex-wrap bg-white slide-in">
            <ul class="list-unstyled">
            @foreach ($ingredients as $ingredient)
                <li class="mt-1">
                    <div class="d-flex">
                        {{-- 取り消し線を引くためのチェックボックス --}}
                        <input type="checkbox" class="mt-1 mr-2" onclick="changeLine('{{ $ingredient['id'] }}')">
                        {{-- 材料名：量 --}}
                        <span id="target-{{ $ingredient['id'] }}">{{ $ingredient["ingredient_name"] }}：{{ $ingredient["unit"] }}</span><br>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
    <div class="m-3">
            <button type="button" class="btn btn-outline-dark text-center" onclick="history.back()"><i class="far fa-caret-square-left mr-1"></i>戻る</button>
        </div>
    </div>
</div>
<script>
</script>
@endsection
