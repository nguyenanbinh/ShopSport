@extends('admin.main')

@section('content')
    <h1>List Role</h1>


    <button type="button" class="btn btn-dark" style="margin-bottom: 1em">
        <a href="{{ route('admin.roles.create') }}">Add Role</a>
    </button>

    <table class="table table-bordered" style="width: 100%;margin-top: .5em">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($roles as $role)
                <tr>
                    <td> <a href="{{ route('admin.roles.view',$role->id ) }}" data-id="{{ $role->id }}"
                            class="role_id">{{ $role->name }}</a></td>
                    {{-- <td>{{ $role->name }}</td> --}}
                    <td><a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-dark" role="button">Edit</a>
                    </td>
                    <td> <a href="{{ route('admin.roles.assign.list', $role->id) }}" class="btn btn-dark">Assign
                            Permission</a></td>

                    <td>
                        <form action="{{ route('admin.roles.delete', $role->id) }}" method="post">
                            {{ @csrf_field() }}
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div>
        {{ $roles->links() }}
    </div>
@endsection

@section('script')
    <script>
        let $this = $(this);
            let url =$this.attr('href');
        $('.role_id').popover({
            
    html: true,
    trigger: 'hover',
    content: function() {
      return $.ajax({url: url,
                     dataType: 'html',
                     async: false}).done(function (result) { 

console.log(result);
if(result){
    $("content").html('').append(result);
}

});

    </script>
@endsection
