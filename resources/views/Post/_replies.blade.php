@foreach ($comments as $comment)
<div class="media mb-4 mt-4">

<i class="fas fa-user"></i>
    <div class="media-body">
        <div class="comment-text"> <span class="username">
                <div class="ml-2">
                    <div class="h5 m-0"> <strong>{{$comment->user->name}} {{$comment->user->apellido}}</strong>
                    </div>
                    <div class="h9 text-muted">{{$comment->created_at->format('d/m/Y')}}</div>
                </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="comment-text">
                {{$comment->body}}
            </div>
            <div>
                @if($comment->user_id == Auth::id())
                <div class="dropdown">
                    <button class="btn btn-link-dark dropdown-toggle" type="button" id="gedf-drop1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                        <a class="dropdown-item" href="{{route('comment.edit', $comment->id)}}" data-toggle="modal"
                            data-target="#modal-edit-comment{{$comment->id}}">Editar</a>

                        {!! Form::open(['route'=>['comment.destroy',$comment->id], 'method'=>'DELETE']) !!}
                        <button class="dropdown-item" title="Eliminar">
                            Eliminar
                        </button>
                        {!! Form::close() !!}

                    </div>
                </div>
                @endif
            </div>
        </div>

        {!! Form::open(['route'=>'reply.add', 'method'=>'POST']) !!}
        <form action="#" method="post">
            @csrf
            <div class="img-push">
                <div class="col-sm-10">
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    @if ($comment->parent_id == null)
                    <div class="input-group input-group-sm mb-0">
                        <input type="text" class="form-control input-sm" name="body"
                            placeholder="Presiona Enter para comentar">
                        <div class="input-group-append">
                            @if ($comment->parent_id == null)
                            <button type="submit" class="btn btn-dark btn-sm" title="Reply">
                                <i class="fas fa-comment-dots"></i> Responder
                            </button>
                            @endif
                        </div>
                    </div>
                    @endif
                   
                </div>
            </div>
        </form>
        {!! Form::close() !!}
      
        @include('Post._replies',['comments'=>$comment->replies])
    </div>
</div>


@endforeach


@if (isset($comment->replies))
@include('Post.partials._editComments',['comments'=>$comment->replies])
@endif