<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">

    <a target="_blank" href="{{ route('admin.payroll.reports.export', ['ttum_id'=>$item->id]) }}"
        class="text-white btn btn-success btn-sm">Export</a>
        <a target="_blank" href="{{ route('admin.payroll.reports.delete', ['ttum_id'=>$item->id]) }}"
            class="text-white btn btn-success btn-sm"><i class="fas fa-trash-alt"></i></a>
</form>
