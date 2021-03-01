<?php
require_once 'assets/php/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($verified == 'Not Verified!') : ?>
                <div class=" alert alert-danger alert-dismissible text-center mt-2 m-0">
                    <button class="close" type="button" data-dismiss="alert">&times;</button>
                    <strong>Your E-mail is not verified! we've sent you an E-mail Verification link on your E-mail, check nad Verify Now!</strong>
                </div>
            <?php endif; ?>

            <h4 class="text-center text-primary mt-2">Student Attendance Management System</h4>
        </div>
    </div>
</div>
<!-- jQuery CDN -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>