<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Models\Frais;
use App\Services\FraisService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FraisController extends Controller
{
    public function listFrais()
    {
        try {
            $service = new FraisService();
            $id_visiteur = session('id_visiteur');
            $fiches = $service->getListFrais($id_visiteur);

            return view('listFrais', compact('fiches'));
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function addFrais()
    {
        try {
            $frais = new Frais();
            $frais->anneemois = date("Y-m");

            $etats = [new Etat()];
            $etats[0]->lib_etat = "Création en cours";

            return view('formFrais', compact('frais', 'etats'));
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function editFrais($id)
    {
        try {
            $service = new FraisService();
            $frais = $service->getFrais($id);
            $etats = $service->getListEtats();

            $erreur = Session::get('erreur');
            Session::remove('erreur');

            return view('formFrais', compact('frais', 'etats', 'erreur'));
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function validFrais(Request $request)
    {
        try {
            $id_frais = $request->input('id');
            $service = new FraisService();

            if ($id_frais) {
                $frais = $service->getFrais($id_frais);
                $frais->id_etat = $request->input('etat');
            } else {
                $frais = new Frais();
                $frais->id_visiteur = session('id_visiteur');
                $frais->id_etat = 2;
            }

            $frais->anneemois = $request->input('mois');
            $frais->titre = $request->input('titre');
            $frais->nbjustificatifs = $request->input('nbjustif');
            $frais->montantvalide = $request->input('valide');
            $frais->datemodification = date("Y-m-d");

            $service->saveFrais($frais);

            return redirect('/listerFrais');
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function removeFrais($id)
    {
        try {
            $service = new FraisService();
            $service->deleteFrais($id);

            return redirect('/listerFrais');
        } catch (Exception $exception) {
            if ($exception->getCode() == 23000) {
                Session::put('erreur', $exception->getUserMessage());
                return redirect(url('/editerFrais/' . $id));
            }
            return view('error', compact('exception'));
        }
    }
}
