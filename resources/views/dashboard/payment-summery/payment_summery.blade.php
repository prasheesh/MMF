<x-dashboard.layout>
    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Payment Summery</h4>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white">
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
                        @php$i = 1;
                            $total = 0;
                        @endphp
                        @foreach ($paymentSummaries as $ps)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>Invoice</td>
                                <td>Description</td>
                                <td>{{ $ps->allotted_balance }}</td>
                                <td>
                                    {{ $ps->used_balance }}
                                </td>
                                <td> {{ $ps->allotted_balance - $ps->used_balance }}</td>
                                {{-- users->user_booking_history()->sum('amount'); --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard.layout>
