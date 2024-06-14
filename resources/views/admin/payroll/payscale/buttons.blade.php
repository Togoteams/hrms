<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">

    @can('edit-payscale')
    <button type="button" onclick="editForm('{{ route('admin.' . $route . '.edit', $item->id) }}', 'edit')" href="#"
        data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-edit btn-sm"><i
            class="fas fa-edit"></i>
    </button>
    @endcan
    @can('delete-payscale')
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')" class="btn btn-delete btn-sm"><i
            class="fas fa-trash-alt"></i>
    </button>
   @endcan
</form>
