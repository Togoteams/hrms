<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">

    @can('view-leave-apply')
        <button type="button" onclick="editForm('{{ route('admin.' . $route . '.show', $item->id) }}', 'show')" href="#"
            data-bs-toggle="modal" data-bs-target="#modalshow" class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
        </button>
    @endcan
    {{-- if once approved the no one can change status --}}
    @if ($item->status != 'approved')
        @can('edit-leave-apply')
            <button type="button" onclick="editForm('{{ route('admin.' . $route . '.edit', $item->id) }}', 'edit')"
                href="#" data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-edit btn-sm"><i
                    class="fas fa-edit"></i>
            </button>
        @endcan
    @endif
    
    @csrf

    <input type="hidden" name="_method" value="DELETE">

    @if ($item->status != 'approved')
        <button type="button" id="delete{{ $item->id }}"
            onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
            class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i>
        </button>
    @endif
    @if (!isemplooye())
        {{-- @if (approvalBtnEnable($item->id) == 1) --}}
            @if($item->status=='approved' && $item->is_reversal==0 && $item->user?->employee?->employment_type=="local" )
                @if($item->leave_type->slug=="leave-without-pay")
                    <button type="button" onclick="reverseLeaveWithoutPay({{$item->id}})"
                    href="#" class="btn btn-edit btn-sm"><i class="fa fa-undo" aria-hidden="true"></i>
                </button>
                @endif
            @endif
            {{-- @if($item->approval_authority==auth()->user()->id) --}}
            @can('change-status-leave-apply')
                <button type="button"
                    @if ($item->status != 'approved') onclick="editForm('{{ route('admin.' . $route . '.status_modal', $item->id) }}', 'statuschange')"
            href="#" data-bs-toggle="modal" data-bs-target="#modalstatus" @endif
                    class="btn @if ($item->status == 'pending') btn-warning @elseif ($item->status == 'reject') btn-danger @elseif($item->status == 'approved') btn-success @else btn-secondary @endif btn-sm">
                    {{ ucfirst($item->status) }} </button>
            @endcan
            {{-- @endif  --}}
        {{-- @endif --}}
    @endif

</form>
