
{{-- <form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">
    <button type="button" onclick="editForm('{{ route('admin.' . $route . '.show', $item->id) }}', 'show')" href="#"
        data-bs-toggle="modal" data-bs-target="#modalshow" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
    {{-- if once approved the no one can change status --}}
    {{-- @if ($item->status != 'approved')
        <button type="button" onclick="editForm('{{ route('admin.' . $route . '.edit', $item->id) }}', 'edit')"
            href="#" data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-edit btn-sm"><i
                class="fas fa-edit"></i></button>
    @endif
    @csrf

    @if (!isemplooye())
        <input type="hidden" name="_method" value="DELETE">
        @if ($item->status != 'approved')
            <button type="button" id="delete{{ $item->id }}"
                onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i>
            </button>
        @endif
        <button type="button"
            onclick="editForm('{{ route('admin.' . $route . '.status_modal', $item->id) }}', 'statuschange')"
            href="#" data-bs-toggle="modal" data-bs-target="#modalstatus"
            class="btn @if ($item->status == 'pending') btn-warning @elseif ($item->status == 'reject') btn-danger @elseif($item->status == 'approved') btn-success @else btn-secondary @endif btn-sm">{{ $item->status }}</button>
    @endif
  
</form> --}}
<form id="edit{{ $item->id }}" action="{{ route('admin.payroll.reimbursement.destroy', $item->id) }}">
                                        
        <button type="button"
            onclick="editForm('{{ route('admin.payroll.reimbursement.edit', $item->id) }}', 'edit')"
            href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
            class="btn btn-edit btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></button>
            @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="button" id="delete{{ $item->id }}"
            onclick="deleteRow('edit{{ $item->id}}','delete{{ $item->id}}')"
            class="btn btn-delete btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>
        </button>
        <button type="button" value="{{$item['id']}}" class="@if($item['status']=='pending') status_change @endif btn btn-success btn-sm">{{ucfirst($item['status'])}}</button>
</form>
