<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Models\User;
use App\Models\Program;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProgramControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'password' => Hash::make('password'),
        ]);
    }
    /** @test */
    public function user_can_access_program_index()
    {
        $this->actingAs($this->admin, 'sanctum');

        Program::factory()->create();

        $response = $this->getJson('/api/admin/manajemen/program');

        Log::info($response->getContent());

        $response->AssertStatus(200)
        ->assertJson([
            'status' => 'succes',
            'message' => 'Get data program successfull',
        ]);
    }
    /** @test */
    public function user_cannot_acces_program_index()
    {
        $response = $this->getJson('/api/admin/manajemen/program');

        Log::info($response->getContent());

        $response->assertStatus(401);
    }

    /** @test */
    public function User_can_store_program()
    {
        $this->actingAs($this->admin, 'sanctum');

        $response = $this->postJson('/api/admin/manajemen/program',[
            'nama_program' => 'Program Test',
            'deskripsi' => 'ujicoba',
            'file' => null,
        ]);

        Log::info($response->getContent());

        $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'message' => 'Add program seccessfull',
        ]);
    }
    /** @test */
    public function user_cannot_store_program()
    {
        $this->actingAs($this->admin, 'sanctum');

        $response = $this->postJson('/api/admin/manajemen/program', [
            'nama_program' => '', //nama program tidak boleh kosong
            'deskripsi' => '',//deskripsi tidak boleh kosong
            'file' => '',
        ]);

        Log::info($response->getContent());

        $response->assertStatus(422)
        ->assertJson([
            'nama_program',
            'deskripsi',
        ]);
    }
}
