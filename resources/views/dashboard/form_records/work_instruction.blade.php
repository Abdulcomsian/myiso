@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Work Instructions</h2>
            <p>Step-by-step guides for conducting activities in the workplace</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="workInstructionFrom()">
                <i class="fa fa-plus"></i> Add Work Instruction
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="am-card work_instruction_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">New Work Instruction</h6>
            <p>Work Instructions are also referred to as Processes. These are used as a step-by-step guide of how to conduct an activity in the workplace. This section should be used to create activities that are later selected to perform internal audits from your process audits.</p>
            <form action="{{route('workinstructions')}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <label>Work Instruction / Process Title:</label>
                        <input type="text" class="form-control" name="workinstruction" placeholder="Add Work Instruction / Process" required="required">
                    </div>
                    <div class="form-col">
                        <label>Work Instruction Reference:</label>
                        <input type="text" class="form-control" name="instructionref" required="required">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Employee ID Number of Work Instruction Creater (taken from the Employee table):</label>
                        <select class="form-control" name="empId" required="required">
                            <option value="">Select Employee</option>
                            @foreach($employess as $emp)
                            <option value="{{$emp->id}}">{{$emp->empNumber}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Issue Date (MM/DD/YYYY):</label>
                        <input type="date" max="2999-12-31" class="form-control" name="issueDate" required="required">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Revision Status:</label>
                        <input type="text" class="form-control" name="revisionstatus" required="required">
                    </div>
                    <div class="form-col">
                        <label>Scope:</label>
                        <input type="text" class="form-control" name="scop" required="required">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Point 1:</label>
                        <input type="text" class="form-control" name="point1">
                    </div>
                    <div class="form-col">
                        <label>Point 2:</label>
                        <input type="text" class="form-control" name="point2">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Point 3:</label>
                        <input type="text" class="form-control" name="point3">
                    </div>
                    <div class="form-col">
                        <label>Point 4:</label>
                        <input type="text" class="form-control" name="point4">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Point 5:</label>
                        <input type="text" class="form-control" name="point5">
                    </div>
                    <div class="form-col">
                        <label>Point 6:</label>
                        <input type="text" class="form-control" name="point6">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Point 7:</label>
                        <input type="text" class="form-control" name="point7">
                    </div>
                    <div class="form-col">
                        <label>Point 8:</label>
                        <input type="text" class="form-control" name="point8">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Point 9:</label>
                        <input type="text" class="form-control" name="point9">
                    </div>
                    <div class="form-col">
                        <label>Point 10:</label>
                        <input type="text" class="form-control" name="point10">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Point 11:</label>
                        <input type="text" class="form-control" name="point11">
                    </div>
                    <div class="form-col">
                        <label>Point 12:</label>
                        <input type="text" class="form-control" name="point12">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Compiled By:</label>
                        <input type="text" class="form-control" name="CompiledBy" required>
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button type="submit" class="am-btn am-btn-primary">Submit</button>
                    <button type="reset" class="am-btn am-btn-sm am-btn-danger" onclick="closeform();" style="margin-left:8px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">Total Work Instructions Listed</h6>
            <div class="am-table-wrap">
                <table class="am-table" id="kt_table_agent">
                    <thead>
                        <tr>
                            <th>WI ID</th>
                            <th>WI Name</th>
                            <th>WI Ref</th>
                            <th>WI Scope</th>
                            <th>Compiled By</th>
                            <th>Issue Date</th>
                            <th>Revision</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($work as $data)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$data->workinstruction}}</td>
                            <td>{{$data->instructionref}}</td>
                            <td>{{$data->scop}}</td>
                            @php
                             $employname=\App\Employee::where('id',$data->empid)->first();
                            @endphp
                            <td>{{isset($data->CompiledBy) ? $data->CompiledBy :''}}</td>
                            <td>{{date('d/m/Y', strtotime($data->issueDate))}}</td>
                            <td>{{$data->revisionstatus}}</td>
                            <td>
                                <button class="am-btn am-btn-sm am-btn-primary" title="View" onclick="getEid({{$data}});">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="am-btn am-btn-sm am-btn-primary" title="Edit" onclick="editDetails({{$data}});">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="am-btn am-btn-sm am-btn-danger" data-toggle="modal" data-target="#deleteworkinst{{$data->id}}" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteworkinst{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                                <h5 class="modal-title">Deleting Work Instruction</h5>
                                                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this entry?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{route('deleteWork')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{$data->id}}" name="id">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="am-empty">
                                    <i class="fa fa-database"></i>
                                    <p>No records.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">Total Employees Listed</h6>
            <div class="am-table-wrap">
                <table class="am-table">
                    <thead>
                        <tr>
                            <th>Employee ID Number</th>
                            <th>Surname</th>
                            <th>Firstname</th>
                            <th>Start Date</th>
                            <th>Job Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employess as $item)
                        <tr>
                            <td>{{$item->empNumber}}</td>
                            <td>{{$item->surname}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{date('d/m/Y', strtotime($item->startDate))}}</td>
                            <td>{{$item->jobdetails}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="am-empty">
                                    <i class="fa fa-database"></i>
                                    <p>No records.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- View Modal -->
<div class="modal fade" id="workinstructionsDetails" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">View Work Instructions</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('workinstructions')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Work Instruction Title:</label>
                                <input type="text" readonly disabled class="form-control" name="workinstruction">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Work Instruction Reference:</label>
                                <input type="text" readonly disabled class="form-control" name="instructionref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee ID Number of Work Instruction Creater:</label>
                                <select class="form-control" name="empId" required="required" disabled>
                                    <option value="">Select Employee</option>
                                    @foreach($employess as $emp)
                                    <option value="{{$emp->id}}">{{$emp->empNumber}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Issue Date (MM/DD/YYYY):</label>
                                <input type="date" readonly disabled class="form-control" name="issueDate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revision Status:</label>
                                <input type="text" readonly disabled class="form-control" name="revisionstatus">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Scope:</label>
                                <input type="text" readonly disabled class="form-control" name="scop">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 1:</label><input type="text" readonly disabled class="form-control" name="point1"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 2:</label><input type="text" readonly disabled class="form-control" name="point2"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 3:</label><input type="text" readonly disabled class="form-control" name="point3"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 4:</label><input type="text" readonly disabled class="form-control" name="point4"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 5:</label><input type="text" readonly disabled class="form-control" name="point5"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 6:</label><input type="text" readonly disabled class="form-control" name="point6"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 7:</label><input type="text" readonly disabled class="form-control" name="point7"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 8:</label><input type="text" readonly disabled class="form-control" name="point8"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 9:</label><input type="text" readonly disabled class="form-control" name="point9"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 10:</label><input type="text" readonly disabled class="form-control" name="point10"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 11:</label><input type="text" readonly disabled class="form-control" name="point11"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 12:</label><input type="text" readonly disabled class="form-control" name="point12"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Compiled By:</label>
                                <input type="text" readonly disabled class="form-control" name="CompiledBy">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editworkinstuction" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">Edit Work Instructions</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('editworkinstructions')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editit" name="id" value="">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Work Instruction Title:</label>
                                <input type="text" class="form-control" name="workinstruction">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Work Instruction Reference:</label>
                                <input type="text" class="form-control" name="instructionref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee ID Number of Work Instruction Creater:</label>
                                <select class="form-control" name="empId" required="required">
                                    <option value="">Select Employee</option>
                                    @foreach($employess as $emp)
                                    <option value="{{$emp->id}}">{{$emp->empNumber}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Issue Date (MM/DD/YYYY):</label>
                                <input type="date" max="2999-12-31" class="form-control" name="issueDate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revision Status:</label>
                                <input type="text" class="form-control" name="revisionstatus">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Scope:</label>
                                <input type="text" class="form-control" name="scop">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 1:</label><input type="text" class="form-control" name="point1"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 2:</label><input type="text" class="form-control" name="point2"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 3:</label><input type="text" class="form-control" name="point3"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 4:</label><input type="text" class="form-control" name="point4"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 5:</label><input type="text" class="form-control" name="point5"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 6:</label><input type="text" class="form-control" name="point6"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 7:</label><input type="text" class="form-control" name="point7"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 8:</label><input type="text" class="form-control" name="point8"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 9:</label><input type="text" class="form-control" name="point9"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 10:</label><input type="text" class="form-control" name="point10"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Point 11:</label><input type="text" class="form-control" name="point11"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Point 12:</label><input type="text" class="form-control" name="point12"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Compiled By:</label>
                                <input type="text" class="form-control" name="CompiledBy" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function getEid(data){
        console.log(data);
         $("#id_feild").val(data.work_id);
          $("select[name='empId']").val(data.empId);
         $("input[name='instructionref']").val(data.instructionref);
         $("input[name='issueDate']").val(data.issueDate);
         $("input[name='point1']").val(data.point1);
         $("input[name='point2']").val(data.point2);
         $("input[name='point3']").val(data.point3);
         $("input[name='point4']").val(data.point4);
         $("input[name='point5']").val(data.point5);
         $("input[name='point6']").val(data.point6);
         $("input[name='point7']").val(data.point7);
         $("input[name='point8']").val(data.point8);
         $("input[name='point9']").val(data.point9);
         $("input[name='point10']").val(data.point10);
         $("input[name='point11']").val(data.point11);
         $("input[name='point12']").val(data.point12);
         $("input[name='revisionstatus']").val(data.revisionstatus);
         $("input[name='scop']").val(data.scop);
         $("input[name='workinstruction']").val(data.workinstruction);
         $("input[name='CompiledBy']").val(data.CompiledBy);
         $("#workinstructionsDetails").modal('show');
     }
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');
     }
     function closeform()
     {
         $(".work_instruction_from_div").hide();
     }
     function editDetails(data){
         console.log(data);
        $("#editit").val(data.id);
         $("select[name='empId']").val(data.empId);
         $("input[name='instructionref']").val(data.instructionref);
         $("input[name='issueDate']").val(data.issueDate);
         $("input[name='point1']").val(data.point1);
         $("input[name='point2']").val(data.point2);
         $("input[name='point3']").val(data.point3);
         $("input[name='point4']").val(data.point4);
         $("input[name='point5']").val(data.point5);
         $("input[name='point6']").val(data.point6);
         $("input[name='point7']").val(data.point7);
         $("input[name='point8']").val(data.point8);
         $("input[name='point9']").val(data.point9);
         $("input[name='point10']").val(data.point10);
         $("input[name='point11']").val(data.point11);
         $("input[name='point12']").val(data.point12);
         $("input[name='revisionstatus']").val(data.revisionstatus);
         $("input[name='scop']").val(data.scop);
         $("input[name='workinstruction']").val(data.workinstruction);
         $("input[name='CompiledBy']").val(data.CompiledBy);
         $("#editworkinstuction").modal('show');
     }
</script>
