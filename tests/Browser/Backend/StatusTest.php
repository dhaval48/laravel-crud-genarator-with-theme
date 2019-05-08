<?php

namespace Tests\Browser\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Models\Status as Module;

class StatusTest extends DuskTestCase
{
    /**
     * A basic browser test example for Status Module....
     * @group status
     * @return void
     */
    public function testStatus() {
        $this->browse(function (Browser $browser) {
            $user = User::first();

            $browser->pause(3000);

            $browser->loginAs($user)
                    ->visit(route('status.create'));

            $browser->type('name', 'Demo')
					
                    ->press('Save')
                    ->assertRouteIs('status.create')
                    ->pause(3000)
                    ->assertSee('Status Created!')
                    ->visit(route('status.index'));

            $model = Module::latest()->first();
            $browser->click('.custom-default')
                    ->clickLink("Edit")
                    ->visit(route('status.edit', $model->id))
                    ->assertSee('Edit Status')
                    ->type('name', 'Demo')
					
                    ->press('Save')
                    ->assertRouteIs('status.edit', $model->id)
                    ->pause(3000)
                    ->assertSee('Status Updated!')
                    ->visit(route('status.index'))
                    ->pause(2000)
                    ->click('.custom-default')
                    ->clickLink("Delete")
                    ->press("Yes Delete it!")
                    ->pause(3000)
                    ->assertSee('Status Deleted!');
        });
    }
}
