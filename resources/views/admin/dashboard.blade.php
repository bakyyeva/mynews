@extends('layouts.admin')

@section('title')
    Admin Dashboard
@endsection

@section('css')
@endsection

@section('content')

<div class="container mt-4">
    <h5 class="card-title"> Dashboard </h5>
    <hr>

    <div class="card radius-10">
        <div class="card-body">
            <div>
                <h6 class="card-title">Statistics</h6>
            </div>
            <hr>
            <div class="row justify-content-evenly align-items-center mt-4">
                <div class="col-md-2 col-sm-12">
                    <h6 class="text-secondary font-weight-bold">Best News</h6>
                    <div class="fs-6">xxx</div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <h6 class="text-secondary font-weight-bold">Best Writers</h6>
                    <div class="fs-6">yyy</div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection

@section('js')
@endsection
