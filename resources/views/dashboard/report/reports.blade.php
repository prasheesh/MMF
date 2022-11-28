<x-dashboard.layout>
    <div class="rightpart">
        <div class="row">
            <div class="col-md-7 mb-3">
                <h4 style="font-weight: 700">Reports</h4>
            </div>
            <div class="col-md-3 ms-auto mb-2 float-end">
                <form>
                    <select class="form-select">
                        <option value="">Filter</option>
                        <option value="">Number of Bookings</option>
                        <option value="">Number of Volumes</option>
                        <option value="">Profits</option>
                    </select>
                </form>
            </div>
             <div class="clearfix mb-3"></div>

            <div class="col-md-12 mb-2">
                <div id="educationChart" class="report">
                    <svg></svg>
                </div>
            </div>

            <div class="clearfix mb-2"></div>
            

            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Booking ID</th>
                            <th>Sector</th>
                            <th>Date of Booking</th>
                            <th>Class</th>
                            <th>No. of Passengers</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>MMF000001</td>
                            <td>Hyderabad to Mumbai</td>
                            <td>16-08-2022</td>
                            <td>Economy</td>
                            <td>03</td>
                            <td class="d-flex justify-content-between">
                                <span>MMFInv158478</span>
                                <span><a href="#"><i class="fa fa-eye"></i></a></span>
                            </td>
                            <td>15000</td>
                            <td><small class="bg-success text-white plr-2 radius-3">Completed</small></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>MMF000003</td>
                            <td>Hyderabad to Banglore</td>
                            <td>16-08-2022</td>
                            <td>Business</td>
                            <td>03</td>
                            <td class="d-flex justify-content-between">
                                <span>MMFInv158555</span>
                                <span><a href="#"><i class="fa fa-eye"></i></a></span>
                            </td>
                            <td>12000</td>
                            <td><small class="bg-success text-white plr-2 radius-3">Completed</small></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>MMF000008</td>
                            <td>Hyderabad to Vijayawada</td>
                            <td>16-08-2022</td>
                            <td>First Class</td>
                            <td>1</td>
                            <td class="d-flex justify-content-between">
                                <span>MMFInv158445</span>
                                <span><a href="#"><i class="fa fa-eye"></i></a></span>
                            </td>
                            <td>25000</td>
                            <td><small class="bg-success text-white plr-2 radius-3">Completed</small></td>
                        </tr>
                        
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
</x-dashboard.layout>