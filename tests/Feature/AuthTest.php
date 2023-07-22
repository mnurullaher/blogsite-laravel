<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tests\utils\TestUtils;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{

    private User $user;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = TestUtils::createUser();
    }

    public function test_create_post_redirects_to_login_for_unauthticated_users()
    {
        $response = $this->get('/posts/create');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_store_post_redirects_to_login_for_unauthticated_users()
    {
        $post = TestUtils::createPost($this->user->id)->toArray();

        $response = $this->post('/posts', $post);

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_edit_page_forbiden_for_unauthorized_users()
    {
        $post = TestUtils::createPost($this->user->id);
        $unauthorizedUser = TestUtils::createUser();

        $response = $this->actingAs($unauthorizedUser)->get('/posts/' . $post->id . '/edit');

        $response->assertStatus(403);
    }

    public function test_update_post_forbiden_for_unauthorized_users()
    {
        $post = TestUtils::createPost($this->user->id);
        $unauthorizedUser = TestUtils::createUser();

        $response = $this->actingAs($unauthorizedUser)->put('/posts/' . $post->id, [
            'title' => 'Updated Title',
            'body' => 'Updated Body'
        ]);

        $response->assertStatus(403);
    }

    public function test_update_post_redirects_to_login_for_unauthticated_users()
    {
        $post = TestUtils::createPost($this->user->id);

        $response = $this->put('/posts/' . $post->id, [
            'title' => 'Updated Title',
            'body' => 'Updated Body'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_delete_post_forbiden_for_unauthorized_users()
    {
        $post = TestUtils::createPost($this->user->id);
        $unauthorizedUser = TestUtils::createUser();

        $response = $this->actingAs($unauthorizedUser)->delete('posts/' . $post->id);

        $response->assertStatus(403);
    }

    public function test_delete_post_redirects_to_login_for_unauthticated_users()
    {
        $post = TestUtils::createPost($this->user->id);

        $response = $this->delete('posts/' . $post->id);

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}
