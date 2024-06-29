@extends('layouts.admin') 

@section('content')
    <div class="container">
        <!-- Intestazione della pagina con titolo e pulsante per aggiungere nuovi progetti -->
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mt-2">Lista Progetti</h1>
            <span class="fs-4 add-btn d-flex align-items-center justify-content-center text-white me-5">
                <a href="{{ route("admin.projects.create") }}"><i class="fa-solid fa-plus"></i></a>
            </span>
        </div>
        <!-- Descrizione e suggerimento per aggiungere progetti -->
        <div class="d-flex justify-content-between align-items-center">
            <p>Clicca il nome per avere maggiori informazioni</p>
            <p class="me-1">Aggiungi progetto</p>
        </div>

        <!-- Messaggi di sessione per le operazioni di eliminazione, caricamento e modifica -->
        @if (session("messageDelete"))
            <div class="alert alert-success">
                {{ session("messageDelete") }}
            </div>
        @endif

        @if (session("messageUpload"))
            <div class="alert alert-primary">
                {{ session("messageUpload") }}
            </div>
        @endif

        @if (session("messageEdit"))
            <div class="alert alert-primary">
                {{ session("messageEdit") }}
            </div>
        @endif

        <!-- Tabella con la lista dei progetti -->
        <table class="table table-striped table-hove ms-body">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Linguaggio</th>
                    <th scope="col">Campo</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <!-- Link per visualizzare maggiori informazioni sul progetto -->
                        <td><a href="{{ route("admin.projects.show", ["project" => $project->slug]) }}">{{ $project->title }}</a></td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->type->name }}</td>
                        <td>{{ $project->type->field }}</td>
                        <td>
                            <!-- Pulsante per eliminare il progetto, apre il modale -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $project->id }}">Elimina</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modale Eliminazione -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- HEADER del modale di eliminazione -->
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- BODY del modale di eliminazione -->
                <div class="modal-body">
                    <span>Vuoi davvero eliminare l'elemento definitivamente?</span>
                </div>
                <!-- FOOTER del modale di eliminazione -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Chiudi</button>
                    <!-- Form per eliminare definitivamente il progetto -->
                    <form id="deleteForm" action="" method="POST">
                        @method("DELETE")
                        @csrf
                        <button class="btn btn-danger">Elimina definitivamente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script per gestire l'azione del modale di eliminazione -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var projectId = button.getAttribute('data-id');
                var form = deleteModal.querySelector('#deleteForm');
                form.action = '/admin/projects/' + projectId;
            });
        });
    </script>
@endsection
