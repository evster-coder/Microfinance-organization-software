@extends('layouts.user')

@section('title')
    Клиент {{$client->surname}} {{$client->name}} {{$client->patronymic}}
@endsection

@push('assets')
    <script src="{{ asset('js/clientsCRUD/show.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
@endpush

@section('content')
    <a class="btn btn-default"
       href="{{route('client.index')}}">
        < К списку
    </a>
    <h1>Клиент {{$client->surname}} {{$client->name}} {{$client->patronymic}}</h1>
    <input type="hidden" id="clientId" value="{{$client->id}}">

    <div class="block-content">
        <div class="block-padding d-flex">
            @perm('edit-client')
            <a class="btn btn-info"
               href="{{route('client.edit', [$client->id])}}"
               role="button">
                Редактировать
            </a>
            @endperm

            @perm('delete-client')
            <form method="POST" action="">
                @method('DELETE')
                @csrf
                <button class="btn btn-info"
                        type="submit"
                        onclick="return confirm('Вы действительно хотите удалить запись?');">
                    Удалить
                </button>
            </form>
            @endperm
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
        <ul class="nav nav-tabs" id="blockinfo" role="tablist">
            <li class="nav-item">
                <a class="nav-link active"
                   data-bs-toggle="tab"
                   href="#tabs-1"
                   role="tab">
                    Основное
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   data-bs-toggle="tab"
                   href="#tabs-2"
                   role="tab">
                    Анкеты
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   data-bs-toggle="tab"
                   href="#tabs-3"
                   role="tab">
                    Договоры займов
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <h4>Основное</h4><br>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Фамилия</td>
                        <td>{{$client->surname}}</td>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td>{{$client->name}}</td>
                    </tr>
                    <tr>
                        <td>Отчество</td>
                        <td>{{$client->patronymic}}</td>
                    </tr>
                    <tr>
                        <td>Дата рождения</td>
                        <td>{{date(config('app.date_format', 'd-m-Y'), strtotime($client->birth_date))}}</td>
                    </tr>

                    <tr>
                        <td>Подразделение</td>
                        <td>{{$client->orgUnit->org_unit_code}}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div class="tab-pane" id="tabs-2" role="tabpanel">
                <h4>Анкеты</h4>
                <div class="d-flex block-padding">
                    <div class="form-group has-search px-3">
                        <strong>от</strong>
                        <span class="fa fa-search form-control-feedback"></span>
                        <input class="form-control"
                               type="date"
                               id="searchFrom"
                               placeholder="От..."/>
                    </div>
                    <div class="form-group has-search">
                        <strong>до</strong>
                        <span class="fa fa-search form-control-feedback"></span>
                        <input class="form-control"
                               type="date"
                               id="searchTo"
                               placeholder="До..."/>
                    </div>
                </div>
                <table class="table table-light table-hover" id="tableClientforms">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col">Дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    <x-client-clientforms-tbody :clientForms="$client->clientForms"/>
                    </tbody>
                </table>
                <div>
                </div>
            </div>
            <div class="tab-pane" id="tabs-3" role="tabpanel">
                <h4>Договоры займов</h4>
                <div class="d-flex block-padding">
                    <div class="form-group has-search px-3">
                        <strong>№ договора</strong>
                        <span class="fa fa-search form-control-feedback"></span>
                        <input class="form-control"
                               type="text"
                               id="searchLoanNumber"
                               placeholder="№ договора..."/>
                    </div>
                    <div class="form-group has-search">
                        <strong>от </strong>
                        <span class="fa fa-search form-control-feedback"></span>
                        <input class="form-control"
                               type="date"
                               id="searchLoanConslusionDate"
                               placeholder="Дата..."/>
                    </div>
                </div>
                <table class="table table-light table-hover"
                       id="tableLoans">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col">Номер договора</th>
                    </tr>
                    </thead>
                    <tbody>
                    <x-client-loans-tbody :loans="$client->loans"/>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
