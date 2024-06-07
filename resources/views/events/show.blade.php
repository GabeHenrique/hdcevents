@extends('layouts.main')

@section('title', $event->title)

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $event->title }}</h1>
                <p class="event-date">
                    <ion-icon name="calendar-outline"></ion-icon>
                    {{ date('d/m/Y', strtotime($event->date)) . ' às '. date('H', strtotime($event->date)) . 'h'. date('i', strtotime($event->date)) . 'min'}}
                </p>
                <p class="event-city">
                    <ion-icon name="location-outline"></ion-icon>
                    {{ $event->city }}</p>
                <p class="events-participants">
                    <ion-icon name="people-outline"></ion-icon>
                    X Participantes
                </p>
                <p class="event-owner">
                    <ion-icon name="star-outline"></ion-icon>
                    {{ $event->user->name }}
                </p>
                @if($event->items)
                    <h3 style="margin-top: 30px">O evento conta com:</h3>
                    <ul id="items-list">
                        @foreach($event->items as $item)
                            <li>
                                <ion-icon name="play-outline"></ion-icon>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if($event->users->contains(Auth::user()))
                    <h3 id="confirmation"> <ion-icon name="checkmark-circle-outline"></ion-icon> Presença confirmada!</h3>
                    <form action="/events/leave/{{ $event->id }}" method="POST">
                        @csrf
                        <a href="/events/leave/{{ $event->id }}"
                           class="btn btn-primary"
                           id="event-submit"
                           onclick="event.preventDefault();
            this.closest('form').submit();">
                            Sair do evento
                        </a>
                    </form>
                @else
                    <form action="/events/join/{{ $event->id }}" method="POST">
                        @csrf
                        <a href="/events/join/{{ $event->id }}"
                           class="btn btn-primary"
                           id="event-submit"
                           onclick="event.preventDefault();
            this.closest('form').submit();">
                            Confirmar Presença
                        </a>
                    </form>
                @endif
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o evento:</h3>
                @if($event->description)
                    <p class="event-description">{{ $event->description }}</p>
                @else
                    <p class="event-description-null">O responsável pelo evento não disponibilizou uma descrição.</p>
                @endif
            </div>
        </div>
    </div>

@endsection
