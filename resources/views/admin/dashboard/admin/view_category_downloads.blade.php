
@forelse($downloads as $download)
<div style="display: flex; margin-left: 2em; margin-right: 2em; background:#f0f4fd; gap:80px; margin-bottom:20px; padding:30px 20px; align-items:center; border-radius:12px; ">
    <div style="display:flex; align-items:center; gap:40px"> 
        @if ($download->thumb_nail)
        <div>
            <img src="{{ asset('uploads/downloads/' . $download->thumb_nail) }}" width="110" height="156">
        </div>
       
        @endif
        <div style="color:#084f95; font-size: 18px; font-weight:600; text-align:left;width:170px; ">{{ $download->name }}</div>
    </div>
    
 <div style="display: flex; gap:20px;justify-content:space-between;">
    <div style="display: flex; flex-direction: column;gap:5px;">
        @if ($download->download_file)
        <a href="{{ asset('uploads/downloads/' . $download->download_file) }}" target="_blank"><img src="assets/img/a4-btn.png"  style="width: 80%"></a><br>
        @endif
        @if ($download->download_file2)
        <a href="{{ asset('uploads/downloads/' . $download->download_file2) }}" target="_blank"><img src="assets/img/a5-btn.png"  style="width: 80%"></a><br>
        @endif
    </div>
    <div>
        <a href="javascript:;" data-toggle="modal" data-target="#delete-{{ $download->id }}" title="Delete"><img src="assets/img/delete.png"  style="width: 80%"></a><br>
    </div>
    <div class="modal fade" id="delete-{{$download->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deleting Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure? Do you really want to delete this?.</p>
                </div>
                <div class="modal-footer">
                    <form action="{{url('/download_delete/'.$download->id)}}" method="POST">
                    @csrf
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>	
 </div>
</div>
@empty
<div class="row">
    <div class="col-12">
        <p class="text-center " style="color:#084f95; font-size: 18px; font-weight:600;">No Record Found</p>
    </div>
</div>
@endforelse
