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
    } else {
        $data = App\Models\LeaveApply::with('user', 'leave_type')->select('*');
        $total_upaid_leave = App\Models\LeaveApply::where('is_paid', 'unpaid')
            ->where('status', 'approved')
            ->count('*');
        $total_pedding = App\Models\LeaveApply::where('status', 'pending')->count('*');
        $total_approved = App\Models\LeaveApply::where('status', 'reject')->count('*');
        $total_reject = App\Models\LeaveApply::where('status', 'approved')->count('*');
    }
@endphp

<div class="p-1 mt-4 text-center row">
    @if (isemplooye())
    <div class="col-lg-3">
        <a href="#" class="">
            <div class="py-5 card card-hover-shadow card-leavtype">Total Remaining Leave - 
                {{ total_remaining_leave(auth()->user()->id) }} </div>
        </a>
    </div>
    @endif
    <div class="col-lg-3 ">

        <a href="{{ route('admin.leave_apply.index') }}" class="">
            <div class="py-5 card card-hover-shadow card-leavtype">Total Leave Applied -
                {{ $data->count('*') }} </div>
        </a>

    </div>
    <div class="col-lg-3">

        <a href="{{ route('admin.leave_apply.request_history') }}" class="">
            <div class="py-5 card card-hover-shadow card-leavtype">Total Leave pending -
                {{ $total_pedding }} </div>
        </a>

    </div>
    <div class="col-lg-3 ">

        <a href="{{ route('admin.leave_apply.get_rejected_leave') }}" class="">
            <div class="py-5 card card-hover-shadow card-leavtype">Total Leave Rejected -
                {{ $total_approved }} </div>
        </a>

    </div>
    <div class="col-lg-3">

        <a href="{{ route('admin.leave_apply.balance_history') }}" class="">
            <div class="py-5 card card-hover-shadow card-leavtype">Total Leave Approved -
                {{ $total_reject }} </div>
        </a>

    </div>

   

</div>
<hr>
