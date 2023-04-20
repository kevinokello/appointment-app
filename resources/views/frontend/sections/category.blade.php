@php

    $content = content('category.content');

    $categories = App\Models\Category::whereHas('services',function($q){$q->where('status',1);})->whereHas('services.user')->where('status',1)->latest()->take(6)->get();
    $content = content('banner.content');

$categories = App\Models\Category::where('status', 1)
    ->orderBy('name','ASC')
    ->take(6)
    ->get();
@endphp
<!--Portfolio Start-->
<div class="case-study-home-page case-study-area pt_70 pb_20">
    <div class="container">
        <div class="doc-search-section text-center ml-50">
            <form action="{{route('experts.search')}}" method="get">
                <div class="box box-search">
                    <input type="text" name="search" class="form-control"
                        placeholder="@changeLang('Search by doctor name')">
                </div>
           
                <div class="doc-search-button">
                    <button type="submit" class="btn btn-danger"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
 
    </div>
</div>