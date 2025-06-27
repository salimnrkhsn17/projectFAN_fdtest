<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_book()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);
        $response = $this->post('/books', [
            'title' => 'Buku Baru',
            'author' => 'Penulis',
            'description' => 'Deskripsi buku',
            'rating' => 4,
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('books', [
            'title' => 'Buku Baru',
            'author' => 'Penulis',
        ]);
    }

    public function test_authenticated_user_can_update_book()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $book = Book::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->put('/books/' . $book->id, [
            'title' => 'Judul Update',
            'author' => 'Penulis Update',
            'description' => 'Deskripsi update',
            'rating' => 5,
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Judul Update',
        ]);
    }

    public function test_authenticated_user_can_delete_book()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $book = Book::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->delete('/books/' . $book->id);
        $response->assertRedirect();
        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }
}
