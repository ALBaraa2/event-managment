<?php

namespace App\Http\Controllers\Api;

// use Illuminate\Routing\Controller;
use App\Http\Traits\CanLoadRelationships;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;
use App\Http\Resources\AttendeeResource;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;

class AttendeeController extends Controller
{

    use CanLoadRelationships;

    private array $relations = ['user'];

    public function __construct() {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'update']);
        // $this->authorizeResource(AttendeeController::class, 'attendee');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $this->authorize('viewAny', [Attendee::class, $event]);

        $attendees = $this->loadRelationships(
            $event->attendees()->latest()
        );

        return AttendeeResource::collection(
            $attendees->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $this->authorize('create', Attendee::class);

        $attendee = $this->loadRelationships(
            $event->attendees()->create([
                'user_id' => 1
            ])
        );

        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        $this->authorize('view', $attendee);

        return new AttendeeResource($this->loadRelationships($attendee));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Attendee $attendee)
    {
        // Gate::authorize('delete-atendee', [$event, $attendee]);
        $this->authorize('delete', $attendee);

        $attendee->delete();

        return response(status: 204);
    }
}
