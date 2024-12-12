@extends('layouts.app')

@section('title', 'Вход')

@section('css')
    <link rel="stylesheet" href="css/main.css">
@endsection




@section('content')
        
<h>Вход</h>
<form action="/login" method="POST">
    @csrf
        <label>Email</label></br>
        <input type="text" name="email" class="@error('email') is-invalid @enderror" value="@if($errors->any()){{ old('email') }}@endif"></br>
        @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
        <label>Пароль</label></br>
        <input type="password" name="password"></br>
        @error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror
<input type="submit" value="Войти">
    </form>
@endsection