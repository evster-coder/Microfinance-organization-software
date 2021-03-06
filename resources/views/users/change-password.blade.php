@extends('layouts.user')

@section('title')
    Сброс пароля
@endsection

@section('content')
    <h1>Сброс пароля</h1>

    <div class="block-content block-section">
        <h5>Укажите новый пароль</h5><br>

        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{route('auth.change-password')}}">
            @method('put')
            @csrf
            <div class="row g-3 edit-fields">
                <div class="col">
                    <label for="new-password"
                           class="col-form-label">
                        Новый пароль
                    </label>
                </div>
                <div class="col">
                    <input class="form-control"
                           type="password"
                           required
                           name="new-password"
                           id="new-password">
                </div>
            </div>

            <div class="row g-3 edit-fields">
                <div class="col">
                    <label for="new-password-confirmation"
                           class="col-form-label">
                        Подтверждение
                    </label>
                </div>
                <div class="col">
                    <input class="form-control"
                           type="password"
                           required
                           name="new-password-confirm"
                           id="new-password-confirm">
                </div>
            </div>

            <div class="form-group d-flex justify-content-center mt-3">
                <button class="btn btn-danger"
                        type="submit">
                    Обновить пароль
                </button>
            </div>
        </form>

    </div>
@endsection
