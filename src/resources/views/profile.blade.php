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
    <div class="user-profile">
        <div class="user-image">
            <img src="{{ asset($users->profile_image) }}" class="img-content">
        </div>

        <div class="user-name-rating">
            <div class="user-name-and-stars">
                <span class="user-name">{{ $users->name }}</span>

                @if (!is_null($users->average_rating))
                    <div class="rating-star">
                        @for ($i = 1; $i <= 5; $i++)
                            <span>{{ $i <= $users->average_rating ? '⭐' : '☆' }}</span>
                        @endfor
                    </div>
                @endif
            </div>
            <div class="profile_edit">
                <a class="edit-form__btn btn" href="mypage/profile">プロフィールを編集</a>
            </div>
        </div>
    </div>
        <div class="toppage-list-wrapper">
            <ul class="toppage-list">
                
                <li><a href="{{ url()->current() }}?status=sell">出品した商品</a></li>
            
            
                <li><a href="{{ url()->current() }}?status=buy">購入した商品</a></li>

                <li><a href="{{ url()->current() }}?status=trading">取引中の商品
                    @if ($unreadMessagesCount > 0)
  <span class="notification-badge">{{ $unreadMessagesCount }}</span>
@endif
                </a></li>
            </ul>
        </div>
        <div class="product-data">

    {{-- 出品商品 --}}
    @if ($status !== 'buy')
        @foreach ($exhibitions as $exhibition)
            <div class="product-sell-content">
                <a href="/item/{{ $exhibition->id }}" class="product-link">
                    <img src="{{ asset('storage/' . $exhibition->product_image) }}" alt="商品画像" class="product-image" width="200" height="190">
                </a>
                <div class="product-detail">
                    <p>{{ $exhibition->product_name }}</p>
                </div>
            </div>
        @endforeach
    @endif

    {{-- 購入商品 --}}
    @if ($status === 'buy')
        @foreach ($purchases as $purchase)
            @if ($purchase->exhibition)
                <div class="product-sell-content">
                    <a href="/item/{{ $purchase->exhibition->id }}" class="product-link">
                        <img src="{{ asset('storage/' . $purchase->exhibition->product_image) }}" alt="商品画像" class="product-image" width="200" height="190">
                    </a>
                    <div class="product-detail">
                        <p>{{ $purchase->exhibition->product_name }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
    @if ($status === 'trading')
    @foreach ($transactions as $transaction)
        @if ($transaction->exhibition)
            <div class="product-sell-content">
                <a href="/item/{{ $transaction->id }}/message" class="product-link">
                    <img src="{{ asset('storage/' . $transaction->exhibition->product_image) }}" alt="商品画像" class="product-image" width="200" height="190">
                     @php
                                    $unreadMessages = $transaction->exhibition->transactionMessages->where('is_read', false);
                                    $unreadCount = $unreadMessages->count();
                                @endphp

                                @if ($unreadCount > 0)
                                    <div class="notification-badge">
                                        {{ $unreadCount }}
                                    </div>
                                @endif
                            </a>
                <div class="product-detail">
                    <p>{{ $transaction->exhibition->product_name }}</p>
                </div>
            </div>
        @endif
    @endforeach
@endif



        </div>
    </div>
    @endsection