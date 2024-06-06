<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">

    @can('print-employee-kra')
    <a target="_blank" href="{{ route('admin.employee-kra.print', $item->user_id) }}"
        class="text-white btn btn-success btn-sm"><i class="fas fa-print"></i></a>
    @endcan

    {{-- @can('view-employee-kra')
    <button type="button" onclick="editForm('{{ route('admin.' . $route . '.show', $item->id) }}', 'show')"
        href="#" data-bs-toggle="modal" data-bs-target="#modalshow" class="btn btn-info btn-sm"><i
            class="fas fa-eye"></i>
    </button>
    @endcan --}}

    {{-- @can('edit-employee-kra')
    <button type="button" onclick="editForm('{{ route('admin.' . $route . '.edit', $item->id) }}', 'edit')" href="#"
        data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-edit btn-sm"><i
            class="fas fa-edit"></i>
    </button>
    @endcan --}}
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    @can('delete-employee-kra')
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')" class="btn btn-delete btn-sm"><i
            class="fas fa-trash-alt"></i>
    </button>
    @endcan

    @can('change-status-employee-kra')
    {{-- <button type="button"
        onclick="changeStatus('{{ route('admin.' . $route . '.status', $item->id) }}','status{{ $item->id }}')"
        id="status{{ $item->id }}"
        class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm">
        @if ($item->status == 'active')
            <i class="fas fa-check-circle"></i>
        @else
            <i class="fas fa-times-circle"></i>
        @endif
    </button> --}}
    <button type="button" data-table="employee-kra" data-uuid="{{$item->id}}"
        @if($item->status=="active") data-value="inactive" data-message="Inactive"  @else data-value="active" data-message="Active" @endif
        class="btn btn-edit btn-sm changeStatus" ><i class="fas  @if($item->status=="active") fa-toggle-on  @else fa-toggle-off @endif" 
            @if($item->status=="active") title="Active"  @else title="Inactive" @endif  data-bs-toggle="tooltip"  ></i>
    </button>
    @endcan
</form>
