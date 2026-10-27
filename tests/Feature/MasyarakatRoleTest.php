<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MasyarakatRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_masyarakat_can_access_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat')
            ->assertOk();
    }

    public function test_admin_cannot_access_masyarakat_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat')
            ->assertForbidden();
    }

    public function test_petugas_cannot_access_masyarakat_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'petugas_lapangan',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat')
            ->assertForbidden();
    }

    public function test_masyarakat_can_access_profile(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat/profil')
            ->assertOk();
    }

    public function test_masyarakat_can_access_pengajuan_form(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat/pengajuan/buat')
            ->assertOk();
    }

    public function test_guest_cannot_access_masyarakat_profile(): void
    {
        $this->get('/masyarakat/profil')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_access_pengajuan_form(): void
    {
        $this->get('/masyarakat/pengajuan/buat')
            ->assertRedirect('/login');
    }
}
