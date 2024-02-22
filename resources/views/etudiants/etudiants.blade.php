@extends('index')

@section('title', 'Etudiant')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Liste des étudiants</div>
            <div class="card-body">
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
                        <i class="fas fa-plus"></i> Créer étudiant
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadStudentsModal">
                        <i class="fas fa-upload"></i> Upload liste étudiants
                    </button>
                     </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Matricule</th>
                            <th>Promotion</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                        <tr>
                            <td>{{ $etudiant->nom }}</td>
                            <td>{{ $etudiant->prenom }}</td>
                            <td>{{ $etudiant->matricule }}</td>
                            <td>{{ $etudiant->promo }}</td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modifyStudentModal"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-info" data-toggle="modal" data-target="#showStudentModal{{ $etudiant->id }}"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $etudiant->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modale pour ajouter un étudiant -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Ajouter un étudiant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">  
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('etudiant.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom :</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                            <div class="form-group">
                                <label for="matricule">Matricule :</label>
                                <input type="text" class="form-control" id="matricule" name="matricule" required>
                            </div>
                            <div class="form-group">
                                <label for="promotion">Promotion :</label>
                                <select class="form-control" id="promotion" name="promo" required>
                                    <option >Selectionnez la promotion</option>
                                    <option value="A1 A">A1 A</option>
                                    <option value="A1 B">A1 B</option>
                                    <option value="A2 A">A2 A</option>
                                    <option value="A2 B">A2 B</option>
                                    <option value="A3">A3</option>
                                    <option value="A4">A4</option>
                                    <option value="A5">A5</option>
                                </select>
                            </div>
                            
                           
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modale pour uploader une liste d'étudiants -->
<div class="modal fade" id="uploadStudentsModal" tabindex="-1" role="dialog" aria-labelledby="uploadStudentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadStudentsModalLabel">Uploader une liste d'étudiants</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('etudiants.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Sélectionnez un fichier CSV :</label>
                                <input type="file" class="form-control-file" id="file" name="file" required accept=".csv">
                            </div>
                            <button type="submit" class="btn btn-primary">Importer</button>
                        </form>
                    </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Importer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modifyStudentModal" tabindex="-1" role="dialog" aria-labelledby="modifyStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Ajouter un étudiant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">  
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('etudiant.update', ['etudiant' => $etudiant->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $etudiant->nom }}" required>
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom :</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $etudiant->prenom }}" required>
                            </div>
                            <div class="form-group">
                                <label for="matricule">Matricule :</label>
                                <input type="text" class="form-control" id="matricule" name="matricule" value="{{ $etudiant->matricule }}" required>
                            </div>
                            <div class="form-group">
                                <label for="promotion">Promotion :</label>
                                <select class="form-control" id="promotion" name="promo" required>
                                    <option value="A1 A" {{ $etudiant->promo == 'A1 A' ? 'selected' : '' }}>A1 A</option>
                                    <option value="A1 B" {{ $etudiant->promo == 'A1 B' ? 'selected' : '' }}>A1 B</option>
                                    <option value="A2 A" {{ $etudiant->promo == 'A2 A' ? 'selected' : '' }}>A2 A</option>
                                    <option value="A2 B" {{ $etudiant->promo == 'A2 B' ? 'selected' : '' }}>A2 B</option>
                                    <option value="A3" {{ $etudiant->promo == 'A3' ? 'selected' : '' }}>A3</option>
                                    <option value="A4" {{ $etudiant->promo == 'A4' ? 'selected' : '' }}>A4</option>
                                    <option value="A5" {{ $etudiant->promo == 'A5' ? 'selected' : '' }}>A5</option>
                                </select>
                            </div>
                            
                           
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showStudentModal{{ $etudiant->id }}" tabindex="-1" role="dialog" aria-labelledby="showStudentModalLabel{{ $etudiant->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showStudentModalLabel{{ $etudiant->id }}">Détails de l'étudiant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
                <p><strong>Prénom :</strong> {{ $etudiant->prenom }}</p>
                <p><strong>Matricule :</strong> {{ $etudiant->matricule }}</p>
                <p><strong>Promotion :</strong> {{ $etudiant->promo }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal{{ $etudiant->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $etudiant->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel{{ $etudiant->id }}">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet étudiant ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <form action="{{ route('etudiant.destroy', $etudiant->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    <!-- Ajoutez ici vos scripts JavaScript si nécessaire -->
@endsection
