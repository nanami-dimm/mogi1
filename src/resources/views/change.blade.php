@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/change.css')}}">
@endsection

@section('link')
<div class="toppage-header">
    <div class="toppage-header-search">
        <form class="search-form" action="/search" method="get">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" placeholder="何をお探しですか？" value="{{ $keyword ?? '' }}">
           
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
    <div class="change-address-form">
        <h2 class="change-address__heading">住所の変更</h2>
        <div class="change-address-form__inner">
            <form class="change-address-form__form" action="/item/purchase/{item_id}" method="post">
                @csrf
                <div class="change-address__group">
                    <label class="change-address__label" for="newpost_code">
                        郵便番号</div>
                        <input class="change-address__input" text="text" name="newpost_code" id="newpost_code" value="{{old('newpost_code')}}">
                        <p class="change-address__error-message">
                            @error('newpost_code')
                            {{$message}}
                            @enderror
                        </p>
                </div>
                <div class="change-address__group">
                    <label class="change-address__label" for="new_address">
                        住所</div>
                        <input class="change-address__input" text="text" name="new_address" id="new_address" value="{{old('new_address')}}">
                        <p class="change-address__error-message">
                            @error('new_address')
                            {{$message}}
                            @enderror
                        </p>
                </div>
                <div class="change-address__group">
                    <label class="change-address__label" for="new_building">
                        建物名</div>
                        <input class="change-address__input" text="text" name="new_building" id="new_building" value="{{old('new_building')}}">
                        <p class="change-address__error-message">
                            @error('new_building')
                            {{$message}}
                            @enderror
                        </p>
                </div>
                <input class="change-address__btn" type="submit" value="更新する">
            </form>
        </div>
    </div>
@endsection