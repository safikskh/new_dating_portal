<?php

use App\User;
use App\Models\Blogs;
use App\Models\Events;
use App\Models\Groups;
use App\Models\Categories;
use App\Models\EventJoinUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(Categories::class,5)->create();
        factory(Groups::class,2)->create();
        factory(User::class,3)->create();
        factory(Blogs::class,6)->create();
        factory(Events::class,2)->create();
        factory(EventJoinUser::class,4)->create();
    }
}
