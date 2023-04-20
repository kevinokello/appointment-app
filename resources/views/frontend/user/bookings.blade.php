@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">

            <h1>@changeLang('All Bookings')</h1>



        </div>
    </section>
@endsection
@section('content')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
             
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>

                                <th>@changeLang('Booking Date')</th>
                                <th>@changeLang('Booking Time')</th>
                                <th>@changeLang('Doctor Username')</th>
                                <th>@changeLang('Doctor Email')</th>
                                <th>@changeLang('Doctor Phone')</th>
                                <th>@changeLang('Created At')</th>

                            </tr>
                            @php
                                $bookings2 = DB::table('appointments')
                                    ->where('user_id', Auth::user()->id)
                                    ->get();
                               
                            @endphp
                            @forelse ($bookings2 as $key => $booking)
                                <tr>

                                    <td>{{ @$booking->date }}</td>
                                    <td>{{ @$booking->time }}</td>
                                    @php
                                             $username = DB::table('users')
                                    ->where('id', $booking->b_id)
                                    ->pluck('username')->first();
                                    $email = DB::table('users')
                                    ->where('id', $booking->b_id)
                                    ->pluck('email')->first();
                                    $mobile = DB::table('users')
                                    ->where('id', $booking->b_id)
                                    ->pluck('mobile')->first();
                                    @endphp
                                    <td>{{ $username }}</td>
                                    <td>{{ $email }}</td>
                                    <td>{{ $mobile }}</td>

                                    <td>{{ @$booking->created_at }}</td>

                                </tr>
                            @empty

                                <tr>

                                    <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>

                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>

          
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@changeLang('Complete Service Booking')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>@changeLang('Are You sure to make the booking completed')?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                        <button type="submit" class="btn btn-primary">@changeLang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@changeLang('Booking Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">
                                <table class="user-data table table-bordered p-0">




                                </table>
                            </div>



                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('custom-script')
    <script>
        $(function() {
            'use strict'

            $('.complete').on('click', function() {
                const modal = $('#complete');
                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show');
            })


            $('.userdata').on('click', function(e) {
                e.preventDefault();

                const modal = $('#confirm');

                let user = $(this).data('user');
                let booking = $(this).data('booking');

                let userAddress = '';

                user.address != null ? userAddress = user.address.address : '';



                let html = `
                
                                    <tr>
                                        <td>@changeLang('Booking Id')</td>
                                        <td>${booking.trx}</td>
                                    </tr> 
                                    <tr>
                                        <td>@changeLang('Total Hours')</td>
                                        <td>${$(this).data('hours')}</td>
                                    </tr>  
                                    
                                     <tr>
                                        <td>@changeLang('Service Date')</td>
                                        <td>${new Date(booking.service_date).toDateString()}</td>
                                    </tr> 
                                   
                                    <tr>
                                        <td>@changeLang('Service Location')</td>
                                        <td>${booking.location}</td>
                                    </tr> 
                                    
                                    <tr>
                                        <td>@changeLang('Booking Time')</td>
                                        <td>${$(this).data('date')}</td>
                                    </tr> 
                                    
                                    <tr>
                                        <td>@changeLang('User Name')</td>
                                        <td>${user.fname +' '+ user.lname}</td>
                                    </tr> 
                                    
                                    <tr>
                                        <td>@changeLang('Mobile Number')</td>
                                        <td>${user.mobile ?? 'N/A'}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>@changeLang('Email')</td>
                                        <td>${user.email}</td>
                                    </tr> 
                                    
                                    <tr>
                                        <td>@changeLang('Address')</td>
                                        <td>${userAddress ?? 'N/A'}</td>
                                    </tr>  
                                    
                                    <tr>
                                        <td>@changeLang('City')</td>
                                        <td>${user.address.city ?? 'N/A'}</td>
                                    </tr>  
                                    
                                    <tr>
                                        <td>@changeLang('Zip')</td>
                                        <td>${user.address.zip ?? 'N/A'}</td>
                                    </tr>  
                                    
                                    <tr>
                                        <td>@changeLang('Country')</td>
                                        <td>${user.address.country ?? 'N/A'}</td>
                                    </tr> 
                                    
                                   
                                    <tr>
                                        <td>@changeLang('Message For Service Provider')</td>
                                        <td>${booking.message}</td>
                                    </tr>
                                   
                
                
                
                `;

                modal.find('.user-data').html(html);

                modal.modal('show');

            })
        })
    </script>
@endpush
