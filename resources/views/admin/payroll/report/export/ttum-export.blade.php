<table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>PL/GL HEAD</th>
            <th>Ac No.</th>
            <th>Transaction detail</th>
            <th>Currency</th>
            <th>Dr Cr</th>
            <th>Transacation Amount</th>
        </tr>
    </thead>
    <tbody>
        @php 
        $creditAmount = 0;
        $debitAmount = 0;
        @endphp
        @foreach($reports as $key => $report)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $report->account?->name }}</td>
            <td>{{ $report->account?->account_number }}</td>
            <td>{{ $report->transaction_details }}</td>
            <td>{{ $report->transaction_currency }}</td>
            <td>{{ $report->transaction_type }}</td>
            @if($report->transaction_type=="credit")
            $creditAmount =  $creditAmount + $report->transaction_amount;
            @else
            $debitAmount =  $debitAmount + $report->transaction_amount;
            @endif
            <td>{{ $report->transaction_amount }}</td>
        </tr>
    @endforeach
        <tr>
            <td>Total Amount</td>
            <td>{{$creditAmount}}</td>
        </tr>
        <tr>
            <td>Total Debit Amount</td>
            <td>{{$debitAmount}}</td>
        </tr>
        <tr>
            <td>Round Off</td>
            <td>{{$creditAmount - $debitAmount}}</td>
        </tr>
    </tbody>
</table>