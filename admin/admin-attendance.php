<?php

require_once 'assets/php/admin-header.php';

// require_once '../assets/php/session.php';

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-info">
            <div class="card-header bg-info text-white">
                <h4 class="m-0"> All Users Attendance</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllAttendance">
                    <p class="text-center align-self-center lead">
                        Please Wait...
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Display Attendance in Details Model -->
<div class="modal fase" id="showAttendanceDetailsModal">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="getName"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <p class="card-text p-2 m-3 rounded" style="border:1px solid #0275d8;" id="getId"></p>
                            <p class="card-text p-2 m-3 rounded" style="border:1px solid #0275d8;" id="getEmail"></p>
                            <p class="card-text p-2 m-3 rounded" style="border:1px solid #0275d8;" id="getAttendanceDate"></p>
                            <p class="card-text p-2 m-3 rounded" style="border:1px solid #0275d8;" id="getAttendanceStatus"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Mark Attendance Modal -->
<div class="modal fade" id="editAttendanceModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Edit Attendance</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data" id="edit_attendance_form">
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <input type="text" name="User Id" id="getUserId" class="form-control form-control-lg" disabled>
                    </div>

                    <div class="form-group">
                        <input type="text" name="User Name" id="getUserName" class="form-control form-control-lg" disabled>
                    </div>

                    <div class="form-group">
                        <input type="text" name="User Name" id="getUserEmail" class="form-control form-control-lg" disabled>
                    </div>

                    <div class="form-group">
                        <input type="text" name="AttendanceDate" id="editAttendanceDate" class="form-control form-control-lg" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="AttendanceStatus" id="editAttendanceStatus" class="form-control form-control-lg" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="Update Attendance" id="updateAttendanceBtn" value="Update Attendance" class="btn btn-info btn-block btn-lg">
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Edit Mark Attendance Modal -->

    <!-- Footer Area -->
</div>
</div>
</div>

<!-- jQuery CDN -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(document).ready(function() {

        //Fetch All Attendance Ajex Request
        fetchAllAttendance();

        function fetchAllAttendance() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'fetchAllAttendance'
                },
                success: function(response) {
                    $("#showAllAttendance").html(response);
                    $("table").DataTable({
                        order: [0, 'desc'] //It will display the latest users at the top
                    });
                }
            });
        }

        //Display Attendance in Details Ajax Request
        $("body").on("click", ".attendanceDetailsIcon", function(e) {
            e.preventDefault();

            attendanceDetails_id = $(this).attr("id");

            $.ajax({
                url: 'assets/php/admin-action.php',
                type: 'post',
                data: {
                    attendanceDetails_id: attendanceDetails_id
                },
                success: function(response) {
                    data = JSON.parse(response);
                    $("#getName").text(data.name + ' ' + '(User ID: ' + data.user_id + ')');
                    $("#getId").text('Attendance ID: ' + data.id);
                    $("#getEmail").text('Email: ' + data.email);
                    $("#getAttendanceDate").text('Attendance Date: ' + data.attendance_date);
                    $("#getAttendanceStatus").text('Attendance Status: ' + data.attendance_status);


                }
            });
        });

        //Delete User Attendance Ajax Request
        $("body").on("click", ".deleteAttendanceIcon", function(e) {
            e.preventDefault();
            deleteAttendance_id = $(this).attr('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {
                            deleteAttendance_id: deleteAttendance_id
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'User deleted successfully!',
                                'success'
                            )
                            fetchAllAttendance();
                        }
                    });
                }
            });
        });

        //Edit User Attendance Ajax Request 
        $("body").on("click", ".editAttendanceIcon", function(e) {
            e.preventDefault();

            attendanceEdit_id = $(this).attr("id");

            $.ajax({
                url: 'assets/php/admin-action.php',
                type: 'post',
                data: {
                    attendanceEdit_id: attendanceEdit_id
                },
                success: function(response) {
                    data = JSON.parse(response);
                    // console.log(data);
                    // $("#getAttendanceDate").val(data.attendance_date);

                    $("#id").val(data.id);
                    $("#getUserId").val(data.user_id);
                    $("#getUserName").val(data.name);
                    $("#getUserEmail").val(data.email);
                    $("#editAttendanceDate").val(data.attendance_date);
                    $("#editAttendanceStatus").val(data.attendance_status);


                }
            });
        });


        //Update Attendance of User Ajax Request
        $("#updateAttendanceBtn").click(function(e) {
            if ($("#edit_attendance_form")[0].checkValidity()) {
                e.preventDefault();

                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: $("#edit_attendance_form").serialize() + "&action=update_attendance",
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    });
</script>
</body>

</html>