@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    @if(session('message'))<div class="alert alert-success">{{ session('message') }}</div>@endif
    @if(Session::has('Error'))<div class="alert alert-danger">{{ Session::get('Error') }}</div>@endif

    <div class="am-page-header">
        <div>
            <h2>Employees</h2>
            <p>Adding Employees will accurately store all relevant information of working staff, including training &amp; skills.</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="employeeForm()"><i class="fa fa-plus"></i> Add Employee</button>
            <button class="am-btn am-btn-primary" onclick="employeeSkillForm()" style="margin-left:6px;"><i class="fa fa-plus"></i> Add Process Skill</button>
            <button class="am-btn am-btn-primary" onclick="employeeRecordForm()" style="margin-left:6px;"><i class="fa fa-plus"></i> Add Training Record</button>
        </div>
    </div>

    <p>To add a record, click on the "Add Employee" button. To amend a record, click on the edit icon of the entry that needs to be modified or deleted.</p>

    {{-- Add Employee Form --}}
    <div class="am-card employee_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <form method="POST" action="{{ route('employee') }}" enctype="multipart/form-data" class="addForm">
                @csrf
                <h3 style="margin-bottom:1rem;">Add Employee</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label>Surname:</label>
                        <input type="text" class="form-control" name="surname" required placeholder="Enter Surname" data-type="add">
                    </div>
                    <div class="form-col">
                        <label>First Name:</label>
                        <input type="text" class="form-control" name="first_name" required placeholder="Enter First Name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" required placeholder="Enter Email">
                    </div>
                    <div class="form-col add-emp-number-div">
                        <label>Employee ID Number:</label>
                        <input name="empNumber" type="text" class="form-control" required placeholder="Enter Employee ID Number" data-type="add">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Start Date (DD/MM/YYYY):</label>
                        <input name="startDate" max="2999-12-31" required type="date" class="form-control">
                        <label style="margin-top:1rem;">Upload Employee CV:</label>
                        <input name="employee_cv" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf">
                    </div>
                    <div class="form-col">
                        <label>Job Description:</label>
                        <textarea name="jobdetails" cols="20" rows="5" class="form-control" placeholder="Enter Job Description:"></textarea>
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button type="reset" onclick="emp1()" class="am-btn am-btn-secondary" style="margin-right:7px;">Cancel</button>
                    <button class="am-btn am-btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Add Employee Skill Form --}}
    <div class="am-card employee_skill_from_div skill" style="display:none;">
        <div class="am-card__body am-form">
            <form action="{{ route('empSkills')}}" method="POST">
                @csrf
                <h3 style="margin-bottom:1rem;">Add Process Skill for Employee</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label>Employee ID Number:</label>
                        <select name="empid" required class="form-control">
                            <option value="" selected="selected" disabled="disabled">Select One</option>
                            @if(isset($userinfo) && $userinfo!= "")
                            @foreach($userinfo as $item)
                            <option value="{{$item->id}}" title="{{ $item->first_name }}">{{$item->empNumber.' ('.$item->first_name.')'}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Skill:</label>
                        <input type="text" name="empskill" class="form-control" required placeholder="Enter a Skill">
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button type="reset" onclick="emp2()" class="am-btn am-btn-secondary" style="margin-right:7px;">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Add Employee Training Record Form --}}
    <div class="am-card employee_record_from_div record" style="display:none;">
        <div class="am-card__body am-form">
            <form action=" {{route('empTraining')}} " method="POST" enctype="multipart/form-data">
                @csrf
                <h3 style="margin-bottom:1rem;">Add Training Record for Employee</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label>Employee ID Number:</label>
                        <select name="empid" required class="form-control">
                            <option value="" selected="selected" disabled="disabled">Select One</option>
                            @if(isset($userinfo) && $userinfo!= "")
                            @foreach($userinfo as $item)
                            <option value="{{$item->id}}" title="{{ $item->first_name }}">{{$item->empNumber.' ('.$item->first_name.')'}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Training Date (MM/DD/YYY):</label>
                        <input type="date" max="2999-12-31" required class="form-control" name="traningdate">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Training Details:</label>
                        <input type="text" class="form-control" required name="traningdetails">
                    </div>
                    <div class="form-col">
                        <label>Upload Training Certificate (PDF, jpeg, png):</label>
                        <input name="attach_file" type="file" class="form-control" accept="image/*,.pdf,.jpeg,.png">
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button type="reset" onclick="emp3()" class="am-btn am-btn-secondary" style="margin-right:7px;">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Employees Table --}}
    <div class="am-card">
        <div class="am-card__body">
            <h4 style="margin-bottom:1rem;">Total Employees Listed</h4>
            <div class="am-table-wrap">
                <table class="am-table common_table" id="kt_table_agent2">
                    <thead>
                        <tr>
                            <th>Employee ID Number</th>
                            <th>Surname</th>
                            <th>Firstname</th>
                            <th>Email</th>
                            <th>Start Date</th>
                            <th>Job Description</th>
                            <th>CV</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @forelse ($userinfo as $item)
                        <tr>
                            <td>{{$item->empNumber}}</td>
                            <td>{{$item->surname}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{date('d/m/Y', strtotime($item->startDate))}}</td>
                            <td>{{$item->jobdetails}}</td>
                            <td>
                                @if(!empty($item->cv))
                                    <?php
                                        $path_info = explode('.', $item->cv);
                                        if($path_info[1]=="pdf"){
                                    ?>
                                        <a target="_blank" style="color: blue;cursor: pointer;" data-toggle="modal" data-target="#cv{{$item->id}}">View CV</a>
                                    <?php
                                        }else{
                                    ?>
                                        <a target="_blank" download href="{{ asset($item->cv) }}">View CV</a>
                                    <?php } ?>

                                    {{-- CV Modal --}}
                                    <div class="modal fade" id="cv{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="viewcvLabel{{$item->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                                    <h5 class="modal-title" id="viewcvLabel{{$item->id}}">View CV</h5>
                                                    <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <object data="{{ asset($item->cv) }}" type="application/pdf">
                                                        <embed src="{{ asset($item->cv) }}" type="application/pdf" />
                                                    </object>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ asset($item->cv) }}" download>
                                                        <h5 class="modal-title" style="float:right;text-align:Right;">Download CV</h5>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    No data found
                                @endif
                            </td>
                            <td>
                                <button onclick="getEid({{json_encode($item)}});" class="am-btn am-btn-sm am-btn-warning" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="am-btn am-btn-sm am-btn-danger" onclick="deleteempl({{$item->id}})" title="Delete Employee"><i class="fa fa-trash"></i></button>
                                <button class="am-btn am-btn-sm am-btn-info" title="View" data-toggle="modal" data-target="#employ{{$item->id}}"><i class="fa fa-eye"></i></button>

                                {{-- View Employee Modal --}}
                                <div class="modal fade" id="employ{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="model1Label{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                                <h5 class="modal-title" id="model1Label{{$item->id}}">Total Employees Listed</h5>
                                                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="form-col" style="flex:1 1 100%;">
                                                        <label>Surname:</label>
                                                        <input type="text" class="form-control" name="surname" placeholder="Enter Surname" value="{{$item->surname}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-col">
                                                        <label>First Name:</label>
                                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{$item->first_name}}" readonly>
                                                    </div>
                                                    <div class="form-col edit-emp-number-div">
                                                        <label>Employee ID:</label>
                                                        <input type="text" name="empNumber" required class="form-control" data-type="edit" value="{{$item->empNumber}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-col">
                                                        <label>Start Date (YYYY/MM/DD):</label>
                                                        <input name="startDate" max="2999-12-31" type="date" class="form-control" value="{{$item->startDate}}" readonly>
                                                    </div>
                                                    <div class="form-col">
                                                        <label>Job Description:</label>
                                                        <textarea name="jobdetails" cols="20" rows="5" class="form-control" placeholder="Enter Job Description:">{{$item->jobdetails}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="padding:1rem 0 0;">
                                                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php $n++; @endphp
                        @empty
                        <tr><td colspan="8"><div class="am-empty"><i class="fa fa-database"></i><p>No records found.</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Employee Skills Table --}}
    <div class="am-card" style="margin-top:1.5rem;">
        <div class="am-card__body">
            <h4 style="margin-bottom:1rem;">Total Employee Skills Listed</h4>
            <div class="am-table-wrap">
                <table class="am-table common_table" id="kt_table_agent">
                    <thead>
                        <tr>
                            <th>Employee ID Number</th>
                            <th>Surname</th>
                            <th>Firstname</th>
                            <th>Skill</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employess as $item)
                        <tr>
                            <td>{{$item->empNumber}}</td>
                            <td>{{$item->surname}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->empskill}}</td>
                            <td>
                                <button onclick="getEidskill({{json_encode($item)}});" class="am-btn am-btn-sm am-btn-warning" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="am-btn am-btn-sm am-btn-danger" onclick="deleteemplskill({{$item->skill_id}})" title="Delete Employee"><i class="fa fa-trash"></i></button>
                                <button class="am-btn am-btn-sm am-btn-info" title="View" data-toggle="modal" data-target="#skill{{$item->skill_id}}"><i class="fa fa-eye"></i></button>

                                {{-- View Skill Modal --}}
                                <div class="modal fade" id="skill{{$item->skill_id}}" tabindex="-1" role="dialog" aria-labelledby="model2Label{{$item->skill_id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                                <h5 class="modal-title" id="model2Label{{$item->skill_id}}">Total Employee Skills Listed</h5>
                                                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="form-col">
                                                        <label>Employee ID Number:</label>
                                                        <input type="text" class="form-control" name="surname" placeholder="Enter Surname" value="{{$item->empNumber}}" readonly>
                                                    </div>
                                                    <div class="form-col">
                                                        <label>Skill:</label>
                                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{$item->empskill}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="padding:1rem 0 0;">
                                                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5"><div class="am-empty"><i class="fa fa-database"></i><p>No records found.</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Training Record Table --}}
    <div class="am-card" style="margin-top:1.5rem;">
        <div class="am-card__body">
            <h4 style="margin-bottom:1rem;">Training Record Summary</h4>
            <div class="am-table-wrap">
                <table class="am-table common_table" id="kt_table_agent">
                    <thead>
                        <tr>
                            <th>Employee ID Number</th>
                            <th>Surname</th>
                            <th>First Name</th>
                            <th>Start Date</th>
                            <th>Training Date</th>
                            <th>Training Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($emptraining as $item)
                        <tr>
                            <td>{{$item->empNumber}}</td>
                            <td>{{$item->surname}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{date('d/m/Y', strtotime($item->startDate))}}</td>
                            <td>{{date('d/m/Y', strtotime($item->traningdate))}}</td>
                            <td>{{$item->traningdetails}}</td>
                            <td>
                                <button onclick="getEidtraining({{json_encode($item)}});" class="am-btn am-btn-sm am-btn-warning" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="am-btn am-btn-sm am-btn-danger" onclick="deleteempltraining({{$item->traning_id}})" title="Delete Employee"><i class="fa fa-trash"></i></button>
                                <button class="am-btn am-btn-sm am-btn-info" title="View" data-toggle="modal" data-target="#training{{$item->traning_id}}"><i class="fa fa-eye"></i></button>

                                {{-- View Training Modal --}}
                                <div class="modal fade" id="training{{$item->traning_id}}" tabindex="-1" role="dialog" aria-labelledby="model3Label{{$item->traning_id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                                <h5 class="modal-title" id="model3Label{{$item->traning_id}}">Training Record Summary</h5>
                                                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="form-col">
                                                        <label>Employee ID:</label>
                                                        <input type="text" class="form-control" name="surname" placeholder="Enter Employee ID" value="{{$item->empNumber}}" readonly>
                                                    </div>
                                                    <div class="form-col">
                                                        <label>Training Date (DD/MM/YYYY):</label>
                                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{$item->traningdate}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-col edit-emp-number-div" style="flex:1 1 100%;">
                                                        <label>Training Details</label>
                                                        <input type="text" name="empNumber" required class="form-control" data-type="edit" value="{{$item->traningdetails}}" readonly>
                                                    </div>
                                                </div>
                                                @if ($item->attach_cert)
                                                <div class="form-row">
                                                    <div class="form-col edit-emp-number-div" style="flex:1 1 100%;">
                                                        <label>Training Certificate</label><br>
                                                        <a href="{{$item->attach_cert}}" target="_blank">Click to View</a>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="modal-footer" style="padding:1rem 0 0;">
                                                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        @endforelse

                        {{-- WordPress LMS Training Records --}}
                        @foreach ($wp_users as $wpuser)
                        @foreach($wpuser as $user)
                        @php
                            $uid= '"user_id";i:'.$user->ID.';';
                            $options = App\CertificateOption::where('option_name', 'LIKE', "%user_cert_%")->Where('option_value', 'LIKE', "%".$uid."%")->get();
                            $finshedcourses = App\CertificateUserItems::Where('user_id', $user->ID)->where('status','finished')->get();

                            if(count($finshedcourses)>0)
                            {
                                foreach ($finshedcourses as $key => $finshedcourse) {
                                    $courses = App\CertificateCourse::where('ID',$finshedcourse->item_id)->get();
                                    foreach ($courses as $key => $course) {
                                        $usercourses[]= $course->post_title;
                                        $postDate[]=$course->post_date;
                                    }
                                    $startdate=$finshedcourse->start_time;
                                    $endate=$finshedcourse->end_time;
                                }
                                $laravel_employee_detail = App\Employee::where('email', $user->user_email)->first();
                        @endphp
                        @if(!empty($usercourses) && count($usercourses) > 0)
                        @foreach($usercourses as $key => $usercourse)
                        <tr>
                            <td>{{$laravel_employee_detail->empNumber}}</td>
                            <td>{{$laravel_employee_detail->surname}}</td>
                            <td>{{$laravel_employee_detail->first_name}}</td>
                            <td>{{$startdate}}</td>
                            <td>{{$endate}}</td>
                            <td><li>{{ $usercourse}}</li></td>
                            <td></td>
                        </tr>
                        @endforeach
                        @endif
                        @php } @endphp
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Delete Employee Modal --}}
<div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="modallabel">Deleting Employee</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this entry?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('employess-delete')}}" method="POST">
                @csrf
                <input type="hidden" value="" name="id" id="res_id"/>
                <input type="hidden" name="type" value="" id="type"/>
                <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="am-btn am-btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Employee Modal --}}
<div class="modal fade" id="editepmloyee" tabindex="-1" role="dialog" aria-labelledby="editEmpLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="editEmpLabel">Edit Employee</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form method="POST" action=" {{ route('editemployee') }} " enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="editproject" value="">
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Surname:</label>
                            <input type="text" class="form-control" name="surname" placeholder="Enter Surname">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>First Name:</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
                        </div>
                        <div class="form-col edit-emp-number-div">
                            <label>Employee ID:</label>
                            <input type="text" name="empNumber" required class="form-control" data-type="edit">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Start Date (YYYY/MM/DD):</label>
                            <input name="startDate" max="2999-12-31" type="date" class="form-control">
                        </div>
                        <div class="form-col">
                            <label>Job Description:</label>
                            <textarea name="jobdetails" id="jobdetails2" cols="20" rows="5" class="form-control" placeholder="Enter Job Description:"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Upload Employee CV:</label>
                            <input name="employee_cv" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Employee Skills Modal --}}
<div class="modal fade" id="editepmloyeeskills" tabindex="-1" role="dialog" aria-labelledby="editEmpSkillLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="editEmpSkillLabel">Edit Employee Skill</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form method="POST" action="{{route('update-employes-skill')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-col">
                            <label>Employee ID Number:</label>
                            <input name="editempid" readonly type="number" class="form-control">
                            <input type="hidden" required placeholder="Enter Employee ID Number" name="employskillid" value=""/>
                        </div>
                        <div class="form-col">
                            <label>Skill:</label>
                            <input type="text" name="editempskill" required class="form-control" placeholder="Enter Skills Name:">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Employee Training Modal --}}
<div class="modal fade" id="editepmloyeetraining" tabindex="-1" role="dialog" aria-labelledby="editEmpTrainLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="editEmpTrainLabel">Edit Employee Training</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form method="POST" action="{{route('update-employes-training')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-col">
                            <label>Employee ID:</label>
                            <input type="hidden" name="edittrainid"/>
                            <input type="number" readonly class="form-control" name="editempidt">
                        </div>
                        <div class="form-col">
                            <label>Training Date (YYYY/MM/DD):</label>
                            <input type="date" max="2999-12-31" class="form-control" name="edittraningdate">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Training Details:</label>
                            <input type="text" class="form-control" name="edittraningdetails">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('myscript')
<script>
    //User for checking emp number for current logged in user , if exist or not by assad yaqoob
    let userId = "{{\Illuminate\Support\Facades\Auth::id()}}";
    let type = '';
    let ajaxCall = null;
    $('input[name="empNumber"]').blur(function(){
        let empNumber = $(this).val();
        type = $(this).data('type');
        let empId = type == 'edit' ? $('#editproject').val() : '';

        let data = {
            empNumber : empNumber,
            type : type,
            userId	: userId,
            _token : "{{csrf_token()}}",
            empId : empId
        }
        console.log(data);
        if(ajaxCall != null){
            ajaxCall.abort();
        }
        ajaxCall = $.ajax({
            method:'get',
            url:'{{url("/check-emp-number")}}',
            data:data,
            success:function(response)
            {
                $("#emp_err_msg").remove();
                if(response.status == 0){
                    let cls = `.${type}-emp-number-div`;
                    $(cls).append(`<p id="emp_err_msg" class="text-danger">${response.message}</p>`)
                    $('input[name="empNumber"]').val('');
                }
            }
        })
    });

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    function employeeCV(){
        $(".employee_cv_from_div").css("display","block")
    }
     function editEmployee(data){
        alert("data");
     }

     function deleteempl(id)
     {
         $("#modallabel").html("Deleting Employee");
         $("#res_id").val(id);
         $("#type").val('employee');
         $("#deleteSupplier").modal('show');
     }

     function deleteemplskill(id)
     {
         $("#modallabel").html("Deleting Employee Skill");
         $("#res_id").val(id);
         $("#type").val('employeeskill');
         $("#deleteSupplier").modal('show');
     }
     function deleteempltraining(id)
     {
         $("#modallabel").html("Deleting Employee Training");
         $("#res_id").val(id);
         $("#type").val('employeetraining');
         $("#deleteSupplier").modal('show');
     }
</script>
<script>
    function getEid(data){
        console.log(data);
         $("#editproject").val(data.id);
         $("input[name='empNumber']").val(data.empNumber);
         $("input[name='first_name']").val(data.first_name);
         $("#jobdetails2").val(data.jobdetails);
         $("input[name='startDate']").val(data.startDate);
         $("input[name='surname']").val(data.surname);
         $("input[name='systemid']").val(data.systemid);
         $("input[name='equipment']").val(data.equipment);
         $("input[name='certificatenumber']").val(data.certificatenumber);
         $("input[name='calibrationid']").val(data.calibrationid);
         $("input[name='calibratedDate']").val(data.calibratedDate);
         $("input[name='acceptance']").val(data.acceptance);
         $("#editepmloyee").modal('show');
     }

     function getEidskill(data)
     {
         console.log(data);
         $("input[name='editempid']").val(parseInt(data.empNumber));
         $("input[name='editempskill']").val(data.empskill);
         $("input[name='employskillid']").val(data.skill_id);
         $("#editepmloyeeskills").modal('show');
     }

     function getEidtraining(data)
     {
         $("input[name='editempidt']").val(data.empNumber);
         $("input[name='edittraningdate']").val(data.traningdate);
         $("input[name='edittraningdetails']").val(data.traningdetails);
         $("input[name='edittrainid']").val(data.traning_id);
         $("#editepmloyeetraining").modal('show');
     }

 function emp1(){
                if($(".employee_from_div").css("display")==="block"){
                    $(".employee_from_div").css("display","none");
                }
                else{
                    $(".employee_from_div").css("display","block");
                }
            }
function emp2(){
    alert(123);
    if($(".employee_skill_from_div").css("display")==="block"){
        $(".employee_skill_from_div").css("display","none");
    }
    else{
        $(".employee_skill_from_div").css("display","block");
    }
}
function emp3(){
    if($(".employee_record_from_div").css("display")==="block"){
        $(".employee_record_from_div").css("display","none");
    }
    else{
        $(".employee_record_from_div").css("display","block");
    }
}
</script>

@include('admin.dashboard.includes.foot')
        <script>
$('#kt_table_agent2').DataTable(
    {
  "ordering": false
}
    );
</script>
<style>
    div#kt_table_agent2_filter {
    float: right;
}
.skill{
    display:none;
}
.record{
    display:none;
}
[type="search"] {
    padding-top: 5px;
    padding-bottom: 5px;
    border-radius: 5px;
}
label {
    color: black !important;
    display: flex;
    align-items: center;
    gap: 10px;
}
</style>

@endsection
