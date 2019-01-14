<?php

namespace App\Console\Commands\Developer;

use Illuminate\Console\Command;

class EmacsTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emacs:tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate emacs TAGS file';

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
        //
    }
}
