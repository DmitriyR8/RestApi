<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ResetPasswordStringEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random string for reset password and put to env file';

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
        $rootPath = getcwd();
        $this->putToEnv($rootPath. '/.env');
    }

    /**
     * @param string $path
     * @return void
     */
    private function putToEnv(string $path)
    {
        $resetPasswordRandomString = "\nPASSWORD_RESET_STRING=". Str::random(65);

        file_put_contents($path, $resetPasswordRandomString, FILE_APPEND);
    }
}
