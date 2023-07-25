@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/diplome.add_a_new_diplome'))

@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/diplome.create_page_title') }}" :indexes="[
        ['name' => trans('pages/diplome.diplome'), 'route' => route('diplomes.index',$profil)],
        ['name' => trans('pages/diplome.add_a_new_diplome'), 'current' => true],
    ]" />
@endsection

@section('content')

    <x-form.form method="post" action="{{ route('diplomes.store') }}">
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/diplome.edit_form_title')) }}">
          
                <input  name="profil" hidden value="{{ $profil }}" />
                <div class=" col-12 col-md-2">
                    <x-form.file name="logoOrganisme" label="{{ trans('pages/diplome.logoOrganisme') }}"/>
                </div>
                <div class="col-md-10 row">
                    <x-form.input name="titre" col="col-md-8" required label="{{ trans('pages/diplome.titre') }}" />
                    <x-form.select name="secteur" col="col-md-4" required label="{{ trans('pages/diplome.secteur') }}" 
                    :bind-with="[\App\Models\SecteurSpect::all(), ['idS', 'nom']]" />
                    <x-form.input name="niveau" col="col-md-3" label="{{ trans('pages/diplome.niveau') }}" />
                    {{-- float --}}
                    <x-form.input type="number" step="0.01" name="score" col="col-md-3"
                        label="{{ trans('pages/diplome.score') }}" />
    
                    <x-form.input name="mention" col="col-md-6" label="{{ trans('pages/diplome.mention') }}" />
                    <x-form.input-date name="dateDebut" col="col-md-3" required label="{{ trans('pages/diplome.dateDebut') }}" />
                    <x-form.input-date name="dateFin" col="col-md-3" required label="{{ trans('pages/diplome.dateFin') }}" />
    
                    <x-form.input name="organismeDelivreur" col="col-md-6" required
                        label="{{ trans('pages/diplome.organismeDelivreur') }}" />
                    <x-form.select name="pays" col="col-md-6" label="{{ trans('pages/diplome.pays') }}"/>
                    <x-form.select name="ville" col="col-md-6" label="{{ trans('pages/diplome.ville') }}" />
                    <x-form.select name="type" col="col-md-6" label="{{ trans('pages/diplome.type') }}" 
                    :options="[
                        'C' => trans('pages/diplome.C'),
                        'B' => trans('pages/diplome.B'),
                        'D' => trans('pages/diplome.D'),
                        'A' => trans('pages/diplome.A'),
                        'S' => trans('pages/diplome.S'),
                        'At' => trans('pages/diplome.At'),
                        'P' => trans('pages/diplome.P'),
                    ]" />
                       <div class="col-md-6 mt-3">
                        <div class="d-flex flex-column">
                            <div class="mb-3">
                                <label for="diplomeJoint"
                                    class="form-label">{{ trans('pages/diplome.diplomeJoint') }}</label>
                                <input class="form-control" type="file" name="diplomeJoint" id="diplomeJoint" >
                            </div>
                        </div>
                    </div>
                </div>
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