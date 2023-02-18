<!-- <div id="modalZoomFinalSave3SIS" class="modal animated zoomInUp custo-zoomInUp fade" role="dialog"> -->
<div id="modalZoomFinalSave3SIS" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content" style='background:#330066'>
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" 
                    y2="18"></line></svg>
                </button>
                <span id='FinalSaveMessage' style='float:left; padding-left:0px' >Final Save Message</span>
            </div>
        </div>
    </div>
</div>
<div id="modalZoomDeleteRecord3SIS" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <!-- Modal content-->
        <!-- <div class="modal-content" style='background:#1b55e2'> -->
        <div class="modal-content" style='background:#330066'>
            <div class="modal-header" id="">
                <h6 class="text-danger">Delete Confirmation</h6>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                    stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" 
                    x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <span id='DeleteRecord' style='float:left; padding-left:0px' >Delete Record</span>
            </div>
            <div class='modal-footer'>
                <input type="submit" name='delete' id='deleteRecord' value='OK' class='btn btn-outline-danger mb-2 confirm'>
            </div>
        </div>
    </div>
</div>     
<div id="modalZoomRestoreRecord3SIS" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered" >
        <div class="modal-content"  style='background:#330066'>
            <div class="modal-header" id="">
                <h6 class="text-success">Restore Confirmation</h6>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                    stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" 
                    x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <span id='RestoreRecord' style='float:left; padding-left:0px' >Restore Record</span>
            </div>
            <div class='modal-footer'>
                <input type="submit" name='delete' id='restoreRecord' value='OK' class='btn btn-outline-success mb-2 confirmrestore'>
            </div>
        </div>
    </div>
</div> 
<div id="modalConfirmationYesNo3SIS" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <!-- Modal content-->
        <!-- <div class="modal-content" style='background:#1b55e2'> -->
        <div class="modal-content" style='background:#330066'>
            <div class="modal-header" id="">
                <h6 class="text-danger">Confirmation</h6>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                    stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" 
                    x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <span id='userConfirmation' style='float:left; padding-left:0px' >User Confirmation</span>
            </div>
            <div class='modal-footer'>
                <div class="row mt-0">
                    <div class="col-md-6">
                        <input type="button" name='userConfirmationYes' id='userConfirmationYes' value='Yes' class='btn btn-outline-danger mb-2 yes'>
                    </div>
                    <div class="col-md-6">
                        <input type="button" name='userConfirmationNo' id='userConfirmationNo' value='No' class='btn btn-outline-danger mb-2 no'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>      