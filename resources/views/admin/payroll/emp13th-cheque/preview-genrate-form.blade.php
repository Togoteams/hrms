<style>
    table{
    
        border: 1px solid black;
    }
    td{
        border: 1px solid black;
    }
    
</style>
@if($financial_year)
<div class="report-display-section">
    @if ($employees)
    <table class="table" >
        <tr>
            <td colspan="12">
                Payment of 13th Cheque {{$financial_year_text}} Of Branch  </td>
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
                <td> {{ $employe['total_amount']}} <input type="hidden" name="total_amount__[{{ $employe['user_id'] }}]" value="{{ $employe['total_amount'] }}"></td>
                <td>{{ $employe['average_amount']}}  <input type="hidden" name="average_amount__[{{ $employe['user_id'] }}]" value="{{ $employe['average_amount'] }}"></td>
                <td>{{ $employe['total_i_tax_amount']}}  <input type="hidden" name="total_i_tax_amount__[{{ $employe['user_id'] }}]" value="{{ $employe['total_i_tax_amount'] }}"></td>
                <td>{{ $employe['net_payable_amount']}}  <input type="hidden" name="net_payable_amount__[{{ $employe['user_id'] }}]" value="{{ $employe['net_payable_amount'] }}"></td>
                <td>{{ $employe['bank_account_number']}}</td>

            </tr>
        @endforeach
    </table>
    @endif
   
</div>
@endif