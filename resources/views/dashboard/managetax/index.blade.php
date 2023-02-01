<x-dashboard.layout>

    @section('styles')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">


        <style type="text/css">

            a{
                text-decoration:none;
            }
        </style>
    @endsection

    <div class="rightpart">


        <div class="row">

            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Manage Tax</h4>

            </div>
            
            <div class="col-md-12 mb-5">
                <form action="{{route('managetax.index')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label"><strong>Select User Lists</strong></label>
                            <select name="user_lists" class="form-select @error('user_lists') is-invalid @enderror">
                                <option value="" label="Select"></option>
                                @foreach ($users as $user)
                                
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>

                            @error('user_lists')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                
                            @enderror
                            
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label"><strong>Type Of Mode</strong></label>
                            <select name="type_of_mode" class="form-select @error('type_of_mode') is-invalid @enderror">
                                <option value="" label="Select"></option>
                                <option value="percentage">Percentage Type</option>
                                <option value="rupee">Amount Type</option>
                            </select>
                            @error('type_of_mode')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label"><strong>Enter Domestic Percentage/Amount</strong></label>
                            <input type="text" class="form-control allownumber @error('enterap') is-invalid @enderror" name="enterap" id="">
                            @error('enterap')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label"><strong>Enter International Percentage/Amount</strong></label>
                            <input type="text" class="form-control allownumber @error('type_of_travel') is-invalid @enderror" name="type_of_travel" id="">
                            @error('type_of_travel')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary mt-4 float-end" value="submit">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white finance_datables">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User ID</th>
                            <th>Type Of Mode</th>
                            <th>Domestic Amount/Percentage</th>
                            <th>International Amount/Percentage</th>
                        </tr>
                    </thead>

                    <tbody >
                        @php
                            $i = 1;
                        @endphp
                        
                        @foreach ($managetaxes as $managetaxe)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$managetaxe->get_user_list->name}}</td>
                            <td>{{$managetaxe->typeofmode}}</td>
                            <td>{{$managetaxe->typeoftravel}}</td>
                            <td>{{$managetaxe->enteramount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                   
                </table>
            </div>

        </div>
    </div>


    @section('scripts')

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <script type="text/javascript">

            'user strict';

            $('.finance_datables').DataTable();

           
          
        </script>

    @endsection

</x-dashboard.layout>