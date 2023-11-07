@php
    if (isemplooye()) {
        $data = App\Models\LeaveApply::with('user', 'leave_type')
            ->where('user_id', Auth::user()->id)
            ->select('*');
        $total_upaid_leave = App\Models\LeaveApply::where('user_id', Auth::user()->id)
            ->where('status', 'approved')
            ->where('is_paid', 'unpaid')
            ->count('*');
        $total_pedding = App\Models\LeaveApply::where('user_id', Auth::user()->id)
            ->where('status', 'pending')
            ->count('*');
        $total_approved = App\Models\LeaveApply::where('user_id', Auth::user()->id)
            ->where('status', 'reject')
            ->count('*');
        $total_reject = App\Models\LeaveApply::where('user_id', Auth::user()->id)
            ->where('status', 'approved')
            ->count('*');
            $total_applied_leave = App\Models\LeaveApply::whereIn('status', ['pending'])
            ->count('*');
    } else {
        $data = App\Models\LeaveApply::with('user', 'leave_type')->select('*');
        $total_upaid_leave = App\Models\LeaveApply::where('is_paid', 'unpaid')
            ->where('status', 'approved')
            ->count('*');
        $total_applied_leave = App\Models\LeaveApply::whereIn('status', ['pending'])
        ->count('*');
        $total_pedding = App\Models\LeaveApply::where('status', 'pending')->count('*');
        $total_approved = App\Models\LeaveApply::where('status', 'reject')->count('*');
        $total_reject = App\Models\LeaveApply::where('status', 'approved')->count('*');
    }
@endphp

<div class="m-1 text-center row">
    @if (isemplooye())
    <div class="col-lg-2">
        <a href="#" class="">
            <div class="py-3 card card-leavtype">Total Remaining - 
                {{ total_remaining_leave(auth()->user()->id) }} </div>
        </a>
    </div>
    @endif
    <div class="col-lg-2 ">

        <a href="{{ route('admin.leave_apply.index') }}" class="">
            <div class="py-3 card card-leavtype">Total  Applied -
                {{ $total_applied_leave }} </div>
        </a>

    </div>
    <div class="col-lg-2">

        <a href="{{ route('admin.leave_apply.request_history') }}" class="">
            <div class="py-3 card card-leavtype">Total  Pending -
                {{ $total_pedding }} </div>
        </a>

    </div>
    <div class="col-lg-2 ">

        <a href="{{ route('admin.leave_apply.get_rejected_leave') }}" class="">
            <div class="py-3 card card-leavtype">Total  Rejected -
                {{ $total_approved }} </div>
        </a>

    </div>
    <div class="col-lg-2">

        <a href="{{ route('admin.leave_apply.balance_history') }}" class="">
            <div class="py-3 card card-leavtype">Total  Approved -
                {{ $total_reject }} </div>
        </a>
    </div>
    @if (!isemplooye())
    <div class="col-lg-2"></div>
    @endif
    <div class="text-right col-lg-2 auto">
        <div class="mt-2 " style="text-align: right;">
            @can('add-leave-apply')
            <button type="button" class="text-right btn btn-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                {{ $page }}
            </button>
            @endcan

        </div>
    </div>
    
</div>
