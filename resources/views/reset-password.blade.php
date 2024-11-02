@extends('layouts.app')

@section('content')
    <!-- Cart view section -->
    <section id="aa-myaccount">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-myaccount-area">         
                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="aa-myaccount-register">                 
                                    <h4>Password Reset</h4>
                                    <form action="{{ route('user.password.update') }}" class="aa-login-form" id="resetPasswordForm">
                                        <label for="password">Password<span>*</span></label>
                                        <input type="password" placeholder="Password" name="password" id="password_reset">

                                        <input type="hidden" name="token" value="{{ request()->token }}">
                                        <input type="hidden" name="email" value="{{ request()->email }}">

                                        <label for="password_confirmation">Confirm Password<span>*</span></label>
                                        <input type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation_reset">

                                        <button type="submit" class="aa-browse-btn" id="resetPasswordFormBtn">Submit</button>                    
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
