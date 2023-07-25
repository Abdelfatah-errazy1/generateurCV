@extends('layout.master')
@include('include.blade-components')
@section('page_title' , trans('pages/langues.add_a_new_langue'))
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="{{ trans('pages/langues.create_page_title') }}"
        :indexes="[
        ['name'=> trans('words.langues') , 'route'=> route('profilLangues.index',$profil)],
        ['name'=> trans('pages/langues.add_a_new_langue') ,     'current' =>true ],
    ]"
    />
@endsection


@section('content')
<form action="{{ route('profilLangues.store') }}" method='POST' id="form"  >
    @csrf
            <input name="profil" hidden value="{{ $profil }}" />

            <table class="table">
                <thead>
                    <th>select</th>
                    <th>{{ trans('pages/langues.flag') }}</th>
                    <th>{{ trans('pages/langues.code') }}</th>
                    <th>{{ trans('pages/langues.nom') }}</th>
                    <th>{{ trans('pages/langues.level') }}</th>
                </thead>
                <tbody>
                    {{-- @dd($langueProfil) --}}
                    @foreach ($langues as $item)
                    @php $value=false; @endphp
                        <tr>
                            <td>
                                <input type="checkbox" name={{ "language[$item->idL]" }}   class="form-check-input checker"  onchange='checker(event)'
                                value="{{ $item->idL }}" 
                                        @foreach ($langueProfil as $langue )
                                               
                                            @if ($item->idL===$langue->langue)
                                                checked='checked'
                                                @php
                                                    $value=$langue->niveau;
                                                    @endphp
                                            @endif
                                            @endforeach onchange="checker() "  />
                                        </td>
                            <td><img src="{{ route('file.private.get',$item->flag) }}" width="40" alt=""></td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->nom }}</td>
                            <td>
                                <input type="number" name={{ "level[$item->idL]" }}   id="{{ "language[$item->idL]" }}" value="{{ isset($value)?$value:0 }}" class="form-control level" max="5" min="0" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-12 mt-5">
                <x-form.button/>
            </div>
        </form>

@endsection


@push('scripts')
        <script>
            const form = document.getElementById('form');
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const language=document.getElementsByName('language')
                if(language.length!==0){
                    Swal.fire(
                        'No languague checked ?',
                        'You have to add at least a langue',
                        'question'
                        )
                }else{
                    form.submit();
                }
            });
            const languageCheckboxes = document.querySelectorAll('input[name^="language"]');
            for (let i = 0; i < languageCheckboxes.length; i++) {
            const languageCheckbox = languageCheckboxes[i];
            const languageId = languageCheckbox.value; 
            languageCheckbox.addEventListener('change', function() {
                const levelInput = document.querySelector(`input[name="level[${languageId}]"]`);
                if (languageCheckbox.checked) {
                levelInput.required = true;
                } else {
                levelInput.required = false;
                }
            });
            }

        </script>
@endpush
