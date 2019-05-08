@extends('layouts.master')

@section('content')
<div class="container">
    <section>
        <div class="row justify-content-center">
            <div class="col-md-12 mtop-10">
                <div class="card">
                
                @if(!isset($data['lists'])) 
                    <div class="card-header">
                        <h5>
                            <a class="card-title" href="{{ $data['list_route'] }}"> 
                                {{ $data['id'] != 0 ? $data['lang']['edit_title'] : $data['lang']['create_title'] }}
                            </a>
                        </h5>
                    </div>

                @else

                    <h5><div class="card-header">{{ $data['lang']['list'] }}</div></h5>                   
                   
                @endif
                    <div class="card-body">
                        
                        <tasks-view :module="{{json_encode($data)}}"></tasks-view>
                        
                    </div> 
                </div>
            </div>
        </div>  
    </section>
</div>

@include("backend.modal.status",$data['status_module'])

{{-- [Modal_path] --}}
@endsection
