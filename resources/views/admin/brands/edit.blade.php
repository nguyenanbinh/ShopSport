@extends('admin.main')
@section('content')
<h1>Edit brand</h1>
<form action="{{route('admin.brands.update',$brand->id)}}" method="post">
{{@csrf_field()}}
@method('PUT')
<div class="form-group">
    <label for="{{route('admin.brands.update',$brand->id)}}">Name</label>
    <input type="text" name="name" value="{{$brand->name}}" class="form-control">

    <input type="submit" id="updateBtn" value="Update" class="btn btn-dark">
</div>
</form>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        var warn_on_unload = "";
        $('input:text,input:checkbox,input:radio,textarea,select').one('change', function() {
            warn_on_unload = "Leaving this page will cause any unsaved data to be lost.";

            $('#updateBtn').click(function(e) {
                warn_on_unload = "";
            });

            window.onbeforeunload = function() {
                if (warn_on_unload != '') {
                    return warn_on_unload;
                }
            }
        });
    });

</script>

@endsection