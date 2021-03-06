@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
        <div class="d-flex justify-content-between justify-content-center">
            <h1 class="text-primary">User List</h1>
            <a href="{{route('user.create')}}" class="btn btn-outline-primary"><i class="material-icons">Create User</i></a>
        </div>
        <div class="card-body">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <td scope="col">id</td>
                        <td scope="col">Name</td>
                        <td scope="col">Email</td>
                        <td scope="col">Phone</td>
                        <td scope="col">Image</td>
                        <td scope="col">Role</td>
                        <td scope="col">Address</td>
                        <td scope="col">Action</td>



                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $key=>$user)
                        <tr>
                            <td> {{$key + 1}} </td>
                            <td> {{$user->name}}</td>
                            <td> {{$user->email}}</td>
                            <td> {{$user->phone}}</td>
                            <td> <img src="{{ asset(!empty($user->image) ? $user->image->url : '')}}" height="80" width="120" alt=""> </td>
                            <td> {{!empty($user->role_users) ? $user->role_users->role->title : ""}}</td>
                            <td> {{Str::limit($user->address,30)}} </td>
                            <td>
                                <a class="btn btn-info waves-effect" href="{{route('user.edit',$user->id)}}">edit</a>
                                <button class="btn btn-danger waves-effect" onclick="deleteUser({{ $user->id }})">delete</button>
                                <form id="delete-form-{{ $user->id }}" action="{{route('user.destroy',$user->id)}}" method="POST" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>

                        </tr>
                    @endforeach




                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>



@endsection


@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deleteUser(id){

        const swalWithBootstrapButtons = Swal.mixin({
customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
},
buttonsStyling: false
})

swalWithBootstrapButtons.fire({
title: 'Are you sure?',
text: "You waana delete this!",
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Yes, delete it!',
cancelButtonText: 'No, cancel!',
reverseButtons: true
}).then((result) => {
if (result.isConfirmed) {
    event.preventDefault();
    document.getElementById('delete-form-'+id).submit();
} else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
) {
    swalWithBootstrapButtons.fire(
    'Cancelled',
    'Your imaginary file is safe :)',
    'error'
    )
}
})

    }
</script>

@endpush
