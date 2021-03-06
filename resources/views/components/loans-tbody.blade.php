@if($loans->total() == 0)
    <tr>
        <td colspan="5">
            Ничего не найдено...
        </td>
    </tr>
@endif

@foreach($loans as $loan)
    <tr>
        <td>{{$loan->loan_number}}</td>
        <td>{{$loan->loan_conclusion_date}}</td>
        <td>{{$loan->clientForm->client->fullName}}</td>
        <td>{{$loan->status_open ? 'Открыт' : 'Закрыт'}}</td>
        <td>
            <div class="d-flex manage-btns">
                <a class="btn btn-success"
                   href="{{route('loan.show', ['id' => $loan->id])}}"
                   role="button">
                    <i class="fas fa-eye"></i>
                </a>

                @perm('delete-loan')
                <form method="POST" action="{{route('loan.destroy', ['id' => $loan->id])}}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger"
                            type="submit"
                            onclick="return confirm('Вы действительно хотите удалить запись?');">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                @endperm
            </div>
        </td>
    </tr>
@endforeach

<tr class="pagination-tr">
    <td colspan="6" align="center">
        <p class="pagination-p">
            Текущая страница {{$loans->currentPage()}} из {{$loans->lastPage()}}
        </p>
        {{ $loans->links('pagination::bootstrap-4') }}
    </td>
</tr>
