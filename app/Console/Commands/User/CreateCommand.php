<?php

namespace App\Console\Commands\User;

use App\Models\User\User;
use Illuminate\Console\Command;

class CreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {login} {email} {password} {root}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user (Params: login email password root (1 or 0))';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $email = $this->argument('email');
      $login = $this->argument('login');
      $password = $this->argument('password');
      $root = $this->argument('root');

      if (User::where('login', $login)->first()) {
        $this->error('The specified login already exists');
        return false;
      }

      if (User::where('email', $email)->first()) {
        $this->error('The specified email already exists');
        return false;
      }

      try {
        User::create([
          'login' => $login,
          'name' => $login,
          'email' => $email,
          'admin' => ($root ? 1 : 0),
          'password' => bcrypt($password),
        ]);
      } catch (\DomainException $e) {
        $this->error($e->getMessage());
        return false;
      }

      $this->info('User is successfully created');
      return true;
    }
}
