@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
	                <div class="row form-group">
	                	<div class="col-md-6">
	                		<input type="text" name="search" class="form-control">
	                	</div>
	                	<div class="col-md-6 text-right">
	                		<a href="/user/create" class="btn theme-btn">Create User</a>
	                		<a href="/user/create" class="btn btn-info text-white">Export</a>
	                	</div>
	                </div>
                
                    <table class="table">
                    	<thead>
                    		<tr>
                    			<th>Name</th>
                    			<th>Email</th>
                    			<th>Date</th>
                    			<th>Status</th>
                    			<th></th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		<tr>
                    			<td>New</td>
                    			<td>new@new.com</td>
                    			<th>5,jun 2019</th>
                    			<th>Active</th>
                    			<th>More</th>
                    		</tr>
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
