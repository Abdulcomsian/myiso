@extends('dashboard.layouts.app')

@section('content')
<style>
    .newWidth{
        width: 50%;
    }
</style>
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 1-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-4">

                <!--begin:: Widgets/Activity-->
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                    <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Welcome {{Auth::user()->name}}  
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-widget17">
                            <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides"
                                 style="background-color: #002c60;    border-bottom-left-radius: 0.42rem;border-bottom-right-radius: 0.42rem;">
                                <div class="kt-widget17__chart" style="height:160px;">

                                </div>
                            </div>
                            <div class="kt-widget17__stats">
                                <div class="kt-widget17__items">
                                    <a href="{{url('quality_manual')}}" class="newWidth">
                                    <div class="kt-widget17__item newColor">
															<span class="kt-widget17__icon">
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1"
                                                                     class="kt-svg-icon kt-svg-icon--brand">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect id="bound" x="0" y="0" width="24"
                                                                              height="24"/>
																		<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                                              id="Combined-Shape" fill="#fff"/>
																		<rect id="Rectangle-Copy-2" fill="#fff"
                                                                              opacity="0.3"
                                                                              transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) "
                                                                              x="16.3255682" y="2.94551858" width="3"
                                                                              height="18" rx="1"/>
																	</g>
																</svg> </span>
                                        <span class="kt-widget17__subtitle text-warning" style="color: white !important;">
															{{-- <a href="{{url('quality_manual')}}"> --}}
																Main Procedures and Forms
                                                            {{-- </a>	 --}}
															</span>
                                    </div>
                                </a>
                                <a href="{{url('sale_processes')}}" class="newWidth">
                                    <div class="kt-widget17__item newColor">
															<span class="kt-widget17__icon">
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1"
                                                                     class="kt-svg-icon kt-svg-icon--success">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<polygon id="Bound"
                                                                                 points="0 0 24 0 24 24 0 24"/>
																		<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                                              id="Shape" fill="#000000"
                                                                              fill-rule="nonzero"/>
																		<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                                              id="Path" fill="#000000" opacity="0.3"/>
																	</g>
																</svg> </span>
                                        <span class="kt-widget17__subtitle text-success" style="color: white !important;">
																{{-- <a href="{{url('sale_processes')}}"> --}}
																	Processes
                                                                {{-- </a> --}}
																
															</span>
                                    </div>
                                </a>
                                </div>
                                <div class="kt-widget17__items">
                                    <a href="{{url('documented_information')}}" class="newWidth">
                                    <div class="kt-widget17__item newColor">
															<span class="kt-widget17__icon">
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1"
                                                                     class="kt-svg-icon kt-svg-icon--warning">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect id="bound" x="0" y="0" width="24"
                                                                              height="24"/>
																		<path d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z"
                                                                              id="Combined-Shape" fill="#000000"
                                                                              opacity="0.3"/>
																		<path d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z"
                                                                              id="Combined-Shape" fill="#000000"/>
																	</g>
																</svg> </span>
                                        <span class="kt-widget17__subtitle text-warning" style="color: white !important;">
																{{-- <a href="{{url('documented_information')}}"> --}}
																	Procedures
                                                                {{-- </a> --}}
																
															</span>
                                    </div>
                                </a>
                                <a href="{{url('requirements_aspect')}}" class="newWidth">
                                    <div class="kt-widget17__item newColor">
															<span class="kt-widget17__icon">
													<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-09-29-132851/theme/html/demo1/dist/../src/media/svg/icons/Files/File.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
              fill="#fff" fill-rule="nonzero" opacity="0.3"/>
        <rect fill="#fff" x="6" y="11" width="9" height="2" rx="1"/>
        <rect fill="#fff" x="6" y="15" width="5" height="2" rx="1"/>
    </g>
</svg><!--end::Svg Icon--></span>
 </span>
                                        <span class="kt-widget17__subtitle" style="color: white !important;">
																{{-- <a href="{{url('requirements_aspect')}}"> --}}
                                                                     Forms and Records
                                                                    {{-- </a> --}}
																
															</span>
                                    </div>
                                </a>
                                </div>
                                <div class="kt-widget17__items">
                                    <a href="{{url('work_instruction')}}" style="width: 100%;">
                                    <div class="kt-widget17__item newColor">
															<span class="kt-widget17__icon">
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1"
                                                                     class="kt-svg-icon kt-svg-icon--danger">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect id="bound" x="0" y="0" width="24"
                                                                              height="24"/>
																		<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                                              id="Combined-Shape" fill="#000000"
                                                                              opacity="0.3"/>
																		<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                                              id="Rectangle-102-Copy" fill="#000000"/>
																	</g>
																</svg> </span>
                                        <span class="kt-widget17__subtitle" style="color: white !important;">
																
																{{-- <a href="{{url('work_instruction')}}"> --}}
																	Local Work Instructions
                                                                {{-- </a> --}}
															</span>
                                    </div>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Activity-->
            </div>
            <div class="col-xl-8">

                <!--Begin::Portlet-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Requirements Due.
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body table-responsive">

                        <!--Begin::Timeline 3 -->
                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable"
                               id="kt_table_agent">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Requirements</th>
                                <th>Date Completed</th>
                                <th>Periodicity (Months)</th>
                                <th>Due Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $requirement=App\requirement::where('user_id',Auth::user()->id)->get();
                            @endphp
                            <?php $counter = 0; ?>
                            @foreach ($requirement as $data)
                                <?php $counter++; ?>


                                <tr>
                                    <td> {{ $counter}}</td>
                                    <td>{{ $data->requirment_title}}</td>
                                    @php
                                        $d = strtotime($data->completion_date);
                                    @endphp
                                    <td>{{date("d/m/Y", $d) }}</td>
                                <!--<td>{{date('d/m/Y', strtotime($data->completion_date))}}</td>-->
                                    <td>{{ $data->periods }}</td>
                                    @php $d = strtotime("+$data->periods months",strtotime($data->completion_date)); @endphp
                                    <td>{{ date("d/m/Y",$d)}}</td>
                                <!--<td>{{ $data->due_date}}</td>-->
                                    <td><a href="#" data-id="{{$data->id}}" class="delete_requirement"
                                           class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">
																			<span class="svg-icon svg-icon-md">
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="18px" height="18px"
                                                                                 viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24"
                                                                                          height="24"></rect>
																					<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                                          fill="#5d78ff"
                                                                                          fill-rule="nonzero"></path>
																					<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                                          fill="#5d78ff"
                                                                                          opacity="0.3"></path>										</g>									</svg>								</span>
                                        </a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable -->

                        <!--End::Timeline 3 -->
                    </div>
                </div>

                <!--End::Portlet-->
                <!--Begin::Portlet-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Calibration Due
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body table-responsive">

                        <!--Begin::Timeline 3 -->
                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable"
                               id="kt_table_agent">
                            <thead>
                            <tr>
                                <th>Equipment ID</th>
                                <th>Equipment Name</th>
                                <th>Serial Number</th>
                                <th>Date Calibrated</th>
                                <th>Frequency</th>
                                <th>Date Due</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $calibration=App\calibration::where('user_id',Auth::user()->id)->get();
                            @endphp

                            <?php $counter = 0; ?>
                            @foreach ($calibration as $data)
                            <?php $counter++; ?>


                            <tr>
                                <td> {{ $counter}}</td>
                                <td>{{$data->equipment}}</td>
                                <td>{{$data->serialNum}}</td>
                                <!--@php $d = strtotime("+$data->calibratedDate months",strtotime($data->calibratedDate)); @endphp-->
                            <!--                 <td>{{ date("d/m/Y",$d)}}</td>-->
                                <td>{{date('d/m/Y', strtotime($data->calibratedDate))}}</td>
                                <td>{{$data->freq}}</td>
                                @php $d = strtotime("+$data->freq months",strtotime($data->calibratedDate));
                                @endphp
                                <td> {{ date("d/m/Y", $d) }}</td>
                                <td><a href="javascript:;" data-toggle="modal" data-id="{{$data->id}}"
                                       class="calibrationModal" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                       title="Delete"> <span class="svg-icon svg-icon-md">									<svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="18px"
                                                    height="18px" viewBox="0 0 24 24" version="1.1">										<g
                                                        stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect
                                                            x="0" y="0" width="24" height="24"></rect>											<path
                                                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                            fill="#5d78ff" fill-rule="nonzero"></path>											<path
                                                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                            fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>
                                    </a></td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable -->

                        <!--End::Timeline 3 -->
                    </div>
                </div>

                @php
                    //$iso9001_certificate = json_decode($user['iso9001_certificate']) ;
                     //dd($user)


                @endphp
                <div class="kt-portlet kt-portlet--height-fluid sd">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                ISO Certificates
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">

                        <div class="kt-widget17 p-4">


                            <div class="row ml-0 mr-0 table-responsive">


                                <table class="table table-striped- table-bordered table-hover table-checkable"
                                       id="kt_table_agent">
                                    <thead>
                                    <tr>
                                        <th>Certificate</th>
                                        <th>Link</th>
                                        <th>Description</th>
                                        <th>Expiry</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($user['iso9001_certificate'])
                                        <tr>
                                            <th>ISO9001</th>
                                            <td>
                                                <a href="public/{{$user['iso9001_certificate']}}" target="_blank">
                                                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                                </a>
                                            </td>
                                            <td>{{ $user['iso9001_description'] }}</td>
                                            <td>{{  date("d/m/Y", strtotime($user['iso9001_expirydate'])) }}</td>
                                        </tr>
                                    @endif
                                    @if($user['iso14001_certificate'])
                                        <tr>
                                            <th>ISO14001</th>
                                            <td>
                                                <a href="public/{{$user['iso14001_certificate']}}" target="_blank">
                                                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                                </a>
                                            </td>
                                            <td>{{ $user['iso14001_description'] }}</td>
                                            <td>{{  date("d/m/Y", strtotime($user['iso14001_expirydate'])) }}</td>
                                        </tr>
                                    @endif
                                    @if($user['iso45001_certificate'])
                                        <tr>
                                            <th>ISO45001</th>
                                            <td>
                                                <a href="public/{{$user['iso45001_certificate']}}" target="_blank">
                                                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                                </a>
                                            </td>
                                            <td>{{ $user['iso45001_description'] }}</td>
                                            <td>{{  date("d/m/Y", strtotime($user['iso45001_expirydate'])) }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>


                                <div class="col-md-3 mt-2 mb-2">

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="kt-portlet kt-portlet--height-fluid sd">
                    <div class="kt-portlet__head" style="border-bottom: none">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Audit Report
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-widget17 p-4">
                            <div class="row ml-0 mr-0 table-responsive">
								@if(!empty($user['audit_report']))
									<a href="public/{{$user['audit_report']}}" target="_blank" class="text-dark ml-2">
										Click to view Audit report
									</a>
								@else
									{{-- <p class="text-dark ml-2">Not found</p> --}}
                                    <p><a href="/uploads/user/pdfs/Remote-Audit-Overview.pdf" target="_blank">
                                        <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                    </a></p>
								@endif
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__head" style="border-bottom: none">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Auditor Comments
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-widget17 p-4">
                            <div class="row ml-0 mr-0 table-responsive">
                                @if(!empty($user['audit_comment']))
                                    {{$user['audit_comment']}}
                                @else
                                    {{-- <p class="text-dark ml-2">Not Comment</p> --}}
                                    <p><a href="/uploads/user/pdfs/Use-Of-Certificate-and-Certification-Marks.pdf" target="_blank">
                                        <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                    </a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
            @php

                    @endphp
            <!--End::Portlet-->
            </div>
        </div>

        <!--End::Section-->
    </div>
    <div class="modal fade" id="calibrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deleting Calibration Due</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this entry?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('deletecaliberinfo')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="req_id2" value=""/>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deleting Requirements Due</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this entry?</p>
                    <form action="{{route('deleteRequirementadmin')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="req_id" value=""/>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete Requirement</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('myscript')
    <script>
        $(".delete_requirement").click(function () {
            $id = $(this).attr('data-id');
            $("#req_id").val($id);
            $("#myModal").modal('show');
        })
        $(".calibrationModal").click(function () {

            $id = $(this).attr('data-id');

            $("#req_id2").val($id);
            $("#calibrationModal").modal('show');
        })
    </script>
@endsection
<style>
    a {
        color: #ffffff !important;
        text-decoration-style: none;

    }

    .newColor {
        background: #4580c6 !important;
    }

    .kt-svg-icon.kt-svg-icon--brand g [fill] {
        fill: #ffffff !important;
    }

    .kt-svg-icon.kt-svg-icon--success g [fill] {
        fill: #ffffff !important;

    }

    .kt-svg-icon.kt-svg-icon--warning g [fill] {
        fill: #ffffff !important;

    }

    .kt-svg-icon.kt-svg-icon--danger g [fill] {
        fill: #ffffff !important;

    }

    .kt-widget17 .kt-widget17__stats .kt-widget17__items .kt-widget17__item .kt-widget17__subtitle {
        color: #ffffff !important;
    }

    @media (max-width: 550px) {

        .table thead th,
        .table thead td {
            min-width: 180px;
        }
    }

</style>
