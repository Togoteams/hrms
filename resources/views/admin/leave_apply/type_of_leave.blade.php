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

<div class="text-center p-1">
    <a href="{{ route('admin.leave_apply.index') }}" class="btn btn-primary ">Total Leave Applied -
        {{ $data->count('*') }}</a>
    <a href="{{ route('admin.leave_apply.request_history') }}" class="btn btn-warning ">Total Leave Pedding -
        {{ $total_pedding }} </a>
    <a href="{{ route('admin.leave_apply.get_rejected_leave') }}" class="btn btn-danger ">Total Leave Rejected -
        {{ $total_approved }} </a>
    <a href="{{ route('admin.leave_apply.balance_history') }}" class="btn btn-success ">Total Leave Approved -
        {{ $total_reject }} </a>
    @if (isemplooye())
        <a class="btn btn-info ">Total Remaining Leave - {{ total_remaining_leave(auth()->user()->id) }} </a>
    @endif

</div>
<hr>
