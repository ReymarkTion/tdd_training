<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Article;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function getArticles($comment)
    {
        return Article::with(['author',
            'comments' => function($q) {
                $q->with('commenter');
            }])
            ->where('id', $comment->article_id)
            ->get()->first();
    }

    public function store(CommentRequest $request) {

        $comment = Comments::create([
            'content' => $request->content,
            'article_id' => $request->article_id,
            'user_id' => auth()->user()->id,
        ]);

        $article = $this->getArticles($comment);

        return redirect()->route('articles.show', $article);
    }

    public function update(Request $request)
    {
        $comment = Comments::where('id', $request->comment_id)
                        ->get()->first();

        $this->authorize('update', $comment);

        $comment->update([
            'content' => $request->content_update
        ]);

        $article = $this->getArticles($comment);

        return redirect()->route('articles.show', $article);
    }

    public function delete(Request $request, $id)
    {
        $comment = Comments::where('id', $id)
                        ->get()->first();

        $this->authorize('delete', $comment);

        $comment->delete();

        $article = $this->getArticles($comment);

        return redirect()->route('articles.show', $article);
    }
}
