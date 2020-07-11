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
                    <div class="alert alert-dark" role="alert">
                    <span class="badge badge-info">Commentor</span> :
                    <span>comment content</span>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST">
                            <!-- <form method="POST" action="{{ route('articles.store') }}"> -->
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input
                                            id="comment"
                                            type="text"
                                            class="form-control @error('comment') is-invalid @enderror"
                                            name="title"
                                            value="{{ old('comment') }}"
                                            autofocus
                                        />

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-info btn-sm">Add Comment</button>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div> 

</div>
@endsection
