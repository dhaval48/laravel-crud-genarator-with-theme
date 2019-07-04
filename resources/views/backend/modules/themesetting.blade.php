@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mtop-10">
            <div class="card">
                <h5><div class="card-header">Theme Color Setting</div></h5>                  
                <div class="card-body">
                    <theme_settings-view :module="{{json_encode($data)}}"></theme_settings-view>
                </div> 
            </div>
        </div>
    </div>  
</div>

{{-- [Modal_path] --}}
@endsection
