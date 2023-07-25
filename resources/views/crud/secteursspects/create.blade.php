@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/secteursspects.add_a_new_secteursspects'))
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/secteursspects.create_page_title') }}" :indexes="[
        ['name' => trans('SecteurSpect'), 'route' => route('secteursspects.index')],
        ['name' => trans('pages/secteursspects.add_a_new_secteursspects'), 'current' => true],
    ]" />
@endsection


@section('content')

    <x-form.form method="post" action="{{ route('secteursspects.store') }}">
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/secteursspects.create_page_title')) }}">
                <x-form.input name="nom" col="col-12" required label="{{ trans('pages/secteursspects.nom') }}" />
                <x-form.text-area name="description"  col="col-12" label="{{ trans('pages/secteursspects.description') }}" />
                <div class="col-12 mt-5">
                    <x-form.button />
                </div>
        </x-form.card>
    </x-form.form>
@endsection


@push('scripts')
    <script src="{{ asset('assets/js/custom/crud/secteursspects/create.js') }}"></script>
@endpush
