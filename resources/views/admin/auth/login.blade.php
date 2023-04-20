@extends('frontend.layout.frontend')
@section('breadcumb')

@php

    $content = content('breadcrumb.content');

@endphp

@endsection
@section('content')

    
    <div class="container padding-top-bottom-50">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-body">


                        <form action="{{route('admin.login')}}" method="POST">

                            @csrf
                            <div class="row justify-content-center">



                                <div class="form-group col-md-12">

                                    <label for="">@changeLang('Email Address') <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control">

                                </div>

                                <div class="form-group col-md-12">

                                    <label for="">@changeLang('Password') <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control">

                                </div>

                           

                                <div class="col-md-12">

                            <button type="submit" id="recaptcha" class="btn  btn-base ">@changeLang('Login Now')</button>
                                </div>

                       



                            </div>


                        </form>


                    </div>



                </div>


            </div>



        </div>


    </div>


@endsection

@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =  "<span class='text-danger'>@changeLang('Captcha field is required.')</span>";
                return false;
            }
            return true;
        }
        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
