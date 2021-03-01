<?php
require_once 'assets/php/header.php';
?>

<!-- <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="css/datepicker.css" /> -->

<!-- <style>
    .datepicker {
        z-index: 1600 !important;
        /* has to be larger than 1050 */
    }
</style> -->

<div class="container">

    <div class="card border-primary">
        <h5 class="card-header bg-primary d-flex justify-content-between">
            <span class="text-light lead align-self-center">Attendance Management</span>

            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#markAttendanceModal"><i class="fas fa-user-check"></i>&nbsp;Mark Attendance</a>

            <!-- <a href="#" class="btn btn-light" data-toggle="modal" data-target="#markLeaveModal"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Mark Leave</a> -->

            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#viewAttendanceModal" id="view_Attendance"><i class="fas fa-eye"></i>&nbsp;View Attendance</a>
        </h5>
        <h3 class="text-center text-primary mt-5" id="view_Attendance_text">Attendance Details Show Here!</h3>
        <div class="card-body">
            <div class="table-responsive" id="showAttendance">
                <!-- Showing All Attendance Details Here -->
            </div>
        </div>
    </div>
</div>

<!-- Start Mark Attendance Modal -->
<div class="modal fade" id="markAttendanceModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Mark Attendance</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data" id="mark_attendance_form">
                    <div id="attendanceAlert"></div>
                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>User ID :</b><?= $cid; ?></p>

                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Name :</b><?= $cname; ?></p>

                    <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-Mail :</b><?= $cemail; ?></p>


                    <div class="card-text p-2 mt-3 rounded" style="border:1px solid #0275d8;">
                        <label for="attendance_Date" class="m-1"><b>Attendance Date</b></label>
                        <input type="date" name="attendanceDate" id="attendanceDate" class="form-control" required>
                    </div>

                    <div class="form-group p-2 mt-3 rounded" style="border:1px solid #0275d8;">
                        <label for="attendance_Status" class="m-1"><b>Attendance Status</b></label>
                        <select name="attendanceStatus" id="attendanceStatus" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Absent">Absent</option>
                            <option value="Present">Present</option>
                            <option value="Leave">Leave</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="markAttendance" id="markAttendanceBtn" value="Mark Attendance" class="btn btn-success btn-block btn-lg">
                    </div>
            </div>

            </form>

        </div>
    </div>
</div>
<!-- End Mark Attendance Modal -->



<!-- jQuery CDN -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    // $('#attendance_date').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true,
    //     container: '#formModal modal-body'
    // });
    $(document).ready(function() {
        $("#showAttendance").toggle();
        $("#view_Attendance").on('click', function() {
            $("#showAttendance").toggle();
        });

        $("#view_Attendance").on('click', function() {
            $("#view_Attendance_text").toggle();
        });

        //Mark Attendance Ajax Request
        $("#markAttendanceBtn").click(function(e) {
            if ($("#mark_attendance_form")[0].checkValidity()) {
                e.preventDefault();

                $("#markAttendanceBtn").val('Please Wait...');

                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: $("#mark_attendance_form").serialize() + '&action=mark_atten',
                    success: function(response) {
                        $("#markAttendanceBtn").val('Mark Attendance');
                        $("#mark_attendance_form")[0].reset();
                        // $("#markAttendanceModal").modal('hide');

                        if (response === 'mark_atten') {

                            // Swal.fire({
                            //     title: 'Attendance Marrk successfully!',
                            //     icon: 'success'
                            // });
                        } else {
                            $("#attendanceAlert").html(response);
                        }
                        displayAllAttendance();

                    }
                });
            }
        });

        displayAllAttendance();
        //Display All Attendance of User
        function displayAllAttendance() {

            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: {
                    action: 'display_attendance'
                },
                success: function(response) {
                    $('#showAttendance').html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

    });
</script>
</body>

</html>