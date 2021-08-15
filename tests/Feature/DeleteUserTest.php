<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Country;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * We can delete a user if the user does not have a user detail
     *
     * @return void
     */
    public function test_user_is_deleted_when_user_detail_does_not_exist()
    {
        // create user without detail
        $user = User::factory()->create();
        // make sure user was added into the table
        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);
        // successfully delete the user without details
        //$user->delete();
        $response = $this->deleteJson('/api/users/' . $user->id);
        $response->assertStatus(200);

        // make sure user was removed from the table
        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }

    /**
     * We can not delete a user when the user has a user detail
     *
     * @return void
     */
    public function test_user_is_not_deleted_when_user_detail_exist()
    {
        // create user with detail (via UserDetail model)
        $country = Country::factory()->create();
        $userDetail = UserDetail::factory()->create();
        $user = $userDetail->user;
        // make sure user was added into the table
        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);
        // try to delete the user
        //$user->delete();
        $response = $this->deleteJson('/api/users/' . $user->id);
        $response->assertStatus(409);
        // make sure user was not removed from the table
        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);
    }
}
