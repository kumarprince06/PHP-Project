<?php require APPROOT . '/views/user/user-header.php'; ?>

<div class="container my-4">

    <div class="tab-content" id="accountTabContent">
        <!-- Account Details Tab -->
        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
            <form class="tg-form mt-3">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputfname">Name</label>
                        <input type="text" class="form-control" id="inputfname" placeholder="First Name" value="<?php echo $_SESSION['sessionData']['userName'] ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" value="<?php echo $_SESSION['sessionData']['userEmail'] ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Details</button>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/user/user-footer.php'; ?>