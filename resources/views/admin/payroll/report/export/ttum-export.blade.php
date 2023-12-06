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
        @foreach($reports as $key => $report)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $report->account?->name }}</td>
            <td>{{ $report->account?->account_number }}</td>
            <td>{{ $report->transaction_details }}</td>
            <td>{{ $report->transaction_currency }}</td>
            <td>{{ $report->transaction_type }}</td>
            <td>{{ $report->transaction_amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>