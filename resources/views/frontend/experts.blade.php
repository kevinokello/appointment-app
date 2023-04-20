@extends('frontend.layout.frontend')

@section('content')


@push('seo')
        <meta name='description' content="{{@$general->seo_description}}">
@endpush


    <!--Service Start-->
    <div class="team-page pt_30 pb_60">
        <div class="container">
            <div class="row justify-content-center">

                @forelse ($experts as $expert)
                    <div class="col-lg-3 col-md-4 col-12 mt_30">
                        <div class="team-item">
                            <div class="team-photo">
                                <img src="@if ($expert->image) {{ asset('uploads/users/' . $expert->image) }} @else {{ asset('assets/img/user.jpg') }} @endif" alt="image">
                            </div>
                            <div class="team-text">
                                <a
                                    href="{{ route('service.provider.details', $expert->slug) }}">{{ __(ucwords($expert->fullname)) }}</a>
                                <p>{{ $expert->designation }}</p>
                            </div>
                        
                        </div>
                    </div>
                @empty

                            <div class="col-12 col-md-6 col-sm-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div class="empty-state" data-height="400">
                                            <div class="empty-state-icon">
                                                <i class="far fa-sad-tear"></i>
                                            </div>
                                            <h2>@changeLang('Sorry We could not find any data')</h2>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
              

                @endforelse

            </div>
        </div>
    </div>
    <!--Service End-->

@endsection


@push('custom-css')

    <style>
        .empty-state {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
        }

        .empty-state .empty-state-icon {
            position: relative;
            background-color: #ca9520;
            width: 80px;
            height: 80px;
            line-height: 100px;
            border-radius: 5px;
        }

        .empty-state .empty-state-icon i {
            font-size: 40px;
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .empty-state h2 {
            font-size: 20px;
            margin-top: 30px;
        }

        .empty-state p {
            font-size: 16px;
        }

    </style>

@endpush
