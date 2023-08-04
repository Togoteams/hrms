<form id="edit{{ $item->id }}"
    action="{{ route('admin.payroll.tax-slab-setting.destroy', $item->id) }}">
    <button type="button"
        onclick="editForm('{{ route('admin.payroll.tax-slab-setting.edit', $item->id) }}', 'edit')"
        href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
        class="btn btn-edit btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></button>
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>   