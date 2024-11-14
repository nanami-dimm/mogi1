@extends('layouts.app')

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
            <label class="product_label" for="product_image">商品画像
            </label>
            <img src="/storage" class="exhibited-products-image__frame">
            <input class="exhibited-products-image__btn" type="file" name="product_image" id="product_image" value="画像を選択する">
            <p class="sell-form__error-message">
          @error('product_image')
          {{ $message }}
          @enderror
                </p>
        </div>
        <div class="exhibited-product-detail-area">
            <label class="exhibited-product-product-detail" for="detail">商品の詳細</label>

            <div class="exhibited-products-category-area">
                <label class="product__label" for="product_category">カテゴリー</label>
                @foreach($categories as $category)
                <input  class="category__content" type="radio" name="product_category" id="product_category" value="{{ $category->product_category}}" >
                @endforeach
                <p class="sell-form__error-message">
          @error('product_category')
          {{ $message }}
          @enderror
                </p>
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
                    <p class="sell-form__error-message">
            @error('condition')
            {{ $message }}
            @enderror
                </p>
            </div>

            <div class="exhibited-product-name-explain">
                <label class="exhibited-product-product-name-explain__label" for="name-explain">商品名と説明</label>
            </div>

            <div class="exhibited-product-name">
                <label class="product-name" for="product_name">商品名</label>
                <input class="product-name__input" type="text" name="product_name" id="product_name">
                <p class="sell-form__error-message">
          @error('product_name')
          {{ $message }}
          @enderror
                </p>
            </div>

            <div class="exhibited-product_description">
                <label class="product_description" for="product_description">商品の説明</label>
                <input class="product_description__input" type="text" name="product_description" id="product_description">
                <p class="sell-form__error-message">
          @error('product_description')
          {{ $message }}
          @enderror
                </p>
            </div>

            <div class="exhibited-product-price">
                <label class="product-price" for="product_price">販売価格</label>
                <input class="product-price__input" type="text" name="product_price" id="product_price" placeholder="￥">
                <p class="sell-form__error-message">
          @error('product_price')
          {{ $message }}
          @enderror
                </p>
            </div>

            <input class="sell-form_btn btn" type="submit" value="出品する">
        </div>
    </div>
</div>
                