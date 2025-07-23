<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SeedTenantJob implements ShouldQueue
{
    use Queueable;
    protected $tenant;
    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tenant->run(function () {
            User::create([
                'name' => $this->tenant->name,
                'email' => $this->tenant->email,
                'password' => $this->tenant->password,
            ]);
        });
    }
}
