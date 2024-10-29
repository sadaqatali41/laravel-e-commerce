@extends('layouts.app')

@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Account Page</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>                   
                        <li class="active">Account</li>
                    </ol>
                </div>
            </div>
       </div>
    </section>
    <!-- / catg header banner section -->
    <!-- Cart view section -->
    <section id="aa-myaccount">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-myaccount-area">         
                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="aa-myaccount-register">                 
                                    <h4>Register</h4>
                                    <form action="{{ route('user.submit') }}" class="aa-login-form" id="registrationForm">
                                        <label for="name">Name<span>*</span></label>
                                        <input type="text" placeholder="Name" name="name" id="name">

                                        <label for="email">Email<span>*</span></label>
                                        <input type="email" placeholder="Email" name="email" id="email">

                                        <label for="password">Password<span>*</span></label>
                                        <input type="password" placeholder="Password" name="password" id="password">

                                        <label for="mobile">Mobile<span>*</span></label>
                                        <input type="text" placeholder="Mobile No" name="mobile" id="mobile">

                                        <button type="submit" class="aa-browse-btn" id="registrationFormBtn">Register</button>                    
                                    </form>
                                </div>
                            </div>
                        </div>          
                    </div>
                </div>
            </div>
        </div>
    </section>
  <!-- / Cart view section -->
    <!-- / product category -->
@endsection
