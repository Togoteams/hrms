<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">

    
    <button type="button" onclick="editForm('{{ route('admin.' . $route . '.edit', $item->id) }}', 'edit')" href="#"
        data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-edit btn-sm"><i
            class="fas fa-edit"></i></button>
    

   
</form>
