<table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Transacation date</th>
            <th>Transacation No.</th>
            <th>TRAN_PARTICULAR</th>
            <th>CCY</th>
            <th>PTT</th>
            <th>Transacation Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $key => $report)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $report->transaction_at }}</td>
            <td>{{ $report->transaction_number }}</td>
            <td>{{ $report->account?->name }}</td>
            <td>{{ $report->transaction_currency }}</td>
            <td>{{ $report->transaction_type }}</td>
            <td>{{ $report->transaction_amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>