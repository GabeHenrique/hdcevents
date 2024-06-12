<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventService
{
    /**
     * Retorna a view da página inicial, com a lista de eventos
     * @return View home page
     */
    public function showHomePage(): View
    {
        $search = request('search');
        if ($search) {
            $events = Event::query()
                ->where([['title', 'like', '%' . $search . '%']])->get()
                ->sortByDesc('created_at');
        } else {
            $events = Event::query()->get()
                ->sortByDesc('created_at');
        }
        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    /**
     * Retorna a view da página de criação de eventos
     * @return View create page
     */
    public function showCreatePage(): View
    {
        return view('events.create');
    }

    /**
     * Cria um evento
     * @param Request $request
     * @return RedirectResponse
     */
    public function createEvent(Request $request): RedirectResponse
    {
        $event = $this->mountEvent($request);

        $event->user_id = auth()->id();

        $event->save();

        return redirect('/')->with('message', 'Evento criado com sucesso!');
    }

    /**
     * Retorna a view da página de um evento
     * @param int $id
     * @return View event page
     */
    public function showEvent(int $id): View
    {
        $event = Event::query()->findOrFail($id);
        return view('events.show', ['event' => $event]);
    }

    /**
     * Retorna a view da página de dashboard
     * @return View dashboard page
     */
    public function showDashboard(): View
    {
        $user = auth()->user();

        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard',
            ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]
        );
    }

    /**
     * Deleta um evento
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteEvent(int $id): RedirectResponse
    {
        Event::query()->findOrFail($id)->delete();
        return redirect('/dashboard')->with('message', 'Evento deletado com sucesso!');
    }

    /**
     * Retorna a view da página de edição de eventos
     * @param int $id
     * @return View edit page
     */
    public function showEditPage(int $id): View
    {
        $user = auth()->user();
        $event = Event::query()->findOrFail($id);

        if ($user->id != $event->user_id) {
            return view('events.show', ['event' => $event]);
        }

        return view('events.update', ['event' => $event]);
    }

    /**
     * Atualiza um evento
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateEvent(Request $request, int $id): RedirectResponse
    {
        $event = $this->mountEvent($request);

        Event::query()->findOrFail($id)->update($event);

        return redirect('/dashboard')->with('message', 'Evento atualizado com sucesso!');
    }

    /**
     * Confirma a presença do usuário em um evento
     * @param int $id
     * @return RedirectResponse
     */
    public function joinEvent(int $id): RedirectResponse
    {
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);

        $event = Event::query()->findOrFail($id);

        return redirect('/events/' . $event->id)->with('message', 'Sua presença no evento ' . $event->title . ' foi confirmada!');
    }

    /**
     * Cancela a presença do usuário em um evento e redireciona para uri específica
     * @param int $id
     * @param string $uri
     * @return RedirectResponse
     */
    public function leaveEventRedirect(int $id, string $uri): RedirectResponse
    {
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);

        $event = Event::query()->findOrFail($id);

        return redirect($uri)->with('message', 'Sua presença no evento ' . $event->title . ' foi cancelada!');
    }

    public function validateImage(Request $request): string
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $request->image->move(public_path('img/events'), $imageName);
            return $imageName;
        } else {
            return 'default.jpg';
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function mountEvent(Request $request): array
    {
        $event = [];
        $event['title'] = $request->input('title');
        $event['description'] = $request->input('description');
        $event['city'] = $request->input('city');
        $event['is_private'] = $request->input('private');
        $event['items'] = $request->input('items');
        $event['date'] = $request->input('date');
        $event['image'] = $this->validateImage($request);
        return $event;
    }
}
