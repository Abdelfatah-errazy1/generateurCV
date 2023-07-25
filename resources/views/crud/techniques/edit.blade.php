@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/techniques.update_technique'))
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/techniques.edit_page_title') }}" :indexes="[
        ['name' => trans('pages/techniques.techniques'), 'route' => route('experiences.show',$model['experience'])],
        ['name' => trans('pages/techniques.update_technique'), 'current' => true],
    ]" />
@endsection
@section('content')
    @bind($model)
        <x-form.form method="post" action="{{ route('techniques.update', $model[$model::PK]) }}">
            <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/techniques.edit_form_title')) }}">
                <div class="col-12 col-md-3">
                    <x-form.file name="logoTech" label="{{ trans('pages/techniques.logoTech') }}" />
                </div>
                <div class="col-12 col-md-9 row">
                    <x-form.input name="titre" required  label="{{ trans('pages/techniques.titre') }}" />
                    <x-form.text-area name="description" label="{{ trans('pages/techniques.description') }}" />
                </div>
                <div class="col-12 mt-5">
                    <x-form.button />
                </div>
            </x-form.card>
        </x-form.form>
    @endBinding
@endsection
