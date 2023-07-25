@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/qualites.add_a_new_qualites'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/qualites.create_page_title') }}"
        :indexes="[
        ['name'=> trans('pages/qualites.qualites') , 'route'=> route('qualites.index',$profil)],
        ['name'=> trans('pages/qualites.add_a_new_qualites') ,     'current' =>true ],
    ]"
    />
@endsection


@section('content')

    <x-form.form
        method="post"
        action="{{ route('qualites.store') }}"
    >
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/qualites.create_page_title')) }}">

            <input name="profil" hidden value="{{ $profil }}" />

            <x-form.input name="titre" required label="{{ trans('pages/qualites.titre') }}"/>


            <div class="col-12 mt-5">
                <x-form.button/>
            </div>
        </x-form.card>

    </x-form.form>

@endsection


@push('scripts')
@endpush
