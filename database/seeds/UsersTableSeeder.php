<?php

use Illuminate\Database\Seeder;
use SON\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@user.com',
            'enrolment' => 100000
        ])->each(function (User $user) {
            $profile = factory(\SON\Models\UserProfile::class)->make();
            $user->profile()->create($profile->toArray());
            User::assingRole($user, User::ROLE_ADMIN);
            $user->save();
        });

        // 10 Professores
        factory(User::class, 100)->create()->each(function (User $user) {
            if (!$user->userable) {
                $profile = factory(\SON\Models\UserProfile::class)->make();
                $user->profile()->create($profile->toArray());
                User::assingRole($user, User::ROLE_TEACHER);
                $user->save();
            }
        });

        // 10 Estudandes
        factory(User::class, 100)->create()->each(function (User $user) {
            if (!$user->userable) {
                $profile = factory(\SON\Models\UserProfile::class)->make();
                $user->profile()->create($profile->toArray());
                User::assingRole($user, User::ROLE_STUDENT);
                $user->save();
            }
        });
    }
}
