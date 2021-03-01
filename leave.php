<?php
require_once 'assets/php/header.php';
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-3">
            <div class="card border-primary">
                <div class="card-header lead text-center bg-primary text-white">
                    Apply For Leave
                </div>
                <div class="card-body">
                    <form action="#" method="post" class="px-4" id="leave-form">

                        <div class="form-group p-2 mt-3 rounded" style="border:1px solid #0275d8;">
                            <label for="attendance_Status" class="m-1"><b>Leave Type</b></label>
                            <select name="leave_Type" id="leave_Type" class="form-control" required>
                                <option value="">Select leave type</option>
                                <option value="Casual Leave">Casual Leave</option>
                                <option value="Medical Leave test">Medical Leave</option>
                                <option value="Restricted Holiday(RH)">Restricted Holiday(RH)</option>
                            </select>
                        </div>

                        <div class="form-group p-2 mt-3 rounded" style="border:1px solid #0275d8;">
                            <label for="FromDate" class="m-1"><b>From Date</b></label>
                            <input type="date" name="FromDate" id="from_Date" class="form-control" required>

                            <label for="to_Date" class="m-1"><b>To Date</b></label>
                            <input type="date" name="ToDate" id="to_Date" class="form-control" required>
                        </div>

                        <div class="form-group p-2 mt-3 rounded" style="border:1px solid #0275d8;">
                            <label for="Description" class="m-1"><b>Description</b></label>

                            <textarea id="leave_textarea" name="leaveDescription" class="form-control-lg form-control rounded-0" placeholder="Write About Leave" rows="8" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="applyLeave" id="applyLeaveBtn" value="Submit Leave" class="btn btn-primary btn-block btn-lg rounded-0">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery CDN -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(document).ready(function() {

        //Send Leave to Admin Ajax Request
        $("#applyLeaveBtn").click(function(e) {
            if ($("#leave-form")[0].checkValidity()) {
                e.preventDefault();

                $(this).val('Please Wait...');

                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: $("#leave-form").serialize() + '&action=leave',
                    success: function(response) {
                        $("#leave-form")[0].reset();
                        $("#applyLeaveBtn").val('Submit Leave');
                        Swal.fire({
                            title: 'Leave Request Successfully sent to the Admin!',
                            icon: 'success'
                        });

                    }
                });
            }
        });
    });
</script>
</body>

</html>