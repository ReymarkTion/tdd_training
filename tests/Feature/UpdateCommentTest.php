<?php

namespace Tests\Feature;

use App\Article;
use App\Comments;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function comment_author_can_see_update_form()
    {
        $this->withoutExceptionhandling();

        $article = create(Article::class, [
            'user_id' => auth()->user()->id
        ]);

        $comment = create(Comments::class, [
            'user_id' => auth()->user()->id,
            'article_id' => $article->id
        ]);

        $this->get("articles/{$article->id}")
            ->assertSeeText('Update Comment');
    }

    /** @test */
    public function a_user_can_update_its_comment()
    {

        $user = create(User::class);
        $article = create(Article::class, [
            'user_id' => $user->id
        ]);
        $comment = create(Comments::class, [
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);

        $updated = [
            'content_update' => 'Changed content.',
            'comment_id' => $comment->id
        ];

        $this->patch("/comments/{$comment->id}", $updated)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
