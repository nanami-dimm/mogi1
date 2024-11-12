d@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css')}}">
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
<div class="sell-form">
    <h2 class="sell-form__heading">商品の出品</h2>
<div class="sell-form__inner">
    <form action="/" method="get">
        @csrf
        <div class="exhibites-products-image">
            <label class="product_label" for="image">商品画像
            </label>
            <img src="/storage" class="exhibited-products-image__frame">
            <input class="exhibited-products-image__btn" type="file" name="image" id="image" value="画像を選択する">
        </div>
        <div class="exhibited-product-detail-area">
            <label class="exhibited-product-product-detail" for="detail">商品の詳細</label>

            <div class="exhibited-products-category-area">
                <label class="product__label" for="category">カテゴリー</label>
                <input  class="category__content" type="radio" name="category" id="category" value="{{ $category->product_category}}" >
            </div>

            <div class="exhibited-product-status">
                <label class="product_label" for="condition">商品の状態</label>
                    <select class="condition-form__select" name="condition_id" id="">
                    <option disabled selected>選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}" {{ old('condition_id')==$condition->id ? 'selected' : '' }}>{{
              $condition->condition }}
                    </option>
                    @endforeach
                    </select>
            </div>

            <div class="exhibited-product-name-explain">
                <label class="exhibited-product-product-name-explain__label" for="name-explain">商品名と説明</label>
            </div>

            <div class="exhibited-product-name">
                <label class="product-name" for="product-name">商品名</label>
                <input class="product-name__input" type="text" name="product-name" id="product-name">
            </div>

            <div class="exhibited-product-explain">
                <label class="product-explain" for="product-explain">商品の説明</label>
                <input class="product-explain__input" type="text" name="product-explain" id="product-explain">
            </div>

            <div class="exhibited-product-price">
                <label class="product-price" for="product-price">販売価格</label>
                <input class="product-price__input" type="text" name="product-price" id="product-price" placeholder="￥">
            </div>

            <input class="sell-form_btn btn" type="submit" value="出品する">
        </div>
    </div>
</div>
                