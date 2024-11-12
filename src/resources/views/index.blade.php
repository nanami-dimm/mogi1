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

        <from action="/logout" method="post">
        @csrf
            <input class="header_link" type="submit" value="ログアウト">
        </form>

        <a class="mypage__link" href="/?tab=mypage">マイページ</a>
        
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
        @foreach ($Exhibitions as $Exhibition )
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
