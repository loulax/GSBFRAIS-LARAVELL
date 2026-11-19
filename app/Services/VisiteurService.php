<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\Visiteur;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class VisiteurService
{
    public function signIn($login, $pwd)
    {
        try {
            $visiteur = Visiteur::query()->where('login_visiteur', '=', $login)->first();
            if ($visiteur && $visiteur->pwd_visiteur == $pwd) {
                Session::put('id_visiteur', $visiteur->id_visiteur);
                Session::put('visiteur', "$visiteur->prenom_visiteur $visiteur->nom_visiteur");
                return true;
            }
            return false;
        } catch (QueryException $exception) {
            $userMessage = "Erreur d'accès à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function signOut()
    {
        Session::remove('id_visiteur');
        Session::remove('visiteur');
    }
}
