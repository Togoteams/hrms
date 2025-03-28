<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">
    
    @can('view-leave-encashment')
    <button type="button" onclick="editForm('{{ route('admin.' . $route . '.show', $item->id) }}', 'show')" href="#"
        data-bs-toggle="modal" data-bs-target="#modalshow" class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
    </button>
    @endcan
    {{-- if once approved the no one can change status --}}
    @if ($item->status != 'approved')
    @can('edit-leave-encashment')
        <button type="button" onclick="editForm('{{ route('admin.' . $route . '.edit', $item->id) }}', 'edit')"
            href="#" data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-edit btn-sm"><i
                class="fas fa-edit"></i></button>  
     @endcan
    @endif
    @csrf

    @if (!isemplooye())
        <input type="hidden" name="_method" value="DELETE">
        @if ($item->status != 'approved')
            {{-- <button type="button" id="delete{{ $item->id }}"
                onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i>
            </button> --}}
        @endif
        @can('delete-leave-encashment')
        <button type="button"
            onclick="editForm('{{ route('admin.' . $route . '.status_modal', $item->id) }}', 'statuschange')"
            href="#" data-bs-toggle="modal" data-bs-target="#modalstatus"
            class="btn @if ($item->status == 'pending') btn-warning @elseif ($item->status == 'reject') btn-danger @elseif($item->status == 'approved') btn-success @else btn-secondary @endif btn-sm">
            {{ ucfirst($item->status) }}</button>
        @endcan
    @endif
   
</form>
