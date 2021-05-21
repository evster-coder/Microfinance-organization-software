  @extends('layouts.user')

@section('title')
	Договор займа № 123321 от 29.05.2020
@endsection

@push('assets')
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
@endpush

@section('content')
	<a href="{{route('loan.index')}}" class="btn btn-default">< К списку</a>
	<h1>Договор займа № 123321 от 29.05.2020</h1>

	<div class="block-content">

		@role('cashier')
		<a class="btn btn-warning">Закрыть договор</a>
		<div class="block-padding d-flex">

            <form method="POST" action="">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить запись?');">Удалить</button>
            </form>
        </div>
        @endrole

		<x-auth-session-status class="mb-4" :status="session('status')" />
    	<x-auth-validation-errors class="mb-4" :errors="$errors" />

		<ul class="nav nav-tabs" id="blockinfo" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-bs-toggle="tab" href="#g-tabs-1" role="tab">Основное</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-bs-toggle="tab" href="#g-tabs-2" role="tab">Анкета</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-bs-toggle="tab" href="#g-tabs-3" role="tab">Платежи</a>
			</li>
		</ul><!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="g-tabs-1" role="tabpanel">
	    		<h4>Основное</h4><br>
		        <table class="table">
		          <tbody>
		            <tr>
		              <td>Договор</td>
		              <td><p>Договор займа № 123321 от 29.05.2020</p>
		              </td>
		            </tr>
		            <tr>
		              <td>Подразделение</td>
		              <td>S-121</td>
		            </tr>
		            <tr>
		              <td>Заемщик</td>
		              <td><p>Петров Иван Иванович, 20.08.1999</p>
		              </td>
		            </tr>
		            <tr>
		              <td>Сумма займа</td>
		              <td>50000.00 руб.</td>
		            </tr>
		            <tr>
		              <td>Процентная ставка</td>
		              <td>1 %</td>
		            </tr>
		            </tr>
		            <tr>
		              <td>Задолженность</td>
		              <td>45000.00 руб.</td>
		            </tr>            
		            <tr>
		              <td>Статус</td>
		              <td>Действующий</td>
		            </tr>
		          </tbody>
		        </table>
			</div>
			<div class="tab-pane" id="g-tabs-2" role="tabpanel">
	    		<h4>Анкета</h4>
	    		<div class="d-flex block-padding">
	    			<a href="{{route('clientform.index')}}" class="btn btn-info">Страница анкеты</a>
	       	 	</div>

	    			<x-clientform-info :clientform="$clientform"></x-clientform-info>
			</div>
			<div class="tab-pane" id="g-tabs-3" role="tabpanel">
				<h4>Платежи</h4>
				@role('cashier')
	    		<div class="d-flex block-padding">
	    			<a href="{{route('payment.create')}}" class="btn btn-primary">Внести платеж</a>
	       	 	</div>
	       	 	@endrole
		    	<table class="table table-light table-hover">
		    		<thead>
						<tr class="table-primary">
							<th scope="col">Дата</th>
							<th scope="col">Сумма платежа</th>
							<th scope="col">Действия
						</tr>
		    		</thead>
		    		<tbody>
			    		<tr>
				    		<td>
			    				<strong> 30.05.2020 </strong>
			    			</td>
			    			<td>
			    				5000
			    			</td>
			    			<td>
							<div class = "d-flex manage-btns">
			                <!-- Админские кнопки редактирования и удаления -->
			                <a class="btn btn-success" href="{{route('payment.show')}}" role="button">
			                	<i class="fas fa-eye"></i>
			        		</a>

			              	<a class="btn btn-info" href="{{route('payment.create')}}" role="button">
			                	<i class="fas fa-edit"></i>
			              	</a>

			                <form method="POST" action="">
			                  @method('DELETE')
			                  @csrf
			                  <button type="submit" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить запись?');"><i class="fas fa-trash-alt"></i></button>
			                </form>

    					</div>
			    			</td>
						</tr>
						</a>
			    	</tbody>
				</table>
			</div>

		</div>
	</div>
	     
@endsection