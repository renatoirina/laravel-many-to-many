@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mt-2">Aggiungi Progetto</h1>
        <!-- Descrizione e link per annullare l'operazione -->
        <div class="d-flex justify-content-between">
            <p>Compila il form per aggiungere un nuovo progetto alla tua lista.</p>
            <a href="{{ route('admin.projects.index') }}" class="text-danger">Annulla</a>
        </div>

        <!-- Se ci sono errori nella validazione, vengono mostrati qui -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="errors-style">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form per creare un nuovo progetto -->
        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            <!-- Campo per il titolo del progetto -->
            <div class="mb-3">
                <label for="titolo" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="title"
                    value="{{ old('title') }}">

                <!-- Campo per la descrizione del progetto -->
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea type="text-area" class="form-control" id="descrizione" aria-describedby="descrizione" name="description">{{ old('description') }}</textarea>

                <!-- Sezione per selezionare il tipo di linguaggio e la tecnologia usata -->
                <div class="d-flex gap-5">
                    <div class="d-flex flex-column">
                        <label class="mt-1 mb-2" for="type">Seleziona un linguaggio</label>
                        <select class="fs-6 p-1" name="type_id" id="type">
                            <option disabled="disabled" selected="selected">Seleziona un linguaggio</option>
                            @foreach ($types as $type)
                                <!-- Verifica se l'opzione selezionata è quella vecchia e la seleziona di conseguenza -->
                                <option @selected(old('type_id') == $type->id ? 'selected' : '') value="{{ $type->id }}">{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex flex-column">
                        <label class="mt-1 mb-2" for="technology">Seleziona una tecnologia usata</label>
                        <select class="fs-6 p-1" name="technologies[]" id="technology" multiple>
                            <option disabled="disabled" selected="selected">Seleziona una tecnologia usata</option>
                            @foreach ($technologies as $technology)
                                <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- Pulsante per inviare il form -->
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
@endsection
