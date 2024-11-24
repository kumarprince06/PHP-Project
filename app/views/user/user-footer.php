</div>
</div>
</div>
<!-- Tabs Content End -->

</div>
</section>

<!-- Edit Profile Image Modal -->
<div class="modal fade" id="editProfileImageModal" tabindex="-1" role="dialog" aria-labelledby="editProfileImageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileImageLabel">Upload New Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="<?php echo URLROOT ?>/userController/uploadProfileImage" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profileImage">Choose an image</label>
                        <input type="file" class="form-control-file" id="profileImage" name="profileImage" accept="image/*" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<?php require APPROOT . '/views/includes/footer.php'; ?>