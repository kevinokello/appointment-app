@extends('frontend.layout.frontend')

@section('content')

 @include('frontend.sections.category')

   

@endsection


@push('custom-css')
   <style>
   
    .modal-dialog {
    position:fixed;
    top:auto;
    right:auto;
    left:auto;
    bottom:0;
 }  
   
   </style> 
@endpush
