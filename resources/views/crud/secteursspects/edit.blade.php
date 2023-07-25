@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/secteursspects.update_secteursspects'))
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/secteursspects.edit_page_title') }}" :indexes="[
        ['name' => trans('pages/secteursspects.secteursspects'), 'route' => route('secteursspects.index')],
        ['name' => trans('pages/secteursspects.update_secteursspects'), 'current' => true],
    ]" />
@endsection
@section('content')
    @bind($model)
        <x-form.form method="post" action="{{ route('secteursspects.update', $model[$model::PK]) }}">
           
                <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/secteursspects.edit_form_title')) }}">
                   
                        <x-form.input name="nom" required label="{{ trans('pages/secteursspects.nom') }}" />
                        <x-form.text-area name="description"  label="{{ trans('pages/secteursspects.description') }}" />
                        <div class="col-12 mt-5">
                            <x-form.button />
                        </div>
                </x-form.card>
           
        </x-form.form>
    @endBinding
@endsection
