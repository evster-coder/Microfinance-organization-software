@extends('layouts.user')

@section('title')
    Справочник: Процентная ставка
@endsection

@push('assets')
    <script src="{{ asset('js/datadictsCRUD/index.js') }}" defer></script>
    <script src="{{ asset('js/datadictsCRUD/interestrate.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/datadicts.css') }}">
@endpush

@section('content')
    <h1>Справочник: Процентная ставка</h1>

    <div class="content-block">
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
        <div class="add-data-btn">
            <a class="btn btn-primary"
               href="javascript:void(0)"
               data-toggle="modal"
               id="new-data">
                Добавление
            </a>
            <div class="form-group has-search">
                <span class="fa fa-search form-control-feedback"></span>
                <input class="form-control"
                       type="text"
                       name="search"
                       id="search"
                       placeholder="Выполните поиск..."/>
            </div>
        </div>
        <table class="table table-bordered data-table"
               id="data-table"
               data-url="/interestrates/get-interestrates">
            <thead>
            <tr class="table-primary">
                <th scope="col">Значение параметра</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <x-interestrates-tbody :rates="$rates"/>
            </tbody>
        </table>
        <input type="hidden" name="hiddenPage" id="hiddenPage" value="1"/>

        <div class="modal fade" id="crud-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="dataCrudModal"></h4>
                    </div>
                    <div class="modal-body">
                        <form name="dataForm"
                              id="dataForm"
                              action="{{ route('interestrate.store') }}"
                              method="POST">
                            <input type="hidden" name="dataId" id="dataId">
                            @csrf
                            <div class="row">
                                <div class="form-group edit-fields">
                                    <label for="percent_value">Процентная ставка</label>
                                    <input class="form-control"
                                           type="number"
                                           step="0.001"
                                           name="percent_value"
                                           id="form-data"
                                           placeholder="Процентная ставка"
                                           oninput="validate()">
                                </div>
                                <div class="btn-group block-padding">
                                    <button class="btn btn-primary"
                                            type="submit"
                                            id="btn-save"
                                            name="btnsave"
                                            disabled>
                                        Подтвердить
                                    </button>
                                    <a class="btn btn-danger"
                                       href="{{route('interestrate.index')}}">
                                        Отмена
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
