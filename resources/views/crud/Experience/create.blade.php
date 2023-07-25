@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/Experiences.addExp'))
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/Experiences.create_page_title') }}" :indexes="[
        ['name' => trans('pages/Experiences.experience'), 'route' => route('experiences.index', $profil)],
        ['name' => trans('pages/Experiences.addExp'), 'current' => true],
    ]" />
@endsection
@section('content')

    <x-form.form method="post" action="{{ route('experiences.store') }}">
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
                <input type="number" name="profil" hidden value="{{ $profil }}" />


                <div class="col-12 mt-5">
                    <x-form.button />
                </div>
        </x-form.card>

    </x-form.form>
    @endsection
    @push('scripts')
    <script src="{{ asset('assets/js/custom/crud/countries.js') }}"></script>
    <script src="{{ asset('assets/js/custom/crud/createCountries.js') }}"></script>

    @endpush