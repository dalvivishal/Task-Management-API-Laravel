<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query();

        // Filtering by status
        if ($request->has('status')) {
            $tasks->where('status', $request->status);
        }

        // Filtering by date
        if ($request->has('date')) {
            $tasks->whereDate('created_at', $request->date);
        }

        // Filtering by assigned user
        if ($request->has('assigned_user')) {
            $tasks->where('assign_to', $request->assigned_user);
        }

        return $tasks->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'assign_to' => 'required|exists:users,id'
        ]);

        $task = Task::create($request->all());

        return response()->json($task, 201);
    }

    public function show($id)
    {
        return Task::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'assign_to' => 'nullable|exists:users,id'
        ]);

        if (!$id) {
            return response()->json(["valid" => FALSE, "err_message" => "Please provide proper record id."], 200);
        }

        $task = Task::findOrFail($id);
        if ($task) {
            $task->update($request->all());
            return response()->json($task, 200);
        }
        else {
            return response()->json("Invalid record id.", 200);
        }

    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
