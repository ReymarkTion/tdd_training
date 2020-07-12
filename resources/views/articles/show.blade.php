@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center mb-3">
        @if ($user->id  == $article->author->id)
            <div class="col-md-8 d-flex flex-row-reverse">
                <a href="{{ route('articles.toUpdate', $article->id) }}" class="btn btn-info">
                    Update Article
                </a>
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ $article->title }}</span>
                    <span>{{ $article->author->name }}</span>
                </div>

                <div class="card-body">
                    {{ $article->content }}
                </div>

                <div class="card-footer">
                    {{ $article->tag }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comments</div>
                <div class="card-body">
                    @foreach ($article->comments as $comment)
                        
                        
                        <div class="alert alert-dark" role="alert">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <span class="badge badge-info">{{ $comment->commenter->name }}</span> :
                                    <span>{{ $comment->content }}</span>
                                </div>
                                <div class="d-flex flex-column">
                                    @if ($user->id  == $comment->commenter->id)
                                        <button type="button" class="btn btn-info btn-sm mb-2"
                                            data-toggle="collapse" data-target="#collapse_{{ $comment->id }}" 
                                            aria-expanded="false" aria-controls="collapse_{{ $comment->id }}">
                                            Update Comment
                                        </button>
                                        <form action="{{ route('comments.delete', $comment->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input class="btn btn-danger btn-sm" type="submit" value="Delete Comment" />
                                        </form>
                                    @endif
                                </div>
                            </div>

                            @if ($user->id  == $comment->commenter->id)
                                <div class="collapse" id="collapse_{{ $comment->id }}">
                                    <div class="card card-body mt-2">

                                        <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                                            <!-- {{csrf_field()}} -->
                                            <!-- {{ method_field('PATCH') }} -->
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-group row">
                                                <div class="col-md-12">

                                                    <input
                                                        id="comment_id"
                                                        type="hidden"
                                                        name="comment_id"
                                                        value="{{ $comment->id }}"
                                                    />

                                                    <input
                                                        id="content_update"
                                                        type="text"
                                                        class="form-control @error('content_update') is-invalid @enderror"
                                                        name="content_update"
                                                        value="{{ $comment->content }}"
                                                    />

                                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-info btn-sm">Update Comment</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('comments.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12">

                                        <input
                                            id="article_id"
                                            type="hidden"
                                            name="article_id"
                                            value="{{ $article->id }}"
                                        />

                                        <input
                                            id="content"
                                            type="text"
                                            class="form-control @error('content') is-invalid @enderror"
                                            name="content"
                                            value="{{ old('content') }}"
                                        />

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info btn-sm">Add Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div> 

</div>
@endsection
