<?php

namespace Tests\Feature;

use App\Article;
use App\Comments;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function a_user_can_delete_its_comment()
    {
        $user = create(User::class);

        $article = create(Article::class, [
            'user_id' => $user->id
        ]);

        $comment = create(Comments::class, [
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);

        // dd($comment->id);

        $this->delete("/comments/{$comment->id}", [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

}
