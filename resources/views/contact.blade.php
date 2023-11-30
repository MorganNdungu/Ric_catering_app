@extends('layouts.app')

@section('title', 'Contact Us')

@section('page-title')
    Contact Us
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Get in Touch</h2>
                <p class="lead">We would love to hear from you. If you have any questions, inquiries, or if you'd like to discuss a catering service for your upcoming event, please feel free to contact us.</p>
                <p>Use the form below or reach out to us via phone or email. Our team is ready to assist you.</p>
            </div>
            <div class="col-md-6">
                <p class="text-muted">Contact Form Placeholder</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <h2 class="mb-4">Visit Us</h2>
                <p class="lead">You can also visit our office to discuss your requirements in person. Here are our office details:</p>
                <address>
                    <strong>RICHARRY</strong><br>
                    KENYA<br>
                    KIAMBU town<br>
                </address>
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">Connect with Us</h2>
                <p class="lead">Stay connected with us on social media for the latest updates and news:</p>
                <ul class="list-unstyled">
                    <li><i class="fab fa-instagram"></i> <a href="#">Instagram</a></li>
                    <li><i class="fab fa-facebook"></i> <a href="#">Facebook</a></li>
                    <li><i class="fab fa-twitter"></i> <a href="#">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
