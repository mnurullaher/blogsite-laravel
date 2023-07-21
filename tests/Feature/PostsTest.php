<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{

    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
   
    public function test_empty_index_page_rendered()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('No Posts Found');
    }


    public function test_non_empty_index_page_rendered() {
    
        $post = $this->createPost();

        $response = $this->get('/');

        $response->assertDontSee('No Posts Found');
        $response->assertViewHas('posts', function ($collection) use ($post) {
            return $collection->contains($post);
        });
    }

    public function test_show_post_page_rendered()
    {
        $post = $this->createPost();
        
        $response = $this->get('/posts/' . $post->id);

        $response->assertStatus(200);
        $response->assertSee($post->title);
        $response->assertSee($post->body);
        $response->assertSee('Post Comment');
    }

    public function test_create_post_view_rendered_for_authenticated_users() {
        $response = $this->actingAs($this->user)->get('/posts/create');

        $response->assertSee('Create a Post');
        $response->assertSee('Post Title');
        $response->assertSee('Post Body');
    }

    public function test_store_method_storing_post_to_database_for_authenticated_users() {
        $post = $this->createPost()->toArray();
    
        $unAuthorizedResponse = $this->post('/posts', $post);

        $unAuthorizedResponse->assertStatus(302);
        $unAuthorizedResponse->assertRedirect('login');


        $response = $this->actingAs($this->user)->post('/posts', $post);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('posts', $post);

        $lastPost = Post::latest()->first();
        $this->assertEquals($post['title'], $lastPost->title);
    }

    public function test_edit_page_rendered_only_for_authorized_user() {
        $post = $this->createPost();

        $unAuthorizedResponse = $this->get('/posts/' . $post->id . '/edit');

        $unAuthorizedResponse->assertStatus(403);

        $authorizedResponse = $this->actingAs($this->user)->get('/posts/' . $post->id . '/edit');

        $authorizedResponse->assertStatus(200);
        $authorizedResponse->assertSee('Edit Post');
        $authorizedResponse->assertSee($post->title);
        $authorizedResponse->assertSee($post->body);
    }

    

    private function createPost(): Post {
        return Post::create([
            'title' => 'Test Title',
            'body' => 'Test Body',
            'user_id' => $this->user->id
        ]);
    }
}
