<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Instituto;
use Illuminate\Http\Request;

class PostController extends Controller
{
   
    public function __construct()
    {
        
    $this->middleware('auth');
    
    }
    public function index()
    {
        
        $posts= Post::all();
    
        return view('Post.index', compact('posts'));

    }

  
    public function create()
    { 
        $institutos=Instituto::get();
        return view('Post.create',compact('institutos'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'nombre'              =>  'required|string|max:60',
            'user_id'             =>  'required|integer',
            'abstract'            =>  'required|max:500',
            'body'                =>  'required',
       
            'image'            =>  'image|dimensions:min_width=1200, max_with=1200, min_height=490, max_height=490|mimes:jpeg,jpg,png',

           
        ]);

        $urlimage=[];
     if($request->hasFile('image')){

        $image=$request->file('image');
        $nombre=time().$image->getClientOriginalName();
        $ruta= public_path().'/imagenes';
        $image->move($ruta,$nombre);
        $urlimage['url']='/imagenes/'.$nombre;
     }

     $post =New Post;
     $post->user_id  = e($request->user_id);
     $post->instituto_id = $request->instituto;
     $post->nombre   = e($request->nombre);
     $post->abstract = e($request->abstract);
     $post->body = e($request->body);
    //  $post->status = e($request->status);
     $post->save();

     $post->image()->create($urlimage);

     return redirect('sistema/posts ')->with('success','Publicación Creado Exitosamente!');


    }

 
    public function show($id)
    {  
         $post = Post::where('id',$id)->with('user','image','comments','comments.user')->firstOrFail();
               return view('Post.show',compact('post', 'id'));
    }

  
    public function edit(Post $post)
    {
        $post=Post::where('id',$post->id)->firstOrFail();

        $institutos = Instituto::get(); // todos los datos de la bd
        $institutopost = Post::find($post->id)->instituto()->get(); //llama al instituto que este relacionado a un usuario 


       return view('Post.edit',compact('post','institutos','institutopost'));
    }

  
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'nombre'              =>  'required|string|max:60',
            'user_id'             =>  'required|integer',
            'abstract'            =>  'required|max:500',
            'body'                =>  'required',
            // 'status'            =>  'required|in:PUBLISHED,DRAFT',
            'image'            =>  'image|dimensions:min_width=1200, max_with=1200, min_height=490, max_height=490|mimes:jpeg,jpg,png',

           
        ]);

        $urlimage=[];
        if($request->hasFile('image')){
   
           $image=$request->file('image');
           $nombre=time().$image->getClientOriginalName();
           $ruta= public_path().'/imagenes';
           $image->move($ruta,$nombre);
           $urlimage['url']='/imagenes/'.$nombre;
        }


        $post->update($request->all());

        if ($request->hasFile('image')){
            $post->image()->delete();
        }
        
        if($request->get('instituto')){
          
            $post->instituto_id = $request->instituto;
          }

        $post->save();
        if ($request->hasFile('image')){
            $post->image()->create($urlimage);
        }

        return redirect('sistema/posts ')->with('success','Publicación Editada Exitosamente!');

    }

   
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id)->delete();
   
        return redirect('sistema/posts ')->with('success','Publicación Eliminada Exitosamente!');
    }
}