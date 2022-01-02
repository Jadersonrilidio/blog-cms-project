
<!-- Modal -->
<div class="modal fade" id="notLoggedModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">  </h2>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <big> <?php echo MODAL_TEXT_CONTENT; ?> </big> 
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="<?php echo Config::REL_PATH.'login'; ?>" class="btn btn-primary"> <?php echo MODAL_LOGIN_LINK; ?> </a> 
                <a href="<?php echo Config::REL_PATH.'registration'; ?>" class="btn btn-primary"> <?php echo MODAL_REGISTER_LINK; ?> </a> 
                <button type="button" class="btn" data-dismiss="modal"> <?php echo MODAL_BTN_CANCEL; ?> </button>
            </div>

        </div>
    </div>
</div>
<!-- End Modal -->
