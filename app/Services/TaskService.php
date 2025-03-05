<?php
namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskService
{
    /**
     * Fetch all tasks with relationships.
     */
    public function getAllTasks()
    {
        return Task::with(['assignedTo', 'assignedBy'])->get();
    }

    /**
     * Store a new task.
     */
    public function createOrUpdateTask($data, $taskId = null)
    {
        
        // Start a transaction
        DB::beginTransaction();
    
        try {
            // If a task ID is provided, update the task
            if ($taskId) {
                $task = Task::findOrFail($taskId); // Find existing task or fail
                $task->update([
                    'client_id' => $data['client_id'],
                    'client_case_information_id' => $data['client_info_id'],
                    'details' => $data['details'] ?? null,
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'completed' => $data['completed'] ?? false,
                    'assigned_by' => auth()->user()->id,
                ]);
            } else {
                // Create a new task if no task ID is provided
                $task = Task::create([
                    'client_id' => $data['client_id'],
                    'client_case_information_id' => $data['client_info_id'],
                    'details' => $data['details'] ?? null,
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'completed' => $data['completed'] ?? false,
                    'assigned_by' => auth()->user()->id,
                ]);
            }
    
            // Ensure that the 'user_ids' field is present and not empty
            if (!empty($data['user_ids'])) {
                // Sync the users with the task (will update pivot table)
                $users = User::whereIn('id', $data['user_ids'])->get();
                $pivotData = $users->mapWithKeys(function ($user) use ($data) {
                    return [
                        $user->id => [
                            'status' => 'pending', // Default status
                        ]
                    ];
                })->toArray();
    
                // Attach or update the users in the pivot table
                $task->users()->sync($pivotData);
            }
    
            // Commit the transaction
            DB::commit();
    
            return $task;
        } catch (\Exception $e) {
            // Rollback if something goes wrong
            DB::rollBack();
    
            // Log the error for debugging and return a user-friendly message
            \Log::error('Task creation/update failed: ' . $e->getMessage());
    
            throw new \Exception('There was an error processing the task. Please try again later.');
        }
    }
    

    /**
     * Update an existing task.
     */
    public function updateTask(Task $task, array $data)
    {
        $task->update($data);
        return $task;
    }

    /**
     * Delete a task.
     */
    public function deleteTask(Task $task)
    {
        $task->delete();
        return true;
    }
}
