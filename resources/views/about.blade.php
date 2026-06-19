@extends('layouts.app')

@section('title', 'About Us - Pandacare')

@section('content')
<style>
    :root {
        --panda-primary: #0057b8;
        --panda-secondary: #00b4d8;
        --panda-dark: #e8f0fe;
        --panda-light: #f5f9ff;
        --panda-accent: #ff6b35;
    }

    /* Futuristic Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    @keyframes glowPulse {
        0% { box-shadow: 0 0 0 0 rgba(0, 180, 216, 0.4); }
        70% { box-shadow: 0 0 0 20px rgba(0, 180, 216, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 180, 216, 0); }
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes rotateSlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Hero Section - Light Version */
    .about-hero {
        position: relative;
        background: linear-gradient(135deg, #e8f0fe 0%, #d4e4fc 50%, #e8f0fe 100%);
        overflow: hidden;
        min-height: 60vh;
        display: flex;
        align-items: center;
    }
    .hero-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    .hero-particle {
        position: absolute;
        background: radial-gradient(circle, rgba(0,180,216,0.15) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }
    .hero-title {
        background: linear-gradient(135deg, #0057b8 0%, #00b4d8 60%, #0057b8 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: scaleIn 0.8s ease;
    }
    .hero-badge {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(0, 87, 184, 0.1);
        border: 1px solid rgba(0, 87, 184, 0.2);
        border-radius: 60px;
        backdrop-filter: blur(10px);
        animation: glowPulse 3s infinite;
        color: #0057b8;
    }

    /* Mission Section */
    .mission-section {
        position: relative;
        background: #ffffff;
    }
    .mission-image-wrapper {
        position: relative;
        border-radius: 32px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
        transition: all 0.5s ease;
    }
    .mission-image-wrapper:hover {
        transform: scale(1.02);
        box-shadow: 0 35px 60px -15px rgba(0,87,184,0.2);
    }
    .mission-image-wrapper img {
        width: 100%;
        height: auto;
        transition: transform 0.7s ease;
    }
    .mission-image-wrapper:hover img {
        transform: scale(1.05);
    }
    .stat-card {
        background: linear-gradient(135deg, #f0f6ff, #ffffff);
        border-radius: 24px;
        padding: 24px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,87,184,0.1);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        border-color: rgba(0,180,216,0.3);
        box-shadow: 0 20px 30px -15px rgba(0,87,184,0.1);
    }
    .stat-number {
        font-size: 2.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0057b8, #00b4d8);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    /* Values Section - Light Version */
    .values-section {
        background: linear-gradient(135deg, #f5f9ff 0%, #e8f0fe 100%);
        position: relative;
    }
    .value-card {
        background: white;
        border-radius: 28px;
        padding: 32px 24px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0,87,184,0.1);
        height: 100%;
        box-shadow: 0 5px 20px rgba(0,0,0,0.02);
    }
    .value-card:hover {
        transform: translateY(-10px);
        border-color: rgba(0,180,216,0.5);
        box-shadow: 0 30px 40px -20px rgba(0,87,184,0.15);
    }
    .value-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #0057b8, #00b4d8);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        transition: all 0.3s ease;
    }
    .value-card:hover .value-icon {
        transform: rotate(10deg) scale(1.05);
        border-radius: 30px;
    }
    .value-icon i {
        font-size: 2.2rem;
        color: white;
    }

    /* Team Section - Light & Bright Version */
    .team-section {
        background: linear-gradient(135deg, #f0f6ff 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }
    .team-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0,180,216,0.08) 0%, transparent 70%);
        border-radius: 50%;
    }
    .team-card {
        background: white;
        border-radius: 32px;
        padding: 32px 24px;
        text-align: center;
        transition: all 0.4s ease;
        border: 1px solid rgba(0,87,184,0.1);
        height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .team-card:hover {
        transform: translateY(-8px);
        border-color: rgba(0,180,216,0.4);
        box-shadow: 0 25px 40px rgba(0,87,184,0.12);
    }
    .team-image {
        width: 160px;
        height: 160px;
        margin: 0 auto 20px;
        position: relative;
    }
    .team-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 10px 25px rgba(0,87,184,0.15);
        transition: all 0.3s ease;
    }
    .team-card:hover .team-image img {
        transform: scale(1.05);
        box-shadow: 0 15px 30px rgba(0,87,184,0.25);
        border-color: #00b4d8;
    }
    .team-social {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 20px;
    }
    .team-social a {
        width: 36px;
        height: 36px;
        background: #f0f6ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0057b8;
        transition: all 0.3s ease;
    }
    .team-social a:hover {
        background: linear-gradient(135deg, #0057b8, #00b4d8);
        color: white;
        transform: translateY(-3px);
    }
    .team-card h4 {
        color: #0a0e27;
    }
    .team-card .small {
        color: #64748b !important;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #0057b8, #00b4d8);
        position: relative;
        overflow: hidden;
    }
    .cta-glow {
        position: absolute;
        top: -50%;
        left: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
        border-radius: 50%;
        animation: rotateSlow 20s linear infinite;
    }
    .btn-cta {
        background: white;
        color: #0057b8;
        padding: 16px 40px;
        border-radius: 60px;
        font-weight: 800;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }
    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        gap: 16px;
        color: #0057b8;
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="hero-particles">
        @for($i = 1; $i <= 8; $i++)
            <div class="hero-particle" style="width: {{ rand(100, 300) }}px; height: {{ rand(100, 300) }}px; top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 5) }}s; opacity: {{ rand(30, 60) / 100 }};"></div>
        @endfor
    </div>
    <div class="container py-5">
        <div class="text-center" style="position: relative; z-index: 2;">
            <div class="hero-badge mb-4" data-aos="fade-up">
                <i class="fas fa-panda me-2"></i> Welcome to Pandacare
            </div>
            <h1 class="display-3 fw-bold mb-4 hero-title" data-aos="fade-up" data-aos-delay="100">
                Your Complete Healthcare<br>Companion
            </h1>
            <p class="lead text-secondary mb-0" data-aos="fade-up" data-aos-delay="200" style="max-width: 600px; margin: 0 auto;">
                Transforming healthcare delivery across Nigeria with technology and compassion
            </p>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="mission-section py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="hero-badge mb-3" style="background: rgba(0,87,184,0.1); color: #0057b8;">Our Mission</span>
                <h2 class="display-5 fw-bold mb-4" style="color: #0a0e27;">Making Quality Healthcare Accessible to Every Nigerian</h2>
                <p class="lead mb-4" style="color: #334155;">At Pandacare, we believe that everyone deserves access to quality healthcare regardless of their location or circumstances.</p>
                <p class="mb-3" style="color: #475569;">Our platform connects patients with verified medical professionals, ensuring that help is always just a tap away. We're committed to leveraging technology to bridge the gap between healthcare providers and patients, making medical care more efficient, transparent, and patient-centered.</p>
                <div class="row mt-5 g-3">
                    <div class="col-sm-6">
                        <div class="stat-card">
                            <div class="stat-number">500+</div>
                            <div class="text-muted">Healthcare Providers</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="stat-card">
                            <div class="stat-number">10K+</div>
                            <div class="text-muted">Happy Patients</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="mission-image-wrapper">
                    <img src="{{ asset('images/sen.jpg') }}" alt="Healthcare professionals" class="img-fluid">
                </div>
            </div>
        </div>     
    </div>
</section>

<!-- Values Section -->
<section class="values-section py-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="hero-badge mb-3" style="background: rgba(0,87,184,0.1); color: #0057b8;">Core Principles</span>
            <h2 class="display-5 fw-bold mb-3" style="color: #0a0e27;">What Drives Us</h2>
            <p class="lead text-muted">The values that guide everything we do at Pandacare</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4 class="h4 fw-bold mb-3">Compassion</h4>
                    <p class="text-muted mb-0">We care deeply about every patient's well-being and treat everyone with dignity and respect.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="h4 fw-bold mb-3">Integrity</h4>
                    <p class="text-muted mb-0">We operate with complete transparency, honesty, and ethical standards in all we do.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4 class="h4 fw-bold mb-3">Excellence</h4>
                    <p class="text-muted mb-0">We strive for the highest quality in every interaction, service, and solution we provide.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h4 class="h4 fw-bold mb-3">Innovation</h4>
                    <p class="text-muted mb-0">We embrace cutting-edge technology to continuously improve healthcare delivery.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section - Light & Bright -->
<section class="team-section py-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="hero-badge mb-3" style="background: rgba(0,87,184,0.1); color: #0057b8;">Meet The Team</span>
            <h2 class="display-5 fw-bold mb-3" style="color: #0a0e27;">Dedicated Professionals</h2>
            <p class="lead text-muted">Committed to revolutionizing healthcare in Nigeria</p>
        </div>
        
        <div class="row g-4">
            <!-- Team Member 1 - Dr. Anumiri Chidozie -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/team/ceo.jpg') }}" alt="Dr. Anumiri Chidozie">
                    </div>
                    <h4 class="h5 fw-bold mb-1">Dr. Anumiri Chidozie</h4>
                    <p class="text-primary mb-2">Founder & CEO</p>
                    <p class="small text-muted">Leading healthcare innovation with 15+ years of experience in medical administration.</p>
                    <div class="team-social">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 2 - Dr Collins Ebogbue -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/team/2F4A0882-240x300.jpg') }}" alt="Dr Collins Ebogbue">
                    </div>
                    <h4 class="h5 fw-bold mb-1">Dr Collins Ebogbue</h4>
                    <p class="text-primary mb-2">Chief Technology Officer</p>
                    <p class="small text-muted">Tech visionary building scalable healthcare solutions for millions.</p>
                    <div class="team-social">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 3 - Dr Samuel Oputeh -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/team/2F4A0902-236x300.jpg') }}" alt="Dr Samuel Oputeh">
                    </div>
                    <h4 class="h5 fw-bold mb-1">Dr Samuel Oputeh</h4>
                    <p class="text-primary mb-2">Medical Director</p>
                    <p class="small text-muted">Ensuring clinical excellence and patient safety across all services.</p>
                    <div class="team-social">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 4 - Anayo Madueke -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/team/2F4A0876a-240x300.jpg') }}" alt="Anayo Madueke">
                    </div>
                    <h4 class="h5 fw-bold mb-1">Anayo Madueke</h4>
                    <p class="text-primary mb-2">Head of Operations</p>
                    <p class="small text-muted">Streamlining healthcare delivery across all 36 states of Nigeria.</p>
                    <div class="team-social">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="cta-glow"></div>
    <div class="container py-5 text-center" style="position: relative; z-index: 2;">
        <h2 class="display-5 fw-bold text-white mb-4" data-aos="fade-up">Join the Pandacare Family Today</h2>
        <p class="lead text-white-50 mb-4" data-aos="fade-up" data-aos-delay="100" style="max-width: 600px; margin: 0 auto 30px;">
            Experience healthcare reimagined. Download our app and start your journey to better health.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="fade-up" data-aos-delay="200">
            <a href="https://apps.apple.com/ng/app/pandacare-app/id6755859705" class="btn-cta">
                <i class="fab fa-apple fa-2x"></i>
                <span>App Store</span>
            </a>
            <a href="https://play.google.com/store/apps/details?id=app.pandacare.com" class="btn-cta" style="background: #0057b8; color: white;">
                <i class="fab fa-google-play fa-2x"></i>
                <span>Google Play</span>
            </a>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Additional responsive styles */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        .display-5 {
            font-size: 1.8rem;
        }
        .value-icon {
            width: 70px;
            height: 70px;
        }
        .team-image {
            width: 120px;
            height: 120px;
        }
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #e8f0fe;
    }
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #0057b8, #00b4d8);
        border-radius: 4px;
    }
</style>
@endpush
@endsection