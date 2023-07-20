<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.header')
<style>
    .pointer {
        cursor: pointer;
    }

    .pointer:hover {
        color: #f85109;
    }

    .btn-bg-color {
        background-color: #f85109d6 !important;
    }

    .required-field{
        color: red;
    }
</style>
@stack('styles')

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">

    <script src="{{ asset('assets/js/hs.theme-appearance.js') }}"></script>

    <script src="{{ asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}">
    </script>

    @include('layouts.partials.navbar')

    <!-- ========== MAIN CONTENT ========== -->

    @include('layouts.partials.sidebar')


    @yield('content')
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== SECONDARY CONTENTS ========== -->

    <!-- Welcome Message Modal -->
    <div class="modal fade" id="welcomeMessageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-close">
                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi-x-lg"></i>
                    </button>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="modal-body p-sm-5">
                    <div class="text-center">
                        <div class="mx-auto mb-4 w-75 w-sm-50">
                            <img class="img-fluid" src="{{ asset('assets/svg/illustrations/oc-collaboration.svg') }}"
                                alt="Image Description" data-hs-theme-appearance="default">
                            <img class="img-fluid"
                                src="{{ asset('assets/svg/illustrations-light/oc-collaboration.svg') }}"
                                alt="Image Description" data-hs-theme-appearance="dark">
                        </div>

                        <h4 class="h1">Welcome to HRMS</h4>

                        <p>We're happy to see you.</p>
                    </div>
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="text-center modal-footer d-block py-sm-5">
                    <small class="text-cap text-muted">Trusted by the world's best teams</small>

                    <div class="mx-auto w-85">
                        <div class="row justify-content-between">
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('assets/svg/brands/gitlab-gray.svg') }}"
                                    alt="Image Description">
                            </div>
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('assets/svg/brands/fitbit-gray.svg') }}"
                                    alt="Image Description">
                            </div>
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('assets/svg/brands/flow-xo-gray.svg') }}"
                                    alt="Image Description">
                            </div>
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('assets/svg/brands/layar-gray.svg') }}"
                                    alt="Image Description">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    </div>

    <!-- End Welcome Message Modal -->

    <!-- Create a new user Modal -->
    <div class="modal fade" id="inviteUserModal" tabindex="-1" aria-labelledby="inviteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="inviteUserModalLabel">Invite users</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <!-- Form -->
                    <div class="mb-4">
                        <div class="mb-2 input-group mb-sm-0">
                            <input type="text" class="form-control" name="fullName"
                                placeholder="Search name or emails" aria-label="Search name or emails">

                            <div class="input-group-append input-group-append-last-sm-down-none">
                                <!-- Select -->
                                <div class="tom-select-custom tom-select-custom-end">
                                    <select class="js-select form-select" autocomplete="off"
                                        data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true,
                            "dropdownWidth": "11rem"
                          }'>
                                        <option value="guest" selected>Guest</option>
                                        <option value="can edit">Can edit</option>
                                        <option value="can comment">Can comment</option>
                                        <option value="full access">Full access</option>
                                    </select>
                                </div>
                                <!-- End Select -->

                                <a class="btn btn-primary d-none d-sm-inline-block" href="javascript:;">Invite</a>
                            </div>
                        </div>

                        <a class="btn btn-primary w-100 d-sm-none" href="javascript:;">Invite</a>
                    </div>
                    <!-- End Form -->

                    <div class="row">
                        <h5 class="col modal-title">Invite users</h5>

                        <div class="col-auto">
                            <a class="d-flex align-items-center small text-body" href="#">
                                <img class="avatar avatar-xss avatar-4x3 me-2"
                                    src="{{ asset('assets/svg/brands/gmail-icon.svg') }}" alt="Image Description">
                                Import contacts
                            </a>
                        </div>
                    </div>

                    <hr class="mt-2">

                    <ul class="mb-0 list-unstyled list-py-2">
                        <!-- List Group Item -->
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{ asset('assets/img/160x160/img10.jpg') }}"
                                            alt="Image Description">
                                    </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <h5 class="mb-0">Amanda Harvey <i
                                                    class="bi-patch-check-fill text-primary" data-toggle="tooltip"
                                                    data-placement="top" title="Top endorsed"></i></h5>
                                            <span class="d-block small">amanda@site.com</span>
                                        </div>

                                        <div class="col-sm-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-sm-end">
                                                <select
                                                    class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                                                    <option value="guest" selected>Guest</option>
                                                    <option value="can edit">Can edit</option>
                                                    <option value="can comment">Can comment</option>
                                                    <option value="full access">Full access</option>
                                                    <option value="remove"
                                                        data-option-template='<div class="text-danger">Remove</div>'>
                                                        Remove</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </li>
                        <!-- End List Group Item -->

                        <!-- List Group Item -->
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{ asset('assets/img/160x160/img3.jpg') }}"
                                            alt="Image Description">
                                    </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <h5 class="mb-0">David Harrison</h5>
                                            <span class="d-block small">david@site.com</span>
                                        </div>

                                        <div class="col-sm-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-sm-end">
                                                <select
                                                    class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                                                    <option value="guest" selected>Guest</option>
                                                    <option value="can edit">Can edit</option>
                                                    <option value="can comment">Can comment</option>
                                                    <option value="full access">Full access</option>
                                                    <option value="remove"
                                                        data-option-template='<div class="text-danger">Remove</div>'>
                                                        Remove</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </li>
                        <!-- End List Group Item -->

                        <!-- List Group Item -->
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{ asset('assets/img/160x160/img9.jpg') }}"
                                            alt="Image Description">
                                    </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <h5 class="mb-0">Ella Lauda <i class="bi-patch-check-fill text-primary"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Top endorsed"></i></h5>
                                            <span class="d-block small">Markvt@site.com</span>
                                        </div>

                                        <div class="col-sm-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-sm-end">
                                                <select
                                                    class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                                                    <option value="guest" selected>Guest</option>
                                                    <option value="can edit">Can edit</option>
                                                    <option value="can comment">Can comment</option>
                                                    <option value="full access">Full access</option>
                                                    <option value="remove"
                                                        data-option-template='<div class="text-danger">Remove</div>'>
                                                        Remove</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </li>
                        <!-- End List Group Item -->

                        <!-- List Group Item -->
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                        <span class="avatar-initials">B</span>
                                    </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <h5 class="mb-0">Bob Dean</h5>
                                            <span class="d-block small">bob@site.com</span>
                                        </div>

                                        <div class="col-sm-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-sm-end">
                                                <select
                                                    class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                                                    <option value="guest" selected>Guest</option>
                                                    <option value="can edit">Can edit</option>
                                                    <option value="can comment">Can comment</option>
                                                    <option value="full access">Full access</option>
                                                    <option value="remove"
                                                        data-option-template='<div class="text-danger">Remove</div>'>
                                                        Remove</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </li>
                        <!-- End List Group Item -->
                    </ul>
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="modal-footer">
                    <div class="row align-items-center flex-grow-1 mx-n2">
                        <div class="mb-2 col-sm-9 mb-sm-0">
                            <input type="hidden" id="inviteUserPublicClipboard" value="/">

                            <p class="modal-footer-text">The public share <a href="#">link settings</a>
                                <i class="bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="The public share link allows people to view the project without giving access to full collaboration features."></i>
                            </p>
                        </div>

                        <div class="col-sm-3 text-sm-end">
                            <a class="js-clipboard btn btn-white btn-sm text-nowrap" href="javascript:;"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard!"
                                data-hs-clipboard-options='{
                  "type": "tooltip",
                  "successText": "Copied!",
                  "contentTarget": "#inviteUserPublicClipboard",
                  "container": "#inviteUserModal"
                 }'>
                                <i class="bi-link-45deg me-1"></i> Copy link</a>
                        </div>
                    </div>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    </div>
    <!-- End Create a new user Modal -->
    @include('layouts.partials.footer')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('custom-scripts')
    <script>
        var APP_URL = "{{ url('/') }}";
    </script>
    <script src="{{ asset('assets/js/admin/common.js') }}"></script>
    <!-- End Style Switcher JS -->
    <script src="{{ asset('assets/js/method.js') }}"></script>



</body>

</html>
