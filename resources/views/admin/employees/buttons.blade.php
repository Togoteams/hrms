<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">

   
    <a class="btn btn-primary btn-sm text-white " href="{{ route('admin.employee.employee-kra.create', $item->user_id) }}"
        title="create Employee" target="_blank">
        <i class="fas fa-plus"></i>
    

    </a>

    <button type="button" onclick="editForm('{{ route('admin.' . $route . '.show', $item->id) }}', 'show')"
        href="#" data-bs-toggle="modal" data-bs-target="#modalshow" class="btn btn-info btn-sm"><i
            class="fas fa-eye"></i></button>

    {{-- EDIT BUTTON --}}
    <a type="button" class="btn btn-warning btn-sm"
        href="{{ route('admin.employee.userDetails.form', $item->emp_id) }}" title="Edit Employee" target="_blank">
        <i class="fas fa-edit"></i>
    </a>

    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')" class="btn btn-danger btn-sm"><i
            class="fas fa-trash-alt"></i>
    </button>

    <button type="button"
        onclick="changeStatus('{{ route('admin.' . $route . '.status', $item->id) }}','status{{ $item->id }}')"
        id="status{{ $item->id }}"
        class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm">
        @if ($item->status == 'active')
            <i class="fas fa-check-circle"></i>
        @else
            <i class="fas fa-times-circle"></i>
        @endif
    </button>
</form>

