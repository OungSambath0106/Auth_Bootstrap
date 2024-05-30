<style>
    .scrollable {
        overflow-y: auto;
        overflow-y: scroll;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollable::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .scrollable::-webkit-scrollbar {
        display: none;
    }

    .img-circle {
        border: 5px solid #3559E0;
        padding: 4px;
    }

    .modal {
        width: 25vw !important;
        margin-left: 80vh;
    }

    .float-right {
        color: #3559E0;
    }
</style>

<div class="modal fade scrollable" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="invoiceSection">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/uploads/users_photo/' . Auth::user()->image) }}"
                                    class="profile-user-img img-fluid img-circle rounded-circle" width="130"
                                    height="130" alt="User profile picture">
                            @else
                                <img src="{{ asset('Image/default-image.png') }}" width="130" height="130"
                                    class="profile-user-img img-fluid img-circle rounded-circle"
                                    alt="Default User profile picture">
                            @endif
                        </div>

                        <h3 class="profile-username text-center mt-2 mb-0">
                            {{ Auth::user()->name }}
                        </h3>

                        <p class="text-muted text-center mt-1">
                            {{ implode(', ', Auth::user()->roles()->pluck('name')->toArray()) }}
                        </p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Sex :</b> <b class="float-right">{{ Auth::user()->sex }}</b>
                            </li>
                            <li class="list-group-item">
                                <b>Email :</b> <b class="float-right">{{ Auth::user()->email }}</b>
                            </li>
                            <li class="list-group-item">
                                <b>Phone Number :</b> <b class="float-right">{{ Auth::user()->phone }}</b>
                            </li>
                        </ul>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('logout') }}" class="btn btn-primary btn-logout"
                    onclick="event.preventDefault(); confirmLogout();">Logout</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3559E0",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, log out"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
