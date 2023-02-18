@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
            
        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                
                @if ($page_name != 'alt_menu' && $page_name != 'blank_page' && $page_name != 'boxed' && $page_name != 'breadcrumb' )

                    <li class="menu {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                        <a href="#dashboard" data-active="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'dashboard') ? 'show' : '' }}" id="dashboard" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'sales') ? 'active' : '' }}">
                                <a href="/sales"> Sales </a>
                            </li>
                            <li class="{{ ($page_name === 'analytics') ? 'active' : '' }}">
                                <a href="/analytics"> Analytics </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'apps') ? 'active' : '' }}">
                        <a href="#app" data-active="{{ ($category_name === 'apps') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'apps') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                                <span>Apps</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'apps') ? 'show' : '' }}" id="app" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'chat') ? 'active' : '' }}">
                                <a href="/apps/chat"> Chat </a>
                            </li>
                            <li class="{{ ($page_name === 'mailbox') ? 'active' : '' }}">
                                <a href="/apps/mailbox"> Mailbox  </a>
                            </li>
                            <li class="{{ ($page_name === 'todo-list') ? 'active' : '' }}">
                                <a href="/apps/todoList"> Todo List </a>
                            </li>                            
                            <li class="{{ ($page_name === 'notes') ? 'active' : '' }}">
                                <a href="/apps/notes"> Notes </a>
                            </li>
                           
                            <li class="{{ ($page_name === 'invoice') ? 'active' : '' }}">
                                <a href="/apps/invoice"> Invoice List </a>
                            </li>
                            <li class="{{ ($page_name === 'calendar') ? 'active' : '' }}">
                                <a href="/apps/calendar"> Calendar </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu {{ ($category_name === 'forms') ? 'active' : '' }}">
                        <a href="#forms" data-active="{{ ($category_name === 'forms') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'forms') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                <span>Forms</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'forms') ? 'show' : '' }}" id="forms" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'basic') ? 'active' : '' }}">
                                <a href="/forms/basic"> Basic </a>
                            </li>
                            <li class="{{ ($page_name === 'input_group') ? 'active' : '' }}">
                                <a href="/forms/input_group"> Input Group </a>
                            </li>
                            <li class="{{ ($page_name === 'layouts') ? 'active' : '' }}">
                                <a href="/forms/layouts"> Layouts </a>
                            </li>
                            <li class="{{ ($page_name === 'validation') ? 'active' : '' }}">
                                <a href="/forms/validation"> Validation </a>
                            </li>
                            <li class="{{ ($page_name === 'input_mask') ? 'active' : '' }}">
                                <a href="/forms/input_mask"> Input Mask </a>
                            </li>
                            <li class="{{ ($page_name === 'bootstrap_select') ? 'active' : '' }}">
                                <a href="/forms/bootstrap_select"> Bootstrap Select </a>
                            </li>
                            <li class="{{ ($page_name === 'select2') ? 'active' : '' }}">
                                <a href="/forms/select2"> Select2 </a>
                            </li>
                            <li class="{{ ($page_name === 'touchspin') ? 'active' : '' }}">
                                <a href="/forms/touchspin"> TouchSpin </a>
                            </li>
                            <li class="{{ ($page_name === 'maxlength') ? 'active' : '' }}">
                                <a href="/forms/maxlength"> Maxlength </a>
                            </li>                          
                            <li class="{{ ($page_name === 'checkbox_radio') ? 'active' : '' }}">
                                <a href="/forms/checkbox_radio"> Checkbox &amp; Radio </a>
                            </li>                            
                            <li class="{{ ($page_name === 'switches') ? 'active' : '' }}">
                                <a href="/forms/switches"> Switches </a>
                            </li>
                            <li class="{{ ($page_name === 'wizards') ? 'active' : '' }}">
                                <a href="/forms/wizards"> Wizards </a>
                            </li>
                            <li class="{{ ($page_name === 'file_upload') ? 'active' : '' }}">
                                <a href="/forms/file_upload"> File Upload </a>
                            </li>
                            <li class="{{ ($page_name === 'quill') ? 'active' : '' }}">
                                <a href="/forms/quill_editor"> Quill Editor </a>
                            </li>
                            <li class="{{ ($page_name === 'markdown') ? 'active' : '' }}">
                                <a href="/forms/markdown_editor"> Markdown Editor </a>
                            </li>
                            <li class="{{ ($page_name === 'date_range_picker') ? 'active' : '' }}">
                                <a href="/forms/date_range_picker"> Date &amp; Range Picker </a>
                            </li>
                            <li class="{{ ($page_name === 'clipboard') ? 'active' : '' }}">
                                <a href="/forms/clipboard"> Clipboard </a>
                            </li>
                            <li class="{{ ($page_name === 'typeahead') ? 'active' : '' }}">
                                <a href="/forms/typeahead"> Typeahead </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Configuration -->
                    <li class="menu {{ ($category_name === 'configuration') ? 'active' : '' }}">
                        <a href="#pages" data-active="{{ ($category_name === 'configuration') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'CommonMaster') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                <span style='color:#F5821F'>Configuration</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'configuration') ? 'show' : '' }}" id="pages" data-parent="#accordionExample">
                            
                            <!-- Common Masters -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#commonMasters" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Common <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="commonMasters" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('company/index') }}">Company</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('currency/index') }}">Currency</a>
                                    </li>
                                </ul>
                            </li>                            
                            <!-- General Masters -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#payrollGeneralMasters" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> General Master <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="payrollGeneralMasters" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('salutation/index') }}">Salutation</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('gender/index') }}">Gender</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('bloodGroup/index') }}">Blood Group</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('nationality/index') }}">Nationality</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('race/index') }}">Race</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('religion/index') }}">Religion Master</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('maritalStatus/index') }}">Marital Status</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('physicalStatus/index') }}">Physical Status</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Employee Status -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#payrollEmployeeStatus" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Emp. Status <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="payrollEmployeeStatus" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('designation/index') }}">Designation</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('department/index') }}">Department</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('grade/index') }}">Grade</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('type/index') }}">Emp.Type</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Employee Credentials -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#payrollEmployeeCredentials" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Credentials <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="payrollEmployeeCredentials" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('qualification/index') }}">Qualifications</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('certificates/index') }}">Certifications</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('skills/index') }}">Skills</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Employee Income Deducntion Type -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#payrollIncomeDeductionType" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Inc.Ded.Type <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="payrollIncomeDeductionType" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('incomeType/index') }}">Income Type</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('deductionType/index') }}">Deducntion Type</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('statutrotyDeductionSlab/index') }}">Stat.Deducntion Slab</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Geographic Info -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#geographicInfo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Geographic Info <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="geographicInfo" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('country/index') }}">Country</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('state/index') }}">State</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('city/index') }}">City</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('location/index') }}">Location</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- {{-- Banking Master --}} -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#bankingMaster" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Banking Master <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="bankingMaster" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('acctType/index') }}">Acct.Type</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('bank/index') }}">Bank</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('branch/index') }}">Branch</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('paymentMode/index') }}">Payment Mode</a>
                                    </li>
                                </ul>
                            </li>
                             <!-- {{-- Payment Master --}} -->
                             <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#paymentMaster" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Payment Master <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="paymentMaster" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('ruleDefinition/index') }}">Rule Definition</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Fiscal Year -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#fiscalYear" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Fiscal Year <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="fiscalYear" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('period/index') }}">Period</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('fy/index') }}">Fiscal Year</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('calendar/index') }}">Calendar</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('publicHoliday/index') }}">Public Holiday</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('weeklyOff/index') }}">Weekly Off</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('populateCalendar/index') }}">Populate Calendar</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('company/index') }}">Company</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Example -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#pages-error" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Banking Master <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="pages-error" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('test/index') }}">Add Program</a>
                                    </li>
                                    
                                </ul>
                            </li>

                            
                        </ul>
                    </li>
                    <!-- Application -->
                    <li class="menu {{ ($category_name === 'application') ? 'active' : '' }}">
                        <a href="#employeeEarningPages" data-active="{{ ($category_name === 'application') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'EmployeeEarnings') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                <span>Application</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'application') ? 'show' : '' }}" id="employeeEarningPages" data-parent="#accordionExample">
                            <!-- Employee Emp. Master -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#payrollEmployeeMaster" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Emp. Master <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="payrollEmployeeMaster" data-parent="#pages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('generalInfo/index') }}">General Info</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('additionalInfo/index') }}">Additional Info</a>
                                    </li>                                    
                                </ul>
                            </li>
                            <!-- Employee Earnings -->
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#payrollEmployeeEarnings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Emp.Earnings <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="payrollEmployeeEarnings" data-parent="#employeeEarningPages"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('employeeEarnings/index') }}">Income/Deduction</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('currency/index1') }}">Stop Payment</a>
                                    </li>
                                  
                                </ul>
                            </li> 
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#loanBook" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Loan & Advances <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="loanBook" data-parent="#loanBook"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('loanBook/index') }}">Loan Book</a>
                                    </li>
                                </ul>
                            </li>                           
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#payrollGeneration" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Payroll <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="payrollGeneration" data-parent="#payrollGeneration"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('noPayDays/index') }}">Maintain No Pay Days</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('salarySlash/indexHed') }}">Maintain Salary Slash</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('incomeAdjustment/indexHed') }}">Maintain Income Adjustment</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('adhocPaymentPeriod/indexHed') }}">Maintain Adhoc Payment</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('payrollGeneration/landingForm') }}">Payroll Generation</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('maintainPayroll/index') }}">Maintain Payroll</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ ($page_name === 'dashboard') ? 'active' : '' }}">
                                <a href="#payrollLeave" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Excel Upload <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="payrollLeave" data-parent="#payrollLeave"> 
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('noPayDays/importform') }}">No Pay Days</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('salarySlash/index') }}">Salary Slash</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('incomeAdjustment/index') }}">Income Adjustment</a>
                                    </li>
                                    <li class="{{ ($page_name === 'html5') ? 'active' : '' }}">
                                        <a href="{{ url('adhocPaymentPeriod/index') }}">Adhoc Payment</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                @else

                <li class="menu {{ ($category_name === 'starter_kits') ? 'active' : '' }}">
                    <a href="#starter-kit" data-toggle="collapse" aria-expanded="{{ ($category_name === 'starter_kits') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-terminal"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>
                            <span>Starter Kit</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ ($category_name === 'starter_kits') ? 'show' : '' }}" id="starter-kit" data-parent="#accordionExample">
                        <li class="{{ ($page_name === 'blank_page') ? 'active' : '' }}">
                            <a href="/starter-kit/blank_page"> Blank Page </a>
                        </li>
                        <li class="{{ ($page_name === 'breadcrumb') ? 'active' : '' }}">
                            <a href="/starter-kit/breadcrumbs"> Breadcrumb </a>
                        </li>
                        <li class="{{ ($page_name === 'boxed') ? 'active' : '' }}">
                            <a href="/starter-kit/boxed"> Boxed </a>
                        </li>
                        <li class="{{ ($page_name === 'alt_menu') ? 'active' : '' }}">
                            <a href="/starter-kit/alternative_menu"> Alternate Menu </a>
                        </li>
                    </ul>
                </li>

                    <li class="menu">
                        <a href="javascript:void(0);" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span> Menu 1</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="#submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                                <span> Menu 2</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="submenu" data-parent="#accordionExample">
                            <li>
                                <a href="javascript:void(0);"> Submenu 1 </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"> Submenu 2 </a>
                            </li>                           
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                <span> Menu 3</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="submenu2" data-parent="#accordionExample">
                            <li>
                                <a href="javascript:void(0);"> Submenu 1 </a>
                            </li>
                            <li>
                                <a href="#sm2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Submenu 2 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="sm2" data-parent="#submenu2"> 
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 1 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 2 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"> Sub-Submenu 3 </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>                   
                
                @endif
                
            </ul>
            
        </nav>

    </div>
    <!--  END SIDEBAR  -->

@endif