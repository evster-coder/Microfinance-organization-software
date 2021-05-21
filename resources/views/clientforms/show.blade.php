  @extends('layouts.user')

@section('title')
	Заявка на займ №{{$clientform->id}} от {{$clientform->loanDate}}
@endsection

@push('assets')
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
@endpush

@section('content')
	<a href="{{route('clientform.index')}}" class="btn btn-default">< К списку</a>
	<h1>Заявка на займ №{{$clientform->id}} от {{$clientform->loanDate}}</h1>

	<div class="block-content">
		<div class="d-flex">
			<p class="me-3">Статус: Одобрено</p>
			<a href="{{route('loan.show')}}" class="btn btn-primary me-3">Сформировать договор</a>
			@perm('delete-clientform')
			<a href="" class="btn btn-danger">Удалить</a>
			@endperm
		</div>
		
		<x-clientform-info :clientform="$clientform"></x-clientform-info>


	</div>
	     
@endsection