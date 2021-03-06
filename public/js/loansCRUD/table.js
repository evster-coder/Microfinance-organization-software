$(document).ready(function(){

  function clearIconData()
  {
    $('#icon-loanNumber').html('');
    $('#icon-loanConclusionDate').html('');
  }


  let clientformNumber = "";
  let loanConclusionDate = "";
  let clientFIO = "";
  let statusOpen = "";
  let page = $('#hiddenPage').val();
  let sortColumn = $('#hiddenSortColumn').val();
  let sortDesc = $('#hiddenSortDesc').val();
  let tbody = $('tbody');


  function loadData()
  {
    loanNumber = $('#searchLoanNumber').val();
    clientFIO = $('#searchClientFIO').val();
    loanConclusionDate = $('#searchLoanConclusionDate').val();
    statusOpen = $('#searchStatusOpen').val();
    sortColumn = $('#hiddenSortColumn').val();
    sortDesc = $('#hiddenSortDesc').val();

    $.ajax({
     url:"/loans/get-loans?page="+ page +
          "&sortby=" + sortColumn +
          "&sortdesc=" + sortDesc +
          "&loan_number=" + loanNumber +
          "&clientFio=" + clientFIO +
          "&loan_conclusion_date=" + loanConclusionDate +
          "&status_open=" + statusOpen,

     success:function(data)
       {
        //очищаем tbody и заполняем снова
        tbody.html('');
        tbody.html(data);
       }
    })
  }

 $(document).on('keyup', '#searchLoanNumber', function(e){
    if(e.key=="Enter")
    {
      //получение данных
      loadData();
    }
 });

 $(document).on('keyup', '#searchLoanConclusionDate', function(e){
    if(e.key=="Enter")
    {
      //получение данных
      loadData();
    }
 });

 $(document).on('keyup', '#searchClientFIO', function(e){
    if(e.key=="Enter")
    {
      //получение данных
      loadData();
    }
 });

 $(document).on('change', '#searchStatusOpen', function(e){
      //получение данных
      loadData();
 });


 $(document).on('click', '.sorting', function(e){
    let sortColumn = $(this).data('column-name');
    let orderDesc = $(this).data('sorting-type');

    let newOrder = '';
    if(orderDesc == 'asc')
    {
       $(this).data('sorting-type', 'desc');
       newOrder = 'desc';
       clearIconData();

      $('#icon-'+ sortColumn).html('<i class="fas fa-angle-up"></i>');
    }
    if(orderDesc == 'desc')
    {
       $(this).data('sorting-type', 'asc');
       newOrder = 'asc';
       clearIconData();

      $('#icon-' + sortColumn).html('<i class="fas fa-angle-down"></i>');
    }

    $('#hiddenSortColumn').val(sortColumn);
    $('#hiddenSortDesc').val(newOrder);

    loadData();
 });


  $(document).on('click', '.pagination a', function(e){
    e.preventDefault();

    //новое значение страницы
    page = $(this).attr('href').split('page=')[1];
    $('#hiddenPage').val(page);

    $('li').removeClass('active');
          $(this).parent().addClass('active');

    loadData();
  });

  $(document).on('click', '#exportExcel', function(event){
    event.preventDefault();

    let url = $(this).data('export');
    loanNumber = $('#searchLoanNumber').val();
    clientFIO = $('#searchClientFIO').val();
    loanConclusionDate = $('#searchLoanConclusionDate').val();
    statusOpen = $('#searchStatusOpen').val();
    sortColumn = $('#hiddenSortColumn').val();
    sortDesc = $('#hiddenSortDesc').val();


    window.location.href = url +
          "?loan_number=" + loanNumber +
          "&clientFio=" + clientFIO +
          "&loan_conclusion_date=" + loanConclusionDate +
          "&status_open=" + statusOpen;
  });
});
