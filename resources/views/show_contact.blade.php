@extends('layout')
@section('page_title', 'Contact Details')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2>Contact-list</h2>
        <div style="margin-right:10%;float: right;">
        
        <a href="{{ route('save_contact')}}" class="btn btn-primary">Contact Form</a>

        </div>
        <table class="table">
            <thead><tr>
                <th>S.No.</th>
                <th> Name</th>
                <th> Email</th>
                <th>Number</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody> 
                @foreach($data as $stu)
                <tr>
                <td>{{$loop->iteration}}</td>    
                <td>{{$stu->name}}</td>
                <td>{{$stu->email}}</td>
                <td>{{$stu->number}}</td>
                <td>{{ Str::limit($stu->message, 50 ) }}</td>
                <td><a href="{{ route('view',$stu->id)}}"><button type="button" class="btn btn-primary">View</button></a></td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

  </div>
   
@endsection