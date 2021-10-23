<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     private function createDummyBlogPost($userId = null): BlogPost {

        return BlogPost::factory()->newTitle()->create();
     }
    public function testNoBlogPost(){
        $response = $this->get('/posts');
        $response->assertSeeText('No blog post has been recorded!');
    }

    public function testNewBlogPostWithNoComments(){

        // Arrange
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('New Title');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title'
        ]);
}

    public function testNewBlogPostWithComments(){
        // Arrange
        $post = $this->createDummyBlogPost();
        Comment::factory(4)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');
        $response->assertSeeText('4 comments');
    }

    public function testStoreValid(){

        $user = $this->user();
        $this->actingAs($user);

         $params = [
             'title' => 'Valid Title',
             'content' => 'At least 10 characters'
         ];
         // POST METHODU - STORE
         $this->post('/posts', $params)
         ->assertStatus(302)
         ->assertSessionHas('status');

         $this->assertEquals(session('status'), 'New blog post has been created!');
    }

    public function testStoreFail(){
        $user = User::factory()->create();

        $params = [
            'title' => 'x',
            'content' => 'y',
        ];

        $this->actingAs($user)
        ->post('/posts', $params)
        ->assertStatus(302)
        ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0],"The title must be at least 5 characters." );
        $this->assertEquals($messages['content'][0],"The content must be at least 10 characters." );
    }

    public function testUpdateValid(){

        $post = $this->createDummyBlogPost();

        $user = $this->user();
        $this->actingAs($user);

         $this->assertDatabaseHas('blog_posts', [
             'title' => 'New Title'
         ]);

         $params = [
             'title' => 'A Newest Title',
             'content' => 'Renoved content of the post'
         ];

         $this->put("/posts/{$post->id}", $params)
         ->assertStatus(302)
         ->assertSessionHas('status');

         $this->assertEquals(session('status'), 'Blog post is updated!!');
         $this->assertDatabaseMissing('blog_posts', [
             'title' => 'New Title'
         ]);
    }

    public function testDelete(){
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title'
        ]);

        $user = $this->user();
        $this->actingAs($user);

        $this->delete("/posts/{$post->id}")
        ->assertStatus(302)
        ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was deleted!');
        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'New Title'
        ]);
    }
}
