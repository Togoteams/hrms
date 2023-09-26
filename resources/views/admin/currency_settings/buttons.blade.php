

<div class="button-container">
    <div class="row">
     <div class="d-flex">
     <button class="success-badges changeStatus" data-table="currency_settings" data-uuid="{{$item->id}}"
         data-message="Inactive" @if($item->status=="Active") data-value="Inactive" @else data-value="Active" @endif>
         <span class="legend-indicator bg-success"></span>{{ $item->status ?? 'Active' }}
     </button>
 
     <form id="edit{{ $item->id }}"
         action="{{ route('admin.currency_settings.destroy', $item->id) }}">
         <button type="button"
             onclick="editForm('{{ route('admin.currency_settings.edit', $item->id) }}', 'edit')"
             href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
             class="btn btn-edit btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
         </button>
         @csrf
         <input type="hidden" name="_method" value="DELETE">
         <button type="button" id="delete{{ $item->id }}"
             onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
             class="btn btn-delete btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>
         </button>
     </form>
 </div>
    </div>
 </div>
 
 
 
 