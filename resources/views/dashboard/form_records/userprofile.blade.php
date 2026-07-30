@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Your Account Details</h2>
            <p>Personal and company profile information</p>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body">
            <div class="am-table-wrap">
                <table class="am-table">
                    <tbody>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Company Name</strong></td>
                            <td>{{ Auth::user()->company_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Phone Number</strong></td>
                            <td>{{ Auth::user()->phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Director</strong></td>
                            <td>{{ Auth::user()->director }}</td>
                        </tr>
                        <tr>
                            <td><strong>Company Profile</strong></td>
                            <td>{{ Auth::user()->company_profile }}</td>
                        </tr>
                        <tr>
                            <td><strong>Company Address</strong></td>
                            <td>{{ Auth::user()->company_address }}</td>
                        </tr>
                        <tr>
                            <td><strong>Servicing Process</strong></td>
                            <td>{{ Auth::user()->servicing_process }}</td>
                        </tr>
                        <tr>
                            <td><strong>Competency Process</strong></td>
                            <td>{{ Auth::user()->competency_process }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
