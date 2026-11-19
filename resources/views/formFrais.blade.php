@extends('layouts.master')

@section('content')
    <form method="POST" action="{{ url('/validerFrais') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $frais->id_frais }}">

        <h1>@if($frais->id_frais) Modification @else Ajout @endif Fiche de frais</h1>
        <div class="col-md-12 card card-body bg-light">
            <div class="form-group mb-3">
                <label class="col-md-3 form-label">Mois</label>
                <div class="col-md-6">
                    <input type="text" name="mois" class="form-control" maxlength="7" value="{{ $frais->anneemois }}" placeholder="AAAA-MM" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="col-md-3 form-label">Titre</label>
                <div class="col-md-6">
                    <input type="text" name="titre" class="form-control" maxlength="50" value="{{ $frais->titre }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="col-md-3 form-label">Montant saisi</label>
                <div class="col-md-6">
                    <input type="number" name="total" class="form-control" min="0" step="0.01" value="" disabled>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="col-md-12 col-md-offset-3">
                    <a href="" class="btn btn-info @if(!$frais->id_frais) disabled @endif">Frais hors forfait</a>
                    <a href="" class="btn btn-info @if(!$frais->id_frais) disabled @endif">Frais au forfait</a>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="col-md-3 form-label">Nb justificatifs</label>
                <div class="col-md-6">
                    <input type="number" name="nbjustif" class="form-control" min="0" value="{{ $frais->nbjustificatifs }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="col-md-3 form-label">Montant validé</label>
                <div class="col-md-6">
                    <input type="number" name="valide" class="form-control" min="0" step="0.01" value="{{ $frais->montantvalide }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="col-md-3 form-label">Etat</label>
                <div class="col-md-6">
                    <select name="etat" class="form-control">
                        @foreach($etats as $etat)
                            <option value="{{ $etat->id_etat }}" @if($etat->id_etat == $frais->id_etat) selected @endif>
                                {{ $etat->lib_etat }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>
            <div class="form-group">
                <div class="col-md-12 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <a href="{{ url('/listerFrais') }}" class="btn btn-secondary" role="button">Annuler</a>
                    @if($frais->id_frais)
                        <a href="{{ url('/supprimerFrais/' . $frais->id_frais) }}" id="suppr" class="btn btn-danger" onclick="return confirm('Supprimer cette fiche de frais ?')">Supprimer</a>
                    @endif
                </div>
            </div>
        </div>
    </form>

    @if(isset($erreur))
        <div class="alert alert-danger mt-3" role="alert">{{ $erreur }}</div>
    @endif
@endsection
