@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/langues.add_a_new_langue'))
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/langues.create_page_title') }}" :indexes="[
        ['name' => trans('langue'), 'route' => route('langues.index')],
        ['name' => trans('pages/langues.add_a_new_langue'), 'current' => true],
    ]" />
@endsection


@section('content')

    <x-form.form method="post" action="{{ route('langues.store') }}">
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/langues.create_page_title')) }}">
            
            <div class="col-md-3 col-12">

                <x-form.file name='flag'  />
            </div>
            <div class="col-md-9 col-12">

                <x-form.input name="code" required  label="{{ trans('pages/langues.code') }}" />
                <x-form.input name="nom"  required label="{{ trans('pages/langues.nom') }}" />
            </div>

                <div class="col-12 mt-5">
                    <x-form.button />
                </div>
        </x-form.card>
    </x-form.form>
@endsection


@push('scripts')
    <script src="{{ asset('assets/js/custom/crud/langues/create.js') }}"></script>
@endpush
