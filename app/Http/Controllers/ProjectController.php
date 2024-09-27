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

    public function __construct(
        protected ProjectService $projectService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->projectService->all(Auth::user())
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request): Response
    {
        $this->projectService->create(Auth::user(), $request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(
            $this->projectService->show($id, Auth::user())
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, int $projectId): Response
    {
        $this->projectService->update(Auth::user(), $projectId, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $projectId): Response
    {
        $this->projectService->destroy(Auth::user(), $projectId);

        return response()->noContent();
    }
}
