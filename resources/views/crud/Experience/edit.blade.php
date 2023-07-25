@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/Experiences.updateExp'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/Experiences.edit_page_title') }}"
        :indexes="[
        ['name'=> trans('pages/Experiences.experience') , 'route'=> route('experiences.index',$model['profil'])],
        ['name'=> trans('pages/Experiences.updateExp') ,     'current' =>true ],
    ]"
    />
@endsection
@section('content')
    @bind($model)

    <x-form.form
        method="post"
        action="{{ route('experiences.update' , $model[$model::PK]) }}"
    >
        <div class="col-12 row">
            <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/Experiences.edit_form_title')) }}">

              
                <div class="col-12 col-md-2">
                    <x-form.file name="logoEntreprise" label="{{ trans('pages/Experiences.logoEntreprise') }}" />
                </div>
                <div class="col-12 col-md-10 row">
                    <x-form.input required name="titrePoste" label="{{ trans('pages/Experiences.titrePoste') }}" />
                    <x-form.text-area required name="missionP" label="{{ trans('pages/Experiences.missionP') }}" />
                    <x-form.input-date  name="dateDebut" col="col-md-3"
                        label="{{ trans('pages/Experiences.dateDebut') }}" />
                    <x-form.input-date name="dateFin" col="col-md-3" label="{{ trans('pages/Experiences.dateFin') }}" />
                    <x-form.input required name="entreprise" col="col-md-6"
                        label="{{ trans('pages/Experiences.entreprise') }}" />
                    <x-form.select name="pays" col="col-md-6" label="{{ trans('pages/Experiences.pays') }}" />
                    <x-form.select name="ville" col="col-md-6" label="{{ trans('pages/Experiences.ville') }}" />
                    <x-form.text-area name="adresse" col="col-12" label="{{ trans('pages/Experiences.adresse') }}" />
    
                    <x-form.select col="col-md-6" name="type" label="{{ trans('pages/Experiences.type') }}"
                        :options="[
                            'S' => trans('pages/Experiences.stage'),
                            'CDI' => trans('pages/Experiences.CDI'),
                            'CDD' => trans('pages/Experiences.CDD'),
                            'L' => trans('pages/Experiences.L'),
                            'V' => trans('pages/Experiences.V'),
                            'B' => trans('pages/Experiences.B'),
                            'AE' => trans('pages/Experiences.AE'),
                        ]" />
    
                    <div class="col-md-6 mt-3">
                        <div class="d-flex flex-column">
                            <div class="mb-3">
                                <label for="formFileMultiple"
                                    class="form-label">{{ trans('pages/Experiences.jointureDip') }}</label>
                                <input class="form-control" type="file" name="jointureDip" id="formFileMultiple" multiple>
                            </div>
                        </div>
                    </div>
                    
    
    
              
                    <div class="col-12 mt-5 row gap-4">
                        <x-form.button/>
                        <a  class="app-button  btn btn-primary col-3"  href="{{ route('taches.create',$model->idE) }}">add new tache</a>
                        <a  class="app-button  btn btn-primary col-3"  href="{{ route('techniques.create',$model->idE) }}">add new technique</a>
                        <a  class="app-button  btn btn-primary col-3"  href="{{ route('profils.show',$model->profil) }}">profil</a>
                    </div>
            </x-form.card>
        </div>
    </x-form.form>
    @endBinding
    <div id="data-countries"  data-ville='{{ $model->ville }}' data-countrie='{{ $model->pays }}'></div>
    <hr class="border border-primary border-3 opacity-50">
        <div class="col-12 row mt-2">
            <a class="col-md-2 btn btn-outline-primary  rounded px-3 " name='liens' id="taches" onclick="show('tachesDiv',event)" >taches</a>
            <a  class="col-md-2 btn btn-outline-primary rounded px-3 " name='liens'  onclick="show('techniquesDiv',event)" id='techniques'>techniques</a>
          
        </div>
        <div name='lists' class="d-none" id="techniquesDiv">
            @bind( $techniques ) 
            <x-table.data-table
                :actions="$actionsTe"
                :heads="$headsTe"
                edit-route='techniques.show' 
                delete-route='techniques.delete'
            />
            @endBinding
        </div>
        <div name='lists' class="d-none" id="tachesDiv">
            @bind( $taches ) 
            <x-table.data-table
                :actions="$actionsTa"
                :heads="$headsTa"
                edit-route='taches.show' 
                delete-route='taches.delete'
            />
            @endBinding
        </div>
       
    @endsection
    @push('scripts')
       
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