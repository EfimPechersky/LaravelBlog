<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comments;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use DateTime;
class PostController extends Controller
{
    public function show_posts():View{
        $info=[];
        $isAdmin=false;
        if (Auth::check()){
            if (Gate::allows('check-admin')) {
                $isAdmin=true;
            }
        }
        if (!$isAdmin){
            foreach (Post::all() as $post) {
                if ($post->is_published){
                    $info[]=['id'=>$post->id,
                    'text'=>$post->text,
                    'image'=>$post->image_name,
                    'header'=>$post->header,
                    'comments'=>$post->comments,
                    'date'=>$post->publishes_on];
                }
            }
        }else{
            foreach (Post::all() as $post) {
                $info[]=['id'=>$post->id,
                'text'=>$post->text,
                'image'=>$post->image_name,
                'header'=>$post->header,
                'date'=>$post->created_at->format('m/d/Y'),
                'comments'=>$post->comments,
                'is_published'=>$post->is_published,
                'publish_on'=>$post->publishes_on];
            }
        }
        return view('posts', ['posts'=>$info, 'isAdmin'=>$isAdmin, "user_id"=>Auth::id()]);
    }
    public function show_create_form(){
        if (!Auth::check()){
            return redirect('/login');
        }
        if (!Gate::allows('check-admin')) {
            return redirect('/');
        }
        return view('createpost');
    }
    public function create_post(Request $request){
        $request->validate([
            'post_header' => ['required', 'string'],
            'text' => ['required', 'string'],
            'image'=>['image'],
            'publish_date'=>['date-format:Y-m-d\TH:i', 'after: 1 minute']
        ]);
        $post = new Post();
        if (!Auth::check()){
            return redirect('/login');
        }
        if (!Gate::allows('check-admin')) {
            return redirect('/');
        }
        if ($request->hasFile('image')) {
            $lastid=count(Post::all())+1;
            $filename='image'.$lastid.".".$request->image->extension();
            $post->image_name = $filename;
            $request->image->storeAs('images', $filename,'public');
        }
        if ($request->has('publish_date')){
            $date = DateTime::createFromFormat('Y-m-d\TH:i', $request->publish_date);
            $post->publishes_on=$date->format("Y-m-d H:i:s");
        }
        $post->text = $request->text;
        $post->header = $request->post_header;
        if ($post)
        $post->save();
        return redirect('/');
    }
    public function show_change_form(Request $request){
        $post =Post::find($request->postid);
        $info=['id'=>$post->id,
            'text'=>$post->text,
            'image'=>$post->image_name,
            'post_header'=>$post->header,
            'publish_date'=>$post->publishes_on,
            'is_published'=>$post->is_published];
        if (!Auth::check()){
            return redirect('/login');
        }
        if (!Gate::allows('check-admin')) {
            return redirect('/');
        }
        return view('changepost', ['post'=>$info]);
    }
    public function change_post(Request $request){
        $request->validate([
            'post_header' => ['required', 'string'],
            'text' => ['required', 'string'],
            'image'=>['image'],
            'publish_date'=>['date-format:Y-m-d\TH:i', 'after: 1 minute']
        ]);
        $post =Post::find($request->postid);
        if (!Auth::check()){
            return redirect('/login');
        }
        if (!Gate::allows('check-admin')) {
            return redirect('/');
        }
        $filename=$post->image_name;
        if ($request->hasFile('image')) {
            $lastid=count(Post::all())+1;
            $filename='image'.$lastid.".".$request->image->extension();
            $request->image->storeAs('images', $filename,'public');
        }
        $date=$post->publishes_on;
        if ($request->has('publish_date')){
            $date = DateTime::createFromFormat('Y-m-d\TH:i', $request->publish_date);
        }
        $post->update(['header'=>$request->post_header,
        'text'=>$request->text,
        'image'=>$filename,
        'publishes_on'=>$date]);
        return redirect('/');
    }
    public function delete_post(Request $request){
        $post =Post::find($request->postid);
        if (!Auth::check()){
            return redirect('/login');
        }
        if (!Gate::allows('check-admin')) {
            return redirect('/');
        }
        $post->delete();
        return redirect('/');
    }
    public function publish_post(Request $request){
        $post =Post::find($request->postid);
        if (!Auth::check()){
            return redirect('/login');
        }
        if (!Gate::allows('check-admin')) {
            return redirect('/');
        }
        $post->is_published=true;
        $post->publishes_on=now();
        $post->save();
        return redirect('/');
    }
    public function unpublish_post(Request $request){
        $post =Post::find($request->postid);
        if (!Auth::check()){
            return redirect('/login');
        }
        if (!Gate::allows('check-admin')) {
            return redirect('/');
        }
        $post->is_published=false;
        $post->publishes_on=null;
        $post->save();
        return redirect('/');
    }
    public function test(){
        return dd(Post::where('is_published', false)
        ->where('publishes_on', '<=', now()));
    }
}