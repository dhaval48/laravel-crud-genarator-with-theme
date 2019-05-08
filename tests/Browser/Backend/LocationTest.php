<?php

namespace Tests\Browser\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Models\Location as Module;

class LocationTest extends DuskTestCase
{
    /**
     * A basic browser test example for Location Module....
     * @group location
     * @return void
     */
    public function testLocation() {
        $this->browse(function (Browser $browser) {
            $user = User::first();

            $browser->pause(3000);

            $browser->loginAs($user)
                    ->visit(route('location.create'));

            $browser->type('name', 'Demo')
					->type('postcode', 'Demo')
					->type('area_no', 'Demo')
					
                    ->press('Save')
                    ->assertRouteIs('location.create')
                    ->pause(3000)
                    ->assertSee('Location Created!')
                    ->visit(route('location.index'));

            $model = Module::latest()->first();
            $browser->click('.custom-default')
                    ->clickLink("Edit")
                    ->visit(route('location.edit', $model->id))
                    ->assertSee('Edit Location')
                    ->type('name', 'Demo')
					->type('postcode', 'Demo')
					->type('area_no', 'Demo')
					
                    ->press('Save')
                    ->assertRouteIs('location.edit', $model->id)
                    ->pause(3000)
                    ->assertSee('Location Updated!')
                    ->visit(route('location.index'))
                    ->pause(2000)
                    ->click('.custom-default')
                    ->clickLink("Delete")
                    ->press("Yes Delete it!")
                    ->pause(3000)
                    ->assertSee('Location Deleted!');
        });
    }
}
