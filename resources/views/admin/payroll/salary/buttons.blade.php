<form id="edit{{ $item->id }}" action="{{ route('admin.' . $route . '.destroy', $item->id) }}">

    @can('print-salary')
    <a target="_blank" href="{{ route('admin.payroll.salary.print', $item->id) }}"
        class="text-white btn btn-success btn-sm"><i class="fas fa-print"></i></a>
    @endcan
    @php
        $enableEdit = false;
        $salaryMonth = $item->pay_for_month_year;
        $salaryStartDate = date("Y-m-d", strtotime("-1 months",strtotime($salaryMonth."-20")));
        $salaryEndDate = date("Y-m-d", strtotime($salaryMonth."-20"));
        if(date('Y-m-d')>=($salaryStartDate) && date('Y-m-d') <=$salaryEndDate)
        {
            $enableEdit = true;
        }
     @endphp

    @if($enableEdit)
    @if(!isemplooye())
    {{-- <button type="button" onclick="editForm('{{ route('admin.' . $route . '.edit', $item->id) }}', 'edit')" href="#"
        data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-edit btn-sm"><i
            class="fas fa-edit"></i></button> --}}
    @endif
    @endif
    @can('delete-salary')
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')" class="btn btn-delete btn-sm"><i
            class="fas fa-trash-alt"></i>
    </button>
    @endcan
   

</form>
