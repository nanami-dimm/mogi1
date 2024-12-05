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
    
        <form action="/logout" method="post" class="logout-form">
        @csrf
            <button class="logout-button">ログアウト</button>
        </form>
      
        <a class="mypage__link" href="/mypage">マイページ</a>
    @endif
        <a class="sell__link" href="/sell">出品</a>
    
</div>
@endsection

@section('content')
    <div class="toppage-list">
        <div class="list">
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
            <a href="/item/{{ $exhibition->id}}" class="product-link">
            <img src="{{ asset($exhibition->product_image) }}" alt="商品画像" class="product-image" width="200" height="190">
            </a>
            <div class="product-detail">
                <p>{{ $exhibition->product_name}}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endsection('content')
