<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index() {
        $user = User::all();

        return view("gestion", compact("user"));
    }

    public function removeAccount($userId) {
        $u = User::find($userId);

        if ($u && $u->hasRole('modo')) {
            return redirect("/gestion")->with("error", "Vous ne pouvez pas supprimer un moderateur !");
        }

        if ($u) {
            $u->delete();
            return redirect('/gestion')->with("success", "Compte supprimé avec succès", 200);
        }


        return redirect("/gestion")->with("error", "Erreur avec l'utilisateur non trouvé", 404);
    }
}
