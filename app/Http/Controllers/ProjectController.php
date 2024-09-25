<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectService $projectService): JsonResponse
    {
        return response()->json($projectService->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request, ProjectService $projectService): JsonResponse
    {
        $projectInstance = $projectService->create(Auth::user(), $request->validated());

        return response()->json($projectInstance);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->loadCount('tasks');

        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void {}
}
