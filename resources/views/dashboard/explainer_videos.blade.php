@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Training Videos</h2>
            <p>Explainer videos and training resources</p>
        </div>
    </div>

    @if($videos->count())
        <div class="row">
            @foreach($videos as $video)
                <div class="col-md-4 mb-4">
                    <div class="am-card h-100">
                        <div class="am-card__body" style="padding:16px; text-align:center;">
                            <a href="{{ asset('/uploads/explainer_videos/' . $video->video) }}" target="_blank">
                                <img src="{{ asset('assets/media/video_images/' . $video->video_image) }}"
                                     class="img-fluid"
                                     style="border-radius:6px; width:100%;">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="am-card">
            <div class="am-card__body">
                <div class="am-empty">
                    <i class="fa fa-play-circle"></i>
                    <p>No training videos are available at the moment.</p>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
