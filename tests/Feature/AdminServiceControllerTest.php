<?php

use App\Models\Service;
use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group("service")]
class AdminServiceControllerTest extends TestCase
{
    protected $indexUrl;
    protected $showUrlName;
    protected $createUrl;
    protected $updateUrlName;
    protected $deleteUrlName;
    protected $adminUser;
    protected $superAdminUser;

    protected function setUp(): void
    {
        $this->setUpTheTestEnvironment();
        $this->indexUrl = route('admin.services.index');
        $this->showUrlName = 'admin.services.show';
        $this->createUrl = route('admin.services.store');
        $this->updateUrlName = 'admin.services.update';
        $this->deleteUrlName = 'admin.services.destroy';
        
        $this->adminUser = User::factory()->admin()->create();
        $this->superAdminUser = User::factory()->superAdmin()->create();
    }

    protected function getUrl($urlName, Service $service)
    {
        return route($urlName, $service);
    }

    public function test_admin_get_services(): void
    {
        $response = $this->actingAs($this->adminUser)->get($this->indexUrl);

        $response->assertStatus(200);
    }

    public function test_admin_get_service(): void
    {
        $service = Service::factory()->create();

        $response = $this->actingAs($this->adminUser)->get($this->getUrl($this->showUrlName, $service));

        $response->assertStatus(200);
    }

    public function test_admin_create_service()
    {
        $service = Service::factory()->make();

        $payload = [
            "name" => $service->name,
            "label" => $service->label,
            "description" => $service->description,
            "price" => $service->price,
            "duration_minutes" => $service->duration_minutes,
            "available" => $service->available,
        ];

        $response = $this->actingAs($this->adminUser, 'sanctum')->post($this->createUrl, $payload);

        $id = $response->json()['id'];

        $response->assertStatus(200);

        // $this->assertDatabaseHas(Post::class, ['id' => $id]);
        // $this->assertDatabaseHas(Post::class, $payload);
        $this->assertNotNull(Service::find($id), 'Service is not found');


        // $response->assertJsonFragment([$expectedPostJson]);
    }

    public function test_admin_update_service_in_db()
    {
        $service = Service::factory()->create();
        $updatingService = Service::factory()->make();

        $payload = [
            "name" => $updatingService->name,
            "label" => $updatingService->label,
            "description" => $updatingService->description,
            "price" => $updatingService->price,
            "duration_minutes" => $updatingService->duration_minutes,
            "available" => $updatingService->available,
        ];

        $response = $this->actingAs($this->adminUser, 'sanctum')
            ->patch($this->getUrl($this->updateUrlName, $service), $payload);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas(Service::class, $payload);
    }

    public function test_super_admin_delete_service_in_db()
    {
        $service = Service::factory()->create();
        
        $response = $this->actingAs($this->superAdminUser, 'sanctum')
            ->delete($this->getUrl($this->deleteUrlName, $service));
        
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
            'name' => $service->name
        ]);
        
        $this->assertNull(Service::find($service->id));
    }
}
