<?php

namespace App\Http\Controllers;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class CommentsController extends Controller
{
    public function create_comment(Request $request){
        $request->validate([
            'text' => ['required', 'string'],
            'post_id'=>['required', 'integer']
        ]);
        $comment = new Comments();
        if (!Auth::check()){
            return redirect('/login');
        }
        $comment->text = $request->text;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect('/');
    }
    public function delete_comment(Request $request){
        $request->validate([
            'comment_id' => ['required', 'integer']
        ]);
        if (!Auth::check()){
            return redirect('/login');
        }
        $comment =Comments::find($request->comment_id);
        if (!Gate::allows('delete-comment', $comment)) {
            return redirect('/');
        }
        $comment->delete();
        return redirect('/');
    }
}
