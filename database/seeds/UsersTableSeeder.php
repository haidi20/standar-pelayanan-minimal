<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
          [
            'nama'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('samarinda'),
            'status'    => 'admin'
          ],
          [
            'name'      => 'user',
            'email'     => 'user@user.com',
            'password'  => bcrypt('samarinda'),
            'status'    => 'user'
          ]
        ]);
    }
}
