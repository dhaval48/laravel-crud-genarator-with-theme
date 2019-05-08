<?php

namespace Tests\Browser\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Models\Task as Module;

class TaskTest extends DuskTestCase
{
    /**
     * A basic browser test example for Task Module....
     * @group task
     * @return void
     */
    public function testTask() {
        $this->browse(function (Browser $browser) {
            $user = User::first();

            $browser->pause(3000);

            $browser->loginAs($user)
                    ->visit(route('task.create'));

            $browser->type('name', 'Demo')
					->select('status',1)
					->type('description', 'Demo')
					
                    ->press('Save')
                    ->assertRouteIs('task.create')
                    ->pause(3000)
                    ->assertSee('Task Created!')
                    ->visit(route('task.index'));

            $model = Module::latest()->first();
            $browser->click('.custom-default')
                    ->clickLink("Edit")
                    ->visit(route('task.edit', $model->id))
                    ->assertSee('Edit Task')
                    ->type('name', 'Demo')
					->select('status',1)
					->type('description', 'Demo')
					
                    ->press('Save')
                    ->assertRouteIs('task.edit', $model->id)
                    ->pause(3000)
                    ->assertSee('Task Updated!')
                    ->visit(route('task.index'))
                    ->pause(2000)
                    ->click('.custom-default')
                    ->clickLink("Delete")
                    ->press("Yes Delete it!")
                    ->pause(3000)
                    ->assertSee('Task Deleted!');
        });
    }
}
