@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rédiger Une Nouvelle Réclamation') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-sm-12 mt-5">
                        <div class="d-flex flex-row justify-content-center">
                          
                          @if(session('flag'))
                            @if(session('flag')=='fail')
                            <div class="col-md-10">
                              <div class="alert alert-danger alert-with-icon w-60" data-notify="container">
                                <i class="fas fa-exclamation-circle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <i class="fas fa-times"></i>
                                </button>
                              <span>{{session('message')}}</span>
                              </div>
                            </div>
                            @else
                            @if(session('flag')=='success')
                            <div class="col-md-10">
                              <div class="alert alert-success alert-with-icon w-60" data-notify="container">
                                <i class="fas fa-check-circle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <i class="fas fa-times"></i>
                                </button>
                              <span>{{session('message')}}</span>
                              </div>
                            </div>
                            @endif
            
                            @endif
                              
                          @endif
                        </div>
                      </div>

                    <div>
                        <form action="{{url('api')}}" method="POST">
                            @csrf
                            
                              
                              <div class="form-group">
                                  <label for="objet-input" >Objet de la reclamation</label>
                                  <select id="objet-input"  name="objet" class="form-control" required>
                                      <option selected>Veuillez choisir l'objet de la réclamations...</option>
                                      <option value="Excavations dangereuses sur les mitoyennetés">Excavations dangereuses sur les mitoyennetés</option>
                                      <option value="Travaux entamés sans autorisation">Travaux entamés sans autorisation</option>
                                      <option value="Intervention d’un voisin sur les éléments  de  structure  du  bâtiment">Intervention d’un voisin sur les éléments  de  structure  du  bâtiment</option>
                                      <option value="Construction sur terrasse">Construction sur terrasse </option>
                                      <option value="Autre">Autre</option>
                                    </select>
                                    @error('objet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="titre-input">Titre</label>
                                  <input type="text" class="form-control" id="titre-input" name="titre" placeholder="Titre (Optionel)">
                                    @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="corps-input">Contenu de la réclamation</label>
                                  <textarea class="form-control" id="corps-input" name="corps" placeholder="Description de votre réclamation" required></textarea>

                                  @error('corps')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            
                            <button type="submit" class="btn btn-primary float-right">Envoyer</button>
                          </form>
                    </div>

                    
                    
                </div>
            </div>
            
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste de vos réclamations') }}</div>
                <div class="card-body">
                    <table class="table table-striped table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col" class="tetxt-center">Date</th>
                            <th scope="col" class="tetxt-center">Titre</th>
                            <th scope="col" class="tetxt-center">Corps</th>
                            <th scope="col" class="tetxt-center">Etat</th>
                            
                          </tr>
                          
                        </thead>
                        <tbody>
                          @foreach ($reclamations as $reclamation)
                          <tr>
                            
                            <td class="text-center">{{ $reclamation->date}}</td>
                            <td class="text-center">{{ $reclamation->titre}}</td>
                            <td class="text-center">{{ $reclamation->corps}}</td>
                            <td class="text-center">
                              <span class="badge badge-pill {{ $reclamation->etat=="ECA"? "badge-warning": ($reclamation->etat=="NF"? "badge-danger":
                                ($reclamation->etat=="ATV"?"badge-info":( $reclamation->etat=="VAL"?"badge-success":"")))
                                }}">
                              {{ $reclamation->etat=="ECA"? "En cours d'analyse":($reclamation->etat=="NF"? "Non fondée":
                              ($reclamation->etat=="ATV"?"Fondée, en cours de validation": ( $reclamation->etat=="VAL"?"Validée":"")))
                            }}
                              </span>
                            </td>
                           
                          
                          </tr>
                
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
