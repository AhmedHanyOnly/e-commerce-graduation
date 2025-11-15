@extends('front.layouts.front')
@section('title', 'اتصل بنا')

@section('content')
<section class="main-section section-contact ">
    <div class="container">
        <x-admin-alert />
        <div class="bg-white rounded shadow p-3">
            <div class="form_section mb-4">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="contact-title">
                            <h3 class="main-title">{{ __('Get in touch with us') }}</h3>
                            <p>
                                {{ __('The world\'s leading non-asset-based supply chain management companies, we design and implement a leading industry. We specialize in intelligent and efficient research and believe in business.') }}
                            </p>
                        </div>
                        <div>
                            <form class="form-contact" action="{{route('contact.store')}}" method="post">
                                @csrf
                                <div class="controls">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input id="form_name" type="text" name="name" class="form-control custom-form" placeholder="*@lang("Name")" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input id="form_email" type="email" name="email" class="form-control custom-form" placeholder="*{{ __('E-Mail Address') }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="tel" name="phone" class="form-control custom-form" placeholder="*{{ __('Phone Number') }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea id="form_message" name="message" class="form-control message-form custom-form" placeholder="*{{ __('Message') }}" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-12 btn-send">
                                            <p>
                                                <input type="submit" class="btn btn-washla" value="{{ __('Send Your Message') }}" />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="contact_way">
                <div class="row g-3 ">
                    <div class="col-lg-3">
                        <div class="box-content">
                            <div class="icon_holder">
                                <a href="https://maps.google.com/maps?q={{setting('address') ? setting('address') : __('Saudi Arabia - Riyadh') }}" target="_blank" class="text-light">
                                    <i class="fa-solid fa-location-dot"></i>
                                </a>
                            </div>
                            <p class="mb-0">
                                {{setting('address') ? setting('address') : __('Saudi Arabia - Riyadh')}}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box-content">
                            <div class="icon_holder">
                                <a href="tel:{{ setting('phone') }}" class="text-light">
                                    <i class="fa-solid fa-phone-volume"></i>
                                </a>
                            </div>
                            <p class="mb-0" dir="ltr">
                                {{ setting('phone') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box-content">
                            <div class="icon_holder">
                                <a href="mailto:{{setting('email')}}?subject=Mail from Our Site" class="text-light">
                                    <i class="fa-solid fa-envelope"></i>
                                </a>
                            </div>
                            <p class="mb-0" dir="ltr"> {{ setting('email') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box-content">
                            <div class="icon_holder">
                                <a href="https://wa.me/{{setting('whatsapp')}}" target="_blank" class="text-light">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <p class="mb-0" dir="ltr">{{ setting('whatsapp') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
