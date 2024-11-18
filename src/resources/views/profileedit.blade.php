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
    <form action="/" method="post">
        @csrf
    <div class="profile-edit-form__inner">
        <div class="profile-edit-form-image">
        <div class="profile-image">
            <img src="storage/img">
        </div>
        <div class="profile-image-file">
            <input type="file" id="profile_image" name="profile_image" accept="image/png, image/jpeg" placeholder="画像を選択する">
            <p class="edit-form__error-message">
          @error('profile_image')
          {{ $message }}
          @enderror
            </p>
        </div>
    </div>
        <div class="edit-form_group">
            <label class="edit-form__label" for="name">ユーザー名</label>
            <input class="edit-form__input" type="text" name="name" id="name" value="{{ old('name') }}" >
            <p class="edit-form__error-message">
          @error('name')
          {{ $message }}
          @enderror
            </p>
        </div>
        <div class="edit-form_group">
            <label class="edit-form__label" for="post_code">郵便番号</label>
            <input class="edit-form__input" type="text" name="post_code" id="post_code" value="{{ old('post_code') }}" >
            <p class="edit-form__error-message">
          @error('post_code')
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
            <input class="edit-form__btn btn" type="submit"  value="登録する">
        </form>
    </div>
</div>
@endsection('content')