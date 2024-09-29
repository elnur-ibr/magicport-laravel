<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(int $projectId): JsonResponse
    {
        return response()->json(
            $this->taskService->all(Auth::user(), $projectId)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request, int $projectId): JsonResponse
    {
        return response()->json(
            $this->taskService->create(Auth::user(), $projectId, $request->validated())
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $projectId, int $taskId)
    {
        return response()->json(
            $this->taskService->show(Auth::user(), $projectId, $taskId)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, int $projectId, int $taskId): JsonResponse
    {
        return response()->json(
            $this->taskService->update(Auth::user(), $projectId, $taskId, $request->validated())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $projectId, int $taskId): Response
    {
        $this->taskService->destroy(Auth::user(),$projectId, $taskId);

        return response()->noContent();
    }
}
