@extends('layouts.user')

@section('title')
	Заявки на выдачу займа
@endsection

@push('assets')
    <link rel="stylesheet" href="{{ asset('css/clientform.css') }}">
    <script src="{{ asset('js/clientformsCRUD/table.js') }}" defer></script>
@endpush

@section('content')

		<h1>Заявки на выдачу займа</h1>

		<div class="content-block">

			<x-auth-session-status class="mb-4" :status="session('status')" />
	    	<x-auth-validation-errors class="mb-4" :errors="$errors" />


	    	@perm('create-clientform')
	      	<div class="add-clientform-btn">
	        	<a class="btn btn-primary" href="{{route('clientform.create')}}" role="button">Добавить</a>
	        </div>
	        @endperm

			<table class="table clientform-table table-bordered mb-5">
				<thead>
					<tr class="table-info">

						<th scope="col" data-column-name="clientFormNumber">
				        	<div class="form-group has-search">
				        		<p align="center">Номер заявки</p>
							    <span class="fa fa-search form-control-feedback"></span>
				      			<input type="text" name="searchClientFormNumber"
				      			 id="searchClientFormNumber" class="form-control" placeholder="Поиск..." />
				      		</div>
						</th>
						<th scope="col" data-column-name="clientFormDate">
				        	<div class="form-group has-search" style="width:13vw;">
				        		<p align="center">Дата оформления</p>
							    <span class="fa fa-search form-control-feedback"></span>
				      			<input type="date" name="searchClientFormDate"
				      			 id="searchClientFormDate" class="form-control" placeholder="Поиск..." />
				      		</div>
				      	</th>
						<th scope="col" data-column-name="clientFIO">
				        	<div class="form-group has-search">
				        		<p align="center">Клиент</p>
							    <span class="fa fa-search form-control-feedback"></span>
				      			<input type="text" name="searchClientFIO" id="searchClientFIO" class="form-control" placeholder="Поиск..." />
				      		</div>
				      	</th>
						<th scope="col">
				        	<div class="form-group has-search">
				        		<p align="center">Статус заявки</p>
					        	<select name="searchState" id="searchState" class="form-select">
					        		<option>Любой</option>
					        		<option>В рассмотрении</option>
					        		<option>Одобрена</option>
					        		<option>Отклонена</option>
					        		<option>Заключен договор</option>
					        	</select>
						  	</div></th>
						<th scope="col" ><p align="center">Действия</p></th>
					</tr>
				</thead>
				<tbody>
					<x-clientforms-tbody :clientforms="$clientforms">
					</x-clientforms-tbody>
				</tbody>
			</table>

		    <input type="hidden" name="hiddenPage" id="hiddenPage" value="1" />
    	</div>

@endsection