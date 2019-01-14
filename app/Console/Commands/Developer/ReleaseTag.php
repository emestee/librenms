<?php

namespace App\Console\Commands\Developer;

use LibreNMS\Util\GitHub;
use Illuminate\Console\Command;

class ReleaseTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'release:tag
                            {tag : The new tag / version}
                            {from : The previous tag / version}
                            {--file= : The filename to update}
                            {--pr= : The last PR to include in this release if not master branch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new LibreNMS release including changelog';

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
        $tag = $this->argument('tag');
        $this->info("Creating release $tag.....");
        try {
            $gh = new GitHub(
                $tag,
                $this->argument('from'),
                $this->option('file') ?: 'doc/General/Changelog.md',
                getenv('GH_TOKEN') ?: $this->secret('Enter a GitHub Token?'),
                $this->option('pr')
            );
            $gh->createChangelog();
            $this->info("Changelog generated for $tag");

            if ($this->confirm('Do you want to view the generated Changelog?')) {
                echo $gh->getMarkdown();
            }

            if ($this->confirm("Do you want to create the release $tag on GitHub?")) {
                if ($gh->createRelease()) {
                    $this->info('Release created.');
                } else {
                    $this->error('Failed to create release, check github to see what was completed.');
                }
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
