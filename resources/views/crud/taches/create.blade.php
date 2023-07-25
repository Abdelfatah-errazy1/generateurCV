@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/taches.add_a_new_tache'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/taches.create_page_title') }}"
        :indexes="[
        ['name'=> trans('pages/taches.taches') , 'route'=> route('taches.index',$experience)],
        ['name'=> trans('pages/taches.add_a_new_tache') ,     'current' =>true ],
    ]"
    />
@endsection


@section('content')

    <x-form.form method="post" action="{{ route('taches.store') }}" >
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/taches.edit_form_title')) }}">
           
            <x-form.input name="titre" required  label="{{ trans('pages/taches.titre') }}"/>       
            <x-form.text-area name="description" label="{{ trans('pages/taches.description') }}" />
          

            <input  name="experience" hidden value="{{ $experience }}" />

            <div class="col-12 mt-5">
                <x-form.button/>
            </div>
        </x-form.card>

    </x-form.form>
@endsection


@push('scripts')
<script>
    $(document).ready(function() {
  $('input[type="range"]').on('input', function() {
    var value = $(this).val();
    var progress = (value / 5) * 100;
    $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', value);
  });
});

</script>
@endpush
@push('style')
<style>
    .progress {
  height: 20px;
  margin-top: 20px;
}

.progress-bar {
  background-color: #007bff;
  height: 100%;
}

</style>
@endpush
