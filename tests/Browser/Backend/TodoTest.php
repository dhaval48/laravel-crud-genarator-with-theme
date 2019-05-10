<?php

namespace Tests\Browser\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Models\Todo as Module;

class TodoTest extends DuskTestCase
{
    /**
     * A basic browser test example for Todo Module....
     * @group todo
     * @return void
     */
    public function testTodo() {
        $this->browse(function (Browser $browser) {
            $user = User::first();

            $browser->pause(3000);

            $browser->loginAs($user)
                    ->visit(route('todo.create'));

            $browser->type('name', 'Demo')
					->type('description', 'Text Area.Demo Test')
					
                    ->press('Save')
                    ->assertRouteIs('todo.create')
                    ->pause(3000)
                    ->assertSee('Todo Created!')
                    ->visit(route('todo.index'));

            $model = Module::latest()->first();
            $browser->click('.custom-default')
                    ->clickLink("Edit")
                    ->visit(route('todo.edit', $model->id))
                    ->assertSee('Edit Todo')
                    ->type('name', 'Demo')
					->type('description', 'Text Area.Demo Test')
					
                    ->press('Save')
                    ->assertRouteIs('todo.edit', $model->id)
                    ->pause(3000)
                    ->assertSee('Todo Updated!')
                    ->visit(route('todo.index'))
                    ->pause(2000)
                    ->click('.custom-default')
                    ->clickLink("Delete")
                    ->press("Yes Delete it!")
                    ->pause(3000)
                    ->assertSee('Todo Deleted!');
        });
    }
}
