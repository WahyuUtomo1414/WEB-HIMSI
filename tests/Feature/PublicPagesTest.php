<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Branch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_returns_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_about_page_returns_successful_response(): void
    {
        $response = $this->get('/tentang-kami');
        $response->assertStatus(200);
    }

    public function test_branch_index_page_returns_successful_response(): void
    {
        $response = $this->get('/cabang');
        $response->assertStatus(200);
    }

    public function test_branch_detail_page_returns_successful_response(): void
    {
        $branch = Branch::query()->where('active', true)->first();
        $this->assertNotNull($branch);

        $response = $this->get('/cabang/' . $branch->id);
        $response->assertStatus(200);
    }

    public function test_blog_index_page_returns_successful_response(): void
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_blog_detail_page_returns_successful_response(): void
    {
        $blog = Blog::query()->where('active', true)->first();
        $this->assertNotNull($blog);

        $response = $this->get('/blog/' . $blog->slug);
        $response->assertStatus(200);
    }

    public function test_contact_page_returns_successful_response(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
    }

    public function test_contact_form_submission_stores_message(): void
    {
        $response = $this->post('/kontak', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => 'Pertanyaan Kerjasama',
            'message' => 'Halo pengurus HIMSI UBSI, kami ingin mengajukan usulan kerjasama event.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('contact', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => 'Pertanyaan Kerjasama',
        ]);
    }
}
