<x-dashboard.layout>

    @section('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/datatable/dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/datatable/jquery.dataTables.min.css') }}}">
    @endsection

    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Manage Users</h4>
            </div>

            <form action="{{ route('manage.user.index') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="form-label"> <strong>Company Name</strong></label>
                        <input type="text" class="form-control" name="company_name" id="">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label"> <strong>User Name</strong></label>
                        <input type="text" class="form-control" name="user_name" id="">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label"> <strong>Phone Name</strong></label>
                        <input type="text" class="form-control allownumber" name="phone_name" id="">
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="submit" class="btn btn-primary float-end" value="search" id="">
                    </div>
                </div>
            </form>


            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white all_datable">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User ID</th>
                            <th>User Type</th>
                            <th>User Name</th>
                            <th>E-mail ID</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>User Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>MMF{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    {{ $user->user_type }}
                                </td>
                                <td>
                                    <a href="{{ route('manage.user.show', $user->id) }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile_number }}</td>
                                <td>{{ $user->address }}</td>
                                <td class="d-flex justify-content-between">
                                    @if ($user->status == '1')
                                        <small class="bg-success text-white plr-2 radius-3"
                                            onclick="showUser({{ $user->id }}, '0');"><i
                                                class="fa fa-eye"></i></small>
                                    @else
                                        <small class="bg-warning text-white plr-2 radius-3"
                                            onclick="showUser({{ $user->id }}, '1');"><i
                                                class="fa fa-eye-slash"></i></small>
                                    @endif
                                    <small class="bg-danger text-white plr-2 radius-3"
                                        onclick="delete_user({{ $user->id }})"><i class="fa fa-trash"></i></small>
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/dataTables.bootstrap5.min.js') }}"></script>

        <script>
            $('.all_datable').DataTable();

            function showUser(user_id, status) {
                swal({
                        title: "Are you sure?",
                        // text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var data = [user_id];
                            $.ajax({
                                url: '{{ route('manage.user.change-visibility-show') }}',
                                type: 'POST',
                                data: {
                                    'user_id': user_id,
                                    'status': status
                                },
                                success: function(data, textStatus, xhr) {
                                    if (xhr.status == 201) {
                                        $.toast({
                                            heading: 'Success',
                                            text: data.msg,
                                            icon: 'success'
                                        });
                                    }
                                    window.location.href = '{{ route('manage.user.index') }}'
                                }
                            });
                        } else {
                            // swal("Your imaginary file is safe!");
                        }
                    });
            }

            function delete_user(user_id) {
                var del = confirm("Are you sure you want to delete this record?");
                if (del == true) {
                    alert("record deleted")
                    $.ajax({
                        url: '{{ route('manage.user.delete-user') }}',
                        type: 'POST',
                        data: {
                            'user_id': user_id
                        },
                        success: function(data, textStatus, xhr) {
                            if (xhr.status == 201) {
                                $.toast({
                                    heading: 'Success',
                                    text: data.msg,
                                    icon: 'success'
                                });
                            }
                            window.location.href = '{{ route('manage.user.index') }}'
                        }
                    });
                } else {
                    alert("Record Not Deleted")
                }

            }
        </script>
    @endsection
</x-dashboard.layout>
