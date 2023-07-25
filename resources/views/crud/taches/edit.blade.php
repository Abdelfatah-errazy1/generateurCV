@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/competences.update_competence'))
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/competences.edit_page_title') }}" :indexes="[
        ['name' => trans('pages/competences.competences'), 'route' => route('competences.index',$model['experience'])],
        ['name' => trans('pages/competences.update_competence'), 'current' => true],
    ]" />
@endsection
@section('content')
    @bind($model)
    <x-form.form method="post" action="{{ route('competences.update', $model['experience']) }}" >
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/competences.edit_form_title')) }}">
           
            <x-form.input name="titre" required  label="{{ trans('pages/taches.titre') }}"/>       
            <x-form.text-area name="description" label="{{ trans('pages/taches.description') }}" />

            <div class="col-12 mt-5">
                <x-form.button/>
            </div>
        </x-form.card>

    </x-form.form>
    @endBinding
@endsection
