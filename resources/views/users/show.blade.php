@extends('layouts.user')

@section('title')
    Пользователь {{$user->username}}
@endsection

@push('assets')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
    <script src="{{ asset('js/usersCRUD/index.js') }}"></script>
@endpush

@section('content')
    <a href="{{route('user.index')}}" class="btn btn-default">< К списку</a>

    <h1> Пользователь {{$user->username}}</h1>

    <div class="block-content">

        <div class="block-padding d-flex">
            @perm('edit-user')
            <a class="btn btn-info"
               href="{{route('user.edit', [$user->id]) }}"
               role="button">
                Редактировать
            </a>
            @endperm

            @perm('delete-user')
            <form method="POST" action="{{route('user.destroy', [$user->id]) }}">
                @method('DELETE')
                @csrf
                <button class="btn btn-info"
                        type="submit"
                        onclick="return confirm('Вы действительно хотите удалить запись?');">
                    Удалить
                </button>
            </form>
            @endperm

            @perm('manage-users')
            @if(!$user->blocked)
                <a class="btn btn-danger"
                   href="{{route ('user.block', [$user->id])}}"
                   onclick="return confirm('Вы действительно хотите заблокировать пользователя?');">
                    Заблокировать
                </a>
            @else
                <a class="btn btn-info"
                   href="{{route ('user.unblock', [$user->id])}}">
                    Разблокировать
                </a>
            @endif
            <a class="btn btn-info"
               href="{{route ('user.resetpassword', [$user->id])}}">
                Сбросить пароль
            </a>
            @endperm
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>


        <ul class="nav nav-tabs" id="blockinfo" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#tabs-1" role="tab">
                    Основное
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tabs-2" role="tab">
                    Роли пользователя
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <h5>Сведения: </h5><br>
                <p>Логин: {{$user->username}}</p>
                <p>ФИО сотрудника: {{$user->full_name}}</p>
                <p>Статус:
                    @if ($user->blocked)
                        <span class="badge bg-danger">ЗАБЛОКИРОВАН</span>
                    @else
                        <span class="badge bg-success">Активен</span>
                    @endif
                </p>
                <p>Подразделение: {{$user->orgUnit->org_unit_code}}</p>

                @perm('manage-users')
                <p>Необходимость смены пароля:
                    @if($user->need_change_password)
                        Да
                    @else
                        Нет
                    @endif
                </p>
                @endperm

                <p>Должность: {{$user->position}}</p>
                <p>Основание: {{$user->reason}}</p>
                <p>Дата регистрации: {{$user->created_at}}</p>
                <p>Дата обновление данных: {{$user->updated_at}}</p>
            </div>
            <div class="tab-pane" id="tabs-2" role="tabpanel">
                <h5>Пользователь имеет роли: </h5><br>
                <ol>
                    @foreach($user->roles as $role)
                        <li>{{ $role->name }} ({{$role->slug}})</li>
                    @endforeach
                </ol>
            </div>
        </div>
@endsection
