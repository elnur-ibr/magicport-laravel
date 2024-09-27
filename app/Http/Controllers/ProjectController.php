<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectService $projectService): JsonResponse
    {
        return response()->json(
            $projectService->all(Auth::user())
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request, ProjectService $projectService): Response
    {
        $projectService->create(Auth::user(), $request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, ProjectService $projectService)
    {
        return response()->json(
            $projectService->show($id, Auth::user())
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, int $projectId, ProjectService $projectService): Response
    {
        $projectService->update(Auth::user(), $projectId, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $projectId, ProjectService $projectService): Response
    {
        $projectService->destroy(Auth::user(), $projectId);

        return response()->noContent();
    }
}
