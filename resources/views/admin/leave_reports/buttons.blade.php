<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">
    <button type="button" onclick="editForm('{{ route('admin.' . $route . '.show', $item->id) }}', 'show')" href="#"
        data-bs-toggle="modal" data-bs-target="#modalshow" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
    {{-- if once approved the no one can change status --}}
   
  
</form>
