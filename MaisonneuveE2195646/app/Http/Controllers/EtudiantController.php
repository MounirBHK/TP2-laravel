<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $listeEtudiants = Etudiant::select('etudiants.*', 'users.name as nom')
                                    ->JOIN('users','users.id','=','etudiants.userId')
                                    ->get();
        return view('etudiant.index',['listeEtudiants' => $listeEtudiants]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listeVilles = Ville::all();
        return view('auth.infouser', ['listeVilles' => $listeVilles]);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'adresse' => 'required',
            'villeId' => 'required',
            'phone' => 'required',
            'date_de_naissance' => 'required',
         ]);
        
        $newEtudiant = new Etudiant;
        $newEtudiant->fill($request->all());
        $newEtudiant->save();

        // $newEtudiant = Etudiant::create([
        //     'adresse' => $request->adresse,
        //     'villeId' => $request->villeId,
        //     'phone' => $request->phone,
        //     'userId' => $request->userId,
        //     'date_de_naissance' => $request->date_de_naissance,
        // ]);

        return redirect(route('etudiant.show', $newEtudiant->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        $id = Session::get('id');
        $user = User::find($id);
        
        $etudiant = Etudiant::select('etudiants.*', 'villes.nom as ville', 'users.name as nom', 'users.email as email')
                                    ->JOIN('villes','villes.id','=','etudiants.villeId')
                                    ->JOIN('users','users.id','=','etudiants.userId')
                                    ->WHERE('etudiants.id', $etudiant->id ) 
                                    ->get();

        return view('auth.show-infouser', ['user' => $user,'etudiant' => $etudiant[0]]);
    }
    
    /**
     * myspace
     *
     * @param  mixed $request
     * @return void
     */
    public function myspace(Request $request)
    {    
        if (Session::has('id'))
        {
            $id = Session::get('id');
            $user = User::find($id);
            $etudiant = Etudiant::select('etudiants.*', 'villes.nom as ville', 'users.name as nom', 'users.email as email')
                                    ->JOIN('villes','villes.id','=','etudiants.villeId')
                                    ->JOIN('users','users.id','=','etudiants.userId')
                                    ->WHERE('etudiants.userId',  $user->id ) 
                                    ->get();

            return view('auth.show-infouser', ['user' => $user, 'etudiant' => $etudiant[0]]);
        }
        return view('welcome');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        $user = User::find($etudiant->userId);

        $selectVilles = Ville::all(); 
        return view('etudiant.edit', ['etudiant' => $etudiant, 'user' => $user, 'listeVilles' => $selectVilles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant, User $user)
    {
        $request->validate([
            'name' => 'required|between:2,20',
            'adresse' => 'required',
            'villeId' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'date_de_naissance' => 'required',
        ]);
        
        $user = User::find($etudiant->userId); 

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        $etudiant->update([
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'date_de_naissance' => $request->date_de_naissance,
            'villeId' => $request->villeId
        ]);

        return redirect(route('etudiant.show', $etudiant->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant, User $user)
    {
        // return 'test';
        $user = User::find($etudiant->userId);
        $etudiant->delete();
        $user->delete();
        return redirect(route('etudiants'));
    }
}
