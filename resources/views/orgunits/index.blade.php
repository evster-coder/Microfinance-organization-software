@extends('layouts.user')

@section('title')
    Структура организации
@endsection

@push('assets')
    <script src="{{ asset('js/orgunits.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/orgunits.css') }}">
@endpush

@section('content')
    <h1>Структура организации</h1>
    <div class="content-block">
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
        <div class="card">
            <div class="card-header"><h5><strong>Список подразделений</strong></h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="d-flex block-padding">
                        @perm('create-orgunit')
                        <a class="btn btn-primary disabled"
                           href=""
                           data-url="{{route('orgunit.create')}}"
                           id="btn-add">
                            Добавить
                        </a>
                        @endperm
                        @perm('edit-orgunit')
                        <a class="btn btn-primary disabled"
                           href=""
                           data-url="{{route('orgunit.index')}}"
                           id="btn-edit">
                            Редактировать
                        </a>
                        @endperm
                        <a class="btn btn-primary disabled"
                           href=""
                           data-url="{{route('orgunit.index')}}"
                           id="btn-show">
                            Просмотреть
                        </a>
                        @perm('delete-orgunit')
                        <form action="{{route('orgunit.destroy')}}" method="POST" id="formDelete">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="org_unit_id" id="org_unit_id">
                            <a class="btn btn-danger disabled"
                               href=""
                               data-url="/orgunit"
                               id="btn-delete">
                                Удалить
                            </a>
                        </form>
                        @endperm

                    </div>
                    <div class="col-md-6">
                        @if($orgUnits->count() == 0)
                            <h5>Отсутствуют структурные подразделения!</h5>
                        @else
                            <ul id="treeStructure">

                                @foreach($orgUnits as $orgUnit)
                                    <div class="d-flex">

                                        <li class="expanded-orgunit single-unit">
                                            @if($orgUnit->childOrgUnits)
                                                <i class="fas fa-search-minus can-expand"></i>
                                            @else
                                                <i class="fas fa-book"></i>
                                            @endif
                                            <strong data-value="{{$orgUnit->id}}">{{$orgUnit->org_unit_code }}</strong>
                                            @if($orgUnit->childOrgUnits)
                                                <x-manage-child-tree
                                                    :childs="$orgUnit->childOrgUnits"></x-manage-child-tree>
                                            @endif
                                        </li>
                                    </div>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
