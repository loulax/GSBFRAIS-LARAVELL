<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\Etat;
use App\Models\Frais;
use Illuminate\Database\QueryException;

class FraisService
{
    public function getListFrais($id_visiteur)
    {
        try {
            return Frais::query()
                ->select('frais.*', 'etat.lib_etat')
                ->join('etat', 'etat.id_etat', '=', 'frais.id_etat')
                ->where('id_visiteur', '=', $id_visiteur)
                ->orderByDesc('datemodification')
                ->get();
        } catch (QueryException $exception) {
            $userMessage = "Erreur d'accès à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function getFrais($id)
    {
        try {
            return Frais::query()->find($id);
        } catch (QueryException $exception) {
            $userMessage = "Erreur d'accès à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function saveFrais(Frais $frais)
    {
        try {
            $frais->save();
        } catch (QueryException $exception) {
            $userMessage = "Erreur d'enregistrement dans la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function deleteFrais($id)
    {
        try {
            $frais = Frais::query()->find($id);
            if ($frais) {
                $frais->delete();
            }
        } catch (QueryException $exception) {
            if ($exception->getCode() == 23000) {
                $userMessage = "Impossible de supprimer une fiche avec des frais saisis";
            } else {
                $userMessage = "Erreur de suppression dans la base de données";
            }
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function getListEtats()
    {
        try {
            return Etat::query()->get();
        } catch (QueryException $exception) {
            $userMessage = "Erreur d'accès à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
}
