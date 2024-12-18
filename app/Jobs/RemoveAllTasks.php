<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class RemoveAllTasks implements ShouldQueue
{
    use Queueable;
    public User $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::delete('delete from tasks where id in(
                    select task_id from task_user where user_id = ? and permission = "owner")', 
                    [$this->user->id]);
    }
}
