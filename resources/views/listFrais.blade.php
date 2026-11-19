@extends('layouts.master')

@section('content')
    <h1>Liste des fiches de frais</h1>

    <table class="table table-striped mt-3">
        <thead>
        <tr>
            <th>Mois</th>
            <th>Titre</th>
            <th>Modification</th>
            <th>Montant saisi</th>
            <th>Nb justificatifs</th>
            <th>Montant validé</th>
            <th>Etat</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($fiches as $frais)
            <tr>
                <td>{{ $frais->anneemois }}</td>
                <td>{{ $frais->titre }}</td>
                <td>{{ $frais->datemodification }}</td>
                <td></td>
                <td>{{ $frais->nbjustificatifs }}</td>
                <td>{{ $frais->montantvalide }}</td>
                <td>{{ $frais->lib_etat }}</td>
                <td><a href="{{ url('/editerFrais/' . $frais->id_frais) }}">Modifier</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
