@extends('layouts.modal')

@section('contnet')
<form id="target" data-action="type_of_vendors" action="" method="post" class="form-horizontal">
    @csrf
    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Name')}}</label>
        <div class="col-7">
            <input required type="text" class="form-control " name="name"  value="{{$item->name}}">
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
<script>$id = {{$item->id}}</script>
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
        }
        $this.find("button:submit").attr('disabled', true);
        $this.find("button:submit").html('<span class="fas fa-spinner" data-fa-transform="shrink-3"></span>');

        $.ajax({
            url: $("meta[name='BASE_URL']").attr("content") + '/admin/type_of_vendors/' + $id,
            type: 'PUT',
            data:data
        })
        .done(function(response) {
            http.success({ 'message': response.message });
            window.location.reload();
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