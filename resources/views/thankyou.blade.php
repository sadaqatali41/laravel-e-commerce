@extends('layouts.app')

@section('content')
    <!-- Cart view section -->
    <section id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="checkout-area text-center">
                        @if(session()->has('message'))
                            <h2>{{ session('message') }}</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
      </section>
    <!-- / Cart view section -->
@endsection
