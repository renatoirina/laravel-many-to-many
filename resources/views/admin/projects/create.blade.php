@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mt-2">Aggiungi Progetto</h1>
        <div class="d-flex justify-content-between">
            <!-- Informazione sul modulo e link per annullare -->
            <p>Compila il form per aggiungere un nuovo progetto alla tua lista.</p>
            <a href="{{ route('admin.projects.index') }}" class="text-danger">Annulla</a>
        </div>

        <!-- Visualizza gli errori di validazione, se presenti -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="errors-style">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form per aggiungere un nuovo progetto -->
        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <!-- Campo per il titolo del progetto -->
                <label for="titolo" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="title"
                    value="{{ old('title') }}">

                <!-- Campo per la descrizione del progetto -->
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea type="text-area" class="form-control" id="descrizione" aria-describedby="descrizione" name="description">{{ old('description') }}</textarea>

                <div class="d-flex gap-5">
                    <!-- Selezione del tipo di progetto (campo) -->
                    <div class="d-flex flex-column">
                        <label class="mt-1 mb-2" for="type">Seleziona un campo</label>
                        <select class="fs-6 p-1" name="type_id" id="type">
                            <option disabled="disabled" selected="selected">Seleziona un campo</option>
                            @foreach ($types as $type)
                                <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selezione delle tecnologie usate nel progetto -->
                    <div class="d-flex flex-column">
                        <span class="mt-1 mb-2">Seleziona un linguaggio</span>
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            @foreach ($technologies as $technology)
                                <!-- Checkbox per ogni tecnologia disponibile -->
                                <input type="checkbox" class="btn-check" id="technology-{{ $technology->id }}"
                                    value="{{ $technology->id }}" name="technologies[]"
                                    @if (in_array($technology->id, old('technologies', []))) checked @endif>
                                <label class="btn btn-outline-primary"
                                    for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pulsante per inviare il modulo -->
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
@endsection
