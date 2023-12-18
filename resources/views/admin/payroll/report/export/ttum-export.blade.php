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
            @php
                $creditAmount =  $creditAmount + $report->transaction_amount;
            @endphp
            @else
            @php
                $debitAmount =  $debitAmount + $report->transaction_amount;
            @endphp
            @endif
            <td>
                @if($report->transaction_amount=="0")
                {{ 0.00 }}
                @else
                {{ number_format($report->transaction_amount,2) }}
                @endif
            </td>
        </tr>
    @endforeach
        <tr>
            <td colspan="6" style="text-align: center">Total Amount</td>
            <td>{{number_format($creditAmount,2)}}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center">Total Debit Amount</td>
            <td>{{number_format($debitAmount,2)}}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center">Round Off</td>
            <td>{{number_format($creditAmount - $debitAmount)}}</td>
        </tr>
    </tbody>
</table>