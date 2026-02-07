<?php

use App\Models\Resource;
use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group("resource")]
class AdminResourceControllerTest extends TestCase
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
        $this->indexUrl = route('admin.resources.index');
        $this->showUrlName = 'admin.resources.show';
        $this->createUrl = route('admin.resources.store');
        $this->updateUrlName = 'admin.resources.update';
        $this->deleteUrlName = 'admin.resources.destroy';
        
        $this->adminUser = User::factory()->admin()->create();
        $this->superAdminUser = User::factory()->superAdmin()->create();
    }

    protected function getUrl($urlName, Resource $resource)
    {
        return route($urlName, $resource);
    }

    public function test_admin_get_resources(): void
    {
        $response = $this->actingAs($this->adminUser)->get($this->indexUrl);

        $response->assertStatus(200);
    }

    public function test_admin_get_resource(): void
    {
        $resource = Resource::factory()->create();

        $response = $this->actingAs($this->adminUser)->get($this->getUrl($this->showUrlName, $resource));

        $response->assertStatus(200);
    }

    public function test_admin_create_resource()
    {
        $resource = Resource::factory()->make();

        $payload = [
            "name" => $resource->name,
            "label" => $resource->label,
            "available" => $resource->available,
        ];

        $response = $this->actingAs($this->adminUser, 'sanctum')->post($this->createUrl, $payload);

        $id = $response->json()['id'];

        $response->assertStatus(200);

        // $this->assertDatabaseHas(Post::class, ['id' => $id]);
        // $this->assertDatabaseHas(Post::class, $payload);
        $this->assertNotNull(Resource::find($id), 'Resource is not found');


        // $response->assertJsonFragment([$expectedPostJson]);
    }

    public function test_admin_update_resource_in_db()
    {
        $resource = Resource::factory()->create();
        $updatingResource = Resource::factory()->make();

        $payload = [
            "name" => $updatingResource->name,
            "label" => $updatingResource->label,
            "available" => $updatingResource->available,
        ];

        $response = $this->actingAs($this->adminUser, 'sanctum')
            ->patch($this->getUrl($this->updateUrlName, $resource), $payload);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas(Resource::class, $payload);
    }

    public function test_super_admin_delete_resource_in_db()
    {
        $resource = Resource::factory()->create();
        
        $response = $this->actingAs($this->superAdminUser, 'sanctum')
            ->delete($this->getUrl($this->deleteUrlName, $resource));
        
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('resources', [
            'id' => $resource->id,
            'name' => $resource->name
        ]);
        
        $this->assertNull(Resource::find($resource->id));
    }
}
