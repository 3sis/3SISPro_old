@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">
    
    <div>
    
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class=" br-6">
                <div style='float:right; padding-right:30px'>
                    <button type='button' name='Undo' id='Undelete_Data' class='btn btnUnDeleteRec3SIS'>Undo
                        <i class="fas fa-undo-alt fa-sm ml-1"> </i>
                    </button>
                    <button type='button' name='add' id='add_Data' class='btn btnAddRec3SIS'>Add
                        <i class="fas fa-plus fa-sm ml-1"> </i>
                    </button>
                </div>                
                <div class="table-responsive">
                    <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <!--CopyChange-->  
                                <th title="Company Id">ID</th>
                                <th>Company Name</th>
                                <th>Nick Name</th>                                    
                                <th>Tag Line</th>
                                <th style="visibility: hidden;">Desc2</th>
                                <th style="visibility: hidden;">Bi Desc</th>
                                <th style="visibility: hidden;">User</th>
                                <th style="visibility: hidden;">Updated</th>
                                <th style="visibility: hidden;">Unique Id</th>
                            </tr>
                        </thead> 
                    </table>
                </div>
                <!-- start undeletemodal -->
                <div id='dataTableModalSmall' class='modal fade  register-modal' role='dialog' 
                    aria-labelledby="registerModalLabel" aria-hidden="true" style='margin-top:40px' 
                    data-backdrop="static">
                    <div class='modal-dialog modal-dialog-centered modal-lg'role="document">
                        <div class='modal-content'>                              
                            <div class="modal-header" id="registerModalLabel">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                    </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            </div>
                            <!--CopyChange-->
                                <div class='modal-body'>
                                    <div class="container-fluid">
                                            <div class="table-responsive">
                                                <table id="html-extension3SIS" class="table table-hover non-hover" style="width:100%">
                                                    <thead>
                                                        <tr>                                                                
                                                            <th title="Company Master">ID</th>
                                                            <th>Company Name</th>
                                                            <th>Desc1</th>
                                                            <th>Action</th>
                                                            <th style="visibility: hidden;">Unique Id</th>
                                                        </tr>
                                                    </thead>   
                                                </table>
                                            </div>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- end undelete modal -->
                <div id="entryModalSmall" class="modal fade UpdateModalBox3SIS" data-backdrop="static" 
                    data-keyboard="false" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-xl" role="document">
                        <div class='modal-content'>                              
                            <div class="modal-header" id="registerModalLabel">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                    </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            </div>
                            <!--CopyChange-->
                            <form  id='singleLevelDataEntryForm' autocomplete="off"
                                    method="post" action="{{ route('company.postData') }}">
                                    <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                                    <div class="modal-body">
                                    <div class="widget-content widget-content-area animated-underline-content">
                                        <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                                href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                                ria-selected="true">General Info</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-address-tab" data-toggle="tab" 
                                                href="#animated-underline-address" role="tab" aria-controls="animated-underline-address" 
                                                aria-selected="false">Address</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-banking-tab" data-toggle="tab" 
                                                href="#animated-underline-banking" role="tab" aria-controls="animated-underline-banking" 
                                                aria-selected="false">Banking Info</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-statutory-tab" data-toggle="tab" 
                                                href="#animated-underline-statutory" role="tab" aria-controls="animated-underline-statutory" 
                                                aria-selected="false">Statutory Info / Logo</a>
                                            </li>                                                
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" 
                                                href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" 
                                                aria-selected="false">Record Info</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="animateLineContent-4">
                                            <!-- General Info -->
                                            <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                                aria-labelledby="animated-underline-home-tab">
                                                <div class="container-fluid">
                                                    <!-- Hidden Fields -->  
                                                    <div class='form-group mb-0'>
                                                        <input type="hidden" name='GMCOHUniqueId' id='GMCOHUniqueId' 
                                                            class='form-control'>                                                  
                                                    </div>
                                                    <!-- Id, Description and Nick Name -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-4">
                                                            <div class='form-group'>                                                
                                                                <label>Company Id</label> 
                                                                <span class="error-text GMCOHCompanyId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text"  name='GMCOHCompanyId' id='GMCOHCompanyId' 
                                                                    class='form-control few-options' maxlength="10" 
                                                                    placeholder="Company Id" style='opacity:1'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Name</label> 
                                                                <span class="error-text GMCOHDesc1_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='GMCOHDesc1' id="GMCOHDesc1"  maxlength="100"
                                                                    class="form-control few-options" placeholder="Company Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Nick Name</label>
                                                                <input type="text" name='GMCOHNickName' id="GMCOHNickName"  maxlength="50"
                                                                    class="form-control few-options" placeholder="Short Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Descriptin2, Tag Line and BI -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-4">
                                                            <div class='form-group'>                                                
                                                                <label>Description2</label>  
                                                                <textarea name='GMCOHDesc2' id='GMCOHDesc2' class='form-control few-options' 
                                                                maxlength="200" name="alloptions" id="alloptions1" placeholder="Company Description2" 
                                                                aria-label="With textarea" 
                                                                style='border-color: rgb(102, 175, 233); outline: 0px'></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group '>
                                                                <label>Tag Line</label>
                                                                <input type="text" name='GMCOHTagLine' id='GMCOHTagLine' 
                                                                    class='form-control few-options' maxlength="100" placeholder="Tag Line">
                                                            </div>
                                                        </div>     
                                                        <div class="col-md-4">
                                                            <div class='form-group '>
                                                                <label>BI Desc</label>
                                                                <input type="text" name='GMCOHBiDesc' id='GMCOHBiDesc' 
                                                                    class='form-control few-options'maxlength="100" placeholder="BI Description">
                                                            </div>
                                                        </div>                                                            
                                                    </div>
                                                    <!-- Dropdown for Currency, Qty & Value Decimal  -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-4">
                                                            <div class='form-group'>
                                                                <label>Currency Id</label>                                                
                                                                <span class="error-text currenyId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='currenyId' name = 'currenyId' style='width: 100%;'>
                                                                    <option value=''>-- Select Currency Id --</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group'>
                                                                <label>Quantity Decimals</label>                                                
                                                                <span class="error-text quantityId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='quantityId' name = 'quantityId' style='width: 100%;'>
                                                                        <option value='0'>0</option>
                                                                        <option value='1'>1</option>
                                                                        <option value='2'>2</option>
                                                                        <option value='3'>3</option>
                                                                        <option value='4'>4</option>
                                                                        <option value='5'>5</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class='form-group'>
                                                                <label>Value Decimals</label>                                                
                                                                <span class="error-text valueId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='valueId' name = 'valueId' style='width: 100%;'>
                                                                <option value='0'>0</option>
                                                                        <option value='1'>1</option>
                                                                        <option value='2'>2</option>
                                                                        <option value='3'>3</option>
                                                                        <option value='4'>4</option>
                                                                        <option value='5'>5</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Landline, Mobile, Email and Website -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Land Line</label> 
                                                                <input type="text" name='GMCOHLandLine' id='GMCOHLandLine' 
                                                                    class='form-control few-options'maxlength="50"  placeholder="Land Line No.">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Mobile No.</label>
                                                                <input type="text" name='GMCOHMobileNo' id='GMCOHMobileNo' 
                                                                    class='form-control few-options'maxlength="50"  placeholder="Mobile No.">
                                                            </div>
                                                        </div>     
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Emial Id</label>
                                                                <input type="text" name='GMCOHEmail' id='GMCOHEmail' 
                                                                    class='form-control few-options'maxlength="100"  placeholder="Email Id">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Web Site</label>
                                                                <input type="text" name='GMCOHWebsite' id='GMCOHWebsite' 
                                                                    class='form-control few-options'maxlength="100"  placeholder="Web Site">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Address Info -->
                                            <div class="tab-pane fade" id="animated-underline-address" role="tabpanel" 
                                                aria-labelledby="animated-underline-address-tab">                                                    
                                                <div class="media">
                                                    <div class="media-body">
                                                        <!-- Address1, 2, 3 -->
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input type="text" name="GMCOHAddress1" id="GMCOHAddress1" 
                                                            class='form-control few-options' maxlength="200" placeholder="Address 1"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="GMCOHAddress2" id="GMCOHAddress2" 
                                                            class='form-control few-options' maxlength="200" placeholder="Address 2"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="GMCOHAddress3" id="GMCOHAddress3" 
                                                            class='form-control few-options' maxlength="200" placeholder="Address 3"/>
                                                        </div>
                                                        <!-- City, State, Country & Pin Code -->
                                                        <div class="row mt-0">
                                                            <div class="col-md-3">
                                                                <div class='form-group'>
                                                                    <label>City</label>                                                
                                                                    <span class="error-text cityId_error text-danger" 
                                                                        style='float:right;'></span>
                                                                    <select id='cityId' name = 'cityId' style='width: 100%;'>
                                                                        <option value=''>-- Select City Id --</option>
                                                                    </select>                                                
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <input type="hidden" name="GMCOHStateId" id="GMCOHStateId">
                                                                    <input type="text" name="stateDesc1" id="stateDesc1" 
                                                                    class="form-control" readonly/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <input type="hidden" name="GMCOHCountryId" id="GMCOHCountryId">
                                                                    <input type="text" name="countryDesc1" id="countryDesc1" 
                                                                    class="form-control" readonly/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Pin Code</label>
                                                                    <input type="text" name="GMCOHPinCode" id="GMCOHPinCode" 
                                                                    class='form-control few-options' maxlength="50" placeholder="Pin Code"/>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Banking Info -->
                                            <div class="tab-pane fade" id="animated-underline-banking" role="tabpanel" 
                                                aria-labelledby="animated-underline-banking-tab">                                                    
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class='row'>
                                                            <!-- Banking 1 -->
                                                            <div class="col-md-6">
                                                                <div class="col-md-12">
                                                                    <div class="row mt-0">
                                                                        <div class='form-group mb-0'>
                                                                            <label style='color:#ffc107'>Bank1</label>        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-0">
                                                                    <div class="col-md-12">
                                                                        <div class='form-group'>
                                                                            <label style='color:#ffc107'>Branch</label>
                                                                            <select id='branchId1' name = 'branchId1' style='width: 100%;'>
                                                                                <option value=''>-- Select Branch --</option>
                                                                            </select>                                                
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-0">
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label style='color:#ffc107'>Bank</label>
                                                                            <input type="hidden" name="GMCOHBankId1" id="GMCOHBankId1">
                                                                            <input type="text" name="bankName1" id="bankName1" 
                                                                                class="form-control" readonly/>                                                
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label style='color:#ffc107'>IFS Code</label>
                                                                            <input type="text" name="ifsCode1" id="ifsCode1" 
                                                                            class="form-control" readonly/>                                              
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-0">
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label style='color:#ffc107'>Acct.Name</label>
                                                                            <input type="text" name="GMCOHBankAcName1" id="GMCOHBankAcName1" maxlength="100"
                                                                            class="form-control few-options" placeholder="Acct.Name">                                             
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label style='color:#ffc107'>Acct.No.</label>
                                                                            <input type="text" name="GMCOHBankAccNo1" id="GMCOHBankAccNo1" maxlength="100" 
                                                                            class="form-control few-options" placeholder="Acct.No.">                                             
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Banking 2 -->
                                                            <div class="col-md-6">
                                                                <div class="col-md-12">
                                                                    <div class="row mt-0">
                                                                        <div class='form-group mb-0'>
                                                                            <label style='color:#20c997'>Bank2</label>        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-0">
                                                                    <div class="col-md-12">
                                                                        <div class='form-group'>
                                                                            <label style='color:#20c997'>Branch</label>
                                                                            <select id='branchId2' name = 'branchId2' style='width: 100%;'>
                                                                                <option value=''>-- Select Branch --</option>
                                                                            </select>                                                
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-0">
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label style='color:#20c997'>Bank</label>
                                                                            <input type="hidden" name="GMCOHBankId2" id="GMCOHBankId2">
                                                                            <input type="text" name="bankName2" id="bankName2" 
                                                                                class="form-control" readonly/>                                                
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label style='color:#20c997'>IFS Code</label>
                                                                            <input type="text" name="ifsCode2" id="ifsCode2" 
                                                                            class="form-control" readonly/>                                              
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-0">
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label style='color:#20c997'>Acct.Name</label>
                                                                            <input type="text" name="GMCOHBankAcName2" id="GMCOHBankAcName2" maxlength="100"
                                                                            class="form-control few-options" placeholder="Acct.Name">                                             
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label style='color:#20c997'>Acct.No.</label>
                                                                            <input type="text" name="GMCOHBankAccNo2" id="GMCOHBankAccNo2" maxlength="100" 
                                                                            class="form-control few-options" placeholder="Acct.No.">                                             
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Statutoty Info and Image-->
                                            <div class="tab-pane fade" id="animated-underline-statutory" role="tabpanel" 
                                                aria-labelledby="animated-underline-statutory-tab">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <!-- PAN and GST -->
                                                        <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group '>
                                                                    <label>GST No.</label>
                                                                    <input type="text" name='GMCOHGSTNo' id='GMCOHGSTNo' 
                                                                        class='form-control few-options' maxlength="100" placeholder="GST No.">
                                                                </div>
                                                            </div>     
                                                            <div class="col-md-6">
                                                                <div class='form-group '>
                                                                    <label>PAN No.</label>
                                                                    <input type="text" name='GMCOHPANNo' id='GMCOHPANNo' 
                                                                        class='form-control few-options'maxlength="100" placeholder="PAN No.">
                                                                </div>
                                                            </div>                                                            
                                                        </div>
                                                        <!-- CIN No and Establishment Date -->
                                                        <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group '>
                                                                    <label>CIN No.</label>
                                                                    <input type="text" name='GMCOHCINNo' id='GMCOHCINNo' 
                                                                        class='form-control few-options' maxlength="100" placeholder="CIN No.">
                                                                </div>
                                                            </div>     
                                                            <div class="col-md-6">
                                                                <div class='form-group '>
                                                                    <label>Establishment Date</label>
                                                                    <input type="date" name='GMCOHESTDate' id='GMCOHESTDate' 
                                                                        class='form-control'>
                                                                </div>
                                                            </div>                                                            
                                                        </div>
                                                        <!-- Company Logo and Folder -->
                                                        <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group '>
                                                                    <label>Folder Name</label>
                                                                    <input type="text" name='GMCOHFolderName' id='GMCOHFolderName' 
                                                                        class='form-control few-options' maxlength="200" placeholder="Folder Name">
                                                                </div>
                                                            </div>     
                                                            <div class="col-md-6">
                                                                <div class='form-group '>
                                                                    <label>Company Logo</label>
                                                                    <input type="text" name='GMCOHImageFileName' id='GMCOHImageFileName' 
                                                                    class='form-control few-options' maxlength="500" placeholder="Folder Name">
                                                                </div>
                                                            </div>                                                            
                                                        </div>                                                            
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- User Info -->
                                            <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" 
                                                aria-labelledby="animated-underline-profile-tab">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="form-group">
                                                            <label> User</label>
                                                            <input type="text" name="GMCOHUser" id="GMCOHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="GMCOHLastCreated" id="GMCOHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="GMCOHLastUpdated" id="GMCOHLastUpdated" 
                                                            class="form-control col-sm-6" readonly />
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <!--To display success messages-->
                                    <span id='form_output' style='float:left; padding-left:0px' ></span> 
                                    <input type="hidden" name='button_action' id='button_action' value='insert'>
                                    <input type="submit" name='submit' id='action' value='Add' 
                                        class='btn btn-outline-success mb-2'>
                                </div>
                            </form>
                        </div>
                    </div>
            
                </div>
                @include('commonViews3SIS.modalCommon3SIS')
            </div>
        </div>

    </div>

</div>
<script>        
    $(document).ready(function(){
        $modalTitle = 'Company'
        $( "#cityId" ).select2();
        $( "#branchId1" ).select2();
        $( "#branchId2" ).select2();
        $('#html5-extension3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
            buttons: [
                { extend: 'excel', className: 'btn' },
                { extend: 'print', className: 'btn' }
            ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" \
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" \
                    class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5">\
                    </polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" \
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" \
                    stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line>\
                    <polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            stripeClasses: [],
            pageLength: 6,
            lengthMenu: [6, 10, 20, 50],
            order: [ 8, "desc" ],
            processing: true,
            serverSide: true,
            // CopyChange                    
            "ajax": "{{ route('company.browserData')}}",
            "columns":[
                // CopyChange
                {data: "GMCOHCompanyId"},
                {data: "GMCOHDesc1"},
                {data: "GMCOHNickName"},                    
                {data: "GMCOHTagLine"},                    
                {data: "action", orderable:false, searchable: false},
                {data: "GMCOHDesc2", "visible": false},
                {data: "GMCOHBiDesc", "visible": false},
                {data: "GMCOHUser", "visible": false},
                {data: "GMCOHLastUpdated", "visible": false},
                {data: "GMCOHUniqueId", "visible": false},
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "25%", "targets": 1 },
                    { "width": "25%", "targets": 2 },
                    { "width": "25%", "targets": 3 },
                    { "width": "15%", "targets": 4 }
                ]      
            });
            
        // Whed add buttonis pushed
        $('#add_Data').click(function(){                    
            $("#GMCOHCompanyId").attr("readonly", false);
            fnReinstateFormControl('0');
            fnUpdateDropdownsAddMode();
        });
        // Add Ends                   
        // When edit button is pushed
        $(document).on('click', '.edit', function(){
            
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('company.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data)
                { 
                    var lastCreated = formattedDate(new Date(data.GMCOHLastCreated));
                    var lastUpdated = formattedDate(new Date(data.GMCOHLastUpdated));
                    var establishmentDte = formattedDate(new Date(data.GMCOHESTDate));
                    // General Info
                    $('#GMCOHUniqueId').val(data.GMCOHUniqueId);                     
                    $('#GMCOHCompanyId').val(data.GMCOHCompanyId);
                    $('#GMCOHDesc1').val(data.GMCOHDesc1);
                    $('#GMCOHDesc2').val(data.GMCOHDesc2);
                    $('#GMCOHBiDesc').val(data.GMCOHBiDesc);
                    $('#GMCOHNickName').val(data.GMCOHNickName);
                    $('#GMCOHTagLine').val(data.GMCOHTagLine);
                    $('#GMCOHCurrenyId').val(data.GMCOHCurrenyId);
                    $('#GMCOHDecimalPositionQty').val(data.GMCOHDecimalPositionQty);
                    $('#GMCOHDecimalPositionValue').val(data.GMCOHDecimalPositionValue);
                    $('#GMCOHLandLine').val(data.GMCOHLandLine);
                    $('#GMCOHMobileNo').val(data.GMCOHMobileNo);
                    $('#GMCOHEmail').val(data.GMCOHEmail);
                    $('#GMCOHWebsite').val(data.GMCOHWebsite);
                    // Address Info
                    $('#GMCOHAddress1').val(data.GMCOHAddress1);
                    $('#GMCOHAddress2').val(data.GMCOHAddress2);
                    $('#GMCOHAddress3').val(data.GMCOHAddress3);
                    $('#GMCOHCityId').val(data.GMCOHCityId);
                    $('#GMCOHStateId').val(data.GMCOHStateId);
                    $('#GMCOHCountryId').val(data.GMCOHCountryId);
                    $('#GMCOHPinCode').val(data.GMCOHPinCode);
                    // Statutory and Logo Info
                    $('#GMCOHCINNo').val(data.GMCOHCINNo);
                    $('#GMCOHPANNo').val(data.GMCOHPANNo);
                    $('#GMCOHGSTNo').val(data.GMCOHGSTNo);
                    $('#GMCOHESTDate').val(establishmentDte);
                    $('#GMCOHFolderName').val(data.GMCOHFolderName);
                    $('#GMCOHImageFileName').val(data.GMCOHImageFileName);
                    // Banking Info
                    $('#GMCOHBankId1').val(data.GMCOHBankId1);
                    $('#GMCOHBranchId1').val(data.GMCOHBranchId1);
                    $('#GMCOHIFSId1').val(data.GMCOHIFSId1);
                    $('#GMCOHBankAccNo1').val(data.GMCOHBankAccNo1);
                    $('#GMCOHBankAcName1').val(data.GMCOHBankAcName1);
                    $('#GMCOHBankId2').val(data.GMCOHBankId2);
                    $('#GMCOHBranchId2').val(data.GMCOHBranchId2);
                    $('#GMCOHIFSId2').val(data.GMCOHIFSId2);
                    $('#GMCOHBankAccNo2').val(data.GMCOHBankAccNo2);
                    $('#GMCOHBankAcName2').val(data.GMCOHBankAcName2);
                    // User Info
                    $('#GMCOHUser').val(data.GMCOHUser);                        
                    $('#GMCOHLastCreated').val(lastCreated);                        
                    $('#GMCOHLastUpdated').val(lastUpdated);                         
                    /* Ajax Call for selected element to show in drop down */
                    // var countrySelect = $('#countryId');
                    // var id = data.GMCOHCountryId;
                    // $.ajax({
                    //     url: "{{route('country.getSelectedCountry')}}",
                    //     method: 'GET',
                    //     data: {id:id},
                    //     dataType: 'json',
                    //     tags: true,
                    //     delay: 250,
                    //     processResults: function(response) {
                    //         return{                                                                         
                    //             results: response                                        
                    //         }
                    //     },
                    //     cache: true                           

                    // });                            
                    /* Ajax Call Ends*/

                    $("#GMCOHCompanyId").attr("readonly", true);                           
                    fnReinstateFormControl('1');
                    fnUpdateDropdownsEditMode(data);
                }
            });
        });
        // Edit Ends
        // When submit button is pushed
        $('#singleLevelDataEntryForm').on('submit', function(event){               
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: "json",
                contentType: false,
                beforeSend: function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(data)
                {
                    if(data.status == 0)
                    {
                        $.each(data.error, function(prefix,val){
                            $('span.' +prefix+ '_error').text(val[0]);
                            $('#' +prefix).css('border-color', '#dc3545');
                        });
                    }else
                    { 
                        $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                        $('#FinalSaveMessage').html($finalMessage3SIS);
                        fnReinstateFormControl('0');
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        if(data.updateMode=='Updated')
                        {
                            $('#entryModalSmall').modal('hide');
                            $('#modalZoomFinalSave3SIS').modal('show');
                        }
                        else
                        {
                            $('#form_output').html($finalMessage3SIS);
                        }
                    }
                }
            })
        });
        // Submit Ends            
        // When delete button is pushed
        $(document).on('click', '.delete', function(){
            var UniqueId = $(this).attr('id');
            // Fetch Record first that need to be deleted.
            $.ajax({
                url: "{{route('company.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.GMCOHCompanyId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    // CopyChange
                    url:"{{route('company.deleteData')}}",
                    mehtod:"get",
                    data:{id:UniqueId},
                    success:function(data)
                    {
                        $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                        $('#FinalSaveMessage').html($finalMessage3SIS);                            
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        // $('#html-extension3SIS').DataTable().ajax.reload();
                        UniqueId = 0;
                        $('#modalZoomDeleteRecord3SIS').modal('hide');
                        $('#modalZoomFinalSave3SIS').modal('show');
                    }
                })
            }); 
            $("#modalZoomDeleteRecord3SIS").on("hide.bs.modal", function () {
                UniqueId = 0;
            });                 
        }); 
        // Delete Ends
        // Whed undo button is pushed
        $('#Undelete_Data').click(function(){                    
            $('#html-extension3SIS').DataTable( {
            stripeClasses: [],
            pageLength: 6,
            lengthMenu: [6, 10, 20, 50],
            order: [[ 1, "desc" ]],
            processing: true,
            serverSide: true,
            destroy: true,                    
            // CopyChange                    
            "ajax": "{{ route('company.browserDeletedRecords')}}",
            "columns":[
                // CopyChange
                {data: "GMCOHCompanyId"},
                {data: "GMCOHDesc1"},
                {data: "GMCOHDesc2"},
                {data: "action", orderable:false, searchable: false},
                {data: "GMCOHUniqueId", "visible": false},
            ]
            });
            fnReinstateDataTable('0');
        });
        // undo Ends 
        // When restore button is pushed
        $(document).on('click', '.restore', function(){
            var DeletedUniqueId = $(this).attr('id');
            // Fetch Record first that need to be restored.
            $.ajax({
                url: "{{route('company.fetchData')}}",
                method: 'GET',
                data: {id:DeletedUniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $restoreMessage3SIS = fnSingleLevelRestoreConfirmation($modalTitle, data.GMCOHCompanyId, '');   
                    $('#RestoreRecord').html($restoreMessage3SIS);
                    $('#modalZoomRestoreRecord3SIS').modal('show');  
                    $('#modalZoomRestoreRecord3SIS').modal('hide');                    
                }
            });
            // Fetch Record Ends
            // Restore record only when OK is pressed on Modal.
            $(document).on('click', '.confirmrestore', function(){
                $.ajax({
                    url:"{{route('company.restoreDeletedRecords')}}",
                    mehtod:"get",
                    data:{id:DeletedUniqueId},
                    success:function(data)
                    {                       
                        $('#html5-extension3SIS').DataTable().ajax.reload();
                        $('#html-extension3SIS').DataTable().ajax.reload();
                        DeletedUniqueId = 0;
                        $('#modalZoomRestoreRecord3SIS').modal('hide');
                        // $('#dataTableModalSmall').modal('hide');
                    }
                })
            }); 
            $("#modalZoomRestoreRecord3SIS").on("hide.bs.modal", function () {
                DeletedUniqueId = 0;
            });                
        }); 
        // restore Ends
        //  city Dropdown
        
        $('#cityId').change(function(){
            let id = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getGeoDesc')}}",
                type:'post',
                data:'id=' + id + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#GMCOHStateId').val(response.stateId);
                    $('#stateDesc1').val(response.stateDesc1);
                    $('#GMCOHCountryId').val(response.countryId);
                    $('#countryDesc1').val(response.countryDesc1);
                }
            })
        });
        // Bringing Desc Ends
        //  Currency Dropdown
        $( "#currenyId" ).select2({
            ajax: { 
                url: "{{route('dropDownMasters.getCurrency')}}",
                type: "POST",
                dataType: 'json',
                tags: true,
                // The number of milliseconds to wait for the user to stop typing before issuing the ajax request.
                delay: 250,
                // @param params The object containing the parameters used to generate the request.
                data: function (params) {
                    return {
                        _token: $('#csrfToken').val(),
                        search: params.term // search term
                    }
                },
                processResults: function (response) {
                    return {
                        results: response
                    }
                },
                cache: true
            }
        });
        //  Currency Dropdown Ends
        // Quantity and Value Decimals
        $('#quantityId').select2();
        $('#valueId').select2();
        // Quantity and Value Decimals End
        // When Branch Id is selected, bring Bank Name and IFS Code
        $('#branchId1').change(function(){
            let $BranchId = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getBranchDetails')}}",
                type:'post',
                data:'id=' + $BranchId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#bankName1').val(response.bankDesc1);
                    $('#ifsCode1').val(response.ifsCode);
                    $('#GMCOHBankId1').val(response.bankId);
                }
            })
        });
        
        // When Branch Id is selected, bring Bank Name and IFS Code
        $('#branchId2').change(function(){
            let $BranchId = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getBranchDetails')}}",
                type:'post',
                data:'id=' + $BranchId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#bankName2').val(response.bankDesc1);
                    $('#ifsCode2').val(response.ifsCode);
                    $('#GMCOHBankId2').val(response.bankId);
                }
            })
        });
        // Bringing Branch Details End
        function fnUpdateDropdownsEditMode(data){
            var $CityId = data.GMCOHCityId;

            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCity')}}",
                method: 'GET',
                data: {id:$CityId},
                dataType: 'json',
                success: function(response) {                    
                    $('#cityId').html(response.SelectedItem);
                },
                cache: true
            })
            $.ajax({
                url: "{{route('dropDownMasters.getGeoDesc')}}",
                type:'post',
                data:'id=' + $CityId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#GMCOHStateId').val(response.stateId);
                    $('#stateDesc1').val(response.stateDesc1);
                    $('#GMCOHCountryId').val(response.countryId);
                    $('#countryDesc1').val(response.countryDesc1);
                }
            })
            //getBranch 
            var $branchId1 = data.GMCOHBranchId1;
            $.ajax({
                url: "{{route('dropDownMasters.getBranch')}}",
                method: 'GET',
                data: {id:$branchId1},
                dataType: 'json',
                success: function(response) {
                    $('#branchId1').html(response.SelectedItem);
                },
                cache: true
            });
            $.ajax({
                url: "{{route('dropDownMasters.getBranchDetails')}}",
                type:'post',
                data:'id=' + $branchId1 + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#bankName1').val(response.bankDesc1);
                    $('#ifsCode1').val(response.ifsCode);
                    $('#GMCOHBankId1').val(response.bankId);
                }
            })
            var $branchId2 = data.GMCOHBranchId2;
            $.ajax({
                url: "{{route('dropDownMasters.getBranch')}}",
                method: 'GET',
                data: {id:$branchId2},
                dataType: 'json',
                success: function(response) {
                    $('#branchId2').html(response.SelectedItem);
                },
                cache: true
            });
            $.ajax({
                url: "{{route('dropDownMasters.getBranchDetails')}}",
                type:'post',
                data:'id=' + $branchId2 + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#bankName2').val(response.bankDesc1);
                    $('#ifsCode2').val(response.ifsCode);
                    $('#GMCOHBankId2').val(response.bankId);
                }
            })
            
        }
    });    
    function fnUpdateDropdownsAddMode(){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedCity')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#cityId').html(response.SelectedItem);
            },
            cache: true
        });
        //getBranch 
        $.ajax({
            url: "{{route('dropDownMasters.getBranch')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#branchId1').html(response.SelectedItem);
            },
            cache: true
        });
        $.ajax({
            url: "{{route('dropDownMasters.getBranch')}}",
            method: 'GET',
            data: {id:'00'},
            dataType: 'json',
            success: function(response) {
                $('#branchId2').html(response.SelectedItem);
            },
            cache: true
        });
            
    }           
</script>
@endsection
