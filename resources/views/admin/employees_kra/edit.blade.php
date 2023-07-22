<form id="form_edit" action="{{ route('admin.employee-kra.store') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ $data[0]->user_id}}" ,>
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="table-responsive"  id="table_data">
        <table class="table  table-bordered table-nowrap table-align-middle card-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>ATTRIBUTES </th>
                    <th>COMMENT OF REPORTING AUTHORITY</th>
                    <th>MAX. MARKS</th>
                    <th>MARKS AWARDED BY REPORTING AUTHORITY</th>
                    <th>MARKS AWARDED BY REVIEWING AUTHORITY </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $kra)
         
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td> <b>{{ $kra->name }} - </b> {{ $kra->description }}
                            <input required type="hidden" name="attribute_name[]" value="{{ $kra->attribute_name }}">
                            <input required type="hidden" name="attribute_description[]"
                                value="{{ $kra->attribute_description }}">
                        </td>
                        <td>
                            <textarea required type="text" class="form-control form-control-sm" name="commects[]">{{$kra->commects}}</textarea>
                        </td>
                        <td>{{ $kra->max_marks }}
                            <input required type="hidden" name="max_marks[]" value="{{ $kra->max_marks }}">
                        </td>
                        <td><input required type="number" maxlength="2" value="{{ $kra->marks_by_reporting_autheority}}" class="form-control form-control-sm"
                                name="marks_by_reporting_autheority[]"></td>
                        <td><input required type="number" maxlength="2" value="{{ $kra->marks_by_review_autheority}}" class="form-control form-control-sm"
                                name="marks_by_review_autheority[]"> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
