<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_book_with_its_inventory_details(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.books.store'), [
                'category_id' => $category->id,
                'title' => 'Laravel in Practice',
                'author' => 'Ayu Putri',
                'price' => '125000.50',
                'stock' => 14,
                'description' => 'Panduan Laravel untuk aplikasi web.',
            ])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('books', [
            'category_id' => $category->id,
            'title' => 'Laravel in Practice',
            'author' => 'Ayu Putri',
            'price' => '125000.50',
            'stock' => 14,
            'description' => 'Panduan Laravel untuk aplikasi web.',
        ]);
    }

    public function test_admin_can_edit_and_update_a_book(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $book = Book::factory()->for($category)->create(['title' => 'Old Title']);

        $this->actingAs($admin)
            ->get(route('admin.books.edit', $book))
            ->assertOk()
            ->assertSee('Old Title');

        $this->actingAs($admin)
            ->put(route('admin.books.update', $book), [
                'category_id' => $category->id,
                'title' => 'Updated Title',
                'author' => $book->author,
                'price' => $book->price,
                'stock' => 8,
                'description' => 'Updated description',
            ])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Updated Title',
            'stock' => 8,
            'description' => 'Updated description',
        ]);
    }

    public function test_book_creation_rejects_a_category_that_does_not_exist(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->from(route('admin.dashboard'))
            ->post(route('admin.books.store'), [
                'category_id' => 999,
                'title' => 'Laravel in Practice',
                'author' => 'Ayu Putri',
                'price' => 125000,
                'stock' => 14,
            ])
            ->assertSessionHasErrors('category_id');

        $this->assertDatabaseCount('books', 0);
    }

    public function test_admin_can_delete_a_book(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $book = Book::factory()->create();

        $this->actingAs($admin)
            ->delete(route('admin.books.destroy', $book))
            ->assertRedirect(route('admin.dashboard'));

        $this->assertModelMissing($book);
    }

    public function test_regular_user_cannot_create_a_book(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.books.store'), [
                'category_id' => $category->id,
                'title' => 'Unauthorized Book',
                'author' => 'Unknown',
                'price' => 10000,
                'stock' => 1,
            ])
            ->assertRedirect('/user/dashboard');

        $this->assertDatabaseCount('books', 0);
    }
}
