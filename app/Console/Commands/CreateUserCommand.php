<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Admin\Admin;
use Illuminate\Support\Str;
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

        // common inputs for both Admin & users
        $commonData['name'] = $this->ask('Enter your name.');
        $commonData['email'] = $this->ask('Enter your email.');
        $commonData['password'] = $this->secret('Enter your password.');

        // non admin specific data
        if($userType !== 'Admin') {
            $commonData['mobile'] = $this->ask('Enter Mobile Number.');
            $commonData['activation_token'] = Str::random(60);
            $commonData['ip'] = request()->ip();
            $commonData['status'] = 'A';
            $commonData['email_verified_at'] = now();
        }

        // common validations
        $commonValidation = [
            'name' => ['required', 'min:3', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password'  => ['required', 'min:6', 'max:16'],
            'mobile' => $userType === 'User' ? 'required|digits:10' : 'nullable'
        ];

        // admin specific validation
        $adminValidation = [
            'email' => 'required|email|unique:admins,email'         
        ];

        if($userType === 'Admin') {
            $commonValidation = array_merge($commonValidation, $adminValidation);
        }

        // perform validations
        $validator = Validator::make($commonData, $commonValidation);

        if($validator->fails()) {
            $this->info($userType . ' is not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // hash the password
        $commonData['password'] = Hash::make($commonData['password']);

        if($userType === 'Admin') {
            Admin::create($commonData);
        } else {
            User::create($commonData);
        }
        $this->info($userType . ' is created successfully. Now login with the same credentials.');
        return 0;
    }
}
