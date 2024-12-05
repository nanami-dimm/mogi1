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
<div class="product-detail">
    <div class="product-image-area">
        <div class="product-image">
            <img src="{{asset($exhibitions->product_image) }}" alt="商品画像" class="image">
        </div>
    </div>
    <div class="product-description-area">
        <div class="product-title">
            <tr class="product-title-inner">
                <td class="product-title-name">{{$exhibitions->product_name}}</td>
            </tr>
            <tr class="product-title-inner">
                <td class="product-title-brand">
                    ブランド</td>
            </tr>
            <tr class="product-title-inner">
                <td class="product-title-price">
                    {{$exhibitions->product_price}}
                </td>
            </tr>
            <div class="product-actions">
                    <img src="/storage/img/星アイコン8.svg">
                    
                    <img src="/storage/img/ふきだしのアイコン.svg"  >
            </div>
        </div>
        <div class="purchase-area">
            <a class="purchase-box" href="">購入手続きへ</a>  
        </div>
        <div class="product-description">
            <label class="product-label" for="description">
                商品説明</label>
                <tr class="description-inner">
                    <td>{{$exhibitions->product_description}}</td>
                </tr>
        </div>
        <div class="product-info">
            <label class="product-label" for="information">
                商品の情報</label>
                <div class="category-info">
                    <label class="information-inner" for="category">
                        <tr><td>
                            {{$categories->product_category}}
                        </td></tr>
                </div>
                <div class="category-condition">
                    <label class="information-inner" for="condition">
                        <tr><td>
                            {{$productconditions->condition}}
                        </td></tr>
                </div>
        </div>
        <div class="product-comments">
            <label class="product-comment">
                コメント</label>
                <div class="comments-list">
                //コメントのところはまだできていない\\
                </div>
                <div class="comments-input">
                    <label class="product-comments" for="comments">商品へのコメント</label>
                    <input class="comments-input" id="comments" type="text">
                    <button class="comments-button">コメントを送信する"</button>
                </div>
        </div>
    </div>
</div>