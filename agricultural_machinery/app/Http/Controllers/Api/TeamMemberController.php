<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamMemberResource;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class TeamMemberController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $teamMembers = TeamMember::query()
            ->when($request->boolean('active', true), fn ($query) => $query->where('is_active', true))
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request));

        return TeamMemberResource::collection($teamMembers);
    }

    public function show(TeamMember $teamMember): TeamMemberResource
    {
        return new TeamMemberResource($teamMember);
    }
}
