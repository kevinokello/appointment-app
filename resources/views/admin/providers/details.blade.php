  @extends('admin.layout.master')
  @section('breadcrumb')
      <section class="section">
          <div class="section-header">

              <h1>@changeLang('Provider Details')</h1>


          </div>
      </section>
  @endsection
  @section('content')

      <div class="row">

          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                  <div class="card-wrap">
                      <div class="card-header">
                          <h4>@changeLang('Total Bookings')</h4>
                      </div>
                      <div class="card-body">
                        @php
                        $app = DB::table('appointments')->where('b_id', $provider->id)->count();
                    @endphp
                      {{ $app}}

                      </div>
                  </div>
              </div>
          </div>



          <div class="col-md-3">
              <div class="card shadow">
                  <img src="@if ($provider->image) {{ getFile('user', $provider->image) }} @else {{ getFile('logo', $general->default_image) }} @endif" alt="" class="w-100">
                  <div class="container my-3">
                      <h4>{{ __($provider->fullname) }}</h4>
                      <p class="title">{{ __($provider->designation) }}</p>
                      <p class="title">{{ __($provider->email) }}</p>
                  </div>
              </div>
          </div>

          <div class="col-md-9">
              <div class="card">
                  <div class="card-body">
                      <form action="{{ route('admin.provider.update', $provider->id) }}" method="post">
                          @csrf

                          <div class="row">

                              <div class="col-md-6 mb-3">

                                  <label for="">@changeLang('First Name')</label>
                                  <input type="text" name="fname" class="form-control" value="{{ $provider->fname }}">

                              </div>
                              <div class="col-md-6 mb-3">

                                  <label for="">@changeLang('Last Name')</label>
                                  <input type="text" name="lname" class="form-control" value="{{ $provider->lname }}">

                              </div>

                              <div class="form-group col-md-6 mb-3 col-6">
                                  <label>@changeLang('Country')</label>
                                  <input type="text" name="country" class="form-control"
                                      value="{{ @$provider->address->country }}">
                              </div>

                              <div class="col-md-6 mb-3">

                                  <label for="">@changeLang('city')</label>
                                  <input type="text" name="city" class="form-control form_control"
                                      value="{{ @$provider->address->city }}">

                              </div>

                              <div class="col-md-6 mb-3">

                                  <label for="">@changeLang('zip')</label>
                                  <input type="text" name="zip" class="form-control form_control"
                                      value="{{ @$provider->address->zip }}">

                              </div>

                              <div class="col-md-6 mb-3">

                                  <label for="">@changeLang('state')</label>
                                  <input type="text" name="state" class="form-control form_control"
                                      value="{{ @$provider->address->state }}">

                              </div>

                              <div class="col-md-6 mb-3">

                                  <label for="">@changeLang('Status')</label>
                                  <select name="status" id="" class="form-control">

                                      <option value="0" {{ $provider->status == 0 ? 'selected' : '' }}>
                                          @changeLang('Inactive')</option>
                                      <option value="1" {{ $provider->status == 1 ? 'selected' : '' }}>
                                          @changeLang('Active')</option>

                                  </select>

                              </div>

                              <div class="col-md-6 mb-3">

                                  <label for="">@changeLang('Make Featured')</label>
                                  <select name="featured" id="" class="form-control">

                                      <option value="1" {{ $provider->featured == 1 ? 'selected' : '' }}>
                                          @changeLang('Yes')</option>
                                      <option value="0" {{ $provider->featured == 0 ? 'selected' : '' }}>
                                          @changeLang('No')</option>

                                  </select>

                              </div>


                              <div class="col-md-12 mt-4">

                                  <button type="submit" class="btn btn-primary w-100">@changeLang('Update User')</button>

                              </div>




                          </div>
                      </form>

                  </div>

              </div>


          </div>

      </div>

  @endsection


  @push('custom-script')

      <script>
          'use strict'

          $(function() {
            

              $('#country option').each(function(index) {

                  let country = "{{ @$provider->address->country }}"

                  if ($(this).val() == country) {
                      $(this).attr('selected', 'selected')
                  }


              })
          })
      </script>

  @endpush
