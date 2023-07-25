@extends('layout.master')
@include('include.blade-components')



@section('page_title', ucwords(trans('pages/secteursspects.index_page_title')))

@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/secteursspects.index_page_title') }}" :indexes="[
        [
            'name' => trans('pages/secteursspects.index_page_title'),
            'route' => route('secteursspects.index'),
        ],
    ]" />

@endsection

@section('content')
    @bind($collection)
        <x-table.data-table 
        :actions="$actions" 
        :heads="$heads" 
        edit-route="secteursspects.show" 
        delete-route="secteursspects.delete" />
    @endBinding
@endsection
