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
                                <!-- <th>Company</th> -->
                                <th>Location</th>
                                <th>Emp Id</th>
                                <th>Name</th>
                                <th title="Date Of Birth">DoB</th>
                                <th title="Date Of Joining">DoJ</th>
                                <th>Action</th>
                                <th style="visibility: hidden;">User</th>
                                <th style="visibility: hidden;">Updated</th>
                                <th style="visibility: hidden;">Unique Id</th>
                                <th style="visibility: hidden;">Company</th>
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
                                                            <!--CopyChange-->                                    
                                                            <th>Emp Id</th>
                                                            <th>Name</th>
                                                            <th title="Date Of Birth">DoB</th>
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
                                method="post" action="{{ route('generalInfo.postData') }}">
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
                                                <a class="nav-link" id="animated-underline-additional-tab" data-toggle="tab" 
                                                href="#animated-underline-additional" role="tab" aria-controls="animated-underline-additional" a
                                                ria-selected="false">Additional Info</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-office-tab" data-toggle="tab" 
                                                href="#animated-underline-office" role="tab" aria-controls="animated-underline-office" a
                                                ria-selected="false">office Info</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="animated-underline-statutory-tab" data-toggle="tab" 
                                                href="#animated-underline-statutory" role="tab" aria-controls="animated-underline-statutory" a
                                                ria-selected="false">Statutory and waged</a>
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
                                                <a class="nav-link" id="animated-underline-resignation-tab" data-toggle="tab" 
                                                href="#animated-underline-resignation" role="tab" aria-controls="animated-underline-resignation" 
                                                aria-selected="false">Resignation and LWP</a>
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
                                                        <input type="hidden" name='EMGIHUniqueId' id='EMGIHUniqueId' 
                                                            class='form-control'> 
                                                         <input type="hidden" name='EMGIHCompId' id='EMGIHCompId' 
                                                            class='form-control'>
                                                        <input type="hidden" name='EMGIHUANNo' id='EMGIHUANNo' 
                                                            class='form-control'>                                                  
                                                    </div>
                                                    <!--Location, Id, Salutation, and Gender -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>Emp Id</label> 
                                                                <span class="error-text EMGIHEmployeeId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='EMGIHEmployeeId' id="EMGIHEmployeeId"  maxlength="100"
                                                                    class="form-control few-options" placeholder="Employee Id">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <label>First Name</label> 
                                                                <span class="error-text EMGIHFirstName_error text-danger" 
                                                                    style='float:right;'></span> 
                                                                <input type="text" name='EMGIHFirstName' id='EMGIHFirstName' class='form-control few-options' 
                                                                maxlength="100" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Middle Name</label>
                                                                <input type="text" name='EMGIHMiddleName' id='EMGIHMiddleName' class='form-control few-options' 
                                                                maxlength="100"  placeholder="Middle Name">
                                                            </div>
                                                        </div>     
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Last Name</label>
                                                                <span class="error-text EMGIHLastName_error text-danger" 
                                                                    style='float:right;'></span> 
                                                                <input type="text" name='EMGIHLastName' id='EMGIHLastName' class='form-control few-options' 
                                                                maxlength="100" placeholder="Last Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- First, Middle and Last name and BI -->
                                                    <div class="row mt-0">
                                                         
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Full Name</label>
                                                                <input type="text" name='EMGIHFullName' id='EMGIHFullName' class='form-control few-options' 
                                                                maxlength="100" placeholder="Full Name" readonly>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <!-- For defining select2 -->
                                                                <label>Salutation</label>                                                
                                                                <span class="error-text EMGIHSalutationId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='EMGIHSalutationId' name = 'EMGIHSalutationId' style='width: 100%;'>
                                                                    <option value='0'>-- Select Salutation --</option>                                                                
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <!-- For defining select2 -->
                                                                <label>Gender</label>                                                
                                                                <span class="error-text EMGIHGenderId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='EMGIHGenderId' name = 'EMGIHGenderId' style='width: 100%;'>
                                                                    <option value='0'>-- Select Gender --</option>                                                                
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>                                                
                                                                <!-- For defining select2 -->
                                                                <label>Location</label>             
                                                                <span class="error-text EMGIHLocationId_error text-danger" 
                                                                    style='float:right;'></span>   
                                                                <select id='EMGIHLocationId' name = 'EMGIHLocationId' class="form-control" style='width: 100%;'>
                                                                    <option value=''>-- Select Location --</option>                                                                
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Dropdown for Employment, Grade,Designation & Department  -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-3">
                                                            <div class='form-group'>
                                                                <label>Employment Type</label>                                                
                                                                <span class="error-text EMGIHEmploymentTypeId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='EMGIHEmploymentTypeId' name = 'EMGIHEmploymentTypeId' style='width: 100%;'>
                                                                    <option value=''>-- Select Employment Type --</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>
                                                                <label>Grade Id</label>                                                
                                                                <span class="error-text EMGIHGradeId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='EMGIHGradeId' name = 'EMGIHGradeId' style='width: 100%;'>
                                                                    <option value=''>-- Select Grade --</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>
                                                                <label>Designation Id</label>                                                
                                                                <span class="error-text EMGIHDesignationId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='EMGIHDesignationId' name = 'EMGIHDesignationId' style='width: 100%;'>
                                                                    <option value=''>-- Select Designation --</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group'>
                                                                <label>Department Id</label>                                                
                                                                <span class="error-text EMGIHDepartmentId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='EMGIHDepartmentId' name = 'EMGIHDepartmentId' style='width: 100%;'>
                                                                    <option value=''>-- Select Department --</option>
                                                                </select>                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Landline, Mobile, Email and Website -->
                                                    <div class="row mt-0">
                                                        <div class="col-md-3">
                                                            <div class='form-group'>
                                                                <label>Calendar Id</label>                                                
                                                                {{-- <span class="error-text EMGIHCalendarId_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <select id='EMGIHCalendarId' name = 'EMGIHCalendarId' style='width: 100%;'>
                                                                    <option value=''>-- Select Calendar --</option>
                                                                </select>  --}}
                                                                <span class="error-text EMGIHCalendarId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                <select id='EMGIHCalendarId' name = 'EMGIHCalendarId' style='width: 100%;'>
                                                                    <option value=''>-- Select Calendar --</option>
                                                                </select>                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Date Of Birth</label> 
                                                                <span class="error-text EMGIHDateOfBirth_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="date" name='EMGIHDateOfBirth' id="EMGIHDateOfBirth"
                                                                    class="form-control">
                                                            </div>
                                                        </div>     
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Date Of Joining</label> 
                                                                <span class="error-text EMGIHDateOfJoining_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="date" name='EMGIHDateOfJoining' id="EMGIHDateOfJoining"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='form-group '>
                                                                <label>Date Of Confirmation</label> 
                                                                <span class="error-text EMGIHDateOfConfirmation_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="date" name='EMGIHDateOfConfirmation' id="EMGIHDateOfConfirmation"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Additional Info -->
                                            <div class="tab-pane fade" id="animated-underline-additional" role="tabpanel" 
                                            aria-labelledby="animated-underline-additional-tab">
                                                <div class="container-fluid">
                                                    <div class='row'>
                                                        <div class="col-md-9">
                                                            <!--NationalityId, ReligionId and RaceCastId -->
                                                            <div class="row mt-0">
                                                                <div class="col-md-4">
                                                                    <div class='form-group'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>Nationality</label>                                                
                                                                        <span class="error-text EMGIHNationalityId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHNationalityId' name = 'EMGIHNationalityId' style='width: 100%;'>
                                                                            <option value='0'>-- Select Nationality --</option>                                                                
                                                                        </select>                                                
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class='form-group'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>Religion</label>                                                
                                                                        <span class="error-text EMGIHReligionId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHReligionId' name = 'EMGIHReligionId' style='width: 100%;'>
                                                                            <option value='0'>-- Select Religion --</option>                                                                
                                                                        </select>                                                
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class='form-group'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>Race/Cast</label>                                                
                                                                        <span class="error-text EMGIHRaceCastId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHRaceCastId' name = 'EMGIHRaceCastId' style='width: 100%;'>
                                                                            <option value='0'>-- Select Race/Cast --</option>                                                                
                                                                        </select>                                                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--BloodGroupId, PhysicalStatusId and MaritalStatusId -->
                                                            <div class="row mt-0">
                                                                <div class="col-md-4">
                                                                    <div class='form-group'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>Blood Group</label>                                                
                                                                        <span class="error-text EMGIHBloodGroupId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHBloodGroupId' name = 'EMGIHBloodGroupId' style='width: 100%;'>
                                                                            <option value='0'>-- Select Blood Group --</option>                                                                
                                                                        </select>                                                
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class='form-group'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>Physical Status</label>                                                
                                                                        <span class="error-text EMGIHPhysicalStatusId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHPhysicalStatusId' name = 'EMGIHPhysicalStatusId' style='width: 100%;'>
                                                                            <option value='0'>-- Select Physical Status --</option>                                                                
                                                                        </select>                                                
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class='form-group'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>Leave Group</label>                                                
                                                                        <span class="error-text EMGIHLeaveGroupId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHLeaveGroupId' name = 'EMGIHLeaveGroupId' style='width: 100%;'>
                                                                            <option value='0'>-- Select Leave Group --</option>                                                                
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- DateOfMarriage, Spouse Name -->
                                                            <div class="row mt-0">
                                                                <div class="col-md-4">
                                                                    <div class='form-group'>                                                
                                                                        <!-- For defining select2 for Leave group-->
                                                                        <label>Marital Status</label>                                                
                                                                        <span class="error-text EMGIHMaritalStatusId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHMaritalStatusId' name = 'EMGIHMaritalStatusId' style='width: 100%;'>
                                                                            <option value='0'>-- Select Marital Status --</option>                                                                
                                                                        </select>                                            
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class='form-group '>
                                                                        <label>Date Of Marriage</label> 
                                                                        <span class="error-text EMGIHDateOfMarriage_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="date" name='EMGIHDateOfMarriage' id="EMGIHDateOfMarriage"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class='form-group '>
                                                                        <label>Spouse Name</label>
                                                                        <input type="text" name='EMGIHSpouseName' id='EMGIHSpouseName' class='form-control few-options' 
                                                                        maxlength="100" placeholder="Spouse Name">
                                                                    </div>
                                                                </div>     
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="row mt-0">
                                                                <div class="col-md-12">
                                                                    <div class='form-group'>                                                
                                                                        <label>PAN No</label> 
                                                                        <span class="error-text EMGIHPANNo_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="text" name='EMGIHPANNo' id="EMGIHPANNo"  maxlength="15"
                                                                            class="form-control few-options" placeholder="PAN No">
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                            <div class="row mt-0">
                                                                <div class="col-md-12">
                                                                    <div class='form-group'>                                                
                                                                        <label>Aadhar No</label> 
                                                                        <span class="error-text EMGIHAadharNo_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="text" name='EMGIHAadharNo' id="EMGIHAadharNo"  maxlength="15"
                                                                            class="form-control few-options" placeholder="Aadhar No">
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                            <div class="row mt-0">
                                                                <div class="col-md-12">
                                                                    <div class='form-group'>                                                
                                                                        <label>Driving License No</label> 
                                                                        <span class="error-text EMGIHDrivingLicenseNo_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="text" name='EMGIHDrivingLicenseNo' id="EMGIHDrivingLicenseNo"  maxlength="15"
                                                                            class="form-control few-options" placeholder="Driving License No">
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- office Info -->
                                            <div class="tab-pane fade" id="animated-underline-office" role="tabpanel" 
                                            aria-labelledby="animated-underline-office-tab">
                                                <div class="container-fluid">
                                                    
                                                    <div class="row mt-0">
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Office Email</label> 
                                                                <span class="error-text EMGIHOfficeEmail_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='EMGIHOfficeEmail' id="EMGIHOfficeEmail"  maxlength="100"
                                                                    class="form-control few-options" placeholder="Office Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Personal Email</label> 
                                                                <span class="error-text EMGIHPersonalEmail_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='EMGIHPersonalEmail' id="EMGIHPersonalEmail"  maxlength="100"
                                                                    class="form-control few-options" placeholder="Personal Email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-0">
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Office Extension</label> 
                                                                <span class="error-text EMGIHOfficeExtension_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='EMGIHOfficeExtension' id="EMGIHOfficeExtension"  maxlength="100"
                                                                    class="form-control few-options" placeholder="Office Extension">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Land Line No</label> 
                                                                <span class="error-text EMGIHOfficeLandLineNo_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='EMGIHOfficeLandLineNo' id="EMGIHOfficeLandLineNo"  maxlength="100"
                                                                    class="form-control few-options" placeholder="Land Line No">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='form-group'>                                                
                                                                <label>Office Mobile No</label> 
                                                                <span class="error-text EMGIHOfficeMobileNo_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='EMGIHOfficeMobileNo' id="EMGIHOfficeMobileNo"  maxlength="100"
                                                                    class="form-control few-options" placeholder="Office Mobile No">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class='form-group'>                                                
                                                                <label>Personal Phone No</label> 
                                                                <span class="error-text EMGIHPersonalPhoneNo_error text-danger" 
                                                                    style='float:right;'></span>
                                                                <input type="text" name='EMGIHPersonalPhoneNo' id="EMGIHPersonalPhoneNo"  maxlength="100"
                                                                    class="form-control few-options" placeholder="Personal Phone No">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Statutory and waged -->
                                            <div class="tab-pane fade" id="animated-underline-statutory" role="tabpanel" 
                                            aria-labelledby="animated-underline-statutory-tab">
                                                <div class="container-fluid">
                                                    <div class='row'>
                                                        <div class="col-md-6">
                                                            <div class="row mt-0">
                                                                <div class="col-md-6 n-chk mt-4">
                                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                        <input type="checkbox" class="new-control-input" name='EMGIHOTApplicable' id='EMGIHOTApplicable'>
                                                                        <span class="new-control-indicator"></span><span class="new-chk-content">OT Applicable</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class='form-group' id='otApplicableId'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>OT Basis</label>                                                
                                                                        <span class="error-text EMGIHOTBasisId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                            <select id='EMGIHOTBasisId' name = 'EMGIHOTBasisId' style='width: 100%;'>
                                                                                <option value='D'>Daily</option>
                                                                                <option value='H'>Hourly</option>
                                                                            </select>                                                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-0">
                                                                <div class="col-md-6 n-chk mt-4">
                                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                        <input type="checkbox" class="new-control-input" name='EMGIHIsDailyWages' id='EMGIHIsDailyWages'>
                                                                        <span class="new-control-indicator"></span><span class="new-chk-content">Daily Wages</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class='form-group' id='dailyWagesId'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>Wage Basis</label>                                                
                                                                        <span class="error-text EMGIHDailyWagesId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHDailyWagesId' name = 'EMGIHDailyWagesId' style='width: 100%;'>
                                                                            <option value='D'>Daily</option>
                                                                            <option value='H'>Hourly</option>
                                                                        </select>                                                
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row mt-0">
                                                                <div class="col-md-12">
                                                                    <div class='form-group'>                                                
                                                                        <!-- For defining select2 -->
                                                                        <label>Regime Id</label>                                                
                                                                        <span class="error-text EMGIHRegimeId_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <select id='EMGIHRegimeId' name = 'EMGIHRegimeId' style='width: 100%;'>
                                                                            <option value='0'>-- Select Regime --</option>                                                                
                                                                        </select>                                                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row mt-0">
                                                                <div class="col-md-5">
                                                                    <div class='form-group'>                                                
                                                                        <label>PF Threshold</label> 
                                                                        <span class="error-text EMGIHPFThreshold_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="number" name='EMGIHPFThreshold' id="EMGIHPFThreshold"  value=0.00
                                                                            class="form-control floatNumberField" placeholder="PF Threshold" style='opacity:1'>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class='form-group'>                                                
                                                                        <label>PF Acct No</label> 
                                                                        <span class="error-text EMGIHPFAcctNo_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="text" name='EMGIHPFAcctNo' id="EMGIHPFAcctNo"  maxlength="100"
                                                                            class="form-control few-options" placeholder="PF Acct No">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-0">
                                                            </div>
                                                            <div class="row mt-0">
                                                                <div class="col-md-5 n-chk mt-4">
                                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                        <input type="checkbox" class="new-control-input" name='EMGIHPFAgreedByComp' id='EMGIHPFAgreedByComp'>
                                                                        <span class="new-control-indicator"></span><span class="new-chk-content">Agreed By Comp</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class='form-group' id='pfCompLimitId'>                                                
                                                                        <label>Comp Limit</label> 
                                                                        <span class="error-text EMGIHPFCompLimit_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="text" name='EMGIHPFCompLimit' id="EMGIHPFCompLimit"  value=0.00
                                                                            class="form-control floatNumberField" placeholder="Comp Limit" style='opacity:1'>
                                                                    </div>
                                                                </div>
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
                                                        <div class='row'>
                                                            <!-- Present Address-->
                                                            <div class="col-md-5">
                                                                <div class="row mt-0">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Present Address 1</label>
                                                                            <span class="error-text EMGIHPresentAddress1_error text-danger" 
                                                                                 style='float:right;'></span>
                                                                            <input type="text" name="EMGIHPresentAddress1" id="EMGIHPresentAddress1" 
                                                                            class='form-control few-options' maxlength="100" placeholder="Present Address 1"/>
                                                                        </div>
                                                                    </div>                                                                
                                                                </div>
                                                                <!-- Address2,Address3-->
                                                                <div class="row mt-0">
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label>Present Address2</label>                                                
                                                                            <input type="text" name="EMGIHPresentAddress2" id="EMGIHPresentAddress2" 
                                                                            class='form-control few-options' maxlength="100" placeholder="Present Address 2"/>                                              
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Present Address3</label>
                                                                            <input type="text" name="EMGIHPresentAddress3" id="EMGIHPresentAddress3" 
                                                                            class='form-control few-options' maxlength="100" placeholder="Present Address 3"/>
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                                <div class="row mt-0">
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label> Present City</label>                                                
                                                                            <span class="error-text EMGIHPresentCityId_error text-danger" 
                                                                                style='float:right;'></span>
                                                                            <select id='EMGIHPresentCityId' name = 'EMGIHPresentCityId' style='width: 100%;'>
                                                                                <option value=''>-- Select Present City --</option>
                                                                            </select>                                                
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label>State</label> 
                                                                            <input type="hidden" name='EMGIHPresentStateId' id='EMGIHPresentStateId' 
                                                                            class='form-control'>                                               
                                                                            <input type="text" name='presentStateDesc1' id='presentStateDesc1'value='' 
                                                                            class='form-control' readonly>  
                                                                            </select>                                                
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Country & Pin Code -->
                                                                <div class="row mt-0">
                                                                        <div class="col-md-6">                                               
                                                                            <div class='form-group'>
                                                                                <label>Country</label>  
                                                                                <input type="hidden" name='EMGIHPresentCountryId' id='EMGIHPresentCountryId' 
                                                                                class='form-control'>                                              
                                                                                <input type="text" name='presentCountryDesc1' id='presentCountryDesc1'value='' 
                                                                                class='form-control' readonly>                                          
                                                                            </div>   
                                                                        </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Pin Code</label>
                                                                            <span class="error-text EMGIHPresentPinCode_error text-danger" 
                                                                                 style='float:right;'></span>
                                                                            <input type="text" name="EMGIHPresentPinCode" id="EMGIHPresentPinCode" 
                                                                            class='form-control few-options' maxlength="50" placeholder="Pin Code"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Permanent Address-->
                                                            <div class="col-md-2">
                                                                <div class="n-chk col-md-12">
                                                                    <div class="form-group">
                                                                        <span class="error-text EMGIHSameAsPresentAdd_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                            <input type="checkbox" class="new-control-input" name='EMGIHSameAsPresentAdd' id='EMGIHSameAsPresentAdd'>
                                                                            <span class="new-control-indicator"></span><span class="new-chk-content">Same As Present Add</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Permanent Address-->
                                                            <div class="col-md-5">
                                                                <div class="row mt-0">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Permanent Address 1</label>
                                                                            <input type="text" name="EMGIHPermanentAddress1" id="EMGIHPermanentAddress1" 
                                                                            class='form-control few-options' maxlength="100" placeholder="Present Address 1"/>
                                                                        </div>
                                                                    </div>                                                                
                                                                </div>
                                                             <!-- Address2,Address3-->
                                                                <div class="row mt-0">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Permanent Address 2</label>
                                                                            <input type="text" name="EMGIHPermanentAddress2" id="EMGIHPermanentAddress2" 
                                                                            class='form-control few-options' maxlength="100" placeholder="Permanent Address 2"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Permanent Address 2</label>
                                                                            <input type="text" name="EMGIHPermanentAddress3" id="EMGIHPermanentAddress3" 
                                                                            class='form-control few-options' maxlength="100" placeholder="Permanent Address 2"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-0">                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label>Permanent City</label>                                                
                                                                            <span class="error-text EMGIHPermanentCityId_error text-danger" 
                                                                                style='float:right;'></span>
                                                                            <select id='EMGIHPermanentCityId' name = 'EMGIHPermanentCityId' style='width: 100%;'>
                                                                                <option value=''>-- Select Permanent City --</option>
                                                                            </select>                                                
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label>State</label> 
                                                                            <input type="hidden" name='EMGIHPermanentStateId' id='EMGIHPermanentStateId' 
                                                                            class='form-control'>                                               
                                                                            <input type="text" name='permanentStateDesc1' id='permanentStateDesc1'value='' 
                                                                            class='form-control' readonly>  
                                                                            </select>                                                
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Country & Pin Code -->
                                                                <div class="row mt-0">                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class='form-group'>
                                                                            <label>Country</label>  
                                                                            <input type="hidden" name='EMGIHPermanentCountryId' id='EMGIHPermanentCountryId' 
                                                                            class='form-control'>                                              
                                                                            <input type="text" name='permanentCountryDesc1' id='permanentCountryDesc1'value='' 
                                                                            class='form-control' readonly>                                          
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Pin Code</label>
                                                                            <input type="text" name="EMGIHPermanentPinCode" id="EMGIHPermanentPinCode" 
                                                                            class='form-control few-options' maxlength="50" placeholder="Pin Code"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Banking Info -->
                                            <div class="tab-pane fade" id="animated-underline-banking" role="tabpanel" aria-labelledby="animated-underline-banking-tab">                                                    
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label style='color:#ffc107'>Branch</label>
                                                                    <select id='EMGIHBranchId' name = 'EMGIHBranchId' style='width: 100%;'>
                                                                        <option value=''>-- Select Branch --</option>
                                                                    </select>                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label style='color:#ffc107'>Bank</label>
                                                                    <input type="hidden" name="EMGIHBankId" id="EMGIHBankId">
                                                                    <input type="text" name="bankName" id="bankName" 
                                                                        class="form-control" readonly/>                                                
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label style='color:#ffc107'>IFS Code</label>
                                                                    <input type="text" name="EMGIHIFSCId" id="EMGIHIFSCId" 
                                                                    class="form-control" readonly/>                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label style='color:#ffc107'>Acct.Name</label>
                                                                    <span class="error-text EMGIHAccountHolderName_error text-danger" 
                                                                                 style='float:right;'></span>
                                                                    <input type="text" name="EMGIHAccountHolderName" id="EMGIHAccountHolderName" maxlength="100"
                                                                    class="form-control few-options" placeholder="Acct.Name">                                             
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label style='color:#ffc107'>Acct.No.</label>
                                                                    <span class="error-text EMGIHBankAccountNo_error text-danger" 
                                                                                 style='float:right;'></span>
                                                                    <input type="text" name="EMGIHBankAccountNo" id="EMGIHBankAccountNo" maxlength="100" 
                                                                    class="form-control few-options" placeholder="Acct.No.">                                             
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-0">
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label style='color:#ffc107'>Account Type</label>
                                                                    <select id='EMGIHAccountTypeId' name = 'EMGIHAccountTypeId' style='width: 100%;'>
                                                                        <option value=''>-- Select Acct Type --</option>
                                                                    </select>                                                
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label style='color:#ffc107'>Payment Mode</label>
                                                                    <select id='EMGIHPaymentModeId' name = 'EMGIHPaymentModeId' style='width: 100%;'>
                                                                        <option value=''>-- Select Payment Mode --</option>
                                                                    </select>                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Resignation Info -->
                                            <div class="tab-pane fade" id="animated-underline-resignation" role="tabpanel" 
                                            aria-labelledby="animated-underline-resignation-tab">
                                                <div class="container-fluid">
                                                    <div class='row'>
                                                        <div class="col-md-9">
                                                            <div class="row mt-0">
                                                                <div class="col-md-3 n-chk mt-4">
                                                                    <div class="form-group">
                                                                        <span class="error-text EMGIHIsResignation_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                            <input type="checkbox" class="new-control-input" name='EMGIHIsResignation' id='EMGIHIsResignation'>
                                                                            <span class="new-control-indicator"></span><span class="new-chk-content">Is Resignation</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class='form-group' id='letterSub'>
                                                                        <label>Letter Submission</label> 
                                                                        <span class="error-text EMGIHDateOfLetterSubmission_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="date" name='EMGIHDateOfLetterSubmission' id="EMGIHDateOfLetterSubmission"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class='form-group' id='dOfResig'>
                                                                        <label>Resignation</label> 
                                                                        <span class="error-text EMGIHDateOfResignation_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="date" name='EMGIHDateOfResignation' id="EMGIHDateOfResignation"
                                                                            class="form-control">                                             
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class='form-group' id='dOfLeaving'>
                                                                        <label>Leaving</label> 
                                                                        <span class="error-text EMGIHDateOfLeaving_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <input type="date" name='EMGIHDateOfLeaving' id="EMGIHDateOfLeaving"
                                                                            class="form-control">                                             
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-0">
                                                                <div class="col-md-6">
                                                                    <div class='form-group'>                                                
                                                                        <label>Reason</label>  
                                                                        <textarea name='EMGIHReason' id='EMGIHReason' class='form-control few-options' 
                                                                        maxlength="100" name="alloptions" id="alloptions1" placeholder="Reason" 
                                                                        aria-label="With textarea" 
                                                                        style='border-color: rgb(102, 175, 233); outline: 0px'></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class='form-group'>                                                
                                                                        <label>Remarks For FnF</label>  
                                                                        <textarea name='EMGIHRemarksForFnF' id='EMGIHRemarksForFnF' class='form-control few-options' 
                                                                        maxlength="100" name="alloptions" id="alloptions1" placeholder="Remarks For FnF" 
                                                                        aria-label="With textarea" 
                                                                        style='border-color: rgb(102, 175, 233); outline: 0px'></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="row mt-0">
                                                                <div class="n-chk mt-4">
                                                                    <div class="form-group">
                                                                        <span class="error-text EMGIHLeaveWithoutPayIndicator_error text-danger" 
                                                                            style='float:right;'></span>
                                                                        <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                            <input type="checkbox" class="new-control-input" name='EMGIHLeaveWithoutPayIndicator' id='EMGIHLeaveWithoutPayIndicator'>
                                                                            <span class="new-control-indicator"></span><span class="new-chk-content">Leave Without Pay Indicator</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-0">
                                                                <div class="col-md-12 mt-2  ">
                                                                    <div class="form-group">
                                                                        <label>Leave Without Pay From</label> 
                                                                            <span class="error-text EMGIHLeaveWithoutPayFrom_error text-danger" 
                                                                                style='float:right;'></span>
                                                                            <input type="date" name='EMGIHLeaveWithoutPayFrom' id="EMGIHLeaveWithoutPayFrom"
                                                                                class="form-control">
                                                                    </div>
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
                                                            <input type="text" name="EMGIHUser" id="EMGIHUser" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Created Date</label>
                                                            <input type="date" name="EMGIHLastCreated" id="EMGIHLastCreated" 
                                                            class="form-control col-sm-6" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Updated Date</label>
                                                            <input type="date" name="EMGIHLastUpdated" id="EMGIHLastUpdated" 
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
        // if($('#EMGIHOTApplicable').prop('checked')==true) {
        //         $("#EMGIHOTBasisId").attr("readonly", false);
        //     }else {
        //         $("#EMGIHOTBasisId").attr("readonly", true);
        //     }
        // if($('#EMGIHIsDailyWages').prop('checked')==true) {
        //     $('#EMGIHDailyWagesId').prop('disabled', false);
        //     }else{
        //         $('#EMGIHDailyWagesId').prop('disabled', true);
        //     }

        if($('#EMGIHPFAgreedByComp').prop('checked')==true) {   
                $("#EMGIHPFCompLimit").attr("readonly", false);
            }else {
                $("#EMGIHPFCompLimit").attr("readonly", true);
            }
        if($('#EMGIHIsResignation').prop('checked')==true) {   
                $("#EMGIHDateOfLetterSubmission").attr("readonly", false);
                $("#EMGIHDateOfResignation").attr("readonly", false);
                $("#EMGIHDateOfLeaving").attr("readonly", false);
                $("#EMGIHReason").attr("readonly", false);
                $("#EMGIHRemarksForFnF").attr("readonly", false);
            }else {
                $("#EMGIHDateOfLetterSubmission").attr("readonly", true);
                $("#EMGIHDateOfResignation").attr("readonly", true);
                $("#EMGIHDateOfLeaving").attr("readonly", true);
                $("#EMGIHReason").attr("readonly", true);
                $("#EMGIHRemarksForFnF").attr("readonly", true);
            }
        if($('#EMGIHLeaveWithoutPayIndicator').prop('checked')==true) {   
                $("#EMGIHLeaveWithoutPayFrom").attr("readonly", false);
            }else {
                $("#EMGIHLeaveWithoutPayFrom").attr("readonly", true);
            }
        if ($('#EMGIHMaritalStatusId').val() != '1000') {
                $("#EMGIHDateOfMarriage").attr("readonly", true);
                $("#EMGIHSpouseName").attr("readonly", true);
            }else{
                $("#EMGIHDateOfMarriage").attr("readonly", false);
                $("#EMGIHSpouseName").attr("readonly", false);
            }
        $( "#EMGIHLocationId" ).select2();
        $( "#EMGIHSalutationId" ).select2();
        $( "#EMGIHGenderId" ).select2();
        $( "#EMGIHEmploymentTypeId" ).select2();
        $( "#EMGIHGradeId" ).select2();
        $( "#EMGIHDesignationId" ).select2();
        $( "#EMGIHDepartmentId" ).select2();
        $( "#EMGIHCalendarId" ).select2();

        $( "#EMGIHNationalityId" ).select2();
        $( "#EMGIHReligionId" ).select2();
        $( "#EMGIHRaceCastId" ).select2();

        $( "#EMGIHBloodGroupId" ).select2();
        $( "#EMGIHPhysicalStatusId" ).select2();
        $( "#EMGIHLeaveGroupId" ).select2();
        $( "#EMGIHMaritalStatusId" ).select2();

        $( "#EMGIHOTBasisId" ).select2();
        $( "#EMGIHDailyWagesId" ).select2();
        $( "#EMGIHRegimeId" ).select2();

        $( "#EMGIHPresentCityId" ).select2();
        $( "#EMGIHPermanentCityId" ).select2();

        $( "#EMGIHBranchId" ).select2();
        $( "#EMGIHAccountTypeId" ).select2();
        $( "#EMGIHPaymentModeId" ).select2();

        $(".floatNumberField").change(function() {
			$(this).val(parseFloat($(this).val()).toFixed(2));
		});

        $modalTitle = 'Employee Master'
        $('#html5-extension3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
            buttons: [
                // { extend: 'copy', className: 'btn' },
                // { extend: 'csv', className: 'btn' },
                { extend: 'excel', className: 'btn' },
                { extend: 'print', className: 'btn' }
            ]
            },
            oLanguage: {
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
            order: [[ 1, "desc" ]],
            processing: true,
            serverSide: true,
            // CopyChange                    
            ajax: "{{ route('generalInfo.browserData')}}",
            columns:[
                // CopyChange
                {data: "EMGIHLocationId"},
                {data: "EMGIHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "EMGIHDateOfBirth"},
                {data: "EMGIHDateOfJoining"},                    
                {data: "action", orderable:false, searchable: false},
                {data: "EMGIHUser", "visible": false},
                {data: "EMGIHLastUpdated", "visible": false},
                {data: "EMGIHUniqueId", "visible": false},
                {data: "EMGIHCompId", "visible": false},                    
            ],
            // columnDefs: [{
            //     "targets": 3,
            //     data:   "EMGIHCurrentFY",
            //     render: function (data ,td, cellData, rowData, row, col) {
            //             if(data==1){
            //                 return '<input class="columnDefs" datacolumnDefs="'+data+'" type="checkbox" checked>';
            //             }else{
            //                 return '<input class="columnDefs" datacolumnDefs="'+data+'" type="checkbox">';
            //             }
            //     }
            // }]
        });
            
        // Whed add buttonis pushed
        $('#add_Data').click(function(){                    
            $("#EMGIHEmployeeId").attr("readonly", false);
            fnReinstateFormControl('0');
            $("#animated-underline-home-tab").trigger('click');
            fnUpdateDropdownsAddMode();
            $('#EMGIHOTBasisId').val('D').trigger('change');                        
            $('#EMGIHDailyWagesId').val('D').trigger('change');                        


        });
        

        // Add Ends                   
        // When edit button is pushed
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $.ajax({
                // CopyChange
                url: "{{route('generalInfo.fetchData')}}",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data)
                {
                    fnReinstateFormControl('1');
                    // Update Screen Variables
                    fnUpdateScreenVariables(data);
                    fnUpdateCheckBoxes(data);
                    // Update Dropdowns
                    fnUpdateDropdownsEditMode(data)
                    $("#EMGIHEmployeeId").attr("readonly", true);
                    $("#animated-underline-home-tab").trigger('click');
                    
                }
            });
        });
        // Edit Ends
        // Update Screen Variables
        function fnUpdateScreenVariables(data) {

            var DoB = formattedDate(new Date(data.EMGIHDateOfBirth));
            var DoJ = formattedDate(new Date(data.EMGIHDateOfJoining));
            var DoC = formattedDate(new Date(data.EMGIHDateOfConfirmation));
            var DoM = formattedDate(new Date(data.EMGIHDateOfMarriage));
            var DoLS = formattedDate(new Date(data.EMGIHDateOfLetterSubmission));
            var DoR = formattedDate(new Date(data.EMGIHDateOfResignation));
            var DoL = formattedDate(new Date(data.EMGIHDateOfLeaving));
            var LeaveWithoutPay = formattedDate(new Date(data.EMGIHLeaveWithoutPayFrom));
            var lastCreated = formattedDate(new Date(data.GMLMHLastCreated));
            var lastUpdated = formattedDate(new Date(data.GMLMHLastUpdated));
            $('#EMGIHUniqueId').val(data.EMGIHUniqueId);
            $('#EMGIHCompId').val(data.EMGIHCompId);
            $('#EMGIHLocationId').val(data.EMGIHLocationId);
            $('#EMGIHEmployeeId').val(data.EMGIHEmployeeId);
            $('#EMGIHSalutationId').val(data.EMGIHSalutationId);
            $('#EMGIHGenderId').val(data.EMGIHGenderId);
            $('#EMGIHFirstName').val(data.EMGIHFirstName);
            $('#EMGIHMiddleName').val(data.EMGIHMiddleName);
            $('#EMGIHLastName').val(data.EMGIHLastName);
            $('#EMGIHFullName').val(data.EMGIHFullName);
            $('#EMGIHDateOfBirth').val(DoB);
            $('#EMGIHDateOfJoining').val(DoJ);
            $('#EMGIHDateOfConfirmation').val(DoC);
            $('#EMGIHEmploymentTypeId').val(data.EMGIHEmploymentTypeId);
            $('#EMGIHGradeId').val(data.EMGIHGradeId);
            $('#EMGIHDesignationId').val(data.EMGIHDesignationId);
            $('#EMGIHDepartmentId').val(data.EMGIHDepartmentId);
            $('#EMGIHCalendarId').val(data.EMGIHCalendarId);
            $('#EMGIHNationalityId').val(data.EMGIHNationalityId);
            $('#EMGIHReligionId').val(data.EMGIHReligionId);
            $('#EMGIHRaceCastId').val(data.EMGIHRaceCastId);
            $('#EMGIHBloodGroupId').val(data.EMGIHBloodGroupId);
            $('#EMGIHPhysicalStatusId').val(data.EMGIHPhysicalStatusId);
            $('#EMGIHMaritalStatusId').val(data.EMGIHMaritalStatusId);
            $('#EMGIHDateOfMarriage').val(DoM);
            $('#EMGIHSpouseName').val(data.EMGIHSpouseName);
            $('#EMGIHOfficeEmail').val(data.EMGIHOfficeEmail);
            $('#EMGIHOfficeExtension').val(data.EMGIHOfficeExtension);
            $('#EMGIHOfficeLandLineNo').val(data.EMGIHOfficeLandLineNo);
            $('#EMGIHOfficeMobileNo').val(data.EMGIHOfficeMobileNo);
            $('#EMGIHPersonalEmail').val(data.EMGIHPersonalEmail);
            $('#EMGIHPersonalPhoneNo').val(data.EMGIHPersonalPhoneNo);
            $('#EMGIHPANNo').val(data.EMGIHPANNo);
            $('#EMGIHAadharNo').val(data.EMGIHAadharNo);
            $('#EMGIHDrivingLicenseNo').val(data.EMGIHDrivingLicenseNo);
            $('#EMGIHUANNo').val(data.EMGIHUANNo);
            $('#EMGIHPresentAddress1').val(data.EMGIHPresentAddress1);
            $('#EMGIHPresentAddress2').val(data.EMGIHPresentAddress2);
            $('#EMGIHPresentAddress3').val(data.EMGIHPresentAddress3);
            $('#EMGIHPresentCityId').val(data.EMGIHPresentCityId);
            $('#EMGIHPresentStateId').val(data.EMGIHPresentStateId);
            $('#EMGIHPresentCountryId').val(data.EMGIHPresentCountryId);
            $('#EMGIHPresentPinCode').val(data.EMGIHPresentPinCode);
            $('#EMGIHPresentContactName').val(data.EMGIHPresentContactName);
            $('#EMGIHSameAsPresentAdd').val(data.EMGIHSameAsPresentAdd);
            $('#EMGIHPermanentAddress1').val(data.EMGIHPermanentAddress1);
            $('#EMGIHPermanentAddress2').val(data.EMGIHPermanentAddress2);
            $('#EMGIHPermanentAddress3').val(data.EMGIHPermanentAddress3);
            $('#EMGIHPermanentCityId').val(data.EMGIHPermanentCityId);
            $('#EMGIHPermanentStateId').val(data.EMGIHPermanentStateId);
            $('#EMGIHPermanentCountryId').val(data.EMGIHPermanentCountryId);
            $('#EMGIHPermanentPinCode').val(data.EMGIHPermanentPinCode);
            $('#EMGIHPermanentContactName').val(data.EMGIHPermanentContactName);
            $('#EMGIHPermanentContactNo').val(data.EMGIHPermanentContactNo);
            $('#EMGIHReportingManager1Id').val(data.EMGIHReportingManager1Id);
            $('#EMGIHReportingManager2Id').val(data.EMGIHReportingManager2Id);
            $('#EMGIHReportingManager3Id').val(data.EMGIHReportingManager3Id);
            $('#EMGIHPaymentModeId').val(data.EMGIHPaymentModeId);
            $('#EMGIHBranchId').val(data.EMGIHBranchId);
            $('#EMGIHBankId').val(data.EMGIHBankId);
            $('#EMGIHIFSCId').val(data.EMGIHIFSCId);
            $('#EMGIHAccountTypeId').val(data.EMGIHAccountTypeId);
            $('#EMGIHBankAccountNo').val(data.EMGIHBankAccountNo);
            $('#EMGIHOTApplicable').val(data.EMGIHOTApplicable);
            $('#EMGIHOTBasisId').val(data.EMGIHOTBasisId);
            $('#EMGIHIsDailyWages').val(data.EMGIHIsDailyWages);
            $('#EMGIHDailyWagesId').val(data.EMGIHDailyWagesId);
            $('#EMGIHPFApplicable').val(data.EMGIHPFApplicable);
            $('#EMGIHPFThreshold').val(data.EMGIHPFThreshold);
            $('#EMGIHPFAgreedByComp').val(data.EMGIHPFAgreedByComp);
            $('#EMGIHPFCompLimit').val(data.EMGIHPFCompLimit);
            $('#EMGIHPFAcctNo').val(data.EMGIHPFAcctNo);
            $('#EMGIHRegimeId').val(data.EMGIHRegimeId);
            $('#EMGIHIsResignation').val(data.EMGIHIsResignation);
            $('#EMGIHDateOfLetterSubmission').val(DoLS);
            $('#EMGIHDateOfResignation').val(DoR);
            $('#EMGIHDateOfLeaving').val(DoL);
            $('#EMGIHReason').val(data.EMGIHReason);
            $('#EMGIHRemarksForFnF').val(data.EMGIHRemarksForFnF);
            $('#EMGIHLeaveWithoutPayIndicator').val(data.EMGIHLeaveWithoutPayIndicator);
            $('#EMGIHLeaveWithoutPayFrom').val(LeaveWithoutPay);
            $('#EMGIHOldEmployeeCode').val(data.EMGIHOldEmployeeCode);
            $('#EMGIHGroup').val(data.EMGIHGroup);
            $('#EMGIHLeaveGroupId').val(data.EMGIHLeaveGroupId);
            $('#EMGIHBiDesc').val(data.EMGIHBiDesc);
            $('#EEGIHIncomeDefined').val(data.EEGIHIncomeDefined);
            $('#EEGIHDeductionDefined').val(data.EEGIHDeductionDefined);
            $('#EMGIHMarkForDeletion').val(data.EMGIHMarkForDeletion);
            $('#EMGIHUser').val(data.EMGIHUser);
            $('#GMLMHLastCreated').val(lastCreated);                        
            $('#GMLMHLastUpdated').val(lastUpdated);
            $('#EMGIHOTBasisId').val(data.EMGIHOTBasisId).trigger('change');
            $('#EMGIHDailyWagesId').val(data.EMGIHDailyWagesId).trigger('change');

        }
        // Update Screen Variables Ends
        // Update Checkboxes
        function fnUpdateCheckBoxes(data) {
            //OTApplicable
            if(data.EMGIHOTApplicable == 1)
            {
                    $("#EMGIHOTApplicable").prop("checked", true);
                }else{
                    $("#EMGIHOTApplicable").prop("checked", false);
            }
            //IsDailyWages
             if(data.EMGIHIsDailyWages == 1)
            {
                    $("#EMGIHIsDailyWages").prop("checked", true);
                }else{
                    $("#EMGIHIsDailyWages").prop("checked", false);
            }
            //PFAgreedByComp
            if(data.EMGIHPFAgreedByComp == 1)
            {
                    $("#EMGIHPFAgreedByComp").prop("checked", true);
                }else{
                    $("#EMGIHPFAgreedByComp").prop("checked", false);
            }
            //SameAsPresentAdd
            if(data.EMGIHSameAsPresentAdd == 1)
            {
                    $("#EMGIHSameAsPresentAdd").prop("checked", true);
                }else{
                    $("#EMGIHSameAsPresentAdd").prop("checked", false);
            }
            //IsResignation
            if(data.EMGIHIsResignation == 1)
            {
                    $("#EMGIHIsResignation").prop("checked", true);
                }else{
                    $("#EMGIHIsResignation").prop("checked", false);
            }
            //LeaveWithoutPayIndicator
            if(data.EMGIHLeaveWithoutPayIndicator == 1)
            {
                    $("#EMGIHLeaveWithoutPayIndicator").prop("checked", true);
                }else{
                    $("#EMGIHLeaveWithoutPayIndicator").prop("checked", false);
            }
        } 
        // Update Checkboxes Ends

        // When submit button is pushed
        $('#singleLevelDataEntryForm').on('submit', function(event){
            //OTApplicable
            if($('#EMGIHOTApplicable').prop('checked')==true) {
                $('#EMGIHOTApplicable').val(1);
            }else {
                $('#EMGIHOTApplicable').val(0);
            }
            //IsDailyWages
            if($('#EMGIHIsDailyWages').prop('checked')==true) {
                $('#EMGIHIsDailyWages').val(1);
            }else {
                $('#EMGIHIsDailyWages').val(0);
            }
            //PFAgreedByComp
            if($('#EMGIHPFAgreedByComp').prop('checked')==true) {
                $('#EMGIHPFAgreedByComp').val(1);
            }else {
                $('#EMGIHPFAgreedByComp').val(0);
            }
            //SameAsPresentAdd
            if($('#EMGIHSameAsPresentAdd').prop('checked')==true) {
                $('#EMGIHSameAsPresentAdd').val(1);
            }else {
                $('#EMGIHSameAsPresentAdd').val(0);
            }
            //IsResignation
            if($('#EMGIHIsResignation').prop('checked')==true) {
                $('#EMGIHIsResignation').val(1);
            }else {
                $('#EMGIHIsResignation').val(0);
            }
            //LeaveWithoutPayIndicator
            if($('#EMGIHLeaveWithoutPayIndicator').prop('checked')==true) {
                $('#EMGIHLeaveWithoutPayIndicator').val(1);
            }else {
                $('#EMGIHLeaveWithoutPayIndicator').val(0);
            }
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: "json",
                // headers : {
                //     "content-type": "application/json",
                //     "accept": "application/json",
                // },
                contentType: false,
                cache: false,
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
                url: "{{route('generalInfo.fetchData')}}",
                method: 'GET',
                data: {id:UniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.EMGIHEmployeeId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');                   
                }
            });
            // Fetch Record Ends
            // Delete record only when OK is pressed on Modal.
            $(document).on('click', '.confirm', function(){
                $.ajax({
                    // CopyChange
                    url:"{{route('generalInfo.deleteData')}}",
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
            "ajax": "{{ route('generalInfo.browserDeletedRecords')}}",
            "columns":[
                // CopyChange
                {data: "EMGIHEmployeeId"},
                {data: "EMGIHFullName"},
                {data: "EMGIHDateOfBirth"},
                {data: "action", orderable:false, searchable: false},
                {data: "EMGIHUniqueId", "visible": false},
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
                url: "{{route('generalInfo.fetchData')}}",
                method: 'GET',
                data: {id:DeletedUniqueId},
                dataType: 'json',
                success: function(data)
                {
                    $restoreMessage3SIS = fnSingleLevelRestoreConfirmation($modalTitle, data.EMGIHEmployeeId, '');   
                    $('#RestoreRecord').html($restoreMessage3SIS);
                    $('#modalZoomRestoreRecord3SIS').modal('show');  
                    $('#modalZoomRestoreRecord3SIS').modal('hide');                    
                }
            });
            // Fetch Record Ends
            // Restore record only when OK is pressed on Modal.
            $(document).on('click', '.confirmrestore', function(){
                $.ajax({
                    url:"{{route('generalInfo.restoreDeletedRecords')}}",
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
        // When Present city Id is selected, bring State and Country Desc
        $('#EMGIHPresentCityId').change(function(){
            let id = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getGeoDesc')}}",
                type:'post',
                data:'id=' + id + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#EMGIHPresentStateId').val(response.stateId);
                    $('#presentStateDesc1').val(response.stateDesc1);
                    $('#EMGIHPresentCountryId').val(response.countryId);
                    $('#presentCountryDesc1').val(response.countryDesc1);
                }
            })
        }); 
        // When Permanent city Id is selected, bring State and Country Desc
        $('#EMGIHPermanentCityId').change(function(){
            let id = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getGeoDesc')}}",
                type:'post',
                data:'id=' + id + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#EMGIHPermanentStateId').val(response.stateId);
                    $('#permanentStateDesc1').val(response.stateDesc1);
                    $('#EMGIHPermanentCountryId').val(response.countryId);
                    $('#permanentCountryDesc1').val(response.countryDesc1);
                }
            })
        }); 
        // When branch Id is selected, bring BankName and IFSC
        $('#EMGIHBranchId').change(function(){
            let id = $(this).val();
            $.ajax({
                url: "{{route('dropDownMasters.getBranchDetails')}}",
                type:'post',
                data:'id=' + id + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#bankName').val(response.bankDesc1);
                    $('#EMGIHIFSCId').val(response.ifsCode);
                    $('#EMGIHBankId').val(response.bankId);
                }
            })
        });  
         // When SameAsPresentAdd is Checked, bring all to addres1 to address2
        $("#EMGIHSameAsPresentAdd").on("click", function(){
            if (this.checked) {
                $('#EMGIHPermanentAddress1').val($("#EMGIHPresentAddress1").val());
                $('#EMGIHPermanentAddress2').val($("#EMGIHPresentAddress2").val());
                $('#EMGIHPermanentAddress3').val($("#EMGIHPresentAddress3").val());
                $('#EMGIHPermanentCityId').val($("#EMGIHPresentCityId").val());

                $('#EMGIHPermanentStateId').val($("#EMGIHPresentStateId").val());
                $('#permanentStateDesc1').val($("#presentStateDesc1").val());

                $('#EMGIHPermanentCountryId').val($("#EMGIHPresentCountryId").val());
                $('#permanentCountryDesc1').val($("#presentCountryDesc1").val());

                $('#EMGIHPermanentPinCode').val($("#EMGIHPresentPinCode").val());
            }
            else {
                $("#EMGIHPermanentAddress1").val('');
                $("#EMGIHPermanentAddress2").val('');
                $("#EMGIHPermanentAddress3").val('');
                $("#EMGIHPermanentCityId").val('');
                $("#EMGIHPermanentStateId").val('');           
                $("#permanentStateDesc1").val('');           
                $("#EMGIHPermanentCountryId").val('');           
                $("#permanentCountryDesc1").val('');           
                $("#EMGIHPermanentPinCode").val('');           
            }
        }); 
        // OTApplicable Checked then show 
        $('#EMGIHOTApplicable').change(function(){
            if($('#EMGIHOTApplicable').prop('checked')==true) {
                $('#EMGIHOTBasisId').prop('disabled', false);
                // fnUpdateDropdownsAddMode();
            }else{
                $('#EMGIHOTBasisId').prop('disabled', true);                
            }
        })
        //IsDailyWages Checked then show 
        $('#EMGIHIsDailyWages').change(function(){
            if($('#EMGIHIsDailyWages').prop('checked')==true) {
                $('#EMGIHDailyWagesId').prop('disabled', false);
                // fnUpdateDropdownsAddMode();
            }else{
                $('#EMGIHDailyWagesId').prop('disabled', true);
            }
        })
        //IsDailyWages Checked then show 
        $('#EMGIHPFAgreedByComp').change(function(){
            if($('#EMGIHPFAgreedByComp').prop('checked')==true) {   
                $("#EMGIHPFCompLimit").attr("readonly", false);
            }else {
                $("#EMGIHPFCompLimit").attr("readonly", true);
            }
        })
        //IsResignation Checked then show 
        $('#EMGIHIsResignation').change(function(){
            if($('#EMGIHIsResignation').prop('checked')==true) {   
                    $("#EMGIHDateOfLetterSubmission").attr("readonly", false);
                    $("#EMGIHDateOfResignation").attr("readonly", false);
                    $("#EMGIHDateOfLeaving").attr("readonly", false);
                    $("#EMGIHReason").attr("readonly", false);
                    $("#EMGIHRemarksForFnF").attr("readonly", false);
                }else {
                    $("#EMGIHDateOfLetterSubmission").attr("readonly", true);
                    $("#EMGIHDateOfResignation").attr("readonly", true);
                    $("#EMGIHDateOfLeaving").attr("readonly", true);
                    $("#EMGIHReason").attr("readonly", true);
                    $("#EMGIHRemarksForFnF").attr("readonly", true);

                    // $('#EMGIHDateOfLetterSubmission').val(" ");
                    // $('#EMGIHDateOfResignation').val(" ");
                    // $('#EMGIHDateOfLeaving').val(" ");
            }
        })
        //LeaveWithoutPayIndicator Checked then show 
        $('#EMGIHLeaveWithoutPayIndicator').change(function(){
            if($('#EMGIHLeaveWithoutPayIndicator').prop('checked')==true) {   
                $("#EMGIHLeaveWithoutPayFrom").attr("readonly", false);
            }else {
                $("#EMGIHLeaveWithoutPayFrom").attr("readonly", true);
            }
        })
        //MaritalStatusId Checked then show 
        $('#EMGIHMaritalStatusId').change(function(){
            if ($('#EMGIHMaritalStatusId').val() != '1000') {
                $("#EMGIHDateOfMarriage").attr("readonly", true);
                $("#EMGIHSpouseName").attr("readonly", true);
            }else{
                $("#EMGIHDateOfMarriage").attr("readonly", false);
                $("#EMGIHSpouseName").attr("readonly", false);
            }
        })
        function fnUpdateDropdownsEditMode(data){
            //GetSelectedEmploymentType
            var $EmploymentType = data.EMGIHEmploymentTypeId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedEmploymentType')}}",
                method: 'GET',
                data: {id:$EmploymentType},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHEmploymentTypeId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedGradeType
            var $GradeId = data.EMGIHGradeId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedGradeType')}}",
                method: 'GET',
                data: {id:$GradeId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHGradeId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedDesignation
            var $DesignationId = data.EMGIHDesignationId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDesignation')}}",
                method: 'GET',
                data: {id:$DesignationId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHDesignationId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedDepartment
            var $DepartmentId = data.EMGIHDepartmentId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDepartment')}}",
                method: 'GET',
                data: {id:$DepartmentId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHDepartmentId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedCalendar
            var $CalendarId = data.EMGIHCalendarId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCalendar')}}",
                method: 'GET',
                data: {id:$CalendarId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHCalendarId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedLocation
            var $LocationId = data.EMGIHLocationId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedLocation')}}",
                method: 'GET',
                data: {id:$LocationId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHLocationId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedSalutation
            var $SalutationId = data.EMGIHSalutationId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedSalutation')}}",
                method: 'GET',
                data: {id:$SalutationId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHSalutationId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedGender
            var $GenderId = data.EMGIHGenderId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedGender')}}",
                method: 'GET',
                data: {id:$GenderId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHGenderId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedNationality
            var $NationalityId = data.EMGIHNationalityId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedNationality')}}",
                method: 'GET',
                data: {id:$NationalityId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHNationalityId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedReligionMaster
            var $ReligionId = data.EMGIHReligionId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedReligionMaster')}}",
                method: 'GET',
                data: {id:$ReligionId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHReligionId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedRaceGroup
            var $RaceCastId = data.EMGIHRaceCastId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedRaceGroup')}}",
                method: 'GET',
                data: {id:$RaceCastId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHRaceCastId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedBloodGroup
            var $BloodGroupId = data.EMGIHBloodGroupId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedBloodGroup')}}",
                method: 'GET',
                data: {id:$BloodGroupId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHBloodGroupId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedPhysicalStatus
            var $PhysicalStatusId = data.EMGIHPhysicalStatusId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedPhysicalStatus')}}",
                method: 'GET',
                data: {id:$PhysicalStatusId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHPhysicalStatusId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedMaritalStatus
            var $MaritalStatusId = data.EMGIHMaritalStatusId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedMaritalStatus')}}",
                method: 'GET',
                data: {id:$MaritalStatusId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHMaritalStatusId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedLeaveGroup
            var $LeaveGroupId = data.EMGIHLeaveGroupId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedMaritalStatus')}}",
                method: 'GET',
                data: {id:$LeaveGroupId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHLeaveGroupId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedCity for presentcityId
            var $PresentCityId = data.EMGIHPresentCityId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCity')}}",
                method: 'GET',
                data: {id:$PresentCityId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHPresentCityId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelected GeoDesc for presentcityId
            $.ajax({
                url: "{{route('location.getGeoDesc')}}",
                type:'post',
                data:'id=' + $PresentCityId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#EMGIHPresentStateId').val(response.stateId);
                    $('#presentStateDesc1').val(response.stateDesc1);
                    $('#EMGIHPresentCountryId').val(response.countryId);
                    $('#presentCountryDesc1').val(response.countryDesc1);
                }
            });
            //GetSelectedCity for permanentcityId
            var $PermanentCityId = data.EMGIHPermanentCityId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCity')}}",
                method: 'GET',
                data: {id:$PermanentCityId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHPermanentCityId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelected GeoDesc for permanentcityId
            $.ajax({
                url: "{{route('location.getGeoDesc')}}",
                type:'post',
                data:'id=' + $PermanentCityId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#EMGIHPermanentStateId').val(response.stateId);
                    $('#permanentStateDesc1').val(response.stateDesc1);
                    $('#EMGIHPermanentCountryId').val(response.countryId);
                    $('#permanentCountryDesc1').val(response.countryDesc1);
                }
            });
            //getBranch 
            var $BranchId = data.EMGIHBranchId;
            $.ajax({
                url: "{{route('dropDownMasters.getBranch')}}",
                method: 'GET',
                data: {id:$BranchId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHBranchId').html(response.SelectedItem);
                },
                cache: true
            });
            //get bankDesc1,ifsCode
            $.ajax({
                url: "{{route('dropDownMasters.getBranchDetails')}}",
                type:'post',
                data:'id=' + $BranchId + '&_token={{csrf_token()}}',
                success:function(response){
                    $('#bankName').val(response.bankDesc1);
                    $('#EMGIHIFSCId').val(response.ifsCode);
                    $('#EMGIHBankId').val(response.bankId);
                }
            })
            //getAcctType
            var $AccountTypeId = data.EMGIHAccountTypeId;
            $.ajax({
                url: "{{route('dropDownMasters.getAcctType')}}",
                method: 'GET',
                data: {id:$AccountTypeId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHAccountTypeId').html(response.SelectedItem);
                },
                cache: true
            });
            //getPaymentMode
            var $PaymentModeId = data.EMGIHPaymentModeId;
            $.ajax({
                url: "{{route('dropDownMasters.getPaymentMode')}}",
                method: 'GET',
                data: {id:$PaymentModeId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHPaymentModeId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedTaxRegim
            var $RegimeId = data.EMGIHRegimeId;
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedTaxRegim')}}",
                method: 'GET',
                data: {id:$RegimeId},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHRegimeId').html(response.SelectedItem);
                },
                cache: true
            });
        }
        //Update Full Name Start
        $('#EMGIHFirstName').change(function(){
            var FullName=$("#EMGIHFirstName").val() + " " + 
                         $("#EMGIHMiddleName").val() + " " + 
                         $("#EMGIHLastName").val();
            $('#EMGIHFullName').val(FullName);
            // $('#EMGIHFullName').val($("#EMGIHFirstName").val());
            // $('#EMGIHFullName').val($("#EMGIHFirstName").val().$("#EMGIHMiddleName").val());
            // $('#EMGIHPermanentAddress1').val($("#EMGIHPresentAddress1").val());
        });
        $('#EMGIHMiddleName').change(function(){
            var FullName=$("#EMGIHFirstName").val() + " " + 
                         $("#EMGIHMiddleName").val() + " " + 
                         $("#EMGIHLastName").val();
            $('#EMGIHFullName').val(FullName);
        });
        $('#EMGIHLastName').change(function(){
            var FullName=$("#EMGIHFirstName").val() + " " + 
                         $("#EMGIHMiddleName").val() + " " + 
                         $("#EMGIHLastName").val();
            $('#EMGIHFullName').val(FullName);
        });
         //Update Full Name Ends
    });
    $(document).on('click', '.columnDefs', function(){
        return false;
        // alert($(this).attr('datacolumnDefs'));
    });
    function fnUpdateDropdownsAddMode(){
            //GetSelectedEmploymentType
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedEmploymentType')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHEmploymentTypeId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedGradeType
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedGradeType')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHGradeId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedDesignation
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDesignation')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHDesignationId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedDepartment
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedDepartment')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHDepartmentId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedCalendar
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCalendar')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHCalendarId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedLocation
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedLocation')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHLocationId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedSalutation
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedSalutation')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHSalutationId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedGender
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedGender')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHGenderId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedNationality
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedNationality')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHNationalityId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedReligionMaster
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedReligionMaster')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHReligionId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedRaceGroup
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedRaceGroup')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHRaceCastId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedBloodGroup
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedBloodGroup')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHBloodGroupId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedPhysicalStatus
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedPhysicalStatus')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHPhysicalStatusId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedMaritalStatus
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedMaritalStatus')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHMaritalStatusId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedLeaveGroup
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedMaritalStatus')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHLeaveGroupId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedCity for presentcityId
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCity')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHPresentCityId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedCity for permanentcityId
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedCity')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHPermanentCityId').html(response.SelectedItem);
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
                    $('#EMGIHBranchId').html(response.SelectedItem);
                },
                cache: true
            });
            //getAcctType
            $.ajax({
                url: "{{route('dropDownMasters.getAcctType')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHAccountTypeId').html(response.SelectedItem);
                },
                cache: true
            });
            //getPaymentMode
            $.ajax({
                url: "{{route('dropDownMasters.getPaymentMode')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHPaymentModeId').html(response.SelectedItem);
                },
                cache: true
            });
            //GetSelectedTaxRegim
            $.ajax({
                url: "{{route('dropDownMasters.getSelectedTaxRegim')}}",
                method: 'GET',
                data: {id:'00'},
                dataType: 'json',
                success: function(response) {
                    $('#EMGIHRegimeId').html(response.SelectedItem);
                },
                cache: true
            });
    }    
</script>

@endsection
