<x-dashboard.layout>
    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Finance History</h4>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-warning-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">Daily</p>
                        <h2><b>1500</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-danger-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">Weekly</p>
                        <h2><b>2500</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-info-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">Monthly</p>
                        <h2><b>5000</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-success-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">All</p>
                        <h2><b>100000</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
            </div>

            <div class="clearfix mb-3"></div>
            <div class="col-md-3 ms-auto mb-2 float-end">
                <form>
                    <input type="text" class="form-control" placeholder="Search by User Name / ID" />
                </form>
            </div>

            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                             <th>User ID</th>
                            <th>Booking ID</th>
                            <th>Sector</th>
                            <th>No. Of Passengers</th>
                            <th>Invoice</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>12345</td>
                            <td>MMF000001</td>
                            <td>Hyderabad to Mumbai</td>
                            <td>02</td>
                            <td class="d-flex justify-content-between">
                                <span>MMFInv158478</span>
                                <span><a href="#"><i class="fa fa-eye"></i></a></span>
                            </td>
                            <td><small class="bg-success text-white plr-2 radius-3">Completed</small></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>12345</td>
                            <td>MMF000002</td>
                            <td>Hyderabad to Singapoor</td>
                            <td>5</td>
                            <td class="d-flex justify-content-between">
                                <span>MMFInv158848</span>
                                <span><a href="#"><i class="fa fa-eye"></i></a></span>
                            </td>
                            <td><small class="bg-success text-white plr-2 radius-3">Completed</small></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>12345</td>
                            <td>MMF000003</td>
                            <td>Hyderabad to Dubai</td>
                            <td>4</td>
                            <td class="d-flex justify-content-between">
                                <span>MMFInv158121</span>
                                <span><a href="#"><i class="fa fa-eye"></i></a></span>
                            </td>
                            <td><small class="bg-danger text-white plr-2 radius-3">Pending</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</x-dashboard.layout>