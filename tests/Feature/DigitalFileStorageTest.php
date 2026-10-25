<?php

namespace Tests\Feature;

use App\Models\DigitalProduct;
use App\Models\Download;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DigitalFileStorageTest extends TestCase
{
    use RefreshDatabase;

    private function product(): DigitalProduct
    {
        return DigitalProduct::create(['type' => 'digital', 'title' => 'Private document', 'description' => 'Digital download',
            'price' => '19.99', 'is_free' => false, 'image' => 'cover.png', 'file' => 'digital-products/files/paid.zip', 'status' => 'published']);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        Storage::fake('digital');
    }

    public function test_dry_run_never_moves_or_deletes_a_public_file(): void
    {
        $p = $this->product();
        Storage::disk('public')->put($p->file, 'original');
        $this->artisan('digital:secure-files')->assertExitCode(0);
        Storage::disk('public')->assertExists($p->file);
        Storage::disk('digital')->assertMissing($p->file);
    }

    public function test_apply_preserves_bytes_removes_public_copy_and_can_be_repeated(): void
    {
        $p = $this->product();
        Storage::disk('public')->put($p->file, 'original');
        $this->artisan('digital:secure-files', ['--apply' => true])->assertExitCode(0);
        $this->assertSame('original', Storage::disk('digital')->get($p->file));
        Storage::disk('public')->assertMissing($p->file);
        $this->artisan('digital:secure-files', ['--apply' => true])->assertExitCode(0);
        $this->assertSame('original', Storage::disk('digital')->get($p->file));
    }

    public function test_conflicting_private_copy_never_deletes_or_overwrites_original(): void
    {
        $p = $this->product();
        Storage::disk('public')->put($p->file, 'original');
        Storage::disk('digital')->put($p->file, 'different');
        $this->artisan('digital:secure-files', ['--apply' => true])->assertExitCode(1);
        $this->assertSame('original', Storage::disk('public')->get($p->file));
        $this->assertSame('different', Storage::disk('digital')->get($p->file));
    }

    public function test_entitled_download_uses_private_storage_and_never_falls_back_to_public(): void
    {
        $p = $this->product();
        $buyer = User::factory()->create();
        Download::create(['user_id' => $buyer->id, 'digital_product_id' => $p->id, 'token' => 'private-token', 'paid' => true]);
        Storage::disk('public')->put($p->file, 'public');
        $this->actingAs($buyer)->get('/downloads/private-token')->assertNotFound();
        Storage::disk('digital')->put($p->file, 'private');
        $this->get('/downloads/private-token')->assertDownload('paid.zip')->assertHeader('X-Content-Type-Options', 'nosniff');
        $this->actingAs(User::factory()->create())->get('/downloads/private-token')->assertForbidden();
    }

    public function test_path_traversal_is_rejected_and_missing_files_are_reported(): void
    {
        $p = $this->product();
        $p->update(['file' => '../secret']);
        $this->artisan('digital:secure-files', ['--apply' => true])->assertExitCode(1);
        $p->update(['file' => 'missing.zip']);
        $this->artisan('digital:secure-files', ['--apply' => true])->assertExitCode(1);
    }
}
