<?php

namespace App\Console\Commands;

use App\Models\Admin\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console create users | admin.
     *
     * @var string
     */
    protected $description = 'Create Users | Admin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userType = $this->choice(
            'Please Select user type',
            ['Admin', 'User'],
            0
        );

        if($userType === 'Admin') {
            $name = $this->ask('Enter your name.');
            $email = $this->ask('Enter your email.');
            $password = $this->secret('Enter your password.');

            $validator = Validator::make([
                'name'      => $name,
                'email'     => $email,
                'password'  => $password
            ], [
                'name' => ['required', 'min:3', 'max:20'],
                'email' => ['required', 'email', 'unique:admins,email'],
                'password'  => ['required', 'min:6', 'max:16']
            ]);

            if($validator->fails()) {
                $this->info($userType . ' is not created. See error messages below:');

                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
                return 1;
            }
            
            Admin::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);

            $this->info($userType . ' is created successfully. Now login with the same credentials.');
        }
        return 0;
    }
}
