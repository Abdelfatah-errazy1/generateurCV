@extends('layout.master')
@include('include.blade-components')
@section('page_title', trans('pages/techniques.add_a_new_technique'))
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="{{ trans('pages/techniques.create_page_title') }}" :indexes="[
        ['name' => trans('pages/techniques.techniques'), 'route' => route('techniques.index', $experience)],
        ['name' => trans('pages/techniques.add_a_new_technique'), 'current' => true],
    ]" />
@endsection


@section('content')

    <x-form.form method="post" action="{{ route('techniques.store') }}">
        <x-form.card col="col-12 row" title="{{ ucwords(trans('pages/techniques.edit_form_title')) }}">
            <div class="col-12 col-md-3">
                <x-form.file name="logoTech" label="{{ trans('pages/techniques.logoTech') }}" />
            </div>
            <div class="col-12 col-md-9 row">
                <x-form.input name="titre" required  label="{{ trans('pages/techniques.titre') }}" />
                <x-form.text-area name="description" label="{{ trans('pages/techniques.description') }}" />
            </div>
            <input name="experience" hidden value="{{ $experience }}" />

            <div class="col-12 mt-5">
                <x-form.button />
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
