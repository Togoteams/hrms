<div class="row">
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="basic">Total Gross Salary</label>
            <input  value="{{number_format($totalPaidSalary,3,'.','')}}" readonly required id="gross_salary" placeholder="Enter correct Basic" type="text" name="gross_salary"  class="form-control form-control-sm">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="reimbursement_amount">Total Reimbursement Amount</label>
            <input  value="{{number_format($reimbursementAmount,3,'.','')}}"  required id="reimbursement_amount" placeholder="Enter correct Basic" type="text" name="reimbursement_amount"  class="form-control form-control-sm">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="taxable_amount">Total Taxable Amount</label>
            <input  value="{{number_format($taxableAmount,3,'.','')}}"  required id="taxable_amount" placeholder="Enter correct Basic" type="text" name="taxable_amount"  class="form-control form-control-sm">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="tax_amount">Total Tax Amount</label>
            <input  value="{{number_format($tax_amount,2,'.','')}}"  required id="tax_amount" placeholder="Enter correct Basic" type="text" name="tax_amount"  class="form-control form-control-sm">
        </div>
    </div>
    
</div>

@if (isset($edit))
<div class="text-center ">
    <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
        {{ $page }}</button>
</div>
@else
<div class="text-center ">
    <button onclick="ajaxCall('form_data','','POST')" type="button" class="btn btn-white">Create
        {{ $page }}</button>
</div>
@endif