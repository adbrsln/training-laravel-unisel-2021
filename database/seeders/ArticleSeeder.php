<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(app()->environment() != 'production') {
        	$users = \App\Models\User::query()
        		->inRandomOrder()
        		->limit(5)
        		->get();

        	$users->each(function($user) {
        		\App\Models\Article::factory()
        			->count(10)
        			->create([
        					'user_id' => $user->id,
        				]);
        	});
        }
    }
}
