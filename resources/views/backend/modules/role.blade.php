@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mtop-10">
            <div class="card">
            
            @if(!isset($data['lists']))
                <h5>
             
                <div class="card-header">
                        <a style="text-decoration:none" href="{{ $data['list_route'] }}"> 
                        {{ $data['id'] != 0 ? $data['lang']['edit_title'] : $data['lang']['create_title'] }}
                        </a>
                </div>
                    </h5>
                
            @else

                <h5><div class="card-header">{{ $data['lang']['list'] }}</div></h5>                   
               
            @endif
                <div class="card-body">
		            <roles-view :module="{{json_encode($data)}}"></roles-view>
                
                </div> 
            </div>
        </div>
    </div>  
</div>

@endsection
