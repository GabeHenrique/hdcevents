<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private EventService $eventService;

    public function __construct()
    {
        $this->eventService = new EventService();
    }

    public function index(): View
    {
        return $this->eventService->showHomePage();
    }

    public function create(): View
    {
        return $this->eventService->showCreatePage();
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->eventService->createEvent($request);
    }

    public function show(int $id): View
    {
        return $this->eventService->showEvent($id);
    }

    public function dashboard(): View
    {
        return $this->eventService->showDashboard();
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->eventService->deleteEvent($id);
    }

    public function edit(int $id): View
    {
        return $this->eventService->showEditPage($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        return $this->eventService->updateEvent($request, $id);
    }

    public function joinEvent(int $id): RedirectResponse
    {
        return $this->eventService->joinEvent($id);
    }

    public function leaveEventAndRedirectToDashboard(int $id): RedirectResponse
    {
        return $this->eventService->leaveEventRedirect($id, '/dashboard');
    }

    public function leaveEvent(int $id): RedirectResponse
    {
        return $this->eventService->leaveEventRedirect($id, "/events/$id");
    }
}
