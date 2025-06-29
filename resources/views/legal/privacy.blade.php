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
        <h1 class="legal-header">Privacy Policy</h1>
        
        <div class="legal-content">
            <p><strong>Last updated:</strong> June 29, 2025</p>
            
            <h2>1. Information We Collect</h2>
            <p>We collect information you provide directly to us, such as when you create an account, place an order, or contact us for support. This may include:</p>
            <ul>
                <li>Name, email address, and contact information</li>
                <li>Shipping and billing addresses</li>
                <li>Payment information</li>
                <li>Order history and preferences</li>
                <li>Profile information and pet details</li>
            </ul>
            
            <h2>2. How We Use Your Information</h2>
            <p>We use the information we collect to:</p>
            <ul>
                <li>Process and fulfill your orders</li>
                <li>Provide customer support</li>
                <li>Send order confirmations and updates</li>
                <li>Improve our services and user experience</li>
                <li>Send marketing communications (with your consent)</li>
                <li>Comply with legal obligations</li>
            </ul>
            
            <h2>3. Information Sharing</h2>
            <p>We do not sell, trade, or otherwise transfer your personal information to third parties except in the following circumstances:</p>
            <ul>
                <li>With your explicit consent</li>
                <li>To process payments (payment processors)</li>
                <li>To fulfill orders (shipping partners)</li>
                <li>To comply with legal requirements</li>
                <li>To protect our rights and safety</li>
            </ul>
            
            <h2>4. Data Security</h2>
            <p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.</p>
            
            <h2>5. Cookies and Tracking</h2>
            <p>We use cookies and similar technologies to enhance your browsing experience, analyze site traffic, and understand where our visitors are coming from. You can control cookie settings through your browser preferences.</p>
            
            <h2>6. Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access your personal information</li>
                <li>Update or correct your information</li>
                <li>Request deletion of your account</li>
                <li>Opt-out of marketing communications</li>
                <li>Request data portability</li>
            </ul>
            
            <h2>7. Data Retention</h2>
            <p>We retain your personal information for as long as necessary to provide our services, comply with legal obligations, resolve disputes, and enforce our agreements.</p>
            
            <h2>8. Children's Privacy</h2>
            <p>Our services are not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13.</p>
            
            <h2>9. International Transfers</h2>
            <p>Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place to protect your information.</p>
            
            <h2>10. Changes to This Policy</h2>
            <p>We may update this privacy policy from time to time. We will notify you of any material changes by posting the new policy on this page and updating the "Last updated" date.</p>
            
            <h2>11. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us at:</p>
            <ul>
                <li>Email: privacy@solipet.com</li>
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