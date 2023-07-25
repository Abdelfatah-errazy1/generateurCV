@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/loisirs.update_loisir'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/loisirs.edit_page_title') }}"
        :indexes="[
        ['name'=> trans('pages/loisirs.loisirs') , 'route'=> route('loisirs.index',$model['profil'])],
        ['name'=> trans('pages/loisirs.update_loisir') ,     'current' =>true ],
    ]"
    />
@endsection
@section('content')
    @bind($model)

    <x-form.form
        method="post"
        action="{{ route('loisirs.update' , $model[$model::PK]) }}" >
            <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/loisirs.edit_form_title')) }}">

                <div class="col-12 col-md-3" >
                    <x-form.file name="logo" label="{{ trans('pages/loisirs.logo') }}"/>
                </div>
                <div class="col-12 col-md-9 row">
                    <x-form.input name="titre" required  label="{{ trans('pages/loisirs.titre') }}"/>
                    <x-form.text-area name="description" label="{{ trans('pages/loisirs.description') }}" />
                </div>

                <div class="col-12 mt-5">
                    <x-form.button/>
                </div>
            </x-form.card>
    </x-form.form>

    @endBinding
@endsection
