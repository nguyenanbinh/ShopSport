@extends('admin.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="width:500px;float:right;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{ session('success') }}</strong>
        </div>
    @elseif(session('delete'))
        <div class="alert alert-success alert-dismissible" style="width:300px;float:right;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{ session('delete') }}</strong>
        </div>
    @elseif(session('update'))
        <div class="alert alert-success alert-dismissible" style="width:300px;float:right;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{ session('update') }}</strong>
        </div>
    @endif
    <h1>List Category</h1>
  
    <button type="button" class="btn btn-dark" style="margin-bottom: 1em">
        <a href="{{ route('admin.categories.create') }}">Add Category</a></button>
    <table class="table table-bordered" style="width: 50%;">
        <thead>
            <tr>
                <th>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                        </label>
                    </div>
                </th>
                <th>ID</th>
                <th>Name</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($categories as $category)
                <tr>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="">
                            </label>
                        </div>
                    </td>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('admin.categories.list-product', $category->id) }}" id="{{ $category->id }}">                          

                            @if (!$category->parent_id)
                                {{$category->name}} 
                                @else 
                                {{"--".$category->name }} 
                            @endif
                {{-- {{$category->name}} --}}
                </a></td>
                <td><a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-dark"
                        role="button">Edit</a></td>
                <td>
                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="post">
                        {{ @csrf_field() }}
                        @method('DELETE')
                        <input type="submit" id="delete" class="btn btn-danger" value="Delete"
                            onclick="return confirm('Are you sure to delete?')">
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $categories->links() }}
    </div>

@endsection

<!-- js -->
@section('script')

    <script>
        $(".alert-dismissible").fadeTo(5500, 100).slideUp(500, function() {
            $(".alert-dismissible").alert('close');
        });

    </script>


@endsection
