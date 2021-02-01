<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	collect($this->roles())->each(function($role) {
    		Role::create(['name' => $role]);
        });

        // collect($this->permissions())->each(function($permission) {

        // });
    }

    private function roles()
    {
    	return [
    		'administrator',
    		'user',
    	];
    }

    private function permissions()
    {
    	return [

    	];
    }
}
