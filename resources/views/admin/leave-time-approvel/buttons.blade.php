<div class="button-container">
    <div class="row">
       <div class="d-flex">
            {{-- <button type="button" data-table="maternity-leave-apply" data-uuid="{{$item->id}}"
                @if($item->status=="active") data-value="inactive" data-message="Inactive"  @else data-value="active" data-message="Active" @endif
                class="btn btn-edit btn-sm changeStatus" ><i class="fas  @if($item->status=="active") fa-toggle-on  @else fa-toggle-off @endif"
                    @if($item->status=="active") title="Active"  @else title="Inactive" @endif  data-bs-toggle="tooltip"  ></i>
            </button> --}}


            <form id="edit{{ $item->id }}"
                action="{{ route('admin.maternity-leave-apply.destroy', $item->id) }}">

                @if($item->approval_authority==auth()->user()->id)
                @can('leave-maternity-approval')
                <button type="button" value="{{$item['id']}}" class="@if($item['status']=='pending') status_change @endif btn btn-success btn-sm">{{ucfirst($item['status'])}}</button>
                @endcan
                @endif

                {{-- @can('change-status-leave-type-approval')
                <button type="button"class="btn btn-success btn-sm">{{ucfirst($item['status'])}}</button>
                @endcan --}}


                @can('view-maternity-leave-apply')
                <button type="button" onclick="editForm('{{ route('admin.maternity-leave-apply.show', $item->id) }}', 'show')" href="#"
                    data-bs-toggle="modal" data-bs-target="#modalshow" class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                </button>
                @endcan

                @if($item->status == 'pending' && Gate::allows('edit-maternity-leave-apply'))
                <button type="button"
                    onclick="editForm('{{ route('admin.maternity-leave-apply.edit', $item->id) }}', 'edit')"
                    href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                    class="btn btn-edit btn-sm">
                    <i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                </button>
                @endif

                @csrf
                <input type="hidden" name="_method" value="DELETE">
                @if($item->status == 'pending')
                @can('delete-maternity-leave-apply')
                <button type="button" id="delete{{ $item->id }}"
                    onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                    class="btn btn-delete btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>
                </button>
                @endcan
                @endif
            </form>
        </div>
    </div>
 </div>
