<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Job;
use \App\Models\Employer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();

        $users = User::all()->shuffle();

        for ($i = 0; $i < 20; $i++) {
            Employer::factory()->create([
                "user_id" => $users->pop()->id,
            ]);
        }

        $employers = Employer::all();

        for ($i = 0; $i < 100; $i++) {
            Job::factory()->create([
                "employer_id" => $employers->random()->id,
            ]);
        }
        User::factory()->create([
            'name' => 'Walle Mechson',
            'email' => 'walle@gmail.com',
        ]);

        foreach ($users as $user) {
            $jobs = Job::inRandomOrder()->take(rand(0, 4))->get();

            foreach ($jobs as $job) {
                \App\Models\JobApplication::factory()->create([
                    "job_id" => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
