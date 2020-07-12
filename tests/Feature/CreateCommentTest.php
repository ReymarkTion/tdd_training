<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Article;
use App\Comments;

class CreateCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function a_user_can_see_comment_box_form()
    {
        $user = create(User::class);

        $article = create(Article::class, [
            'user_id' => $user->id
        ]);

        $this->get("articles/{$article->id}")
            ->assertSeeText('Add Comment');
    }

    /** @test */
    public function a_user_can_create_a_comment_to_an_article()
    {
        $article = create(Article::class, [
            'user_id' => auth()->user()->id
        ]);

        $comment = create(Comments::class, [
            'user_id' => auth()->user()->id,
            'article_id' => $article->id
        ]);

        $this->get("articles/{$article->id}")
            ->assertSeeText('Comments');
        
        $this->assertDatabaseHas('comments', [
            'content' => $comment->content,
            'user_id' => auth()->user()->id,
            'article_id' => $article->id
        ]);
    }

    /** @test */
    public function content_field_is_required()
    {
        $this->post('/comments', [])
            ->assertSessionHasErrors(['content']);
    }
}
