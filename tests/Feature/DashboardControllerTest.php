<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_dashboard_shows_books_and_statistics_from_the_database(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::factory()->create(['name' => 'Web Development']);
        Book::factory()->for($category)->create([
            'title' => 'Laravel in Practice',
            'author' => 'Ayu Putri',
            'price' => 125000,
            'stock' => 4,
            'description' => 'A real catalog description.',
        ]);
        Book::factory()->for($category)->create(['stock' => 3]);

        $this->actingAs($user)
            ->get('/user/dashboard')
            ->assertOk()
            ->assertViewHas('stats', [
                'titles' => 2,
                'stock' => 7,
                'categories' => 1,
            ])
            ->assertViewHas('books', fn (LengthAwarePaginator $books): bool => $books->total() === 2)
            ->assertSee('Total Judul Buku')
            ->assertSee('Total Stok Buku')
            ->assertSee('Kategori Buku')
            ->assertSee('Web Development')
            ->assertSee('Laravel in Practice')
            ->assertSee('Ayu Putri')
            ->assertSee('A real catalog description.');
    }

    public function test_user_dashboard_shows_an_empty_state_without_inventory(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get('/user/dashboard')
            ->assertOk()
            ->assertSee('Belum ada buku di katalog');
    }

    public function test_admin_dashboard_lists_database_categories_and_books(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create(['name' => 'Database']);
        Book::factory()->for($category)->create(['title' => 'SQL Fundamentals']);

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSee('Kategori Buku')
            ->assertSee('Database')
            ->assertSee('SQL Fundamentals')
            ->assertSee('Tambah Buku');
    }

    public function test_guest_cannot_open_the_admin_dashboard(): void
    {
        $this->get('/admin/dashboard')
            ->assertRedirect('/login');
    }

    public function test_user_dashboard_escapes_book_descriptions(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::factory()->create();
        Book::factory()->for($category)->create([
            'description' => '<script>alert("xss")</script>',
        ]);

        $response = $this->actingAs($user)->get('/user/dashboard');

        $response->assertSee('<script>alert("xss")</script>');
        $response->assertDontSee('<script>alert("xss")</script>', false);
    }
}
