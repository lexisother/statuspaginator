<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class CreateUser extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user manually.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = Str::random();

        if (!$name || !$email) {
            $this->error('Somehow there was no name or email provided.');
            die(1);
        }

        /** @var User $user */
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        $user->save();

        if ($this->confirm('Make this user an admin?'))
            $user->assignRole('admin');

        $this->info('User successfully created!');
        $this->comment('Do note, the password is temporary and randomly generated! Change it ASAP!');
        $this->table(
            ['Name', 'Email', 'Password'],
            [[$user->name, $user->email, $password]]
        );
    }

    protected function promptForMissingArgumentsUsing()
    {
        return [
            'name' => "What is the user's name?",
            'email' => "What is the user's email?"
        ];
    }
}
