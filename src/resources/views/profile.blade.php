@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css')}}">
@endsection('css')

@section('link')
<div class="toppage-header">
    <div class="toppage-header-search">
        <form class="search-form" action="/search" method="get">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" placeholder="何をお探しですか？">
        </form>
    </div>
    <div class="toppage-header-nav">

        <form action="/logout" method="post">
        @csrf
            <input class="header_link" type="submit" value="ログアウト">
        </form>

        <a class="mypage__link" href="/?tab=mypage">マイページ</a>
        
        <a class="sell__link" href="/sell">出品</a>
    </div>
</div>
@endsection('link')

@section('content')
    <div class="user-info">
        @foreach ($profiles as $profile )
        <div class="user-image">
            <img src="{{ asset($profile->profile_image) }}"  class="img-content">
        </div>
        

        
        <div class="user-name">
            <p>{{ $profile->name }}</p>
        </div>
        <div class="profile_edit">
            <input class="edit-form__btn btn" type="submit" href="/mypage/edit"  value="プロフィールを編集">
        </div>
        <div class="toppage-list">
            <div class="toppage-list-sell">
                <input class="sell-item" type="submit" value="出品した商品">
            </div>
            <div class="toppage-list-buy">
                <input class="buy-item" type="submit" value="購入した商品">
            </div>
        </div>
        @endforeach
        <div class="product-data">
            @foreach ($exhibitions as $exhibition)
        <div class="product-sell-content">
            <a href="/item/{{ $exhibition->id}}" class="product-link"></a>
            <img src="{{ asset($exhibition ->product_image) }}" alt="商品画像" class="product-image">
            <div class="product-detail">
                <p>{{ $exhibition ->product_name}}</p>
            </div>
        </div>
        @endforeach
        </div>
    </div>
    @endsection('content')