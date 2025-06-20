@extends('layouts.frontend.app')
@section('title')
    Notifications
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('layouts.frontend.sidebar')


        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('frontend.dashboard.notification.deleteAll') }}" style="margin-left:270px "
                            class="btn btn-sm btn-danger">Delete All</a>
                    </div>

                </div>
                @forelse (auth()->user()->notifications as $notification)

                    <a href="{{ $notification->data['link'] }}?notify={{ $notification->id }}">
                        <div class="notification alert alert-warning">
                            <strong>You have a notification form: {{ $notification->data['username'] }}</strong>
                            Info!{{ substr($notification->data['post_title'], 0, 9) }}
                            <div class="float-right">
                                <button
                                    onclick="if(confirm('are You shure you want delete?')){document.getElementById('deleteForm').submit()}return false"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </a>
                    <form method="post" id="deleteForm" action="{{ route('frontend.dashboard.notification.delete') }}">@csrf
                        <input hidden name="notify_id" value="{{ $notification->id }}">
                    </form>
                @empty
                    <div class="alert alert-danger">No notifications</div>

                @endforelse

            </div>
        </div>
    </div>
    <!-- Dashboard End-->

@endsection