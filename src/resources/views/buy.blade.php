@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/buy.css')}}">
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
        <div class="product">
        <div class="product-image">
         <img src="{{ asset($exhibitions->product_image) }}" alt="商品画像" class="product-image" width="200" height="190">
        </div>
        <div class="product-detail">
         <p>{{$exhibitions->product_name}}</p>
         <p>￥{{$exhibitions->product_price}}
         </p>
        </div>  
        </div>
        <div class="pay-method">
            <label class="pay" for="pay-method">
                支払い方法</label>
            <select class="pay-form__select" name="paymethod_id" id="paymethod" >
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
                <a class="change-address" href="/purchase/address/{{$exhibitions->id}}">変更する</a>
            <label class="delivery-form" name="delivery" id="delivery-form">
            
                   <p>〒{{$users->post_code}}</p>
                    <p>{{$users->address}}{{$users->building}}</p>
                
                    </label>
        </div>
        <aside class="confirm-surface">
            
            <label class="product-price" for="price">
                商品代金</label>
                <p>{{$exhibitions->product_price}}</p>
            
            @foreach($paymethods as $paymethod)
            <label class="delivery-address" for="delivery">
                支払い方法</label>
                <p>{{$paymethod->name}}</p>
                @endforeach
        </aside>
        <form action="/" method="post"> 
            @csrf        
        <div class="action-bar">
            <input class="buy-form_btn btn" type="submit" value="購入する">
        </div>
                    </form>
    </div>
</div>
@endsection