@extends('layout.master')
@include('include.blade-components')



@section('page_title', ucwords(trans('pages/langues.index_page_title')))

@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/langues.index_page_title') }}" :indexes="[
        [
            'name' => trans('pages/langues.index_page_title'),
            'route' => route('langues.index'),
        ],
    ]" />

@endsection

@section('content')
    @bind($collection)
        <x-table.data-table 
        :actions="$actions" 
        :heads="$heads" 
        edit-route="langues.show" 
        delete-route="langues.delete" />
    @endBinding
@endsection
