<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">

    <a target="_blank" href="{{ route('admin.payroll.reports.export', ['ttum_id'=>$item->id]) }}"
        class="text-white btn btn-success btn-sm">Export</a>

</form>
