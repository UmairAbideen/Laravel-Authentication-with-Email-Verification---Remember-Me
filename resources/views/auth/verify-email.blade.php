@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded">
                    <div class="card-body text-center">

                        <h3 class="mb-4">Email Verification Required</h3>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success" role="alert">
                                ✅ A new verification link has been sent to your email address.
                            </div>
                        @endif

                        <p class="mb-3">
                            We've sent an email verification link to your registered email address.<br>
                            Please check your inbox and click the link to verify your account.
                        </p>

                        <p>If you didn’t receive the email, you can request another one:</p>

                        @if (!Auth::user()->hasVerifiedEmail())
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    Resend Verification Email
                                </button>
                            </form>
                        @else
                            <div class="alert alert-warning mt-3">
                                Your email is already verified. No need to resend the verification email.
                            </div>
                        @endif


                        <hr class="my-4">

                        <p>Want to logout and register again?</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
