@extends('layouts.header-nologin')

@section('content')
<style>
    main {
        display: flex;
        justify-content: center;
        background: url("assets/transparent-logo.png");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: left top;
    }
    
    .legal-container {
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 2rem 0;
    }

    .legal-card {
        background: #77401E;
        color: white;
        width: 80%;
        max-width: 800px;
        border-radius: 1.5em;
        padding: 2rem;
        margin: 0 auto;
    }

    .legal-header {
        font-family: "Irish Grover", sans-serif;
        font-size: 2.5em;
        text-align: center;
        color: #E8C7AA;
        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        margin-bottom: 2rem;
    }

    .legal-content {
        font-family: "Manrope", sans-serif;
        line-height: 1.6;
        font-size: 1.1em;
    }

    .legal-content h2 {
        color: #E8C7AA;
        font-size: 1.5em;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .legal-content h3 {
        color: #FFE1C8;
        font-size: 1.2em;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        font-weight: bold;
    }

    .legal-content p {
        margin-bottom: 1rem;
        text-align: justify;
    }

    .legal-content ul {
        margin-bottom: 1rem;
        padding-left: 2rem;
    }

    .legal-content li {
        margin-bottom: 0.5rem;
    }

    .back-btn {
        background-color: #FFE1C8;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border: none;
        padding: 1rem 2rem;
        border-radius: 0.5em;
        color: #522222;
        font-weight: 700;
        font-size: 1.2em;
        font-family: "Irish Grover", sans-serif;
        text-decoration: none;
        display: inline-block;
        margin-top: 2rem;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background-color: #E8C7AA;
        color: #77401E;
        text-decoration: none;
    }

    .btn-container {
        text-align: center;
    }

    @media screen and (max-width: 768px) {
        .legal-card {
            width: 95%;
            padding: 1rem;
        }
        
        .legal-header {
            font-size: 2em;
        }
        
        .legal-content {
            font-size: 1em;
        }
    }
</style>

<div class="container legal-container">
    <div class="legal-card">
        <h1 class="legal-header">Terms of Service</h1>
        
        <div class="legal-content">
            <p><strong>Last updated:</strong> June 29, 2025</p>
            
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing and using Solipet's website and services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>
            
            <h2>2. Description of Service</h2>
            <p>Solipet is an online pet supplies store that provides various pet products including food, toys, accessories, and other pet-related items. We offer delivery and pickup services for your convenience.</p>
            
            <h2>3. User Accounts</h2>
            <p>When you create an account with us, you must provide information that is accurate, complete, and current at all times. You are responsible for safeguarding the password and for all activities that occur under your account.</p>
            
            <h2>4. Product Information</h2>
            <p>We strive to provide accurate product descriptions and images. However, we do not warrant that product descriptions or other content is accurate, complete, reliable, current, or error-free.</p>
            
            <h2>5. Pricing and Payment</h2>
            <p>All prices are subject to change without notice. Payment must be made at the time of order placement. We accept various payment methods as indicated on our website.</p>
            
            <h2>6. Shipping and Delivery</h2>
            <p>We offer both delivery and pickup options. Delivery times may vary based on location and product availability. Risk of loss and title for items pass to you upon delivery.</p>
            
            <h2>7. Returns and Refunds</h2>
            <p>We accept returns within 30 days of purchase for unused items in original packaging. Refunds will be processed according to our return policy.</p>
            
            <h2>8. Prohibited Uses</h2>
            <p>You may not use our service for any unlawful purpose or to solicit others to perform unlawful acts. You may not violate any international, federal, provincial, or state regulations, rules, laws, or local ordinances.</p>
            
            <h2>9. Intellectual Property</h2>
            <p>The service and its original content, features, and functionality are and will remain the exclusive property of Solipet and its licensors.</p>
            
            <h2>10. Limitation of Liability</h2>
            <p>In no event shall Solipet, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages.</p>
            
            <h2>11. Changes to Terms</h2>
            <p>We reserve the right to modify or replace these terms at any time. If a revision is material, we will provide at least 30 days notice prior to any new terms taking effect.</p>
            
            <h2>12. Contact Information</h2>
            <p>If you have any questions about these Terms of Service, please contact us at:</p>
            <ul>
                <li>Email: support@solipet.com</li>
                <li>Phone: +63 912 345 6789</li>
                <li>Address: 123 Pet Street, Manila, Philippines</li>
            </ul>
        </div>
        
        <div class="btn-container">
            <a href="{{ route('register') }}" class="back-btn">Go Back to Registration</a>
        </div>
    </div>
</div>
@endsection 