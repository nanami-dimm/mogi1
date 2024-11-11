@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profileedit.css')}}">
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
<div class="profile-edit-form">
    <h2 class="profile-form__heading content__heading">プロフィール設定</h2>
    <form action="/mypage/profile" method="get">
        @csrf
    <div class="profile-edit-form__inner">
        <div class="profile-image">
            <img src="storage/img">
        </div>
        <div class="profile-image-file">
            <input type="file" id="image" name="image" accept="image/png, image/jpeg">
            <p class="edit-form__error-message">
          @error('image')
          {{ $message }}
          @enderror
            </p>
        </div>
        <div class="edit-form_group">
            <label class="edit-form__label" for="yousername">ユーザー名</label>
            <input class="edit-form__input" type="text" name="yousername" id="yousername" value="{{ old('yousername') }}" >
            <p class="edit-form__error-message">
          @error('yousername')
          {{ $message }}
          @enderror
            </p>
        </div>
        <div class="edit-form_group">
            <label class="edit-form__label" for="postcode">郵便番号</label>
            <input class="edit-form__input" type="text" name="postcode" id="postcode" value="{{ old('postcode') }}" >
            <p class="edit-form__error-message">
          @error('postcode')
          {{ $message }}
          @enderror
            </p>
        </div>
        <div class="edit-form_group">
            <label class="edit-form__label" for="address">住所</label>
            <input class="edit-form__input" type="text" name="address" id="address" value="{{ old('address') }}" >
            <p class="edit-form__error-message">
          @error('address')
          {{ $message }}
          @enderror
            </p>
        </div>
        <div class="edit-form_group">
            <label class="edit-form__label" for="building">建物名</label>
            <input class="edit-form__input" type="text" name="building" id="building" value="{{ old('building') }}" >
            <p class="edit-form__error-message">
          @error('building')
          {{ $message }}
          @enderror
                </p>
            </div>
            <input class="edit-form__btn btn" type="submit" href="/"  value="登録する">
        </form>
    </div>
</div>
@endsection('content')