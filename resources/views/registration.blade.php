@extends('layouts.app')

@section('title', 'Регистрация')

@section('css')
    <link rel="stylesheet" href="css/main.css">
@endsection




@section('content')
        
<h>Регистрация</h>
<form action="/registration" method="POST">
    @csrf
        <label>Имя пользователя</label></br>
        <input type="text" name="name" class="@error('name') is-invalid @enderror" value="@if($errors->any()){{ old('name') }}@endif"></br>
        @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
        <label>Email</label></br>
        <input type="text" name="email" class="@error('email') is-invalid @enderror" value="@if($errors->any()){{ old('email') }}@endif"></br>
        @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
        <label>Пароль</label></br>
        <input type="password" name="password" class="@error('password')@if ($message!='The password field confirmation does not match.') is-invalid @endif @enderror"></br>
        @error('password')@if ($message!='The password field confirmation does not match.') <div class="alert alert-danger">{{ $message }}</div>@endif @enderror
        <label>Повторите пароль</label></br>
        <input type="password" name="password_confirmation" class="@error('password') @if ($message=='The password field confirmation does not match.') is-invalid @endif @enderror"></br>
        @error('password')@if ($message=='The password field confirmation does not match.') <div class="alert alert-danger">{{ $message }}</div> @endif @enderror
        <input type="submit" value="Зарегистрироваться">
    </form>
@endsection