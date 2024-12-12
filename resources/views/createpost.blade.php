@extends('layouts.app')

@section('title', 'Создать')

@section('css')
    <link rel="stylesheet" href="../css/main.css">
@endsection




@section('content')
        
<h>Новая запись</h>
<form action="/post/create" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Заголовок*</label></br>
    <input type="text" name="post_header" value="@if($errors->any()){{ old('post_header') }}@endif"></br>
    @error('post_header') <div class="alert alert-danger">{{ $message }}</div> @enderror
    <label>Текст*</label></br>
    <textarea name="text">@if($errors->any()){{ old('text') }}@endif</textarea></br>
    @error('text') <div class="alert alert-danger">{{ $message }}</div> @enderror
    <label>Картинка</label></br>
    <input type="file" name="image"></br>
    <label>Дата публикации</label></br>
    <input type="datetime-local" name="publish_date" value="@if($errors->any()){{ old('publish_date') }}@endif"></br>
    @error('publish_date') <div class="alert alert-danger">{{ $message }}</div> @enderror
    <input type="submit" value="Создать">
</form>
@endsection