@extends('layouts.frontend.app')
@section('Breadcrumb')
  @parent
  <li class="breadcrumb-item active">Contact</li>

@endsection
@section('title')
  Contact-Us
@endsection
@section('body')
  <!-- Breadcrumb Start -->

  <!-- Breadcrumb End -->

  <!-- Contact Start -->
  <div class="contact">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8">
      <div class="contact-form">
        <form method="post" action="{{ route('frontend.contact.store') }}">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-4">
          <input type="text" class="form-control" placeholder="Your Name" name="name" />
          <strong class="text-denger">
            @error('name')
        {{ $message }}
        @enderror</strong>
          </div>
          <div class="form-group col-md-4">
          <input type="email" class="form-control" placeholder="Your Email" name="email" />
          <strong class="text-denger">
            @error('email')
        {{ $message }}
        @enderror</strong>
          </div>
          <div class="form-group col-md-4">
          <input type="text" class="form-control" placeholder="Your Phone" name="phone" />
          <strong class="text-denger">
            @error('phone')
        {{ $message }}
        @enderror</strong>
          </div>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Subject" name="title" />
          <strong class="text-denger">
          @error('title')
        {{ $message }}
      @enderror</strong>
        </div>
        <div class="form-group">
          <textarea class="form-control" rows="5" placeholder="Message" name='body'></textarea>
          <strong class="text-denger">
          @error('body')
        {{ $message }}
      @enderror</strong>
        </div>
        <div>
          <button class="btn" type="submit">Send Message</button>
        </div>
        </form>
      </div>
      </div>
      <div class="col-md-4">
      <div class="contact-info">
        <h3>Get in Touch</h3>
        <p class="mb-4">
        The contact form is currently inactive. Get a functional and
        working contact form with Ajax & PHP in a few minutes. Just copy
        and paste the files, add a little code and you're done.
        </p>
        <h4><i class="fa fa-map-marker"></i>{{ $getsetting->street }}, {{ $getsetting->city }},
        {{ $getsetting->country }}
        </h4>
        <h4><i class="fa fa-envelope"></i>{{ $getsetting->email }}</h4>
        <h4><i class="fa fa-phone"></i>{{ $getsetting->phone }}</h4>
        <div class="social">
        <a href="{{ $getsetting->X }}" title="X" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="{{ $getsetting->facebook }}" title="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="{{ $getsetting->linkedin }}" title="LinkedIn" target="_blank"><i
          class="fab fa-linkedin-in"></i></a>
        <a href="{{ $getsetting->instagram }}" title="Instagram" target="_blank"><i
          class="fab fa-instagram"></i></a>
        <a href="{{ $getsetting->youtube }}" title="Youtube" target="_blank"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- Contact End -->
@endsection