<table class="table table-bordered table-hover">
    <thead class="table-danger ">
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Control</th>
        <th>Created_at</th>
    </tr>
    </thead>
    <tbody>
    @foreach(\App\Category::with('getUser')->get() as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->getUser->name }}</td>
            <td>
                <a href="{{ route('category.edit',$category->id) }}" class="btn  btn-sm btn-outline-warning">Edit</a>
                <form id="delForm"   action="{{ route('category.destroy',$category->id) }}" class="d-inline-block " method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-outline-primary deleteBtn">Delete</button>
                </form>
            </td>
            <td class="text-secondary ">
                <small class="mr-3  "> <i class="fa fa-calendar-alt mr-2 "></i>   {{ $category->created_at->format('d-m-Y ') }}</small>
                <small><i class="fa fa-clock mr-2 "></i>{{ $category->created_at->format('h:i a ') }}</small>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
