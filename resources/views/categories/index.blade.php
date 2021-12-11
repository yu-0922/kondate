@extends('layouts.app')
@section('title', 'カテゴリ一覧')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2 slide-in">
            <div class="bg-light p-5 border border-3">
            @foreach ($categories as $category)
            <ul class="list-unstyled category-list">
                <li class="category-item text-center">
                    <a href="{{ route('category.show', ['category' => $category]) }}" class="category-name">{{ $category->category_name }}</a>
                </li>
            </ul>
            @endforeach
            </div>
        </div>
    </div>
@endsection
