@extends('layouts.app')

@section('title', 'Блог')

@section('css')
    <link rel="stylesheet" href="css/main.css">
@endsection




@section('content')
<main>
<h>Блог</h>
@if ($isAdmin)
    <a class="menubutton" style='align-self:center' href='post/create'>Создать пост</a>
@endif
@foreach($posts as $post)
<div class="post">
    <div class="header">{{$post['header']}}</div>
    <div class="posttext">{{$post['text']}}</div>
    @if ($post['image']!=null)
    <div class="imagesizes"><img class="postimage" src="storage/images/{{$post['image']}}"></div>
    @endif
    <div class="postdate">{{$post['date']}}</div>
    @if ($isAdmin)
        <form action="/post/change/{{$post['id']}}" method="GET">
        @csrf
        <input type="submit" value="Изменить">
        </form>
        <form action="/post/delete" method="POST">
        @csrf
        <input type="text" name="postid" value="{{$post['id']}}" style="display:none"></br>
        <input type="submit" value="Удалить">
        </form>
        @if ($post['is_published'])
            <form action="/post/unpublish" method="POST">
            @csrf
            <input type="text" name="postid" value="{{$post['id']}}" style="display:none"></br>
            <input type="submit" value="Снять с публикации">
            </form>
        @else
            @if ($post['publish_on']==null)
            <div>Не опубликован</div>
            @else
            <div>Будет опубликован {{$post['publish_on']}}</div>
            @endif
            <form action="/post/publish" method="POST">
            @csrf
            <input type="text" name="postid" value="{{$post['id']}}" style="display:none"></br>
            <input type="submit" value="Опубликовать сейчас">
            </form>
        @endif
    @endif
    <div>Комментарии:</div>
    @foreach ($post['comments'] as $comment)
    <div class="comment">
        <div class="username">{{$comment->user->name}}</div>
        <div class="text">{{$comment->text}}</div>
        <div class="date">{{$comment->created_at->format("d/m/Y")}}</div>
        @if ($isAdmin || $comment->user_id==$user_id)
        <form class='deletecomment'action="/comment/delete" method="POST">
        @csrf
        <input type="text" name="comment_id" value="{{$comment->id}}" style="display:none"></br>
        <input class=submit type="submit" value="Удалить">
        </form>
        @endif
    </div>
    @endforeach
    <form class="addcomment" action="/comment/create" method="POST">
    @csrf
    <input type="text" name="text"></br>
    <input type="text" name="post_id" value="{{$post['id']}}" style="display:none"></br>
    <input class=submit type="submit" value="Оставить комментарий">
    </form>
</div>


@endforeach
</main>
@endsection