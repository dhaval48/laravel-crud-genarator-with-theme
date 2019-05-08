<?php

namespace Tests\Browser\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Models\Themesetting as Module;

class ThemesettingTest extends DuskTestCase
{
    /**
     * A basic browser test example for Themesetting Module....
     * @group themesetting
     * @return void
     */
    public function testThemesetting() {
        $this->browse(function (Browser $browser) {
            $user = User::first();

            $browser->pause(3000);

            $browser->loginAs($user)
                    ->visit(route('themesetting.create'));

            $browser->select('color', 1)
					
                    ->press('Save')
                    ->assertRouteIs('themesetting.create')
                    ->pause(3000)
                    ->assertSee('Theme Setting Created!')
                    ->visit(route('themesetting.index'));

            $model = Module::latest()->first();
            $browser->click('.custom-default')
                    ->clickLink("Edit")
                    ->visit(route('themesetting.edit', $model->id))
                    ->assertSee('Edit Theme Setting')
                    ->select('color', 1)
					
                    ->press('Save')
                    ->assertRouteIs('themesetting.edit', $model->id)
                    ->pause(3000)
                    ->assertSee('Theme Setting Updated!')
                    ->visit(route('themesetting.index'))
                    ->pause(2000)
                    ->click('.custom-default')
                    ->clickLink("Delete")
                    ->press("Yes Delete it!")
                    ->pause(3000)
                    ->assertSee('Theme Setting Deleted!');
        });
    }
}
