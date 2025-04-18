<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the task.
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;  // Only the task owner can update
    }

    /**
     * Determine whether the user can delete the task.
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;  // Only the task owner can delete
    }

  
    public function restore(User $user, Task $task)
    {
        return $user->id === $task->user_id;  // Only the task owner can restore
    }
}
