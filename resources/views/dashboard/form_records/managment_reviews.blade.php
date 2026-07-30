@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    @if(session('message'))<div class="alert alert-success">{{ session('message') }}</div>@endif

    <div class="am-page-header">
        <div>
            <h2>Management Reviews</h2>
            <p>Management Reviews ensure that the company can measure the effectiveness of the management system.</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="managemnetReviewForm()"><i class="fa fa-plus"></i> Add Management Review</button>
        </div>
    </div>

    <p>Management Reviews are to ensure that the company can measure the effectiveness of the management system, whilst focusing on the direction of the business and its continual improvement. These should be conducted monthly, quarterly, semiannually, or annually depending on the size and nature of the business.</p>
    <p>To add a record, click on the "Add Management review" button. To amend a record, click on the edit icon of the entry that needs to be modified or deleted.</p>

    {{-- Add Management Review Form --}}
    <div class="am-card managemnet_review_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <form action="{{route('mgtreview')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" name="mgtreviewId" value="241">
                <h3 style="margin-bottom:1rem;">Add Management Review</h3>
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Management Review Date:</label>
                        <input type="date" max="2999-12-31" required class="form-control" name="reviewdate">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Management Review Meeting Attendees:</label>
                        <textarea class="form-control" name="meetingatt" required placeholder="Enter attendees name:" cols="30" rows="4"></textarea>
                    </div>
                    <div class="form-col">
                        <label>Review of previous meeting minutes:</label>
                        <textarea class="form-control" name="prevmeeting" required placeholder="Enter Previous meetings key points" cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
                        <textarea class="form-control" name="recommendedchange" required placeholder="Enter Changes" cols="30" rows="4"></textarea>
                    </div>
                    <div class="form-col">
                        <label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
                        <textarea class="form-control" placeholder="Enter Summary" name="sammarisecustomr" required cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Comment on previous objectives:</label>
                        <textarea class="form-control" name="prevobjectv" placeholder="Enter Comments of Previous Objects" required cols="30" rows="4"></textarea>
                    </div>
                    <div class="form-col">
                        <label>Process Audit performance and conformity of products and services:</label>
                        <textarea class="form-control" placeholder="Enter Feedback of performance of products and services created in process audits" name="conformity" required cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Nonconformities and corrective actions:</label>
                        <textarea class="form-control" name="nonconformities" required placeholder="Enter Nonconformities and corrective actions" cols="30" rows="4"></textarea>
                    </div>
                    <div class="form-col">
                        <label>Monitoring and measurement results:</label>
                        <textarea class="form-control" name="monitoringres" required placeholder="Enter Outcome" cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Comment on Audit results:</label>
                        <textarea class="form-control" name="auditres" required placeholder="Enter comments of audit findings" cols="30" rows="4"></textarea>
                    </div>
                    <div class="form-col">
                        <label>Comment on the performance of external providers:</label>
                        <textarea class="form-control" name="externalprovider" required placeholder="Enter Comments of external providers performance" cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>The adequacy of resources and changes recommended:</label>
                        <textarea class="form-control" name="adequacy" required placeholder="Enter Comments of adequacy of the resources and recommended changes" cols="30" rows="4"></textarea>
                    </div>
                    <div class="form-col">
                        <label>The effectiveness of actions taken to address risks and opportunities:</label>
                        <textarea class="form-control" name="effectiveness" required placeholder="Enter Effectiveness of actions" cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Add New Quality Objectives, Targets and opportunities for improvement. Consider who is responsible, when they will be completed and what is considered a success. Objectives should be both quality based and financial. Consider aligning objectives to the quality policy:</label>
                        <textarea class="form-control" name="newquality" required placeholder="Enter New Quality Objectives" cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Attachment File (PDF, jpeg, txt, .docx, doc, png):</label>
                        <input name="attach_file" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf,.jpeg,.png">
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                    <button type="reset" onclick="mngmnt_reviews()" class="am-btn am-btn-secondary" style="margin-left:12px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Management Reviews Table --}}
    <div class="am-card">
        <div class="am-card__body">
            <h4 style="margin-bottom:1rem;">Management Review</h4>
            <div class="am-table-wrap">
                <table class="am-table common_table" id="kt_table_agent">
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Date</th>
                            <th>Attendees</th>
                            <th>Planned Objectives</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @forelse ($userData as $item)
                        <tr>
                            <td>@php echo $i; @endphp</td>
                            <td>{{date('d/m/Y', strtotime($item->reviewdate))}}</td>
                            <td>{{$item->meetingatt}}</td>
                            <td>{{$item->newquality}}</td>
                            <td>
                                <button class="am-btn am-btn-sm am-btn-info" title="View" onclick="displaydetail({{json_encode($item)}});"><i class="fa fa-eye"></i></button>
                                <button class="am-btn am-btn-sm am-btn-warning" title="Edit" onclick="getEid({{$item}});"><i class="fa fa-edit"></i></button>
                                <button class="am-btn am-btn-sm am-btn-danger" title="Delete" onclick="deleteData({{$item}})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @empty
                        <tr><td colspan="5"><div class="am-empty"><i class="fa fa-database"></i><p>No records found.</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="deleteMgtLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="deleteMgtLabel">Deleting Management review</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this entry?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('deletemgtreview')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="validid">
                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="am-btn am-btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- View Management Review Modal --}}
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="viewMgtLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="viewMgtLabel">View Management Reviews Details</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" readonly disabled name="id" value="" id="id_feild">
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Management Review Date:</label>
                            <input type="date" readonly disabled class="form-control" name="1reviewdate">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Management Review Meeting Attendees:</label>
                            <input type="text" readonly disabled class="form-control" name="1meetingatt" placeholder="Enter attendees name:">
                        </div>
                        <div class="form-col">
                            <label>Review of previous meeting minutes:</label>
                            <input type="text" readonly disabled class="form-control" name="1prevmeeting" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
                            <input type="text" readonly disabled class="form-control" placeholder="Enter Changes" name="1recommendedchange">
                        </div>
                        <div class="form-col">
                            <label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
                            <input type="text" readonly disabled class="form-control" placeholder="Enter Summary" name="1sammarisecustomr">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Comment on previous objectives:</label>
                            <input type="text" readonly disabled class="form-control" placeholder="Enter Comments of Previous Objects" name="1prevobjectv">
                        </div>
                        <div class="form-col">
                            <label>Process performance and conformity of products and services:</label>
                            <input type="text" readonly disabled placeholder="Enter Feedback of performance of products and services" class="form-control" name="1conformity">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Nonconformities and corrective actions:</label>
                            <input type="text" readonly disabled class="form-control" placeholder="Enter Nonconformities and corrective actions" name="1nonconformities">
                        </div>
                        <div class="form-col">
                            <label>Monitoring and measurement results:</label>
                            <input type="text" readonly disabled class="form-control" placeholder="Enter Outcome" name="1monitoringres">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Comment on Audit results:</label>
                            <input type="text" readonly disabled class="form-control" name="1auditres">
                        </div>
                        <div class="form-col">
                            <label>Comment on the performance of external providers:</label>
                            <input type="text" readonly disabled class="form-control" name="1externalprovider">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>The adequacy of resources and changes recommended:</label>
                            <input type="text" readonly disabled class="form-control" name="1adequacy">
                        </div>
                        <div class="form-col">
                            <label>The effectiveness of actions taken to address risks and opportunities:</label>
                            <input type="text" readonly disabled class="form-control" name="1effectiveness">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Add New Quality Objectives and opportunities for improvement. Consider who is responsible, when they will be completed and what is considered a success:</label>
                            <input type="text" readonly disabled class="form-control" name="1newquality">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Attachment File (PDF, jpeg, txt, .docx, doc, png):</label>
                            <div class="file_attachemnt_div"></div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:1rem 0 0;">
                        <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Management Review Modal --}}
<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="editMgtLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="editMgtLabel">Edit Management Reviews Details</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('mgtreviewupdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="" id="sdsd">
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Management Review Date:</label>
                            <input type="date" max="2999-12-31" required class="form-control" name="reviewdate">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Management Review Meeting Attendees:</label>
                            <input type="text" class="form-control" required name="meetingatt" placeholder="Enter attendees name:">
                        </div>
                        <div class="form-col">
                            <label>Review of previous meeting minutes:</label>
                            <input type="text" class="form-control" required name="prevmeeting" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
                            <input type="text" class="form-control" placeholder="Enter Changes" required name="recommendedchange">
                        </div>
                        <div class="form-col">
                            <label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
                            <input type="text" class="form-control" placeholder="Enter Summary" required name="sammarisecustomr">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Comment on previous objectives:</label>
                            <input type="text" class="form-control" placeholder="Enter Comments of Previous Objects" required name="prevobjectv">
                        </div>
                        <div class="form-col">
                            <label>Process performance and conformity of products and services:</label>
                            <input type="text" class="form-control" placeholder="Enter Feedback of performance of products and services" required name="conformity">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Nonconformities and corrective actions:</label>
                            <input type="text" class="form-control" placeholder="Enter Nonconformities and corrective actions" name="nonconformities">
                        </div>
                        <div class="form-col">
                            <label>Monitoring and measurement results:</label>
                            <input type="text" class="form-control" placeholder="Enter Outcome" required name="monitoringres">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Comment on Audit results:</label>
                            <input type="text" class="form-control" required name="auditres">
                        </div>
                        <div class="form-col">
                            <label>Comment on the performance of external providers:</label>
                            <input type="text" class="form-control" required name="externalprovider">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>The adequacy of resources and changes recommended:</label>
                            <input type="text" class="form-control" required name="adequacy">
                        </div>
                        <div class="form-col">
                            <label>The effectiveness of actions taken to address risks and opportunities:</label>
                            <input type="text" class="form-control" required name="effectiveness">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Add New Quality Objectives and opportunities for improvement. Consider who is responsible, when they will be completed and what is considered a success:</label>
                            <input type="text" class="form-control" required name="newquality">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Attachment File (PDF, jpeg, txt, .docx, doc, png):</label>
                            <input name="attach_file" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf,.jpeg,.png">
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:1rem 0 0;">
                        <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="am-btn am-btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function getEid(data){
        console.log(data);
         $("#sdsd").val(data.id);
         $("input[name='adequacy']").val(data.adequacy);
         $("input[name='mgtreviewId']").val(data.mgtreviewId);
         $("input[name='auditres']").val(data.auditres);
         $("input[name='conformity']").val(data.conformity);
         $("input[name='effectiveness']").val(data.effectiveness);
         $("input[name='externalprovider']").val(data.externalprovider);
         $("input[name='meetingatt']").val(data.meetingatt);
         $("input[name='monitoringres']").val(data.monitoringres);
         $("input[name='newquality']").val(data.newquality);
         $("input[name='nonconformities']").val(data.nonconformities);
         $("input[name='prevmeeting']").val(data.prevmeeting);
         $("input[name='prevobjectv']").val(data.prevobjectv);
         $("input[name='recommendedchange']").val(data.recommendedchange);
         $("input[name='reviewdate']").val(data.reviewdate);
         $("input[name='sammarisecustomr']").val(data.sammarisecustomr);
         $("#editSupplier").modal('show');
     }
     function deleteData(data){
         $("#validid").val(data.id);
         $("#deleteRequirment").modal('show');
     }
   function  displaydetail(data){
         $("input[name='1adequacy']").val(data.adequacy);
         $("input[name='1mgtreviewId']").val(data.mgtreviewId);
         $("input[name='1auditres']").val(data.auditres);
         $("input[name='1conformity']").val(data.conformity);
         $("input[name='1effectiveness']").val(data.effectiveness);
         $("input[name='1externalprovider']").val(data.externalprovider);
         $("input[name='1meetingatt']").val(data.meetingatt);
         $("input[name='1monitoringres']").val(data.monitoringres);
         $("input[name='1newquality']").val(data.newquality);
         $("input[name='1nonconformities']").val(data.nonconformities);
         $("input[name='1prevmeeting']").val(data.prevmeeting);
         $("input[name='1prevobjectv']").val(data.prevobjectv);
         $("input[name='1recommendedchange']").val(data.recommendedchange);
         $("input[name='1reviewdate']").val(data.reviewdate);
         $("input[name='1sammarisecustomr']").val(data.sammarisecustomr);
         console.log("modal here");

         if(data.attach_file){
			$('.file_attachemnt_div').empty().append(`<a target="_blank" href="${data.attach_file}">Click to View</a>`);
		}else{
			$('.file_attachemnt_div').empty().append('No data found');
		}

        $("#DetailModal").modal('show');
     }
  function mngmnt_reviews(){

				if($(".managemnet_review_from_div").css("display")==="block"){
					$(".managemnet_review_from_div").css("display","none");
				}
				else{
					$(".managemnet_review_from_div").css("display","block");
				}
			}
 </script>
