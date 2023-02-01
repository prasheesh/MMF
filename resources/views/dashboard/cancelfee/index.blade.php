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
                <h4 style="font-weight: 700">Add Cancellation Fee</h4>
            </div>

            <div class="col-md-12">
                <form action="{{route('cancellationfee.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label"><b>Cancellation Fee</b></label>
                            <input type="text" name="cancellation_fee" id="" value="{{cancelfees('cancellation_fee')}}" class="form-control @error('cancellation_fee') is-invalid @enderror">
                            @error('cancellation_fee')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                
                            @enderror
                        </div>
                        <div class="col-md-6  mt-2">
                            <label for="" class="form-label"><b>Cancellation Fee Tax</b></label>
                            <input type="text" name="cancellation_fee_tax" value="{{cancelfees('cancellation_fee_tax')}}" id="" class="form-control @error('cancellation_fee_tax') is-invalid @enderror">
                            @error('cancellation_fee_tax')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label"><b>Reschedule Fee</b></label>
                            <input type="text" name="reschedule_fee" id="" value="{{cancelfees('reschedule_fee')}}" class="form-control @error('reschedule_fee') is-invalid @enderror">
                            @error('reschedule_fee')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label"><b>Reschedule Fee Tax</b></label>
                            <input type="text" name="reschedule_fee_tax" value="{{cancelfees('reschedule_fee_tax')}}" class="form-control @error('reschedule_fee_tax') is-invalid @enderror" id="">
                            @error('reschedule_fee_tax')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                
                            @enderror
                        </div>
                        <div class="col-md-12 mt-2">
                            <input type="submit" value="Submit" class="btn btn-primary float-end">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @section('scripts')

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>


    @endsection

</x-dashboard.layout>