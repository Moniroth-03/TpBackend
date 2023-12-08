<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::all();
        return PostResource::collection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $task = Tasks::create($validatedData);
            return new PostResource($task);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create task'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(StorePostRequest $request, Tasks $task)
     {
         try {
             $validatedData = $request->validated();
             $task->update($validatedData);
             return new PostResource($task);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Failed to update task'], 500);
         }
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
