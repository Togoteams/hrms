<div class="p-2 mt-3 table-responsive">
    <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Salary Month</th>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Basic</th>
                <th>Gross Earning</th>
                <th>Total Deduction</th>
                <th>Net Take Home</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script type="text/javascript">
    $(function() {
        var i = 1;
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.payroll.salary.index') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'pay_for_month_year',
                    name: 'pay_for_month_year'
                },

                {
                    data: 'employee.ec_number',
                    name: 'employee.ec_number'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'basic',
                    name: 'basic'
                },

                {
                    data: 'gross_earning',
                    name: 'gross_earning'
                },
                {
                    data: 'total_deduction',
                    name: 'total_deduction'
                },
                {
                    data: 'net_take_home',
                    name: 'net_take_home'
                },




                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true
                },
            ]
        });

    });
</script>
<!-- End Table -->
