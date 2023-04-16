<form id="edit{{ $item->id }}" action="{{ route('admin.'.$route.'.destroy', $item->id) }}">
    <button type="button" onclick="editForm('{{ route('admin.'.$route.'.edit', $item->id) }}', 'edit')" href="#"
        data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-warning btn-sm"><i
            class="fas fa-edit"></i></button>
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')" class="btn btn-danger btn-sm"><i
            class="fas fa-trash-alt"></i>
    </button>

    <button type="button"
        onclick="changeStatus('{{ route('admin.'.$route.'.status', $item->id) }}','status{{ $item->id }}')"
        id="status{{ $item->id }}"
        class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm">
        @if ($item->status == 'active')
            <i class="fas fa-check-circle"></i>
        @else
            <i class="fas fa-times-circle"></i>
        @endif
    </button>
</form>
