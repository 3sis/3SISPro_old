@extends('layouts.app')
@section('content')
<div class="layout-px-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class=" br-6">
            <!-- Landing Page browser -->
            <div class="table-responsive">
                <table id="html5-extension3SIS" class="table table-hover non-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <!--CopyChange-->  
                            <th>Rule ID</th>
                            <th>Description</th>  
                            <th>Hierarchy ID</th>  
                            <th>Based On</th>
                            <th title="Statutory Deduction Slab Defined">SDSD</th>
                            <th>Action</th>
                            <th style="visibility: hidden;">Unique Id</th>
                            <th style="visibility: hidden;">User Id</th>
                            <th style="visibility: hidden;">Last Updated</th>

                        </tr>
                    </thead> 
                </table>
            </div>
            <!-- Landing Page browser Ends-->
            <!-- Header Level Data Entry -->
            <div id="entryModalSmall" class="modal fade UpdateModalBox3SIS" data-backdrop="static" 
                data-keyboard="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-xl" role="document">
                    <div class='modal-content'> 
                        <!-- Modal Header -->
                        <div class="modal-header" id="registerModalLabel">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                stroke-linecap="round" stroke-linejoin="round" 
                                class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        </div>
                        <form  id='singleLevelDataEntryForm' autocomplete="off"
                                method="post" action="{{ route('statutrotyDeductionSlab.postHeaderDetailSubform') }}">
                                <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <div class="widget-content widget-content-area animated-underline-content">
                                    <!-- Nav Tabs -->
                                    <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" 
                                            href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" a
                                            ria-selected="true">Deduction Slab</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="animated-underline-selectDeductionInfo-tab" data-toggle="tab" 
                                            href="#animated-underline-selectDedInfo" role="tab" aria-controls="animated-underline-selectDedInfo" 
                                            aria-selected="false">Deduction Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" 
                                            href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" 
                                            aria-selected="false">Record Info</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="animateLineContent-4">
                                        <!-- Tab : Deduction Slab Selections -->
                                        <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" 
                                            aria-labelledby="animated-underline-home-tab">
                                            <!-- -------------------------------------------------------------------- -->
                                            <div class="container-fluid">
                                                <!-- Hidden Fields at Header Level -->
                                                <div class='form-group mb-0'>
                                                    <input type="hidden" name='PMRDHUniqueId' id='PMRDHUniqueId' class='form-control'>
                                                    <input type="hidden" name='PMDTHApplicableFor' id='PMDTHApplicableFor' class='form-control'>
                                                </div>    
                                                <!-- Error Messages -->
                                                <div class='col-md-12 alert alert-danger' id='errorMessageHeaderId'>
                                                    <div class='row mt-0'>
                                                        <span id='headerSubFormErrorMessage'></span>
                                                    </div>
                                                </div>            
                                                <div style='float:right; padding-right:30px'>
                                                    <button type='button' name='add_Data_DedSlabHead' id='add_Data_DedSlabHead' 
                                                        class='btn btnAddRec3SIS'>Add Slab
                                                        <i class="fas fa-plus fa-sm ml-1"> </i>
                                                    </button>
                                                </div>                                                
                                                <!-- Sub Form -->
                                                <div class="table-responsive">
                                                    <table id="html5-deductionSlabHeadSubform3SIS" class="table table-hover non-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Geo.Id</th>
                                                                <th>Gender</th>
                                                                <th>Effective From</th>
                                                                <th>Effective To</th>
                                                                <th>Deleted</th>
                                                                <th>Action</th>
                                                                <th style="visibility: hidden;">User</th>
                                                                <th style="visibility: hidden;">Unique Id</th>
                                                            </tr>
                                                        </thead> 
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- -------------------------------------------------------------------- -->
                                        </div>
                                        <!-- Tab : Deduction Info -->
                                        <div class="tab-pane fade" id="animated-underline-selectDedInfo" role="tabpanel" 
                                            aria-labelledby="animated-underline-selectDeductionInfo-tab">
                                            <!-- -------------------------------------------------------------------- -->
                                            <div class="container-fluid">                                                                                                                                        
                                                <div class='row'>
                                                    <div class="col-md-6">
                                                        <!-- Id, Description -->
                                                        <div class="row mt-0">
                                                            <div class="col-md-4">
                                                                <div class='form-group'>                                                
                                                                    <label>Deduction Id</label>
                                                                    <input type="text"  name='PMDSHRuleId' id='PMDSHRuleId' 
                                                                        class='form-control' style='opacity:1' readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class='form-group'>                                                
                                                                    <label>Description</label>
                                                                    <input type="text" name='PMDSHDesc1' id="PMDSHDesc1" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Hierarchy Id & Description -->
                                                        <div class="row mt-0">                                                        
                                                            <div class="col-md-4">
                                                                <div class='form-group'>                                                
                                                                    <label>Hierarchy Id</label>
                                                                    <input type="text" name='PMDSHHierarchyId' id="PMDSHHierarchyId" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class='form-group'>                                                
                                                                    <label>Based On</label>
                                                                    <input type="text" name='HierarchyDesc' id="HierarchyDesc" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- -------------------------------------------------------------------- -->
                                        </div>
                                        <!-- Tab : User Info Prodile Tab -->
                                        <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" 
                                            aria-labelledby="animated-underline-profile-tab">
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="form-group">
                                                        <label> User</label>
                                                        <input type="text" name="PMDSHUser" id="PMDSHUser" 
                                                        class="form-control col-sm-6" readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> Created Date</label>
                                                        <input type="date" name="PMDSHLastCreated" id="PMDSHLastCreated" 
                                                        class="form-control col-sm-6" readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> Updated Date</label>
                                                        <input type="date" name="PMDSHLastUpdated" id="PMDSHLastUpdated" 
                                                        class="form-control col-sm-6" readonly />
                                                    </div>                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Footer -->
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
            <!-- Header Level Data Entry Ends*****-->

            <!-- Detail Level Data Entry : Deduction Slab Header and Subform-->
            <div id="detailEntryModal1" class="modal fade" data-backdrop="static" 
                data-keyboard="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-xl" role="document">
                    <div class='modal-content'> 
                        <!-- Modal Header -->
                        <div class="modal-header-detail3SIS" id="registerModalLabel" style='background-color: #343A40;'>
                            <h4 class="modal-title-detail1"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                stroke-linecap="round" stroke-linejoin="round" 
                                class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        </div>
                        <form  id='twoLevelDataEntryForm1' autocomplete="off"
                                method="post" action="{{ route('statutrotyDeductionSlab.postSubFormDataHeader') }}">
                                <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <div class="widget-content widget-content-area-detail3SIS animated-underline-content">
                                    <div class="container-fluid">
                                        <div class='form-group mb-0'>
                                            <input type="hidden" name='PMDSHUniqueIdM' id='PMDSHUniqueIdM' class='form-control'>
                                            <input type="hidden" name='PMDTHApplicableForH' id='PMDTHApplicableForH' class='form-control'>
                                            <input type="hidden" name='PMDSHRuleIdH' id='PMDSHRuleIdH' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSHDesc1H' id='PMDSHDesc1H' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSHHierarchyIdH' id='PMDSHHierarchyIdH' class='form-control-detail3SIS'>
                                            <input type="hidden" name='HierarchyDescH' id='HierarchyDescH' class='form-control-detail3SIS'>
                                        </div>
                                        <div class='row'>
                                            <!-- Error Messages -->
                                            <div class='col-md-12 alert alert-danger'  id='errorMessageSubformDetailId1'>
                                                <div class='row mt-0'>
                                                    <span id='subformDetailEntryMessages1'></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row mt-0">
                                                    <div class="col-md-3">
                                                        <div class='form-group'>
                                                            <label>Effeictive From</label>
                                                            <span class="error-text PMDSHEffectiveFrom_error text-danger" 
                                                                style='float:right;'></span>
                                                            <input type="date" name='PMDSHEffectiveFrom' id="PMDSHEffectiveFrom" value='2020-01-01'
                                                                class="form-control">   
                                                        </div>                 
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class='form-group'>
                                                            <label>Effeictive To</label>
                                                            <span class="error-text PMDSHEffectiveTo_error text-danger" 
                                                                style='float:right;'></span>
                                                            <input type="date" name='PMDSHEffectiveTo' id="PMDSHEffectiveTo" value='9999-12-31'
                                                                class="form-control">                 
                                                        </div>                 
                                                    </div>
                                                    <div class="col-md-3">
                                                        <!-- Geographic Id Dropdown -->
                                                        <div class='form-group'>
                                                            <label>Select Geography</label>                                                
                                                            <span class="error-text PMDSHGeographicId_error text-danger" 
                                                                style='float:right;'></span>
                                                            <select id='PMDSHGeographicId' name = 'PMDSHGeographicId' style='width: 100%;'>
                                                                <option value=''>--Geographic Id --</option>
                                                            </select>                                                
                                                        </div>                 
                                                    </div>
                                                    <div class="col-md-3" id='selectGenderId'>
                                                        <!-- Gender Dropdown -->
                                                        <div class='form-group'>
                                                            <label>Select Gender</label>                                                
                                                            <span class="error-text PMDSHGenderId_error text-danger" 
                                                                style='float:right;'></span>
                                                            <select id='PMDSHGenderId' name = 'PMDSHGenderId' style='width: 100%;'>
                                                                <option value=''>-- Gender Id --</option>
                                                            </select>                                                
                                                        </div>                 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div style='float:right; padding-right:30px; padding-top:5px; padding-bottom:5px;'>                                                    
                                        <button type='button' name='add_Data_DedSlabDetail' id='add_Data_DedSlabDetail' 
                                            class='btn btnAddRec3SIS'>Add Ded.Slab
                                            <i class="fas fa-plus fa-sm ml-1"> </i>
                                        </button>
                                    </div>
                                    <!-- Sub Form -->
                                    <div class="table-responsive">
                                        <table id="html5-deductionSlabSubformDetail3SIS" class="table table-hover non-hover" 
                                            style="width:100%; background-color:#060818;">
                                            <thead>
                                                <tr>
                                                    <th>Line No.</th>
                                                    <th>Gender</th>                                                
                                                    <th>Income From</th>
                                                    <th>Income To</th>
                                                    <th>Action</th>
                                                    <th style="visibility: hidden;">User</th>
                                                    <th style="visibility: hidden;">Unique Id</th>
                                                    <th style="visibility: hidden;">Effective From</th>
                                                    <th style="visibility: hidden;">Effective To</th>
                                                </tr>
                                            </thead> 
                                        </table>
                                    </div>


                                </div>                                
                            </div>
                            
                            <!-- Modal Footer -->
                            <div class='modal-footer-detail3SIS'>
                                <!--To display success messages-->
                                <span id='form_output_detail_entry1' style='float:left; padding-left:0px' ></span> 
                                <input type="hidden" name='button_action_DetailEntry1' id='button_action_DetailEntry1' value='insert'>
                                <input type="submit" name='submit_DetailEntry1' id='action_DetailEntry1' value='Update' 
                                    class='btn btn-outline-success mb-2'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Detail Level Data Entry : Deduction Slab Header and Subform Ends*****-->

            <!-- Detail Level Data Entry : Deduction Slab Detail Definition -->
            <div id="detailEntryModal2" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-lg" role="document">
                    <div class='modal-content'> 
                        <!-- Modal Header -->
                        <div class="modal-header-detail13SIS" id="registerModalLabel">
                            <h4 class="modal-title-detail2"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                stroke-linecap="round" stroke-linejoin="round" 
                                class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        </div>
                        <form  id='twoLevelDataEntryForm2' autocomplete="off"
                                method="post" action="{{ route('statutrotyDeductionSlab.postSubFormDataDetail') }}">
                                <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <div class="widget-content widget-content-area-detail13SIS animated-underline-content">
                                    <div class="container-fluid">
                                        <div class='form-group mb-0'>
                                            <input type="hidden" name='PMDSDUniqueId' id='PMDSDUniqueId' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDUniqueIdM' id='PMDSDUniqueIdM' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDLineId' id='PMDSDLineId' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDRuleId' id='PMDSDRuleId' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDDesc1' id='PMDSDDesc1' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDHierarchyId' id='PMDSDHierarchyId' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDGeographicId' id='PMDSDGeographicId' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDGenderId' id='PMDSDGenderId' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDEffectiveFrom' id='PMDSDEffectiveFrom' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDSDEffectiveTo' id='PMDSDEffectiveTo' class='form-control-detail3SIS'>
                                            <input type="hidden" name='PMDTHApplicableForD' id='PMDTHApplicableForD' class='form-control'>
                                        </div>
                                        <!-- Error Messages -->
                                        <div class='row mt-0' id='errorMessageDetailEntryId'>
                                            <div class='col-md-12 alert alert-danger'>
                                                <span id='detailEntryMessages2'></span>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <!-- From Slab To Slab -->
                                            <div class='col-md-12'>
                                                <div class='row mt-0'>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>                                                
                                                            <label>Income From</label> 
                                                            <span class="error-text PMDSDIncomeFrom_error text-danger" 
                                                                style='float:right;'></span>
                                                            <input type="number" name='PMDSDIncomeFrom' id='PMDSDIncomeFrom' value=0.01
                                                                class='form-control' step='any' placeholder="Income From" style='opacity:1' readonly>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>                                                
                                                            <label>Income To</label>
                                                            <span class="error-text PMDSDIncomeTo_error text-danger" 
                                                                style='float:right;'></span>
                                                            <input type="number" name='PMDSDIncomeTo' id='PMDSDIncomeTo' value=9999999999.99
                                                                class='form-control floatNumberField' step='any' placeholder="Income To" style='opacity:1'>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Employee, Company Contribution -->
                                            <div class='col-md-12'>
                                                <div class='row mt-0'>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>                                                
                                                            <label>Emp.Contribution</label> 
                                                            <span class="error-text PMDSDEmpContriAmount_error text-danger" 
                                                                style='float:right;'></span>
                                                            <input type="number" name='PMDSDEmpContriAmount' id='PMDSDEmpContriAmount' value=0.00
                                                                class='form-control floatNumberField' step='any' placeholder="Emp. Contribution" style='opacity:1'>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>                                                
                                                            <label>Comp.Contribution</label> 
                                                            <span class="error-text PMDSDCompContriAmount_error text-danger" 
                                                                style='float:right;'></span>
                                                            <input type="number" name='PMDSDCompContriAmount' id='PMDSDCompContriAmount' value=0.00
                                                                class='form-control floatNumberField' step='any' placeholder="Comp. Contribution" style='opacity:1'>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Contribution Type - Fixed or Percent -->
                                            <div class='col-md-12'>
                                                <div class='row mt-0'>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>                                                
                                                            <label>Contribution Basis</label>                                                
                                                            <span class="error-text PMDSDEmpContriType_error text-danger" 
                                                                style='float:right;'></span>
                                                            <select id='PMDSDEmpContriType' name = 'PMDSDEmpContriType' style='width: 100%;'>
                                                                <option value='P'>Percent</option>
                                                                <option value='F'>Fixed</option>
                                                            </select>      
                                                        </div>
                                                    </div>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>                                                
                                                            <label>Contribution Basis</label>                                                
                                                            <span class="error-text PMDSDCompContriType_error text-danger" 
                                                                style='float:right;'></span>
                                                            <select id='PMDSDCompContriType' name = 'PMDSDCompContriType' style='width: 100%;'>
                                                                <option value='P'>Percent</option>
                                                                <option value='F'>Fixed</option>
                                                            </select>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Footer -->
                            <div class='modal-footer-detail13SIS'>
                                <!--To display success messages-->
                                <span id='form_output_detail_entry2' style='float:left; padding-left:0px' ></span> 
                                <input type="hidden" name='button_action_DetailEntry2' id='button_action_DetailEntry2' value='insert'>
                                <input type="submit" name='submit_DetailEntry2' id='action_DetailEntry2' value='Update' 
                                    class='btn btn-outline-success mb-2'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Detail Level Data Entry : Deduction Slab Detail Definition Ends**********-->

            <!-- Date Change Window Entry : Header -->
            <div id="detailEntryModal3" class="modal fade" data-backdrop="static" 
                data-keyboard="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered 3SISPro-modal-dialog modal-md" role="document">
                    <div class='modal-content'> 
                        <!-- Modal Header -->
                        <div class="modal-header-detail13SIS" id="registerModalLabel">
                            <h4 class="modal-title-detail3"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                stroke-linecap="round" stroke-linejoin="round" 
                                class="feather feather-x text-danger"><line x1="18" y1="6" x2="6" y2="18">                                            
                                </line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        </div>
                        <form  id='twoLevelDataEntryForm3' autocomplete="off"
                                method="post" action="{{ route('statutrotyDeductionSlab.dateChangeHeaderDetail') }}">
                                <input type="hidden" name="_token" id="csrfTokenDetail" value="{{ csrf_token() }}">
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <div class="widget-content widget-content-area-detail13SIS animated-underline-content">
                                    <div class="container-fluid">
                                        <div class='form-group mb-0'>
                                            <input type="hidden" name='PMDSHUniqueIdDateChange' id='PMDSHUniqueIdDateChange' class='form-control-detail3SIS'>
                                            <input type="hidden" name='uniqueIdMDateChange' id='uniqueIdMDateChange' class='form-control-detail3SIS'>
                                            <input type="hidden" name='geographicIdDateChange' id='geographicIdDateChange' class='form-control-detail3SIS'>
                                            <input type="hidden" name='genderIdDateChange' id='genderIdDateChange' class='form-control-detail3SIS'>
                                            <input type="hidden" name='currentStartDate' id='currentStartDate' class='form-control-detail3SIS'>
                                        </div>
                                        <!-- Current Date -->
                                        <div class="row mt-0">
                                            <div class="col-md-6">
                                                <div class='form-group'>                                                
                                                    <label>Current End Date</label>
                                                    <input type="date" name='currentEndDate' id="currentEndDate" readonly
                                                        class="form-control">
                                                </div>
                                            </div>                                   
                                        </div>
                                        <!-- Expiry Date -->
                                        <div class="row mt-0">
                                            <div class="col-md-6">
                                                <div class='form-group'>                                                
                                                    <label>Expiry Date</label> 
                                                    <span class="error-text expiryDate_error text-danger" 
                                                        style='float:right;'></span>
                                                    <input type="date" name='expiryDate' id="expiryDate" class="form-control">
                                                </div>
                                            </div>                                               
                                        </div>                   
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Footer -->
                            <div class='modal-footer-detail13SIS'>
                                <!--To display success messages-->
                                <span id='form_output_detail_entry3' style='float:left; padding-left:0px' ></span> 
                                <input type="hidden" name='button_action_DetailEntry3' id='button_action_DetailEntry3' value='insert'>
                                <input type="submit" name='submit_DetailEntry3' id='action_DetailEntry3' value='Update' 
                                    class='btn btn-outline-success mb-2'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Date Change Window Entry : Header Ends*****-->
            @include('commonViews3SIS.modalCommon3SIS')
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $modalTitle = 'Statutory Deductions Slab Definition ';
        // Loading Landing Page Browser
        fnLoadLandingPageBrowser();
        // Landing Page browser Ends*****
    });
    function fnLoadLandingPageBrowser(){
        $('#html5-extension3SIS').DataTable( {
                dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                    <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                buttons: {
                    buttons: [
                        // { extend: 'copy', className: 'btn' },
                        // { extend: 'csv', className: 'btn' },
                        // { extend: 'excel', className: 'btn' },
                        // { extend: 'print', className: 'btn' }
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
                order: [ 0, "asc" ],
                processing: true,
                serverSide: true,
                autoWidth: false,
                "ajax": "{{ route('statutrotyDeductionSlab.browserData')}}",
                "columns":[
                    // CopyChange
                    {data: "PMRDHRuleId"},
                    {data: "PMRDHDesc1"},                    
                    {data: "PMRDHHierarchyId"},
                    {data: "PMRHHDesc1"},
                    {data: "PMRDHSlabDefined"},
                    {data: "action", orderable:false, searchable: false},
                    {data: "PMRDHUniqueId", "visible": false},
                    {data: "PMRDHUser", "visible": false},
                    {data: "PMRDHLastUpdated", "visible": false}, 
                ],                
                "columnDefs": [{
                    // Setting width of each column
                    width: "10%", "targets": 0,
                    width: "30%", "targets": 1,
                    width: "10%", "targets": 2,
                    width: "30%", "targets": 3,
                    width: "5%", "targets": 4,
                    width: "15%", "targets": 5,
                    "targets": 4,
                    data:   "PMRDHSlabDefined",
                    render: function (data ,td, cellData, rowData, row, col) {

                        if(data==1){
                            return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                            <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                            <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                        }else{
                            return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                            <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                            <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                        }
                    },  
                }],
            });
    }
    // Click on Broswer : disabled
    $(document).on('click', '.columnDefs', function(){
        return false;
        // alert($(this).attr('datacolumnDefs'));
    });
    // Pad numbers with 2 decimals
    $(".floatNumberField").change(function() {
        $(this).val(parseFloat($(this).val()).toFixed(2));
    });
    // Landing Page Browser : Edit Events
    $(document).on('click', '.editLandingPageBrowser', function(){        
        var id = $(this).attr('id');
        $.ajax({
            url: "{{route('statutrotyDeductionSlab.fetchData')}}",
            method: 'GET',
            data: {id:id},
            dataType: 'json',
            beforeSend: function(){
                $('#errorMessageHeaderId').hide();
            },
            success: function(data)
            {
                // Update Screen Variables
                fnUpdateScreenVariablesHeader(data);
                // $("#PMDSHGenderId").select2();
                fnLoadSlabHeaderSubForm();
                $titleSuffix = "<b style='color: #F5821F'>" + ' [ ' + $('#PMDSHDesc1').val() + ' ]' + "</b>" + " -> singleLevelDataEntryForm.submit";                    
                fnDataEntryFormHeader('1', 'Edit ', $titleSuffix);
                $("#animated-underline-home-tab").trigger('click');  
            }
        });
    });
    function fnUpdateScreenVariablesHeader(data){
        var lastCreated = formattedDate(new Date(data.PMRDHLastCreated));
        var lastUpdated = formattedDate(new Date(data.PMRDHLastUpdated));
        // Header Level Fields
        $('#PMRDHUniqueId').val(data.PMRDHUniqueId);
        $('#PMDTHApplicableFor').val(data.PMDTHApplicableFor);        
        $('#PMDSHRuleId').val(data.PMRDHRuleId);
        $('#PMDSHDesc1').val(data.PMRDHDesc1);
        $('#PMDSHHierarchyId').val(data.PMRDHHierarchyId);
        $('#HierarchyDesc').val(data.HierarchyDesc);
        $('#PMDSHUser').val(data.PMRDHUser);
        $('#PMDSHLastCreated').val(lastCreated);
        $('#PMDSHLastUpdated').val(lastUpdated);
        // Header Level Fields End*****

        // Detail Level Sub Form Fields
        $('#PMDSHUniqueIdM').val(data.PMRDHUniqueId);
        $('#PMDTHApplicableForH').val(data.PMDTHApplicableFor);
        $('#PMDSHRuleIdH').val(data.PMRDHRuleId);
        $('#PMDSHDesc1H').val(data.PMRDHDesc1);
        $('#PMDSHHierarchyIdH').val(data.PMRDHHierarchyId);
        $('#HierarchyDescH').val(data.HierarchyDesc);
        // Detail Level Sub Form Fields End*****
        
        // Detail Entry Level Screen Variables
        $('#PMDSDUniqueIdM').val(data.PMRDHUniqueId);
        $('#PMDTHApplicableForD').val(data.PMDTHApplicableFor);
        $('#PMDSDRuleId').val(data.PMRDHRuleId);
        $('#PMDSDDesc1').val(data.PMRDHDesc1);
        $('#PMDSDHierarchyId').val(data.PMRDHHierarchyId);
        // Detail Entry Level Screen Variables End*****
    }
    function fnLoadSlabHeaderSubForm(){
        $('#html5-deductionSlabHeadSubform3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    // { extend: 'excel', className: 'btn' },
                    // { extend: 'print', className: 'btn' }
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
            lengthMenu: [6,10,25,50],
            order: [ 0, "desc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,            
            "ajax": {
                "url": "{{ route('statutrotyDeductionSlab.browserSubFormHeader')}}",
                "type": "GET",
                // "data": function ( d ) {
                //     d.id = $('#PMDSHHierarchyId').val();;
                // }
            },
            "columns":[
                {data: "PMDSHGeographicId"},
                {data: "PMDSHGenderId"},
                {data: "PMDSHEffectiveFrom"},
                {data: "PMDSHEffectiveTo"},
                {data: "PMDSHMarkForDeletion"},
                {data: "action", orderable:false, searchable: false},
                {data: "PMDSHUser", "visible": false},
                {data: "PMDSHUniqueId", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "10%", "targets": 0,
                width: "10%", "targets": 1,
                width: "15%", "targets": 2,
                width: "15%", "targets": 3,
                width: "5%", "targets": 4,
                width: "20%", "targets": 5,
                "targets": 4,
                data:   "PMDSHMarkForDeletion",
                render: function (data ,td, cellData, rowData, row, col) {

                    if(data==1){
                        return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info" checked>\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }else{
                        return '<label class="columnDefs new-control new-checkbox checkbox-primary">\
                        <input type="checkbox" class="new-control-input chk-parent select-customers-info">\
                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span></label>';
                    }
                }
            }],
        });
    }
    // Landing Page Browser : Edit Events End*****
    // --------------------------------------------------------------------------------------------
    // Header Page Events
    
    // When Add button is pushed - Ded.Slab Header
    $('#add_Data_DedSlabHead').click(function(){
        $('#subformDetailEntryMessages1').html('');
        $('#errorMessageSubformDetailId1').hide();
        $("#PMDSHGenderId").select2();
        $("#PMDSHGeographicId").select2();
        $('#errorMessageHeaderId').hide();

        // Make Key Fields Editable
        $("#PMDSHEffectiveFrom").attr("readonly", false);
        $("#PMDSHEffectiveTo").attr("readonly", false);
        $("#PMDSHGeographicId").prop('disabled', false);
        $("#PMDSHGenderId").prop('disabled', false);


        $modalTitleDetailEntry1 = " Deduction Slab Definition <b style='color: #ffbf00'>" + ' [ ' + $('#HierarchyDesc').val() + ' ]' + "</b>" + "->twoLevelDataEntryForm1.submit ";
        fnDetailEntryOnSubForm1('0', 'Add ', 'Edit ');
        // All Dropdowns in Add Mode
        $id = '00'
        $HierarchyId = $('#PMDSHHierarchyId').val();
        // Pick Appropriate Geographic Dropdowns
        fnPickGeographicDropDown($id, $HierarchyId);        
        // Gender Specific Dropdown
        if ($('#PMDTHApplicableFor').val() == 'I') {
            $('#selectGenderId').show();
            $('#PMDSHGenderId').prop('disabled', false);
            fnGenderDropdowns($id);
        }else{
            $('#selectGenderId').hide();
            $('#PMDSHGenderId').prop('disabled', true);                
        }
        // Display subform for Deduction Slabs to enter.
        fnLoadSubFormSlabDefinition($('#PMDSHEffectiveFrom').val(), $('#PMDSHEffectiveTo').val(), $('#PMDSHGeographicId').val(), 
            $('#PMDSHGenderId').val(), $('#PMDSHUniqueIdM').val());
    });
    function fnPickGeographicDropDown($id, $HierarchyId){
        // Country Level Dropdown
        if ($HierarchyId == '1000') {
            fnCountryDropdowns($id);
        }
        // State Level Dropdown
        if ($HierarchyId == '1100') {                
            fnStateDropdowns($id);
        }
        // City Level Dropdown
        if ($HierarchyId == '1200') {                
            fnCityDropdowns($id);
        }
        // Location Level Dropdown
        if ($HierarchyId == '1300') {                
            fnLocationDropdowns($id);
        }
    }
    // Country Dropdown
    function fnCountryDropdowns($id){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedCountry')}}",
            method: 'GET',
            data: {id:$id},
            dataType: 'json',
            success: function(response) {
                $('#PMDSHGeographicId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    // State Dropdown
    function fnStateDropdowns($id){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedState')}}",
            method: 'GET',
            data: {id:$id},
            dataType: 'json',
            success: function(response) {
                $('#PMDSHGeographicId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    // City Dropdown
    function fnCityDropdowns($id){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedCity')}}",
            method: 'GET',
            data: {id:$id},
            dataType: 'json',
            success: function(response) {
                $('#PMDSHGeographicId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    // Location Dropdown
    function fnLocationDropdowns($id){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedLocation')}}",
            method: 'GET',
            data: {id:$id},
            dataType: 'json',
            success: function(response) {
                $('#PMDSHGeographicId').html(response.SelectedItem);
            },
            cache: true
        })
    }
    // Gender Dropdown
    function fnGenderDropdowns($id){
        $.ajax({
            url: "{{route('dropDownMasters.getSelectedGender')}}",
            method: 'GET',
            data: {id:$id},
            dataType: 'json',
            success: function(response) {
                $('#PMDSHGenderId').html(response.SelectedItem);
            },
            cache: true
        })
    };
    function fnLoadSubFormSlabDefinition(param1, param2, param3, param4, param5){
        // Income Type Selection browser
        // alert(param1+param2+ param3+ param4+ param5);
        $('#html5-deductionSlabSubformDetail3SIS').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> \
                <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    // { extend: 'excel', className: 'btn' },
                    // { extend: 'print', className: 'btn' }
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
            lengthMenu: [6,10,25,50],
            order: [ 0, "asc" ],
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            searching: false,
            "ajax": {
                url: '{{ route('statutrotyDeductionSlab.browserSubFormDeductionSlab')}}',
                "type": "GET",
                "data": function ( d ) {
                    d.param1 = param1;
                    d.param2 = param2;
                    d.param3 = param3;
                    d.param4 = param4;
                    d.param5 = param5;
                }
            },
            "columns":[
                {data: "PMDSDLineId"},
                {data: "PMDSDGenderId"},                
                {data: "PMDSDIncomeFrom", render: $.fn.dataTable.render.number(',', '.', 2), className: 'text-right'},
                {data: "PMDSDIncomeTo", render: $.fn.dataTable.render.number(',', '.', 2), className: 'text-right'},
                {data: "action", orderable:false, searchable: false},
                {data: "PMDSDUser", "visible": false},
                {data: "PMDSDUniqueId", "visible": false},
                {data: "PMDSDEffectiveFrom", "visible": false},
                {data: "PMDSDEffectiveTo", "visible": false},
            ],
            columnDefs: [{
                // Setting width of each column
                width: "5%", "targets": 0,
                width: "5%", "targets": 1,
                width: "15%", "targets": 2,
                width: "15%", "targets": 3,
                width: "10%", "targets": 4,
                width: "10%", "targets": 5,
                width: "15%", "targets": 6,
            }],
        });
    }
    // Final Submit Button - Header Level
    $('#singleLevelDataEntryForm').on('submit', function(e){
        e.preventDefault();     // Will stop multiple submission
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function(){
                $('#errorMessageHeaderId').hide();
            },
            success:function(data)
            {
                if(data.statusHeader == 0)
                {
                    $('#errorMessageHeaderId').show();
                    $('#headerSubFormErrorMessage').html(data.ErrorOutputHeader);
                    $('#html5-deductionSlabHeadSubform3SIS').DataTable().ajax.reload();
                }else{                        
                    $('#html5-extension3SIS').DataTable().ajax.reload();
                    $('#entryModalSmall').modal('hide');
                }
            }
        })  
    });
    // Header Page Events End*****
    // --------------------------------------------------------------------------------------------
    // Detail Sub Form Page Events
    // When Add button is pushed - Ded.Slab Detail
    $('#add_Data_DedSlabDetail').click(function(){
        // Validate the Header Entry
        var $PMDSHEffectiveFrom = $('#PMDSHEffectiveFrom').val();
        var $PMDSHEffectiveTo = $('#PMDSHEffectiveTo').val();
        var $PMDTHApplicableFor = $('#PMDTHApplicableFor').val();
        var $PMDSHGeographicId = $('#PMDSHGeographicId').val();
        var $PMDSHGenderId = $('#PMDSHGenderId').val();
        var $PMDSHRuleId = $('#PMDSHRuleId').val();
        $('#subformDetailEntryMessages1').html('');
        $('#errorMessageSubformDetailId1').hide();
        $.ajax({
            // CopyChange
            url: "{{route('statutrotyDeductionSlab.checkHeaderData')}}",
            method: 'GET',
            data: {PMDSHEffectiveFrom: $PMDSHEffectiveFrom, PMDSHEffectiveTo: $PMDSHEffectiveTo, 
                    PMDTHApplicableFor: $PMDTHApplicableFor, PMDSHGeographicId: $PMDSHGeographicId, 
                    PMDSHGenderId: $PMDSHGenderId, PMDSHRuleId: $PMDSHRuleId},
            dataType: 'json',
            success: function(data)
            {
                if(data.status == 0)
                {
                    $.each(data.error, function(prefix,val){
                        $('span.' +prefix+ '_error').text(val[0]);
                        $('#' +prefix).css('border-color', '#dc3545');                            
                    });
                    if (data.ErrorOutputDetail != '') {                            
                        $('#errorMessageSubformDetailId1').show();
                        $('#subformDetailEntryMessages1').html(data.ErrorOutputDetail); 
                    }          
                }else{
                    $('#PMDSDEffectiveFrom').val($('#PMDSHEffectiveFrom').val());
                    $('#PMDSDEffectiveTo').val($('#PMDSHEffectiveTo').val());
                    $('#PMDSDGeographicId').val($('#PMDSHGeographicId').val());
                    $('#PMDSDGenderId').val($('#PMDSHGenderId').val());
                    if($('#PMDSHGenderId').val() == ''){
                        $('#PMDSDGenderId').val('C');
                    }                    
                    $('#PMDSDLineId').val(data.lastLineNo);
                    $('#detailEntryMessages2').html('');
                    $('#errorMessageDetailEntryId').hide();
                    fnInitializeSelect2();            
                    $modalTitleDetailEntry2 = " Slabs" + "->twoLevelDataEntryForm2.submit";  
                    fnDetailEntryOnSubForm2('0', 'Add ', 'Edit ');
                    $('#PMDSDIncomeFrom').val(data.nextFromSlab); 
                }
            }
        });
    });
    // When Delet button is pushed : Slab Sub Form
    $(document).on('click', '.delete_slabDetail', function(){
        var UniqueId = $(this).attr('id');
        var $PMDSHEffectiveFrom = $('#PMDSHEffectiveFrom').val();
        var $PMDSHEffectiveTo = $('#PMDSHEffectiveTo').val();
        var $PMDTHApplicableFor = $('#PMDTHApplicableFor').val();
        var $PMDSHGeographicId = $('#PMDSHGeographicId').val();
        var $PMDSHGenderId = $('#PMDSHGenderId').val();
        var $PMDSHRuleId = $('#PMDSHRuleId').val();
        // Fetch Record first that need to be deleted.
        $.ajax({
            url: "{{route('statutrotyDeductionSlab.fetchSubformDetailData')}}",
            method: 'GET',
            data: {id:UniqueId, PMDSHEffectiveFrom: $PMDSHEffectiveFrom, PMDSHEffectiveTo: $PMDSHEffectiveTo, 
                    PMDTHApplicableFor: $PMDTHApplicableFor, PMDSHGeographicId: $PMDSHGeographicId, 
                    PMDSHGenderId: $PMDSHGenderId, PMDSHRuleId: $PMDSHRuleId},
            dataType: 'json',
            beforeSend: function(){                 
                $('#errorMessageSubformDetailId1').hide();
            },
            success: function(data) {
                if (data.status == 0) {
                    $('#errorMessageSubformDetailId1').show();
                    $('#subformDetailEntryMessages1').html(data.ErrorOutputDetail);
                }else{
                    $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.LineId, '');   
                    $('#DeleteRecord').html($deleteMessage3SIS);
                    $('#modalZoomDeleteRecord3SIS').modal('show');
                }
            }
        });
        // Fetch Record Ends
        // Delete record only when OK is pressed on Modal.
        $(document).on('click', '.confirm', function(){
            $.ajax({
                url:"{{route('statutrotyDeductionSlab.deleteSubFormDetail')}}",
                mehtod:"GET",
                data:{id:UniqueId},
                success:function(data)
                {
                    $GenderId = $('#PMDSHGenderId').val();
                    if($('#PMDTHApplicableFor').val() == 'C'){
                        $GenderId = 'C'
                    } 
                    fnLoadSubFormSlabDefinition($('#PMDSHEffectiveFrom').val(), $('#PMDSHEffectiveTo').val(), $('#PMDSHGeographicId').val(), 
                    $GenderId, $('#PMDSHUniqueIdM').val());
                    UniqueId = 0;
                    $('#modalZoomDeleteRecord3SIS').modal('hide');
                }
            })
        });
        $("#modalZoomDeleteRecord3SIS").on("hide.bs.modal", function () {
            UniqueId = 0;
        });                   
    });
    // When Edit button is pushed - Ded.Slab Detail
    $(document).on('click', '.edit_slabDetail', function(){
        $('#PMDTHApplicableForD').val($('#PMDTHApplicableFor').val());        
        $('#subformDetailEntryMessages1').html('');
        $('#errorMessageSubformDetailId1').hide();
        $('#errorMessageDetailEntryId').hide();
        var uniqueId = $(this).attr('id');
        $.ajax({
                url: "{{route('statutrotyDeductionSlab.fetchSubFormDataDeductionSlab')}}",
                method: 'GET',
                data: {id:uniqueId},
                dataType: 'json',
                success: function(data)
                {
                    // Update Screen Variables
                    fnUpdateScreenVariablesDeductionSlab(data);
                    $modalTitleDetailEntry2 = " Slabs" + "->twoLevelDataEntryForm2.submit";  
                    fnDetailEntryOnSubForm2('1', 'Add ', 'Edit ');
                }
            });

    });
    function fnUpdateScreenVariablesDeductionSlab(data){
        var effectiveFrom   = formattedDate(new Date(data.PMDSDEffectiveFrom));
        var effectiveTo     = formattedDate(new Date(data.PMDSDEffectiveTo));
        $('#PMDSDUniqueId').val(data.PMDSDUniqueId);
        $('#PMDSDUniqueIdM').val(data.PMDSDUniqueIdM);
        $('#PMDSDLineId').val(data.PMDSDLineId);
        $('#PMDSDRuleId').val(data.PMDSDRuleId);
        $('#PMDSDDesc1').val(data.PMDSDDesc1);
        $('#PMDSDHierarchyId').val(data.PMDSDHierarchyId);
        $('#PMDSDGeographicId').val(data.PMDSDGeographicId);
        $('#PMDSDGenderId').val(data.PMDSDGenderId);
        $('#PMDSDEffectiveFrom').val(effectiveFrom);
        $('#PMDSDEffectiveTo').val(effectiveTo);
        $('#PMDSDIncomeFrom').val(data.PMDSDIncomeFrom);
        $('#PMDSDIncomeTo').val(data.PMDSDIncomeTo);
        $('#PMDSDEmpContriAmount').val(data.PMDSDEmpContriAmount);
        $('#PMDSDCompContriAmount').val(data.PMDSDCompContriAmount);
        $('#PMDSDEmpContriType').val(data.PMDSDEmpContriType);
        $('#PMDSDCompContriType').val(data.PMDSDCompContriType);
        $("#PMDSDEmpContriType").select2();
        $("#PMDSDCompContriType").select2();
        if ($('#PMDSDIncomeTo').val() == 9999999999.99) {
            $("#PMDSDIncomeTo").attr("readonly", false);
        }else{
            $("#PMDSDIncomeTo").attr("readonly", true);
        }
    }
    function fnInitializeSelect2(){
        $("#PMDSDEmpContriType").val('P').trigger('change.select2');
        $("#PMDSDEmpContriType").select2();
        $("#PMDSDCompContriType").val('P').trigger('change.select2');
        $("#PMDSDCompContriType").select2();
    }
    // When submit button pushed - Ded.Slab Header 
    $('#twoLevelDataEntryForm1').on('submit', function(event){
        $("#PMDSHGeographicId").prop('disabled', false);
        $("#PMDSHGenderId").prop('disabled', false);
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
                // Reinstate Border Color
                ReinstateBorderColorHeader();                    
                $('#errorMessageSubformDetailId1').hide();
            },
            success:function(data)
            {
                if(data.status == 0)
                {
                    $.each(data.error, function(prefix,val){
                        $('span.' +prefix+ '_error').text(val[0]);
                        $('#' +prefix).css('border-color', '#dc3545');
                    });
                    if (data.ErrorOutputDetail != '') {                            
                        $('#errorMessageSubformDetailId1').show();                        
                        $('#subformDetailEntryMessages1').html(data.ErrorOutputDetail); 
                    }                        
                }else{                        
                    $('#html5-deductionSlabHeadSubform3SIS').DataTable().ajax.reload();
                    $('#detailEntryModal1').modal('hide');
                }
                
            }
        })
    });
    function ReinstateBorderColorHeader(){
        $('#PMDSHEffectiveFrom').css('border-color', 'rgb(102, 175, 233)');
        $('#PMDSHEffectiveTo').css('border-color', 'rgb(102, 175, 233)');
        $('#PMDSHGeographicId').css('border-color', 'rgb(102, 175, 233)');
        $('#PMDSHGenderId').css('border-color', 'rgb(102, 175, 233)');
    }
    // Detail Sub Form Page Events End*****
    // --------------------------------------------------------------------------------------------
    // Detail Entry Page Events
    // When Submit button is pushed - Ded.Slab Detail
    $('#twoLevelDataEntryForm2').on('submit', function(event){
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
                // Reinstate Border Color
                ReinstateBorderColorDetailEntry();                    
                $('#errorMessageDetailEntryId').hide();
            },
            success:function(data)
            {
                if(data.status == 0)
                {
                    $.each(data.error, function(prefix,val){
                        $('span.' +prefix+ '_error').text(val[0]);
                        $('#' +prefix).css('border-color', '#dc3545');                            
                    });                  
                }else{
                    $finalMessage3SIS = fnSingleLevelFinalSave(data.masterName, data.Id, data.Desc1, data.updateMode);
                    $('#FinalSaveMessage').html($finalMessage3SIS);
                    fnDetailEntryOnSubForm2('0', 'Add ', 'Edit ');
                    $GenderId = $('#PMDSDGenderId').val();
                    if($('#PMDTHApplicableForD').val() == 'C'){
                        $GenderId = 'C'
                    } 
                    fnLoadSubFormSlabDefinition($('#PMDSDEffectiveFrom').val(), $('#PMDSDEffectiveTo').val(), $('#PMDSDGeographicId').val(), 
                        $GenderId, $('#PMDSDUniqueIdM').val());
                    if(data.updateMode=='Updated')
                    {
                        $('#detailEntryModal2').modal('hide');
                        $('#modalZoomFinalSave3SIS').modal('show');
                    }
                    else
                    {
                        $('#PMDSDLineId').val(data.lastLineNo);
                        $('#PMDSDIncomeFrom').val(data.nextFromSlab);
                        $('#form_output_detail_entry2').html($finalMessage3SIS);
                    }
                }
            }
        })
    });
    function ReinstateBorderColorDetailEntry(){
        $('#PMDSDIncomeFrom').css('border-color', 'rgb(102, 175, 233)');
        $('#PMDSDIncomeTo').css('border-color', 'rgb(102, 175, 233)');
        $('#PMDSDEmpContriAmount').css('border-color', 'rgb(102, 175, 233)');
    }
    // When Submit button is pushed - Ded.Slab Detail Ends*****
    // Detail Entry Page Events End*****
    // --------------------------------------------------------------------------------------------
    // Header Subform Browser : Date Change Event
    $(document).on('click', '.dateChange_slabHead', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: "{{route('statutrotyDeductionSlab.fetchSubformHeaderData')}}",
            method: 'GET',
            data: {id:id},
            dataType: 'json',
            beforeSend: function(){
                $('#errorMessageHeaderId').hide();
            },
            success: function(data)
            {
                var startDate = formattedDate(new Date(data.currentStartDate));
                var endDate = formattedDate(new Date(data.expiryDate));
                var expirtyDate = formattedDate(new Date(data.expiryDate));
                // Update Screen Variables
                $('#PMDSHUniqueIdDateChange').val(data.PMDSHUniqueIdDateChange);
                $('#uniqueIdMDateChange').val(data.uniqueIdMDateChange);
                $('#geographicIdDateChange').val(data.geographicIdDateChange);
                $('#genderIdDateChange').val(data.genderIdDateChange);

                $('#currentStartDate').val(startDate);
                $('#currentEndDate').val(expirtyDate);
                $('#expiryDate').val(expirtyDate);
                $modalTitleDetailEntry3 = " Slabs";               
                fnDetailEntryOnSubForm3('2', 'Add ', 'Delete ', 'Save'); 
            }
        });
    });
    // When Submit button is pushed - Date Change Slab Detail
    $('#twoLevelDataEntryForm3').on('submit', function(event){
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
                }else{
                    $('#detailEntryModal3').modal('hide');
                    $('#html5-deductionSlabHeadSubform3SIS').DataTable().ajax.reload(); 
                }
            }
        })
    });
    // --------------------------------------------------------------------------------------------
    // Header Subform Browser : Edit Events
    $(document).on('click', '.edit_slabHead', function(){
        $('#subformDetailEntryMessages1').html('');
        $('#errorMessageSubformDetailId1').hide();
        $("#PMDSHGenderId").select2();
        $("#PMDSHGeographicId").select2();
        $('#errorMessageHeaderId').hide();

        var id = $(this).attr('id');
        $.ajax({
            url: "{{route('statutrotyDeductionSlab.fetchSubformHeaderData')}}",
            method: 'GET',
            data: {id:id},
            dataType: 'json',
            beforeSend: function(){
                $('#errorMessageHeaderId').hide();
            },
            success: function(data)
            {
                // Update Screen Variables Edit Mode
                fnUpdateScreenVariablesHeaderEditMode(data);
                // Updae Dropdowns
                var $id = data.PMDSHGeographicId;
                var $HierarchyId = data.PMDSHHierarchyIdH;
                fnPickGeographicDropDown($id, $HierarchyId)
                // Gender Specific Dropdown
                if (data.PMDTHApplicableForH == 'I') {
                    $('#selectGenderId').show();
                    $('#PMDSHGenderId').prop('disabled', false);
                    fnGenderDropdowns(data.PMDSHGenderId);
                }else{
                    $('#selectGenderId').hide();
                    $('#PMDSHGenderId').prop('disabled', true);                
                }
                // Updae Dropdowns Ends
                // Load Header Sub Form for this Id.
                fnLoadSubFormSlabDefinition($('#PMDSHEffectiveFrom').val(), $('#PMDSHEffectiveTo').val(), 
                    data.PMDSHGeographicId, data.PMDSHGenderId, data.PMDSHUniqueIdM);
                    $modalTitleDetailEntry1 = " Deduction Slab Definition <b style='color: #ffbf00'>" + ' [ ' + $('#HierarchyDesc').val() + ' ]' + "</b>" + "->twoLevelDataEntryForm1.submit ";
                fnDetailEntryOnSubForm1('1', 'Add ', 'Edit ');
                // Make Key Fields Readonly
                $("#PMDSHEffectiveFrom").attr("readonly", true);
                $("#PMDSHEffectiveTo").attr("readonly", true);
                $("#PMDSHGeographicId").prop('disabled', true);
                $("#PMDSHGenderId").prop('disabled', true);
            }
        });
    });
    function fnUpdateScreenVariablesHeaderEditMode(data){
        var startDate = formattedDate(new Date(data.PMDSHEffectiveFrom));
        var endDate = formattedDate(new Date(data.PMDSHEffectiveTo));
        // Detail Level Sub Form Fields
        $('#PMDSHUniqueIdM').val(data.PMDSHUniqueIdM);
        $('#PMDTHApplicableForH').val(data.PMDTHApplicableForH);
        $('#PMDSHRuleIdH').val(data.PMDSHRuleIdH);
        $('#PMDSHDesc1H').val(data.PMDSHDesc1H);
        $('#PMDSHHierarchyIdH').val(data.PMDSHHierarchyIdH);
        $('#HierarchyDescH').val(data.HierarchyDescH);
        $('#PMDSHEffectiveFrom').val(startDate);
        $('#PMDSHEffectiveTo').val(endDate);
        $('#PMDSHGeographicId').val(data.PMDSHGeographicId);
        $('#PMDSHGenderId').val(data.PMDSHGenderId);        
        // Detail Level Sub Form Fields End*****
        
        // Detail Entry Level Screen Variables
        $('#PMDSDUniqueIdM').val(data.PMDSHUniqueIdM);
        $('#PMDTHApplicableForD').val(data.PMDTHApplicableForH);
        $('#PMDSDRuleId').val(data.PMDSHRuleIdH);
        $('#PMDSDDesc1').val(data.PMDSHDesc1H);
        $('#PMDSDHierarchyId').val(data.PMDSHHierarchyIdH);
        // Detail Entry Level Screen Variables End*****     
    }
    // --------------------------------------------------------------------------------------------
    // When delete button is pushed : Header Sub Form
    $(document).on('click', '.delete_slabHead', function(){
        var UniqueId = $(this).attr('id');
        // Fetch Record first that need to be deleted.
        $.ajax({
            url: "{{route('statutrotyDeductionSlab.fetchSubformHeaderData')}}",
            method: 'GET',
            data: {id:UniqueId},
            dataType: 'json',
            success: function(data)
            {
                $deleteMessage3SIS = fnSingleLevelDeleteConfirmation($modalTitle, data.PMDSHGeographicId, data.HierarchyDescH);   
                $('#DeleteRecord').html($deleteMessage3SIS);
                $('#modalZoomDeleteRecord3SIS').modal('show');                                
            }
        });
        // Fetch Record Ends
        // Delete record only when OK is pressed on Modal.
        $(document).on('click', '.confirm', function(){
            $.ajax({
                url:"{{route('statutrotyDeductionSlab.deleteSubFormHeaderDetail')}}",
                mehtod:"GET",
                data:{id:UniqueId},
                success:function(data)
                {                          
                    $('#html5-deductionSlabHeadSubform3SIS').DataTable().ajax.reload();
                    UniqueId = 0;
                    $('#modalZoomDeleteRecord3SIS').modal('hide');
                }
            })
        });
        $("#modalZoomDeleteRecord3SIS").on("hide.bs.modal", function () {
            UniqueId = 0;
        });                   
    }); 
    // Delete Ends
    // --------------------------------------------------------------------------------------------
</script>
@endsection