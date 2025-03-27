<style>
    .table{
    
        width: 100%;
        font-size: 10px;
        border: 1px solid black;
    }
    .table td{
            border: 1px solid black;
            padding: 2px;
        }
    
    
</style>
@if($financial_year)
<div class="report-display-section">
    @if ($employees)
    <table class="table" >
        <tr>
            <td colspan="19">
                Payment of 13th Cheque {{$financial_year_text}} Of Branch {{ $branch->name }}  </td>
        </tr>
        <tr>
            <td>Employees Name</td>
            <td>EC Number</td>
            @foreach ($months as $keyM => $month )
            <td>{{$month['month']['lable']."-".$month['year']}} Basic</td>
            @endforeach
            <td> Total</td>
            <td> Average</td>
            <td> I.Tax</td>
            <td> Net payable</td>
            <td> Account No.</td>
            
        </tr>
        @foreach($emp13ChequeReport as $key => $employe)
            <tr>
                <td>{{ $employe['name_of_employee']}} <input type="hidden" name="employee_users_ids[]" value="{{ $employe['user_id'] }}"></td>
                <td>{{ $employe['ec_number']}}</td>
                @foreach ($employe['months'] as $keyM => $month )
                <td> {{$month['basic']}} <div>
                    <input type="hidden" name="month_[{{ $month['month_key'] }}][{{ $employe['user_id'] }}]" value="{{ $month['basic'] }}">    
                </div>  </td>
                
                @endforeach 
                <td> {{ number_format($employe['total_amount'],2)}} <input type="hidden" name="total_amount__[{{ $employe['user_id'] }}]" value="{{ $employe['total_amount'] }}"></td>
                <td>{{ number_format($employe['average_amount'],2)}}  <input type="hidden" name="average_amount__[{{ $employe['user_id'] }}]" value="{{ $employe['average_amount'] }}"></td>
                <td>{{ number_format($employe['total_i_tax_amount'],2)}}  <input type="hidden" name="total_i_tax_amount__[{{ $employe['user_id'] }}]" value="{{ $employe['total_i_tax_amount'] }}"></td>
                <td>{{ number_format($employe['net_payable_amount'],2)}}  <input type="hidden" name="net_payable_amount__[{{ $employe['user_id'] }}]" value="{{ $employe['net_payable_amount'] }}"></td>
                <td>{{ $employe['bank_account_number']}}</td>

            </tr>
        @endforeach
    </table>
    @endif
   
</div>
@endif