@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/competences.add_a_new_competences'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/competences.create_page_title') }}"
        :indexes="[
        ['name'=> trans('pages/competences.competences') , 'route'=> route('competences.index',$profil)],
        ['name'=> trans('pages/competences.add_a_new_competences') ,     'current' =>true ],
    ]"
    />
@endsection


@section('content')

    <x-form.form method="post" action="{{ route('competences.store') }}" >
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/competences.edit_form_title')) }}">
           
            <x-form.input name="titre" required col="col-md-8" label="{{ trans('pages/competences.titre') }}"/>       
                <div class="form-group col-md-4 d-flex flex-column mt-8">
                  <label for="exampleRange">{{ ucwords(trans('pages/competences.level')) }}</label>
                  <input type="range" name="level" required  class="form-control-range mt-5" id="exampleRange" min="0" max="5">
                </div>
              
            <x-form.text-area name="description" label="{{ trans('pages/competences.description') }}" />
          

            <input  name="profil" hidden value="{{ $profil }}" />

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
