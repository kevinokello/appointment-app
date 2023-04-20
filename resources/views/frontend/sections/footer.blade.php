@php
    $footer = content('footer.content');

    $about = content('about.content');

    $categories = App\Models\Category::where('status',1)->latest()->take(4)->get();

    $policies = element('policy.element');

    $contact = content('contact.content');

    $socials = element('social.element');
   
@endphp

<!--Footer Start-->
<div class="main-footer">
   

    <div class="footer-copyrignt">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright-text">
                        <p>{{__(@$footer->data->copyright)}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-social">
                        @foreach ($socials as $social )
                            <a href="{{@$social->data->socail_link}}"><i class="{{@$social->data->social_icon}}"></i></a>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Footer End-->

<!--Scroll-Top-->
<div class="scroll-top">
    <i class="fa fa-angle-up"></i>
</div>
<!--Scroll-Top-->
