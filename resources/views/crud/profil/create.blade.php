@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/profils.addPro'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/profils.create_page_title') }}"
        :indexes="[
        ['name'=> trans('words.profil') , 'route'=> route('profils.index')],
        ['name'=> trans('pages/profils.addPro') ,     'current' =>true ],
    ]"
    />
@endsection


@section('content')

    <x-form.form
        method="post"
        action="{{ route('profils.store') }}"
    >
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/profils.edit_form_title')) }}">

            <div class="col-12 col-md-2">
                <x-form.file name="avatar" label="{{ trans('words.avatar') }}"/>
            </div>
            <div class=" col-12 col-md-10 row">
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
                <x-form.input type='email' required name="email" col="col-md-6" label="{{ trans('words.email') }}"/>
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

    </x-form.form>
    {{-- <div id="asa" data-data="{{ json_encode( $data) }}"></div> --}}
    
    @endsection
    @push('scripts')
       
        <script src="{{ asset('assets/js/custom/crud/countries.js') }}"></script>
        <script src="{{ asset('assets/js/custom/crud/createCountries.js') }}"></script>

    @endpush   