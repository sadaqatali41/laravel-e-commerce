<?php

namespace Tests\Feature;

use App\Models\Admin\Admin;
use App\Models\Admin\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SliderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function authenticateAdmin() {
        $admin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $this->actingAs($admin, 'admin');

        return $admin;
    }

    public function test_admin_can_view_slider_page()
    {
        $this->authenticateAdmin();

        $response = $this->get(route('admin.slider.index'));
        
        $response->assertStatus(200);
    }

    public function test_admin_can_open_create_slider()
    {
        $this->authenticateAdmin();

        $response = $this->get(route('admin.slider.create'));
        
        $response->assertStatus(200);
    }

    public function test_admin_can_create_new_slider()
    {
        $admin = $this->authenticateAdmin();

        $category = Category::create([
            'name' => 'Shoes',
            'slug' => 'shoes',
            'created_by' => $admin->id,
            'updated_by' => $admin->id
        ]);

        $file = UploadedFile::fake()->image('slider.png', 1920, 920);
        
        $this->assertEquals('image/png', $file->getMimeType());
        
        $req = [
            'category_id' => $category->id,
            'title' => 'My Title',
            'short_title' => 'Shortest tile!',
            'description' => 'My Description',
            'image' => $file,
        ];

        $response = $this->post(route('admin.slider.store', $req));
        
        $response->assertStatus(200);
    }
}
