// Data Entry Form on Landing Page Browser
function fnReinstateFormControl(blankScreenId) {
    if (blankScreenId == '0') {
        $('#singleLevelDataEntryForm')[0].reset(); // To initialize all the fields on form.        
        $('#action').val('Save');
        $('#button_action').val('insert');
        $('.modal-title').text('Add ' + $modalTitle);
    } else {
        $('#action').val('Edit');
        $('#button_action').val('update');
        $('.modal-title').text('Edit ' + $modalTitle);
    }
    $('#form_output').html(''); // To clear success message.
    $('#entryModalSmall').modal('show');
    $(document).find('span.error-text').text('');
    $(document).find('input.form-control').css({
        'border-color': '#66afe9',
        'outline': '0'
    });
}

function fnDataEntryFormHeader(blankScreenId, $UpdatMode, $TitleSuffix) {
    if (blankScreenId == '0') {
        $('#singleLevelDataEntryForm')[0].reset(); // To initialize all the fields on form.        
        $('#action').val('Save');
        $('#button_action').val('insert');
        $('.modal-title').text($UpdatMode + $modalTitle + $TitleSuffix);
    } else {
        $('#action').val('Edit');
        $('#button_action').val('update');
        // $('.modal-title').text($UpdatMode + $modalTitle + $TitleSuffix);
        $('.modal-title').text('').html($UpdatMode + $modalTitle + $TitleSuffix);
    }
    $('#form_output').html(''); // To clear success message.
    $('#entryModalSmall').modal('show');
    $(document).find('span.error-text').text('');
    $(document).find('input.form-control').css({
        'border-color': '#66afe9',
        'outline': '0'
    });
}
// Data Entry Form on Landing Page Browser Ends**********

// Data Entry Form on Sub Form
function fnReinstateSubForm(blankScreenId, $AddMode, $EditMode) {
    if (blankScreenId == '0') {
        $('#twoleLevelDataEntryForm')[0].reset(); // To initialize all the fields on form.        
        $('#action_DetailEntry').val('Save');
        $('#button_action_DetailEntry').val('insert');
        $('.modal-title-detail').text($AddMode + $modalTitleDetailEntry);
    } else {
        // $('#action').val('Edit');
        $('#button_action_DetailEntry').val('update');
        $('.modal-title-detail').text($EditMode + $modalTitleDetailEntry);
    }
    $('#form_output_detail_entry').html(''); // To clear success message.
    $('#detailEntryModal').modal('show');
    // $(document).find('span.error-text').text('');
    // $(document).find('input.form-control').css({
    //     'border-color': '#66afe9',
    //     'outline': '0'
    // });
}
// Data Entry Form on Sub Form Ends**********

// Data Entry Form on SubForm1
function fnDetailEntryOnSubForm1(blankScreenId, $AddMode, $EditMode) {
    if (blankScreenId == '0') {
        $('#twoLevelDataEntryForm1')[0].reset();        
        $('#action_DetailEntry1').val('Save');
        $('#button_action_DetailEntry1').val('insert');
        $('.modal-title-detail1').html($AddMode + $modalTitleDetailEntry1);
    } else {
        $('#action_DetailEntry1').val('Edit');
        $('#button_action_DetailEntry1').val('update');
        $('.modal-title-detail1').html($EditMode + $modalTitleDetailEntry1);
    }
    $('#form_output_detail_entry1').html(''); // To clear success message.
    $('#detailEntryModal1').modal('show');
    $(document).find('span.error-text').text('');
    $(document).find('input.form-control').css({
        'border-color': '#66afe9',
        'outline': '0'
    });
}
// Data Entry Form on SubForm1 ENds*****
// Data Entry Form on SubForm2
function fnDetailEntryOnSubForm2(blankScreenId, $AddMode, $EditMode) {
    if (blankScreenId == '0') {
        $('#twoLevelDataEntryForm2')[0].reset();        
        $('#action_DetailEntry2').val('Save');
        $('#button_action_DetailEntry2').val('insert');
        $('.modal-title-detail2').html($AddMode + $modalTitleDetailEntry2);
    } else {
        $('#action_DetailEntry2').val('Edit');
        $('#button_action_DetailEntry2').val('update');
        $('.modal-title-detail2').html($EditMode + $modalTitleDetailEntry2);
    }
    $('#form_output_detail_entry2').html(''); // To clear success message.
    $('#detailEntryModal2').modal('show');
    $(document).find('span.error-text').text('');
    $(document).find('input.form-control').css({
        'border-color': '#66afe9',
        'outline': '0'
    });
}
// Data Entry Form on SubForm2 ENds*****
// Data Entry Form on SubForm3
function fnDetailEntryOnSubForm3(blankScreenId, $AddMode, $EditMode, $SubmitButtonName) {
    if (blankScreenId == '0') {
        $('#twoLevelDataEntryForm3')[0].reset();        
        $('#action_DetailEntry3').val($SubmitButtonName);
        $('#button_action_DetailEntry3').val('insert');
        $('.modal-title-detail3').html($AddMode + $modalTitleDetailEntry3);
    } else if (blankScreenId == '1') {
        $('#action_DetailEntry3').val($SubmitButtonName);
        $('#button_action_DetailEntry3').val('update');
        $('.modal-title-detail3').html($EditMode + $modalTitleDetailEntry3);
    } else{
        $('#action_DetailEntry3').val($SubmitButtonName);
        $('#button_action_DetailEntry3').val('delte');
        $('.modal-title-detail3').html($EditMode + $modalTitleDetailEntry3);
    }
    $('#form_output_detail_entry3').html(''); // To clear success message.
    $('#detailEntryModal3').modal('show');
    $(document).find('span.error-text').text('');
    $(document).find('input.form-control').css({
        'border-color': '#66afe9',
        'outline': '0'
    });
}
// Data Entry Form on SubForm3 Ends*****
function fnReinstateDataTable(blankdatatable) {
    if (blankdatatable == '0') {
        // var jsData = dataTable.row(this).data();
        // $('#html5-extension3SIS').text();
        $('.modal-title').text('Restore ' + $modalTitle);
    }
    $('#dataTableModalSmall').modal('show');
    $(document).find('span.error-text').text('');

}

function fnSingleLevelFinalSave(masterName, Id, Desc1, updateMode) {
    if(Desc1 != '') 
    {
        return masterName + "for Id <b style='color: #F5821F'>" +
        Id + " [</b> <b style='color: #F5821F'>" + Desc1 + " ]</b> is " +
        updateMode + '</b> SUCCESSFULLY.';
    }else {
        return masterName + "for Id <b style='color: #F5821F'>" +
        Id + "</b> is " + updateMode + ' SUCCESSFULLY.';
    }    
}

function fnSingleLevelDeleteConfirmation(masterName, Id, Desc1) {
    if(Desc1 != '')
    {
        return "This action will delete " + masterName + "<b style='color: #F5821F'> " + Id +
        " [ " + Desc1 + " ] </b>. <br><br>Do you want to Proceed with this Action?";
    }else {
        return "This action will delete " + masterName + "<b style='color: #F5821F'> " + Id +
            "</b>. <br>Do you want to Proceed with this Action?";
    }
}

function fnSingleLevelRestoreConfirmation(masterName, Id, Desc1) {
    $('.modal-titlee').text('Restore ' + $modalTitle);
    if(Desc1 != '') 
    {
        return "This action will restore " + masterName + "<b style='color: #F5821F'> " + Id +
        " [ " + Desc1 + " ] </b>. <br><br>Do you want to Proceed with this Action?";
    } else {
        return "This action will restore " + masterName + "<b style='color: #F5821F'> " + Id  + 
        "</b>. <br>Do you want to Proceed with this Action?"; 
    }
}
function formattedDate(date)
{
    var year = date.getFullYear();
    var month = String(date.getMonth()+1).padStart(2,0);
    var ddOfMonth = String(date.getDate()).padStart(2,0);
    return returnDate =  year + '-' + month + '-' + ddOfMonth;

}
function fnUserConfirmationYesNo(userMessage) {
    return userMessage;
}
