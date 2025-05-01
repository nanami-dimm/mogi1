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
    <form action="/" method="post" class="buy"> 
            @csrf       
    <div class="product-information">
        <div class="product">
        <div class="product-image">
         <img src="{{ asset($exhibitions->product_image) }}" alt="商品画像" class="product-image" width="200" height="190">
        </div>
        <div class="product-detail">
         <p>{{$exhibitions->product_name}}</p>
         <p>￥{{$exhibitions->product_price}}
         </p>
         <input type="hidden" name="product_name" value="{{ $exhibitions->product_name }}">
        <input type="hidden" name="price" value="{{ $exhibitions->product_price }}">
        </div>  
        </div>
        <div class="pay-method">
            <label class="pay" for="pay-method">
                支払い方法</label>
            <select class="pay-form__select" name="paymethod_id" id="paymethod" >
                    <option value="konbini">コンビニ払い</option>
                        <option value="card">クレジットカード払い</option>  
                   
                    </select>
        </div>
        <div class="delivery">
            <label class="delivery" for="delovery-address">
                配送先</label>
                <a class="change-address" >変更する</a>
            <div class="delivery-form" name="delivery" id="delivery-form">
            
                <p>〒{{$users->post_code}}</p>
                <p>{{$users->address}}{{$users->building}}</p>
                <input type="hidden" name="postcode" value="{{ $users->post_code }}">
                <input type="hidden" name="address" value="{{ $users->address }}">
                <input type="hidden" name="building" value="{{ $users->building }}">
            </div>
        </div>
        <div class="confirm-surface">
            <table>
                <tr>
                    <th class="product-price" for="price">
                商品代金</th>
                <td class="table_data" >￥{{ $exhibitions->product_price }}</td>
                </tr>
                <tr>
                    <th class="delivery-address" for="delivery">
                支払い方法</th>
                <td class="table_data">コンビニ支払い</td>
                </tr>
            </table>
        </div>
         
        <div class="action-bar">
            <input class="buy-form_btn btn" type="submit" value="購入する">
        </div>
                    </form>
    </div>
</div>
@endsection