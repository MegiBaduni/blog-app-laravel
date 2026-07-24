<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_delete_others_post(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $post = Post::create([
            'title' => 'Post i pronarit',
            'body' => 'Permbajtje',
            'user_id' => $owner->id,
        ]);

        $response = $this->actingAs($otherUser)->delete("/posts/{$post->id}");

        $response->assertStatus(403);

        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }

    public function test_owner_can_delete_own_post(): void
    {
        $owner = User::factory()->create();

        $post = Post::create([
            'title' => 'Post i pronarit',
            'body' => 'Permbajtje',
            'user_id' => $owner->id,
        ]);

        $response = $this->actingAs($owner)->delete("/posts/{$post->id}");

        $response->assertRedirect('/hello');

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
