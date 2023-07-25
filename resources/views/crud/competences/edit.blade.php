@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/competences.update_competence'))
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/competences.edit_page_title') }}" :indexes="[
        ['name' => trans('pages/competences.competences'), 'route' => route('competences.index',$model['profil'])],
        ['name' => trans('pages/competences.update_competence'), 'current' => true],
    ]" />
@endsection
@section('content')
    @bind($model)
    <x-form.form method="post" action="{{ route('competences.update', $model[$model::PK]) }}" >
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/competences.edit_form_title')) }}">
           
            <x-form.input name="titre" required col="col-md-8" label="{{ trans('pages/competences.titre') }}"/>       
                <div class="form-group col-md-4 d-flex flex-column mt-8">
                  <label for="exampleRange">{{ ucwords(trans('pages/competences.level')) }}</label>
                  <input type="range" name="level"  class="form-control-range mt-5" value="{{ $model['level'] }}" id="exampleRange" min="0" max="5">
                </div>
              
            <x-form.text-area name="description" label="{{ trans('pages/competences.description') }}" />
          

            <div class="col-12 mt-5">
                <x-form.button/>
            </div>
        </x-form.card>

    </x-form.form>
    @endBinding
@endsection
