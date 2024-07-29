<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Ulasan;

class UlasanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_the_request()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/store-review', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['komentar', 'penilaian', 'id_ebook']);
    }

    /** @test */
    public function it_checks_if_user_has_already_reviewed_the_ebook()
    {
        $user = User::factory()->create();
        $ebook = Ebook::factory()->create();
        $review = Ulasan::factory()->create([
            'id_user' => $user->id,
            'id_ebook' => $ebook->id,
            'komentar' => 'Komentar sebelumnya',
            'penilaian' => 4
        ]);

        $this->actingAs($user);

        $response = $this->postJson('/store-review', [
            'komentar' => 'Komentar baru',
            'penilaian' => 5,
            'id_ebook' => $ebook->id
        ]);

        $response->assertStatus(422)
            ->assertJson(['errors' => ['review' => 'Anda sudah memberikan penilaian']]);
    }

    /** @test */
    public function it_stores_a_review_successfully()
    {
        $user = User::factory()->create();
        $ebook = Ebook::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson('/store-review', [
            'komentar' => 'Komentar baru',
            'penilaian' => 5,
            'id_ebook' => $ebook->id
        ]);

        $response->assertStatus(200)
            ->assertJson(['status' => true]);

        $this->assertDatabaseHas('ulasans', [
            'id_user' => $user->id,
            'id_ebook' => $ebook->id,
            'komentar' => 'Komentar baru',
            'penilaian' => 5
        ]);
    }
}
