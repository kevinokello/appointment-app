@extends('frontend.layout.frontend')

@section('content')


    <!--Team Detail Start-->
    <div class="team-detail-page pt_40 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-detail-photo">
                        <img src="@if ($user->image) {{ asset('uploads/users/' . $user->image) }} @else {{ asset('assets/img/user.jpg') }} @endif"
                            alt="Team Photo">
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="team-detail-text">
                        <h4>{{ __($user->fullname) }}</h4>
                        <span><b>{{ $user->designation }}</b></span>
            
                        <div class="total-job mt_10">
                            {{ $jobSuccess }} @changeLang('Successful Jobs')
                        </div>
                        <p>
                            @php
                                
                                echo clean($user->details);
                            @endphp
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($services->count() > 0)
        <div class="expert-sevice bg_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@changeLang('All Offered Services')</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-md-4">
                            <div class="service-list">
                                <div class="photo">
                                    <a
                                        href="{{ route('service.details', ['id' => $service->id, 'slug' => Str::slug($service->name)]) }}"><img
                                            src="
                                         @if ($service->service_image) {{ getFile('service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif
                    "
                                            alt=""></a>
                                    <div class="cat">
                                        {{ __($service->category->name) }}
                                    </div>
                                </div>
                                <div class="title"><a
                                        href="{{ route('service.details', ['id' => $service->id, 'slug' => Str::slug($service->name)]) }}">{{ $service->name }}</a>
                                </div>
                                <div class="rate">KSH {{  $service->rate }}</div>
                             
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif

    <div class="team-exp-area pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="team-headline">
                        <h2>@changeLang('Profile Details')</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <!--Tab Start-->
                    <div class="event-detail-tab mt_20">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a class="active" href="#working_hour" data-toggle="tab">@changeLang('Available Appointments')</a>
                            </li>
                       
                            <li>
                                <a href="#experience" data-toggle="tab">@changeLang('Experience')</a>
                            </li>
                            <li>
                                <a href="#qualification" data-toggle="tab">@changeLang('Qualifications')</a>
                            </li>
                            <li>
                                <a href="#contact" data-toggle="tab">@changeLang('Contact')</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content event-detail-content">
                        <div id="working_hour" class="tab-pane fade show active">
                            <div class="">
                                <h1 class="center">
                                    Available Appointments
                                </h1>
                                <div class="row">
                                @auth
                                    @foreach ($appointments as $appointment)
                                        <div class="col 1">
                                            <h5 class="center">
                                                {{ $appointment['date'] }}
                                            </h5>
                                            <h5 class="center">
                                                <b> {{ $appointment['day_name'] }}</b>
                                            </h5>
                                            @if (!$appointment['off'])
                                                @foreach ($appointment['business_hours'] as $time)
                                                    @if (!in_array($time, $appointment['reserved_hours']))
                                                        <form action="{{ route('reserve') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="date" value=" {{ $appointment['full_date'] }}">
                                                            <input type="hidden" name="time" value="{{ $time }}">
                                                            <input type="hidden" name="b_id" value="{{ $user->id }}">

                                                            <button class="waves-effect waves-light btn info darken-2" type="submit">
                                                                {{ $time }}
                                                            </button>
                                                            <br>
                                                            <br>
                                                        </form>
                                                    @else
                                                        <button class="waves-effect waves-light btn info darken-2" disabled>
                                                            {{ $time }}
                                                        </button>
                                                    @endif
                                                @endforeach
                                            @endif
                        
                                        </div>
                                    @endforeach
                        @else
Login first to reserve an appointment
                        @endauth
                                </div>
                            </div>
                        </div>

                        <div id="service_location" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wh-table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>@changeLang('Service')</th>
                                                    <th>@changeLang('Location')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($services as $service)
                                                    <tr>
                                                        <td>{{ __($service->name) }}</td>
                                                        <td>
                                                            {{ __(str_replace(['.', '"'], [',', ''], $service->location)) }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="experience" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>@php
                                        echo clean($user->experience);
                                    @endphp</p>
                                </div>
                            </div>
                        </div>
                        <div id="qualification" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        @php
                                            
                                            echo clean($user->qualification);
                                        @endphp
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div id="contact" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="item d-flex align-items-center justify-content-center">
                                        <div class="item-content">
                                            <h3>Location</h3>
                                            <p>
                                                {{ @$user->address->address ?? @$user->address->city . ',' . @$user->address->zip . ',' . @$user->address->country }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="item d-flex align-items-center justify-content-center">
                                        <div class="item-content">
                                            <h3>@changeLang('Phone')</h3>
                                            <p>
                                                {{ $user->mobile }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="item d-flex align-items-center justify-content-center">
                                        <div class="item-content">
                                            <h3>@changeLang('Email Address')</h3>
                                            <p>
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tab End-->
                </div>

            </div>
        </div>
    </div>
    <!--Team Detail End-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.timepicker');
            var instances = M.Timepicker.init(elems, {
                twelveHour: false
            });
        });
    </script>

@endsection
