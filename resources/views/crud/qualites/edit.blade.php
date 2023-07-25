@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/qualites.update_qualites'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/qualites.edit_page_title') }}"
        :indexes="[
        ['name'=> trans('pages/qualites.qualites') , 'route'=> route('qualites.index',$model['profil'])],
        ['name'=> trans('pages/qualites.update_qualites') ,     'current' =>true ],
    ]"
    />
@endsection
@section('content')
    @bind($model)

    <x-form.form
        method="post"
        action="{{ route('qualites.update' , $model[$model::PK]) }}"
    >
        <div class="col-12 row">
            <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/qualites.update_qualites')) }}">

                <x-form.input name="titre" required label="{{ trans('pages/qualites.titre') }}"/>


                <div class="col-12 mt-5">
                    <x-form.button/>
                </div>
            </x-form.card>
        </div>
    </x-form.form>

    @endBinding
@endsection
