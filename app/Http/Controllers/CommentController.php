<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class CommentController extends Controller
{
   

   
    public function store(Request $request)
    {
        $request->validate([
            'body'=> 'required',
        ]);

        $comment=New Comment();
        $comment->body = $request->body;
        $comment->user()->associate($request->user());
        $post = Post::find($request->post_id);
        $post->comments()->save($comment);

        return back()->with('success','El comentario esta siendo evaluado');
       
    }


    public function replyStore(Request $request)
    {
        $request->validate([
            'body'=> 'required',
        ]);

        $reply=New Comment();
        $reply->body = $request->get('body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($reply);

         return back()->with('info','El respuesta esta siendo evaluado');
    }

    public function edit(Comment $comment){

        return view('Post.partials._editComments', compact('comment'));

    }


    public function update(Request $request, Comment $comment){

        $request->validate([
            'body'=> 'required',
        ]);

        $comment->fill($request->all())->save();
        return back()->with('info','Actualizado con Éxito');

    }





  
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('info','Borrado con Exito');
    }
}
