<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Reclamation;

class ReclamationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(Request $request){

        Validator::make($request->all(), [
            'objet' => ['required', 'string', 'max:100'],
            'corps' => ['required', 'string', 'min:50']
        ])->validate();


        try{

            $new_reclamation=Reclamation::create(
                [
                    'objet' => $request->objet,
                    'corps' => $request->corps,
                    'titre' => $request->titre,
                    'reclamateur' => Auth::user()->id,
                ]);
            return back()->with([
                'flag'=>'success',
                'message'=> 'Réclamation transmise avec succès.'
                ]);
        }catch(Exception $e){
            return back()->with([
                'flag'=>'fail',
                'message'=> "Une erreur s\'est produite. Impossible d'envoyer votre réclamation."
                ]);

        }




    }
}
