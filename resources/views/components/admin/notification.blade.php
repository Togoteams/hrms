<div class="dropdown">
    <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown"
        aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
        <div class="notification-icon">


            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-bell-ring">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                <path d="M4 2C2.8 3.7 2 5.7 2 8" />
                <path d="M22 8c0-2.3-.8-4.3-2-6" />
            </svg>
        </div>
    </a>

    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-notification"
        aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
        <div class="dropdown-item-text">
            <div class="d-flex align-items-center">

                <div class="list-group list-group-flush list-group-activity my-n3">
                    @forelse($notifications as $notification )
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('assets/img/160x160/img3.jpg') }}" alt="..."
                                        class="avatar-img rounded-circle">
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Content -->
                                <div class="small">
                                    <strong>{{$notification->title}}</strong> {{$notification->description}}
                                </div>

                                <!-- Time -->
                                <small class="text-muted">
                                    {{$notification->created_at->diffForHumans()}}
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                    @empty
                        <p>Notification not Found</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="dropdown-divider"></div>
        <a href="{{route('admin.notification.index')}}">See all</a>
    </div>
</div>
