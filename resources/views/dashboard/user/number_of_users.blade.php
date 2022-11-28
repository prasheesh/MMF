<x-dashboard.layout>
    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Number of B2B Users</h4>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User ID</th>
                           
                            <th>Company Name</th>
                            <th>User Name</th>
                            <th>Phone Number</th>
                            <th>Email ID</th>
                            <th>Manage Users</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php $i=1; @endphp
                        @foreach ($users_b2b as $user)
                        <tr>
                            <td>{{$i}}</td>
                            <td>MMF{{str_pad($user->id, 6, "0", STR_PAD_LEFT);}}</td>
                           
                            <td>{{$user->name}}</td>
                            <td>{{$user->company_name}}</td> 
                            <td>{{$user->mobile_number}}</td> 
                            <td>{{$user->email}}</td>                          
                            <td class="d-flex justify-content-between">
                            @if($user->status == '1')
                                <small class="bg-success text-white plr-2 radius-3"><i class="fa fa-eye" onclick="showUser({{$user->id}}, '0');"></i></small>
                            @else
                                <small class="bg-warning text-white plr-2 radius-3"><i class="fa fa-eye-slash" onclick="showUser({{$user->id}}, '1');"></i></small>
                            @endif
                                <small class="bg-danger text-white plr-2 radius-3"><i class="fa fa-trash" onclick="delete_user({{$user->id}})"></i></small>
                            </td>
                        </tr>
                        @php $i++; @endphp                           
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            
            <hr>
            
             <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Number of B2E Users</h4>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User ID</th>
                            <th>Company Name</th>
                            <th>User Name</th>
                            <th>Phone Number</th>
                            <th>Email ID</th>
                            <th>Manage Users</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php $i=1; @endphp
                        @foreach ($users_b2e as $user)
                        <tr>
                            <td>{{$i}}</td>
                            <td>MMF{{str_pad($user->id, 6, "0", STR_PAD_LEFT);}}</td>
                           
                            <td>{{$user->name}}</td>
                            <td>{{$user->company_name}}</td> 
                            <td>{{$user->mobile_number}}</td> 
                            <td>{{$user->email}}</td>                          
                            <td class="d-flex justify-content-between">
                            @if($user->status == '1')
                                <small class="bg-success text-white plr-2 radius-3"><i class="fa fa-eye" onclick="showUser({{$user->id}}, '0');"></i></small>
                            @else
                                <small class="bg-warning text-white plr-2 radius-3"><i class="fa fa-eye-slash" onclick="showUser({{$user->id}}, '1');"></i></small>
                            @endif
                                <small class="bg-danger text-white plr-2 radius-3"><i class="fa fa-trash" onclick="delete_user({{$user->id}})"></i></small>
                            </td>
                        </tr>
                        @php $i++; @endphp                           
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

        </div>

        <footer>
            <div class="row">
                <div class="col-md-12 text-center">
                    <small>© 2022 All Rights Reserved by Makemyfly.com</small>
                </div>
            </div>
        </footer>
    </div>
    <script>
        function showUser(user_id, status)
        {
            var data = [user_id];
            $.ajax({
                url : '{{ route('manage.user.change-visibility-show') }}',
                type : 'POST',
                data : {'user_id':user_id, 'status':status},
                success : function(data, textStatus, xhr) {
                                            if (xhr.status == 201) {    
                                                $.toast({
                                                    heading: 'Success',
                                                    text: data.msg,
                                                    icon: 'success'
                                                });
                                            }
                                            window.location.href = '{{ route(('number.of.user.index')) }}'
                }
            });
        }
    
        function delete_user(user_id)
        {
            var del=confirm("Are you sure you want to delete this record?");
        if (del==true){
           alert ("record deleted")
           $.ajax({
                url : '{{ route('manage.user.delete-user') }}',
                type : 'POST',
                data : {'user_id':user_id},
                success : function(data, textStatus, xhr) {
                                            if (xhr.status == 201) {    
                                                $.toast({
                                                    heading: 'Success',
                                                    text: data.msg,
                                                    icon: 'success'
                                                });
                                            }
                                            window.location.href = '{{ route(('number.of.user.index')) }}'
                }
            });
        }else{
            alert("Record Not Deleted")
        }
            
        }
    </script>
</x-dashboard.layout>