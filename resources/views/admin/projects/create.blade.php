@extends('layouts.admin')

@section('content')
    <div class="container">
        <!-- Titolo della pagina -->
        <h1 class="mt-2">Aggiungi Progetto</h1>
        <div class="d-flex justify-content-between">
            <!-- Descrizione della pagina e link per annullare e tornare alla lista dei progetti -->
            <p>Compila il form per aggiungere un nuovo progetto alla tua lista.</p>
            <a href="{{ route('admin.projects.index') }}" class="text-danger">Annulla</a>
        </div>

        <!-- Se ci sono errori di validazione, mostrali in un elenco -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="errors-style">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form per l'aggiunta di un nuovo progetto -->
        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <!-- Campo di input per il titolo del progetto -->
                <label for="titolo" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="title"
                    value="{{ old('title') }}">

                <!-- Campo di textarea per la descrizione del progetto -->
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea type="text-area" class="form-control" id="descrizione" aria-describedby="descrizione" name="description">{{ old('description') }}</textarea>

                <div class="d-flex gap-5">
                    <!-- Dropdown per selezionare il linguaggio del progetto -->
                    <div class="d-flex flex-column">
                        <label class="mt-1 mb-2" for="type">Seleziona un linguaggio</label>
                        <select class="fs-6 p-1" name="type_id" id="type">
                            <option disabled="disabled" selected="selected">Seleziona un linguaggio</option>
                            @foreach ($types as $type)
                                <option @selected(old('type_id') == $type->id ? 'selected' : '') value="{{ $type->id }}">{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Checkbox per selezionare le tecnologie utilizzate nel progetto -->
                    <div class="d-flex flex-column">
                        <span class="mt-1 mb-2">Seleziona una tecnologia</span>
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            @foreach ($technologies as $technology)
                                <input @checked(in_array($technology->id, old('technologies', []))) type="checkbox" class="btn-check"
                                    id="technology-{{ $technology->id }}" value="{{ $technology->id }}"
                                    name="technologies[]">
                                <label class="btn btn-outline-primary"
                                    for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pulsante per inviare il form -->
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
@endsection
