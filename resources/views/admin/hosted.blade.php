@extends('layout.admin')

<?php $title = "Hosted contests";?>

@section('page_title')<?php echo $title?>@stop

@section('title')<?php echo $title?>@stop

@section('content')
        <div class="col-md-12">
                 <table class="table">
       <thead>
         <tr>
             <th>Name</th>
             <th>Description</th>
             <th>Type</th>
             <th>Publish type</th>
             <th>End's on</th>
             <th>Status</th>
             {{-- <th>Created at</th> --}}
        </thead>
        <tbody>

        @if($contests)


            @foreach($contests as $contest)

          <tr>
              <td>{{$contest->contest_name}}</td>
              <td>{{str_limit($contest->contest_desc, 20)}}</td>
              <td>{{$contest->contest_type}}</td>
              <td>{{$contest->publishing_type}}</td>
              <td>{{date('Y-m-d',strtotime($contest->endDateTime))}}</td>
              <td>{{$contest->ended == 1 ? "Ended" : "Live"}}</td>
              {{-- <td>{{$contest->created_at->toFormattedDateString()}}</td> --}}
          </tr>

            @endforeach

            @endif

       </tbody>
     </table>



    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

            {{$contests->render()}}

        </div>
    </div>

        </div>
@stop
