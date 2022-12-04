@extends('layouts.modal')
@section('contnet')
<form id="target" data-action="features" action="" method="post" class="form-horizontal">
    @csrf
    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Name ')}}</label>
        <div class="col-7">
            <input required type="text" class="form-control " name="name" >
            <p class="invalid-feedback"></p>
        </div>
    </div>

    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Description ')}}</label>
        <div class="col-7">
            <textarea required type="text" class="form-control"  cols="40" rows="5" name="description" ></textarea>
            <p class="invalid-feedback"></p>
        </div>
    </div>

    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Price')}}</label>
        <div class="col-7">
            <input required type="text" class="form-control " name="price" >
            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Price After Discount')}}</label>
        <div class="col-7">
            <input required type="text" class="form-control " name="price_after_discount" >
            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Whose Work')}}</label>
        <div class="col-7">
            <div class="form-check">
                <input class="form-check-input" value="1" type="radio" name="flag" id="flag1" checked>
                <label class="form-check-label" for="flag1">
                  Price
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" value="2" type="radio" name="flag" id="flag2" >
                <label class="form-check-label" for="flag2">
                    Price After Discount
                </label>
              </div>
            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Categories')}}</label>
        <div class="col-7">
            <select name="category_id" class="js-example-basic-single form-select form-control ">
                <option value="">{{__('Choose Category ...')}}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Vendor')}}</label>
        <div class="col-7">
            <select name="user_id" class="js-example-basic-single form-select form-control " multiple>
                <option value="">{{__('Choose Vendor ...')}}</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-offset-2 col-7">
            <input id="btn-submit-modal" value="{{__('Add')}}" hidden type="submit" class="btn btn-primary" >
        </div>
    </div>
</form>
@endsection
@section('js')
<script>$id = ''</script>
<script>
    myDropzoneForModal('products')
    $('.js-example-basic-single').select2();
  </script>
<script>
    $("button#btn-submit").on('click', function(event){
        event.preventDefault();
        var $this = $(this).parent().parent().find('form');
        fail = true;
        http.checkRequiredFelids($this);
        if(!fail){
            return true;
        }
        var buttonText = $this.find('button:submit').text();
        data = {
            _token: $("meta[name='csrf-token']").attr("content"),
            name: $.trim($this.find("input[name='name']").val()),
            user_id: $.trim($this.find("select[name='user_id']").val()),
            description: $.trim($this.find("textarea[name='description']").val()),
            price: $.trim($this.find("input[name='price']").val()),
            price_after_discount: $.trim($this.find("input[name='price_after_discount']").val()),
            flag: $.trim($this.find("input[name='flag']").val()),
            category_id: $.trim($this.find("select[name='category_id']").val()),
        }
        $this.find("button:submit").attr('disabled', true);
        $this.find("button:submit").html('<span class="fas fa-spinner" data-fa-transform="shrink-3"></span>');

        $.post($("meta[name='BASE_URL']").attr("content") + "/admin/products", data,
        function (response, status) {
            $id = response.data.id;
            $myDropzone.userId = $id
            $myDropzone.processQueue();
            http.success({ 'message': response.message });
            // window.location.reload();
        })
        .fail(function (response) {
            http.fail(response.responseJSON, true);
        })
        .always(function () {
            $this.find("button:submit").attr('disabled', false);
            $this.find("button:submit").html(buttonText);
        });
});


</script>

@endsection 