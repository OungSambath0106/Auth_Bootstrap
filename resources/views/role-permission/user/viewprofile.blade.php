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

<div class="modal fade scrollable" id="viewprofile" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="invoiceSection">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="" id="pfImage"
                                class="profile-user-img img-fluid img-circle rounded-circle" width="130"
                                height="130" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center mt-2 mb-0" id="profileName"></h3>
                        <p class="text-muted text-center mt-1" id="profileRoles"></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Sex :</b> <b class="float-right" id="profileSex"></b>
                            </li>
                            <li class="list-group-item">
                                <b>Email :</b> <b class="float-right" id="profileEmail"></b>
                            </li>
                            <li class="list-group-item">
                                <b>Phone Number :</b> <b class="float-right" id="profilePhone"></b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-bs-toggle="modal"]').on('click', function() {
            var userId = $(this).data('id');
            $.ajax({
                url: '/users/' + userId,
                method: 'GET',
                success: function(data) {
                    $('#pfImage').attr('src', data.image ?
                        '/storage/uploads/users_photo/' + data.image :
                        '/Image/default-image.png');
                    $('#profileName').text(data.name);
                    $('#profileRoles').text(data.roles.map(role => role.name).join(', '));
                    $('#profileSex').text(data.sex);
                    $('#profileEmail').text(data.email);
                    $('#profilePhone').text(data.phone);
                },
                error: function() {
                    alert('Failed to fetch user data');
                }
            });
        });
    });
</script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
