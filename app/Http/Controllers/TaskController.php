<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskService $taskService): JsonResponse
    {
        return response()->json(
            $taskService->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request, TaskService $taskService): Response
    {
        $taskService->create(Auth::user(), $request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, TaskService $taskService)
    {
        return response()->json(
            $taskService->get($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, int $projectId, TaskService $taskService): Response
    {
        $taskService->update($projectId, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $projectId, TaskService $taskService): Response
    {
        $taskService->destroy($projectId);

        return response()->noContent();
    }
}
