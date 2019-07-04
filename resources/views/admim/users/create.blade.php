@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create User</div>

                <div class="card-body">
	                
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Lst Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card button-card">
                <div class="row">
                    <div class="col-md-12">
                        <a href="" class="btn float-left cancel-btn">Cancel</a>
                        <a href="" class="btn float-right theme-btn">Save</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
