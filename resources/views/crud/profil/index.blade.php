@extends('layout.master')
@include('include.blade-components')



@section('page_title' , 'liste profils')
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="liste des profils"
        :indexes="[

            [
               'name'=> 'liste des profils',
               'route'=> route('profils.index')
           ],
        ]"
    />

@endsection
@section('content')
    @bind( $collection )
        <x-table.data-table
            :actions="$actions"
            :heads="$heads"
            edit-route="profils.show"
            delete-route="profils.delete"
        />
    @endBinding
@endsection


