@extends('layouts.app')
@section('contnet')

<div class="col1556">
    <div class="gutter-b example example-compact">
        <div class="contentTabel">
            <button  type="button" class="btn btn-secondar btn--filter mr-2" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="icon-xl la la-sliders-h"></i>filter</button>
        
            <div class="mb-7 box-filter-collapse collapse"  id="collapseExample">
                <div class="row align-items-center">
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="input-icon">
                            <input type="text" class="form-control" placeholder="name..." id="kt_datatable_search_name" name="name"/>
                            <span>
                                <i class="flaticon2-search-1 text-muted"></i>
                            </span>
                        </div>
                    </div> 
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                        {{-- <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
        <div></div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-checkable"  style="margin-top: 13px !important" id="kt_datatable">
            <thead>
                <tr>
                    <th class="wd-1p no-sort">
                        <div class="checkbox-inline">
                            <label class="checkbox">
                            <input type="checkbox"  name="checkAll"/>
                            <span></span></label>
                        </div>
                    </th>
                    <th>{{__('Product Name')}} </th>
                    <th>{{__('Status')}} </th>
                    <th>{{__('Price')}} </th>
                    <th>{{__('Quantity')}} </th>
                    <th>{{__('Totla')}} </th>
                    <th>{{__('Created At')}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade edit_modal" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >{{__('Edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="add-employee-form edit_form_data">
                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{__('Cancel')}}</button>
                <button type="button" id="btn-submit" class="btn btn-primary font-weight-bold edit_send_form">{{__('Edit')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade create_modal" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >{{__('Add')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="add-employee-form create_form_data">
                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{__('Cancel')}}</button>
                <button type="button" id="btn-submit" class="btn btn-primary font-weight-bold create_send_form">{{__('create')}}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function () {
        var table = $('#kt_datatable').DataTable({
          searching: false,
          destroy: true,
          processing: true,
          serverSide: true,
          autoWidth: false,
          dom: '<"dt-top-container"<B><"dt-center-in-div"l><f>r>t<"dt-filter-spacer"><ip>',
          buttons: table_btns,
          ajax: {
            url:  "{{ route('product_transaction.manage') }}",
            data: function (d) {
                d.name = $('input[name="name"]').val()
                d.email = $('select[name="email"]').val()
            }
          },
          columns: [
            {data: 'index', name: 'index'},
            {data: 'product.name', name: 'product.name', defaultContent: "__"},
            {data: 'status', name: 'status', defaultContent: "__"},
            {data: 'price', name: 'price', defaultContent: "__"},
            {data: 'quantity', name: 'quantity', defaultContent: "__"},
            {data: 'total', name: 'total', defaultContent: "__"},
            {data: 'created_at', name: 'created_at', defaultContent: "__"},
          ],
      });
    $('.dt-top-container').addClass('d-flex justify-content-lg-between mt-5');
    $('input').on('change', function(e) {
        table.draw();
        e.preventDefault();
    });
    $('select').on('change', function(e) {
        table.draw();
        e.preventDefault();
    });
    setTimeout(() => {
    $('a[data-action="destroy"]').on('click', function (e) {  
        e.preventDefault();
        $id =$(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: $("meta[name='BASE_URL']").attr("content") + '/admin/product_transaction/' + $id,
                    type: 'DELETE',
                    data:{
                        _token: $("meta[name='csrf-token']").attr("content"),
                    }
                })
                .done(function(response) {
                    http.success({ 'message': response.message });
                    window.location.reload();
                })
                .fail(function(response){
                http.fail(response.responseJSON, true);
                })
            } else {
                swal("Your imaginary file is safe!");
            }
            });
    }); 

    }, 1000);
    
});
</script>
<script>
    $(document).on('click','.edit_item_btn',function (e) {
       e.preventDefault();
       $('.edit_form_data').html('<div class="text-center" style="margin: 150px 0px;"><i class="fas fa-spinner fa-spin" style="font-size: 50px;"></i></div>');
        $('.edit_modal').modal('show');
         
          
       var id = $(this).data("id");
        $.ajax({
            url: $("meta[name='BASE_URL']").attr("content") + '/admin/product_transaction/' + id + '/edit', 
            type: "get", 
            success: function (response) {
                if(response.code ==200){
                    $('.edit_form_data').html(response.html);
                }else if(response.validator !=null){    
                    swal({
                        text: response.validator,
                        button: "{{__('OK')}}",
                        dangerMode: true,
                    });
                    $(".contact_us").attr("disabled", false);
                }else{
                    // swal(response.message)
                }
            } 
            
        });
    });
    $('.edit_modal').on('hidden.bs.modal', function () {
      $('.edit_form_data').html();
});
</script>
<script>
    $(document).on('click','.create_item_btn',function (e) {
       e.preventDefault();
       $('.create_form_data').html('<div class="text-center" style="margin: 150px 0px;"><i class="fas fa-spinner fa-spin" style="font-size: 50px;"></i></div>');
        $('.create_modal').modal('show');
         
          
       var id = $(this).data("id");
        $.ajax({
            url: $("meta[name='BASE_URL']").attr("content") + '/admin/product_transaction/create', 
            type: "get", 
            success: function (response) {
                if(response.code ==200){
                    $('.create_form_data').html(response.html);
                }else if(response.validator !=null){    
                    swal({
                        text: response.validator,
                        button: "{{__('OK')}}",
                        dangerMode: true,
                    });
                    $(".contact_us").attr("disabled", false);
                }else{
                    // swal(response.message)
                }
            } 
            
        });
    });
    $('.create_modal').on('hidden.bs.modal', function () {
      $('.create_form_data').html();
});
</script>
@endsection
