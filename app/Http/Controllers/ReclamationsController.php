<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;

class ReclamationsController extends Controller
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
    
    public function decliner($recId){
        $rec=Reclamation::find($recId);
        if($rec==null)
            return back()->with([
                'flag'=>'fail',
                'message'=> 'Reclamation invalide.'
            ]);
        $rec->etat="NF";
        $rec->save(); 
        return back()->with([
            'flag'=>'success',
            'message'=> 'Réclmation mise à jours avec succès.'
            ]);    



    }


    public function setFonde($recId){
        $rec=Reclamation::find($recId);
        if($rec==null)
            return back()->with([
                'flag'=>'fail',
                'message'=> 'Reclamation invalide.'
            ]);
        try{

            $rec->etat="ATV";
            $rec->save();    

            return back()->with([
                'flag'=>'success',
                'message'=> 'Réclmation mise à jours avec succès.'
                ]); 
        }catch(Exception $e){
            return back()->with([
                'flag'=>'fail',
                'message'=> 'Une erreur s\'est produite. Impossible de mettre à jours la réclamation.'
                ]);

        }

        


    }


    public function setValidee($recId){
        $rec=Reclamation::find($recId);
        if($rec==null)
            return back()->with([
                'flag'=>'fail',
                'message'=> 'Reclamation invalide.'
            ]);

        try{

            $rec->etat="VAL";
            $rec->save();   
            return back()->with([
                'flag'=>'success',
                'message'=> 'Réclmation mise à jours avec succès.'
                ]); 
        }catch(Exception $e){
            return back()->with([
                'flag'=>'fail',
                'message'=> 'Une erreur s\'est produite. Impossible de mettre à jours la réclamation.'
                ]);

        }



    }
}
