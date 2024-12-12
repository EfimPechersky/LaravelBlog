@extends('layouts.app')

@section('title', 'Публикация')

@section('css')
    <link rel="stylesheet" href="{{url('css/main.css')}}">
@endsection




@section('content')
        
<h>Изменить запись</h>
<form action="/post/change" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Заголовок</label></br>
    <input type="text" name="post_header" value="{{$post['post_header']}}"></br>
    <label>Текст</label></br>
    <textarea name="text">{{$post['text']}}</textarea></br>
    @error('text') <div class="alert alert-danger">{{ $message }}</div> @enderror
    <label>Картинка</label></br>
    <img src="{{url('storage/images/'.$post['image'])}}">
    <input type="file" name="image"></br>
    @error('image') <div class="alert alert-danger">{{ $message }}</div> @enderror
    @if (!$post['is_published'])
    <label>Дата публикации</label></br>
    <input type="datetime-local" name="publish_date" value="{{$post['publish_date']}}"></br>
    @error('publish_date') <div class="alert alert-danger">{{ $message }}</div> @enderror
    @endif
    <input type="text" name="postid" value="{{$post['id']}}" style="display:none"></br>
    <input type="submit" value="Изменить">
</form>
@endsection