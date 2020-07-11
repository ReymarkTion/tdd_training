<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCommentToArticle extends TestCase
{
    
    public function setUp() : void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function an_authenticated_user_can_create_comment_to_an_article()
    {
        // $this->withoutExceptionHandling();


        // $user = create(User::class);

        // $article = create(Article::class, [
        //     'user_id' => $user->id
        // ]);

        // $updated = [
        //     'title' => 'Changed title',
        //     'content' => 'Changed content.',
        // ];

        // $this->patch("/articles/{$article->id}", $updated)
        //     ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
