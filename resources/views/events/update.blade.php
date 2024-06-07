@extends('layouts.main')

@section('title', 'Editar evento')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Editando o evento: {{ $event->title }}</h1>
        <form action="/events/{{ $event->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @METHOD('PUT')
            <div class="form-group">
                <label for="image">Imagem do Evento:</label>
                <input type="file" id="image" name="image" class="from-control-file" accept="image/*">
                <img style="width: 100px" src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
            </div>
            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento"
                       value="{{ $event->title }}">
            </div>
            <div class="form-group">
                <label for="date">Data e hora do evento:</label>
                <input type="datetime-local" class="form-control" id="date" name="date"
                       value="{{ date('Y-m-d\TH:i', strtotime($event->date)) }}">
            </div>
            <div class="form-group">
                <label for="title">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento"
                       value="{{ $event->city }}">
            </div>
            <div class="form-group">
                <label for="title">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                        <option value="0">Não</option>
                        <option value="1" {{ $event->is_private == 1 ? "selected='selected'" : "" }}>Sim</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Descrição:</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                    placeholder="O que vai acontecer no evento?">{{$event->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Adicione itens de infraestrutura:</label>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Cadeiras" {{ in_array("Cadeiras", $event->items) ? "checked" : "" }}>Cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Palco" {{ in_array("Palco", $event->items) ? "checked" : "" }}>Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Cerveja grátis" {{ in_array("Cerveja grátis", $event->items) ? "checked" : "" }}>Cerveja grátis
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open Food" {{ in_array("Open Food", $event->items) ? "checked" : "" }}>Open Food
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Brindes" {{ in_array("Brindes", $event->items) ? "checked" : "" }}>Brindes
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Criar Evento" onclick="console">
        </form>
    </div>

@endsection
