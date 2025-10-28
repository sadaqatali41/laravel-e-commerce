<?php

namespace Tests\Feature;

use App\Models\Admin\Admin;
use App\Models\Admin\Category;
use App\Models\Admin\Slider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SliderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function authenticateAdmin() 
    {
        $admin = Admin::factory()->create();
        
        $this->actingAs($admin, 'admin');

        return $admin;
    }

    private function fakeSliderImage($fileName = 'slider.jpg')
    {
        // Fake the storage
        Storage::fake('public');
        // Create fake image
        $image = UploadedFile::fake()->image($fileName, 1920, 700)->size(2048);

        return $image;
    }

    public function test_admin_can_view_slider_page()
    {
        $this->authenticateAdmin();

        $response = $this->get(route('admin.slider.index'));
        
        $response->assertStatus(200);

        $response->assertViewHas([
            'exp' => 'index',
            'title' => 'Manage Slider'
        ]);
    }

    public function test_admin_can_open_create_slider()
    {
        $this->authenticateAdmin();

        $response = $this->get(route('admin.slider.create'));
        
        $response->assertStatus(200);
    }

    public function test_admin_can_create_new_slider_with_image()
    {
        // Authenticate the admin
        $admin = $this->authenticateAdmin();

        // Create the new category
        $category = Category::factory()->create();

        // Create fake image
        $image = $this->fakeSliderImage();
        
        // Prepare post data
        $data = [
            'category_id' => $category->id,
            'title' => 'Test Slider Title',
            'short_title' => 'Short Title',
            'description' => 'This is a short description.',
            'image' => $image,
            'status' => 'A',
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ];

        // Send POST request
        $response = $this->postJson(route('admin.slider.store'), $data);

        // Assert response
        $response->assertStatus(200)->assertJson(['success' => true]);

        // Assert image was stored
        Storage::disk('public')->assertExists('slider/' . $image->hashName());

        // Assert database has the slider
        $this->assertDatabaseHas('sliders', [
            'title' => 'Test Slider Title',
            'short_title' => 'Short Title',
            'description' => 'This is a short description.',
            'image' => $image->hashName(),
            'status' => 'A',
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);
    }

    public function test_admin_can_see_slider_edit_page()
    {
        // Authenticate the admin
        $admin = $this->authenticateAdmin();

        // Create the new category
        $category = Category::factory()->create();

        // Slider data
        $slider = Slider::factory()->create([
            'category_id' => $category->id,
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);

        $response = $this->get(route('admin.slider.edit', $slider));
        $response->assertStatus(200);
    }

    public function test_admin_can_update_slider_with_new_image()
    {
        // Authenticate the admin
        $admin = $this->authenticateAdmin();

        // Create the new category
        $category = Category::factory()->create();

        // Old Slider data
        $slider = Slider::factory()->create([
            'category_id' => $category->id,
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);

        // New file name
        $fileName = 'new_slider.jpg';

        // Create fake image
        $image = $this->fakeSliderImage($fileName);
        
        // Prepare post data
        $data = [
            'category_id' => $category->id,
            'title' => 'Updated Slider Title',
            'short_title' => 'Short Title',
            'description' => 'This is a short description.',
            'image' => $image,
            'status' => 'A',
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ];

        // Send POST request
        $response = $this->putJson(route('admin.slider.update', $slider), $data);

        // Assert response
        $response->assertStatus(200)->assertJson(['success' => true]);

        // Assert image was stored
        Storage::disk('public')->assertExists('slider/' . $image->hashName());

        // Assert database has the slider
        $this->assertDatabaseHas('sliders', [
            'title' => 'Updated Slider Title',
            'short_title' => 'Short Title',
            'description' => 'This is a short description.',
            'image' => $image->hashName(),
            'status' => 'A',
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);
    }

    public function test_admin_can_not_submit_without_data()
    {
        $this->authenticateAdmin();

        $response = $this->postJson(route('admin.slider.store'), []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['category_id', 'title', 'short_title', 'description', 'image']);
    }

    public function test_guest_cannot_access_protected_routes()
    {
        auth()->logout();

        $response = $this->get(route('admin.slider.index'));
        $response->assertRedirect(route('admin.login'));

        $response = $this->post(route('admin.slider.store'), []);
        $response->assertRedirect(route('admin.login'));
    }
}
