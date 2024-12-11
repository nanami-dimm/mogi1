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

        <form action="/logout" method="post">
        @csrf
            <input class="header_link" type="submit" value="ログアウト">
        </form>

        <a class="mypage__link" href="/?tab=mypage">マイページ</a>
        
        <a class="sell__link" href="/sell">出品</a>
    </div>
</div>
@endsection

@section('content')
<div class="buy-form">
    <div class="product-information">
        @foreach ($exhibitions as $exhibition )
        <div class="product-image">
         <img src="{{ asset($exhibition->product_image) }}" alt="商品画像" class="product-image" width="200" height="190">
        </div>
        <div class="product-detail">
         <p>{{ $exhibition->product_name}}</p>
         <p>{{$exhibition->product_price}}</p>
        </div>  
        <div class="pay-method">
            <label class="pay" for="pay-method">
                支払い方法</label>
            <select class="pay-form__select" name="pay_id" id="pay-method" >
                    <option disabled selected>選択してください</option>
                    @foreach ($paymethods as $paymethod)
                    <option value="{{ $paymethod->id }}" {{ old('paymethod_id')==$paymethod->id ? 'selected' : '' }}>{{
              $paymethod->name }}</option>     
                    @endforeach
                    </select>
        </div>
        <div class="delivery">
            <label class="delivery" for="delovery-address">
                配送先</label>
                <a class="change-address" href="/purchase/address/:item_id">変更する</a>
            <select class="delivery-form" name="delivery" id="delivery-form">
                @foreach ($users as $user)
                <p>〒{{$user->post_code}}</p>
                <p>{{$user->address}}{{$user->building}}</p>
                @endforeach
            </select>
        </div>
        <div class="confirm-serface">
            <label class="product-price" for="price">
                商品代金</label>
                <p>{{$exhibitions->product_price}}</p>
        
            <label class="delivery-address" for="delivery">
                支払い方法</label>
                <p>{{$paymethods->name}}</p>
        </div>
        <div class="action-bar">
            <input class="buy-form_btn btn" type="submit" value="購入する">
        </div>
    </div>
</div>
@endsection('content')