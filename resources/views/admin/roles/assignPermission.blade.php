@extends('admin.main')
@section('content')
<h1>Assign permission role</h1>

<form action="{{ route('admin.roles.assign', $role->id) }}" method="post">
{{@csrf_field()}}
 
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="{{$role->name}}" class="form-control" disabled><br>
    <label>Permission Name</label><br>
    <div class="container" style="border:2px solid #ccc; width:100%;  overflow-x: auto;padding-left: 5em;margin-left:0">
        
        @foreach ($permissions as $item)
                  @if ($role->getPermissionNames()->contains($item->name))
                  <div class="checkbox" >
                    <label><input type="checkbox" name="permissions[]" value="{{$item->name}}" checked > {{$item->name}}</label>
                  </div>
                    @else 
                    <div class="checkbox">
                        <label><input type="checkbox" name="permissions[]" value="{{$item->name}}"> {{$item->name}}</label>
                      </div>
                  @endif
                 

        @endforeach
    </div>
    <br>
    <input type="submit" id="assignBtn" value="Assign" class="btn btn-dark">
</div>
</form>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        var warn_on_unload = "";
        $('input:text,input:checkbox,input:radio,textarea,select').one('change', function() {
            warn_on_unload = "Leaving this page will cause any unsaved data to be lost.";

            $('#assignBtn').click(function(e) {
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