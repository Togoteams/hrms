<div class="button-container">
    <div class="row">
       <div class="d-flex">
        @can('change-status-country')
            <button type="button" data-table="country" data-uuid="{{$item->id}}"
                @if($item->status=="active") data-value="inactive" data-message="Inactive"  @else data-value="active" data-message="Active" @endif
                class="btn btn-edit btn-sm changeStatus" ><i class="fas  @if($item->status=="active") fa-toggle-on  @else fa-toggle-off @endif" 
                    @if($item->status=="active") title="Active"  @else title="Inactive" @endif  data-bs-toggle="tooltip"  ></i>
            </button>
         @endcan
            <form id="edit{{ $item->id }}"
                action="{{ route('admin.country.destroy', $item->id) }}">

                @can('edit-country')
                <button type="button"
                    onclick="editForm('{{ route('admin.country.edit', $item->id) }}', 'edit')"
                    href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                    class="btn btn-edit btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                </button>
                @endcan

                @csrf
                <input type="hidden" name="_method" value="DELETE">

                @can('delete-country')
                <button type="button" id="delete{{ $item->id }}"
                    onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                    class="btn btn-delete btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>
                </button>
                @endcan


            </form>
        </div>
    </div>
 </div>