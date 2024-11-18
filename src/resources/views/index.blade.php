@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('link')
<div class="toppage-header">
    <div class="toppage-header-search">
        <form class="search-form" action="/search" method="get">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" placeholder="何をお探しですか？">
        </form>
    </div>
    <div class="toppage-header-nav">
    @if (Auth::check())
        <form action="/logout" method="post">
        @csrf
            <button class="logout-button">ログアウト</button>
        </form>

        <a class="mypage__link" href="/?tab=mypage">マイページ</a>
    @endif
        <a class="sell__link" href="/sell">出品</a>
    </div>
</div>
@endsection

@section('content')
    <div class="toppage-list">
        <div class="best-list">
            <input class="best_list-btn" type="submit" value="おすすめ">
        </div>
        <div class="my-list">
            <input class="my-list_btn" type="submit" value="マイリスト">
        </div>
    </div> 
    <div class="product-row">
        @foreach ($exhibitions as $exhibition )
        <div class="product-content">
            <a href="/item/{{ $Exhibition->id}}" class="product-link"></a>
            <img src="{{ asset($Exhibition ->product_image) }}" alt="商品画像" class="product-image">
            <div class="product-detail">
                <p>{{ $Exhibition ->product_name}}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endsection('content')
