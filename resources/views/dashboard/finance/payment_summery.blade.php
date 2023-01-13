<x-dashboard.layout>
    
    
    @section('styles')
    
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    
    @endsection
    
    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Payment Summery</h4>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white all_datable">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Invoice</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Payble Amount</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>342543</td>
                            <td>-</td>
                            <td>500000</td>
                            <td>10000</td>
                            <td>40000</td>                            
                            
                        </tr>
                         <tr>
                            <td>2</td>
                            <td>342543</td>
                            <td>-</td>
                            <td>500000</td>
                            <td>10000</td>
                            <td>40000</td>                            
                            
                        </tr>
                         <tr>
                            <td>3</td>
                            <td>342543</td>
                            <td>-</td>
                            <td>500000</td>
                            <td>10000</td>
                            <td>40000</td>                            
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
    @section('scripts')
        

        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        
        <script type="text/javascript">
        
         $('.all_datable').DataTable();
         
         
        </script>
        
    @endsection
</x-dashboard.layout>