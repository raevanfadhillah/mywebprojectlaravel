<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_and_update_a_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create(['name' => 'Design']);

        $this->actingAs($admin)
            ->post(route('admin.categories.store'), ['name' => 'Programming'])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('categories', ['name' => 'Programming']);

        $this->actingAs($admin)
            ->put(route('admin.categories.update', $category), ['name' => 'Visual Design'])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Visual Design']);
    }

    public function test_admin_cannot_create_a_duplicate_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Category::factory()->create(['name' => 'Programming']);

        $this->actingAs($admin)
            ->from(route('admin.dashboard'))
            ->post(route('admin.categories.store'), ['name' => 'Programming'])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('categories', 1);
    }

    public function test_category_cannot_be_deleted_while_books_use_it(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        Book::factory()->for($category)->create();

        $this->actingAs($admin)
            ->delete(route('admin.categories.destroy', $category))
            ->assertRedirect(route('admin.dashboard'))
            ->assertSessionHasErrors('category');

        $this->assertModelExists($category);
    }

    public function test_admin_can_delete_an_unused_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $this->actingAs($admin)
            ->delete(route('admin.categories.destroy', $category))
            ->assertRedirect(route('admin.dashboard'));

        $this->assertModelMissing($category);
    }

    public function test_regular_user_cannot_create_a_category(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->post(route('admin.categories.store'), ['name' => 'Programming'])
            ->assertRedirect('/user/dashboard');

        $this->assertDatabaseCount('categories', 0);
    }
}
