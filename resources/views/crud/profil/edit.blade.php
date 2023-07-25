@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/profils.updatePro'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/profils.edit_page_title') }}"
        :indexes="[
        ['name'=> trans('words.profil') , 'route'=> route('profils.index')],
        ['name'=> trans('pages/profils.updatePro') ,     'current' =>true ],
    ]"
    />
@endsection
@section('content')
{{-- @dd($model) --}}
    @bind($model)

    <x-form.form
        method="post"
        action="{{ route('profils.update' , $model[$model::PK]) }}"
    >
            <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/profils.edit_form_title')) }}">

                <div class="col-12 col-md-2">
                    <x-form.file name="avatar" label="{{ trans('words.avatar') }}"/>
                </div>
                <div class="col-12 col-md-10 row">
                    <x-form.input required  name="cin" col="col-md-4" label="{{ trans('words.cin') }}"/>
                    <x-form.input required name="nom" col="col-md-4" label="{{ trans('words.name') }}"/>
                    <x-form.input required name="prenom" col="col-md-4" label="{{ trans('words.prenom') }}"/>
                    <x-form.radios required  col="col-md-4" name="genre" label="{{ trans('words.gender') }}"
                        :radios="[
                            [
                                'value' => 'H',
                                'label' => 'Homme',
                            ],
                             [
                                'value' => 'F',
                                'label' => 'Femme',
                            ]
                        ]"
                    />
                    <x-form.select col="col-md-4" name="civilite" label="{{ trans('words.civilite') }}"
                    :options="[  
                           'C' => trans('words.celibataire'),
                           'M' =>  trans('words.marie'),
                           'D' =>  trans('words.divorce'),
                           'V' =>  trans('words.veuf'),  
                        ]"
                    />
                    <x-form.input-date required name="dateNaissance" col="col-md-4" label="{{ trans('words.dateNaissance') }}"/>
                    <x-form.radios required col='col-md-4' name="etat" label="{{ trans('words.etat') }}"
                        :radios="[
                            [
                                'value' => 'O',
                                'label' => 'Oui',
                            ],
                             [
                                'value' => 'N',
                                'label' => 'Non',
                            ]
                        ]"
                    />
                    <x-form.input required  name="titre" col="col-md-8" label="{{ trans('words.titre') }}"/>
                    <x-form.text-area name="sousTitre" label="{{ trans('words.sousTitre') }}"/>
                    <x-form.input required name="gsm1" col="col-md-3" label="{{ trans('words.gsm1') }}"/>
                    <x-form.input name="gsm2" col="col-md-3" label="{{ trans('words.gsm2') }}"/>
                    <x-form.input  type='email' required name="email" col="col-md-6" label="{{ trans('words.email') }}"/>
                    <x-form.input name="linkden" col="col-md-6" label="{{ trans('words.linkden') }}"/>
                    <x-form.input name="facebook" col="col-md-6" label="{{ trans('words.facebook') }}"/>
                    <x-form.input name="instagram" col="col-md-6" label="{{ trans('words.instagram') }}"/>
                    <x-form.input name="siteWeb" col="col-md-6" label="{{ trans('words.siteWeb') }}"/>
                    <x-form.select name="pays" col="col-md-6" label="{{ trans('words.country') }}" />
                    <x-form.select name="ville" col="col-md-6" label="{{ trans('words.ville') }}"/>
                    <x-form.text-area name="adresse" col="col-12" label="{{ trans('words.adresse') }}"/>
                    <x-form.text-area name="observation" col="col-12" label="{{ trans('words.observation') }}"/>
    
                    <div class="col-12 mt-5">
                        <x-form.button/>
                    </div>

            </x-form.card>
        </div>
    </x-form.form>

    @endBinding

    <div class="container">              
      
        <div class="d-flex justify-content-evenly">
            <a href="{{ route('experiences.create',$model->id) }}" class="col-3 btn btn-primary m-3" >Ajouter Expérience</a>
            <a href="{{ route('diplomes.create',$model->id) }}" class="col-3 btn btn-primary m-3" >Ajouter Diplome</a>
            <a href="{{ route('competences.create',$model->id) }}" class="col-3 btn btn-primary m-3" >Ajouter Competence</a>
        </div>
        
        <div class="mt-2 d-flex justify-content-evenly">
            <a href="{{ route('profilLangues.create',$model->id) }}" class="col-3 btn btn-primary m-3" >Affecter Langue</a>
            <a href="{{ route('loisirs.create',$model->id) }}" class="col-3 btn btn-primary m-3" >Ajouter Loisirs</a>
            <a href="{{ route('qualites.create',$model->id) }}" class="col-3 btn btn-primary m-3" >Ajouter Qualité</a>
        </div>
   
        <div class="hr"></div>
        <hr class="border border-primary border-3 opacity-50">
        <div class="col-12 row mt-2">
            <a class="col-md-2 btn btn-outline-primary  rounded px-3 " name='liens' id="experiences" onclick="show('experiencesDiv',event)" >experiences</a>
            <a  class="col-md-2 btn btn-outline-primary rounded px-3 " name='liens'   onclick="show('diplomesDiv',event)" id='diplomes'>diplomes</a>
            <a  class="col-md-2 btn btn-outline-primary rounded px-3 " name='liens'  onclick="show('qualitesDiv',event)" id="qualites" >qualites</a>
            <a  class="col-md-2 btn btn-outline-primary rounded px-3 " name='liens'  onclick="show('competencesDiv',event)" id="competences" >compentences</a>
            <a class="col-md-2 btn btn-outline-primary rounded px-3 "  name='liens' onclick="show('loisirsDiv',event)" id="loisirs" >loisirs</a>
            <a  class="col-md-2 btn btn-outline-primary rounded px-3 " name='liens'  onclick="show('languesDiv',event)" id="langues" >langues</a>
            
        </div>
        
        {{-- @dd($code) --}}
        <div name='lists' id="diplomesDiv" class="d-none">
            @bind( $diplomes ) 
            <x-table.data-table
                :actions="$actionsD"
                :heads="$headsD"
                edit-route='diplomes.show' 
                delete-route='diplomes.delete'
                :more-routes="[
                    [
                        'name' => 'download',
                        'route' => 'diplomes.download',
                        'paras' => [[
                                        'idD' => null
                                    ],
                        'blank' => true,
                    ],
                    ]
                    ]"
            />
            @endBinding
        </div>
        <div name='lists' class="d-none" id="experiencesDiv">
            @bind( $experiences ) 
            <x-table.data-table
                :actions="$actionsE"
                :heads="$headsE"
                edit-route='experiences.show' 
                delete-route='experiences.delete'
                :more-routes="[
                    [
                        'name' => 'download',
                        'route' => 'experiences.download',
                        'paras' => [[
                                        'idE' => null
                                    ],
                        'blank' => true,
                    ],
                    ]
                    ]"
            />
            @endBinding
        </div>
        <div name='lists' class="d-none" id="competencesDiv">
            @bind( $competences ) 
            <x-table.data-table
                :actions="$actionsC"
                :heads="$headsC"
                edit-route='competences.show' 
                delete-route='competences.delete'
            />
            @endBinding
        </div>
        <div name='lists' class="d-none" id="languesDiv">
            @bind( $langues ) 
            <x-table.data-table
                :actions="$actionsLang"
                :heads="$headsLang"
                delete-route='profilLangues.delete'
            />
            @endBinding
        </div>
        <div name='lists' class="d-none" id="loisirsDiv">
            @bind( $loisirs ) 
            <x-table.data-table
                :actions="$actionsL"
                :heads="$headsL"
                edit-route='loisirs.show' 
                delete-route='loisirs.delete'
            />
            @endBinding
        </div>
        <div name='lists' class="d-none" id="qualitesDiv">
            @bind( $qualites ) 
            <x-table.data-table
                :actions="$actionsQ"
                :heads="$headsQ"
                edit-route='qualites.show' 
                delete-route='qualites.delete'
            />
            @endBinding
        </div>
        
       
    </div>


    <div id="data-countries"  data-ville='{{ $model->ville }}' data-countrie='{{ $model->pays }}'></div>
    @endsection
    @push('scripts')
        {{-- <script src="{{ asset('countries.js') }}"></script> --}}
         <script src="{{ asset('assets/js/custom/crud/countries.js') }}"></script>
        <script src="{{ asset('assets/js/custom/crud/editCountries.js') }}"></script> 
        <script>
            
            function show(id,e){
                const lists = document.getElementsByName('lists');
                const liens = document.getElementsByName('liens');
                const element = document.getElementById(id);
                    
                    for(let i=0 ;i<lists.length;i++){
                        liens[i].classList.remove('btn-primary')
                        lists[i].classList.add('d-none')
                    }
                    e.target.classList.add('btn-primary')
                    element.classList.remove('d-none')

                }
        </script>

    @endpush