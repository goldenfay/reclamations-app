@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row mt-5 justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Historique des réclamations') }}</div>
                <div class="card-body">

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
                    <table class="table table-striped table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col" class="text-center">Date</th>
                            <th scope="col" class="text-center">Titre</th>
                            <th scope="col" class="text-center">Corps</th>
                            <th scope="col" class="text-center">Etablie par</th>
                            <th scope="col" class="text-center">Etat</th>
                            <th scope="col" class="text-center">Actions</th>
                            
                          </tr>
                          
                        </thead>
                        <tbody>
                          @foreach ($reclamations as $reclamation)
                          <tr>
                            
                            <td class="text-center">{{ $reclamation->date}}</td>
                            <td class="text-center">{{ $reclamation->titre}}</td>
                            <td class="text-center">{{ $reclamation->corps}}</td>
                            <td class="text-center">{{ $reclamation->reclamateur()->name}}</td>
                            <td class="text-center">
                              <span class="badge badge-pill {{ $reclamation->etat=="ECA"? "badge-warning": ($reclamation->etat=="NF"? "badge-danger":
                                ($reclamation->etat=="ATV"?"badge-info":( $reclamation->etat=="VAL"?"badge-success":"")))
                                }}">
                              {{ $reclamation->etat=="ECA"? "En cours d'analyse":($reclamation->etat=="NF"? "Non fondée":
                              ($reclamation->etat=="ATV"?"Fondée, en cours de validation": ( $reclamation->etat=="VAL"?"Validée":"")))
                            }}
                              </span>
                            </td>
                            <td>
                              <div class="row justify-content-between">
                                @if($reclamation->etat!="NF")
                                  <form class="col" action="{{route('declare.nonfondee',$reclamation->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="m-2 btn btn-danger" 
                                      title="Déclarer non fondue">Décliner
                                    </button>
                                    
                                  </form>
                                @endif
                                @if($reclamation->etat=="ECA" || $reclamation->etat=="NF")
                                  <form class="col" action="{{route('declare.fondee',$reclamation->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="_method" value="PUT">
                                    
                                    <button type="submit" class="m-2 btn btn-primary" 
                                      title="Déclarer comme fondue">Confirmer
                                    </button>
                                    
                                  </form>
                                @endif
                                @if($reclamation->etat!="VAL" )
                                  <form class="col" action="{{route('declare.validee',$reclamation->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="_method" value="PUT">
                                    
                                    <button type="submit" class="m-2 btn btn-success" 
                                      title="Déclarer comme fondue">Valider
                                    </button>
                                    
                                  </form>
                                @endif
                                
                                {{-- <a href="{{route('declare.nonfondee',$reclamation->id)}}">
                                </a>
                                <a href="{{route('declare.fondee',$reclamation->id)}}">
                                  <button class="col m-2 btn btn-primary" 
                                    title="Déclarer comme fondue">Décliner
                                  </button>
                                </a> --}}
                                {{-- <button class="col btn btn-round btn-danger"><i class="text-white fas fa-ban"></i></button>
                                <button class="col btn btn-round btn-primary"><i class="text-white fas fa-hourglass-start"></i></button> --}}
                              </div>
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
