@extends('layouts.app')

@section('title', 'Pandacare - Your Complete Healthcare Companion')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>

/* ════════════════════════════════════════════════════════
   GLOBAL TYPOGRAPHY & TOKENS
════════════════════════════════════════════════════════ */
:root {
    --pc-blue:        #0057b8;
    --pc-blue-dark:   #003f8a;
    --pc-blue-light:  #e8f1fc;
    --pc-sky:         #00b4d8;
    --pc-white:       #ffffff;
    --pc-ink:         #0d1b2a;
    --pc-muted:       #64748b;
    --pc-surface:     #f8faff;
    --pc-border:      rgba(0,87,184,.10);
    --pc-radius:      20px;
    --pc-shadow:      0 8px 40px rgba(0,87,184,.12);
    --pc-shadow-sm:   0 2px 12px rgba(0,87,184,.08);
    --font-display:   'Playfair Display', Georgia, serif;
    --font-body:      'DM Sans', system-ui, sans-serif;
}

body { font-family: var(--font-body); }

/* Section heading pattern */
.pch-tag {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--pc-blue-light);
    color: var(--pc-blue);
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    padding: .35rem 1rem;
    border-radius: 50px;
    margin-bottom: 1rem;
}
.pch-tag--light {
    background: rgba(255,255,255,.15);
    color: #fff;
}
.pch-title {
    font-family: var(--font-display);
    font-size: clamp(1.9rem, 3vw, 2.7rem);
    font-weight: 800;
    color: var(--pc-ink);
    line-height: 1.18;
}
.pch-title--white { color: #fff; }
.pch-sub {
    font-size: 1.05rem;
    color: var(--pc-muted);
    max-width: 560px;
    margin: .75rem auto 0;
}
.pch-sub--light { color: rgba(255,255,255,.75); }

/* ════════════════════════════════════════════════════════
   HERO SECTION
════════════════════════════════════════════════════════ */
.pc-hero {
    background: #f8f9fa; /* or whatever your background color is */
}

.pc-hero__imgwrap {
    height: 6px;           /* Adjust this value if you want it even taller */
    min-height: 5px;
}

.pc-hero__img--lg {
    max-height: 10%;
    transition: transform 0.4s ease;
}

.pc-hero__img--lg:hover {
    transform: scale(1.01);   /* subtle zoom on hover for extra "wow" */
}

.pc-hero__imgglow {
    position: absolute;
    top: -30px;
    left: -30px;
    right: -30px;
    bottom: -30px;
    background: radial-gradient(circle, rgba(0,123,255,0.15) 0%, transparent 70%);
    z-index: -1;
    border-radius: 30px;
}

/* Make sure the row takes good height on large screens */
@media (min-width: 120px) {
    .pc-hero__row {
        min-height: 70px;
    }
}

/* ════════════════════════════════════════════════════════
   HERO BUTTONS — Blue
════════════════════════════════════════════════════════ */
.pc-btn--blue {
    background: var(--pc-blue);
    color: #fff !important;
    border: 2px solid var(--pc-blue);
    padding: .8rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-family: var(--font-body);
    transition: background .25s, box-shadow .25s, transform .2s;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    box-shadow: 0 4px 18px rgba(0,87,184,.30);
}
.pc-btn--blue:hover {
    background: var(--pc-blue-dark);
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,87,184,.40);
}
.pc-btn--blue-outline {
    background: transparent;
    color: var(--pc-blue) !important;
    border: 2px solid var(--pc-blue);
    padding: .8rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-family: var(--font-body);
    transition: background .25s, color .25s, transform .2s;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}
.pc-btn--blue-outline:hover {
    background: var(--pc-blue);
    color: #fff !important;
    transform: translateY(-2px);
}

/* ════════════════════════════════════════════════════════
   SERVICES — WordPress full-width container
════════════════════════════════════════════════════════ */
.pc-services-wp {
    position: relative;
    background: linear-gradient(160deg, #e8f3ff 0%, #f0f7ff 50%, #e0eeff 100%);
    padding: 0;
}
.pc-services-wp__wave-top,
.pc-services-wp__wave-bottom {
    display: block;
    line-height: 0;
    overflow: hidden;
}
.pc-services-wp__wave-top svg,
.pc-services-wp__wave-bottom svg {
    display: block;
    width: 100%;
    height: 70px;
}
.pc-services-wp__inner { padding: 5rem 0; }

/* Service card — premium redesign */
.pch-svc-card {
    background: #fff;
    border-radius: var(--pc-radius);
    padding: 2.2rem 1.8rem;
    border: 1px solid var(--pc-border);
    box-shadow: var(--pc-shadow-sm);
    transition: transform .3s ease, box-shadow .3s ease, border-color .3s;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.pch-svc-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(0,87,184,.04) 0%, transparent 60%);
    opacity: 0;
    transition: opacity .3s;
}
.pch-svc-card:hover { transform: translateY(-6px); box-shadow: var(--pc-shadow); border-color: rgba(0,87,184,.25); }
.pch-svc-card:hover::before { opacity: 1; }

.pch-svc-card__num {
    font-family: var(--font-display);
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--pc-blue-light);
    line-height: 1;
    position: absolute;
    top: 1rem;
    right: 1.2rem;
    transition: color .3s;
}
.pch-svc-card:hover .pch-svc-card__num { color: rgba(0,87,184,.12); }

.pch-svc-card__iconring {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    background: linear-gradient(135deg, var(--pc-blue-light), #d6eaff);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.4rem;
    transition: background .3s, transform .3s;
}
.pch-svc-card:hover .pch-svc-card__iconring {
    background: linear-gradient(135deg, var(--pc-blue), var(--pc-sky));
    transform: rotate(-6deg) scale(1.08);
}
.pch-svc-card__iconring i {
    font-size: 1.5rem;
    color: var(--pc-blue);
    transition: color .3s;
}
.pch-svc-card:hover .pch-svc-card__iconring i { color: #fff; }

.pch-svc-card__name {
    font-family: var(--font-display);
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--pc-ink);
    margin-bottom: .6rem;
}
.pch-svc-card__desc {
    font-size: .92rem;
    color: var(--pc-muted);
    line-height: 1.65;
    flex: 1;
}
.pch-svc-card__link {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    color: var(--pc-blue);
    font-weight: 600;
    font-size: .88rem;
    text-decoration: none;
    margin-top: 1.2rem;
    transition: gap .2s;
}
.pch-svc-card__link:hover { gap: .7rem; }

/* ════════════════════════════════════════════════════════
   FEATURES SECTION (Why Us)
════════════════════════════════════════════════════════ */
.pc-features {
    position: relative;
    background: linear-gradient(135deg, #0d1b2a 0%, #1a2f3f 100%);
    padding: 5rem 0;
    overflow: hidden;
}
.pc-features__bg {
    position: absolute;
    inset: 0;
    overflow: hidden;
}
.blob--f1 {
    width: 400px;
    height: 400px;
    background: rgba(0,87,184,0.15);
    top: -150px;
    right: -100px;
    filter: blur(80px);
}
.blob--f2 {
    width: 350px;
    height: 350px;
    background: rgba(0,180,216,0.1);
    bottom: -100px;
    left: -80px;
    filter: blur(80px);
}
.pc-features__dots {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 30px 30px;
}
.pc-feat-card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 24px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
}
.pc-feat-card:hover {
    transform: translateY(-8px);
    background: rgba(255,255,255,0.12);
    border-color: rgba(255,255,255,0.25);
}
.pc-feat-card__ring {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--pc-blue), var(--pc-sky));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}
.pc-feat-card__ring i {
    font-size: 2rem;
    color: #fff;
}
.pc-feat-card__title {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.75rem;
}
.pc-feat-card__text {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.7);
    line-height: 1.6;
}

/* ════════════════════════════════════════════════════════
   ABOUT SECTION
════════════════════════════════════════════════════════ */
.pc-about {
    padding: 5rem 0;
    background: var(--pc-surface);
}
.pc-about__inner {
    max-width: 1200px;
    margin: 0 auto;
}
.pc-about__lead {
    font-size: 1.1rem;
    color: var(--pc-ink);
    font-weight: 500;
}
.pc-about__body {
    color: var(--pc-muted);
    line-height: 1.7;
}
.pc-btn--dark {
    background: var(--pc-blue);
    color: #fff;
    padding: 0.8rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}
.pc-btn--dark:hover {
    background: var(--pc-blue-dark);
    transform: translateY(-2px);
    color: #fff;
}
.pc-about__badge {
    background: linear-gradient(135deg, #fff 0%, #f8faff 100%);
    backdrop-filter: blur(8px);
    padding: 1rem 1.8rem;
    border-radius: 60px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    border: 1px solid rgba(0,87,184,.2);
    display: flex;
    align-items: center;
    gap: 1rem;
    z-index: 5;
    transition: transform .3s ease;
}
.pc-about__badge:hover { transform: scale(1.05); }
.pc-about__badge-lbl {
    font-size: .75rem;
    text-transform: uppercase;
    letter-spacing: .1em;
    font-weight: 600;
    color: var(--pc-muted);
}
.pc-about__badge-val {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 800;
    color: var(--pc-blue);
    line-height: 1.2;
}

/* ════════════════════════════════════════════════════════
   TEAM SECTION
════════════════════════════════════════════════════════ */
.pc-team-moved {
    background: var(--pc-surface);
    padding: 5rem 0;
}
.pc-team-card {
    background: #fff;
    border-radius: 28px;
    overflow: hidden;
    transition: all .3s cubic-bezier(0.2, 0, 0, 1);
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid var(--pc-border);
    text-align: center;
}
.pc-team-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,87,184,0.12);
    border-color: rgba(0,87,184,0.2);
}
.pc-team-card__imgwrap {
    position: relative;
    overflow: hidden;
    aspect-ratio: 1 / 1;
    background: #f0f4fa;
}
.pc-team-card__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .5s ease;
}
.pc-team-card:hover .pc-team-card__img { transform: scale(1.05); }
.pc-team-card__overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,87,184,.75);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    opacity: 0;
    transition: opacity .3s;
}
.pc-team-card:hover .pc-team-card__overlay { opacity: 1; }
.pc-team-card__social {
    width: 38px;
    height: 38px;
    background: #fff;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--pc-blue);
    font-size: 1rem;
    transition: transform .2s, background .2s;
}
.pc-team-card__social:hover {
    transform: scale(1.1);
    background: var(--pc-blue-dark);
    color: #fff;
}
.pc-team-card__body {
    padding: 1.5rem 1rem;
}
.pc-team-card__name {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 800;
    margin-bottom: .3rem;
}
.pc-team-card__role {
    font-size: .8rem;
    color: var(--pc-muted);
    letter-spacing: .02em;
}

/* ════════════════════════════════════════════════════════
   CEO / FOUNDER — Premium section
════════════════════════════════════════════════════════ */
.pch-ceo {
    background: var(--pc-surface);
    padding: 6rem 0;
}
.pch-ceo__wrap {
    background: #fff;
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 16px 64px rgba(0,87,184,.13);
    border: 1px solid var(--pc-border);
    display: grid;
    grid-template-columns: 380px 1fr;
}

/* Left image panel */
.pch-ceo__imgpanel {
    position: relative;
    background: linear-gradient(160deg, var(--pc-blue) 0%, #003380 100%);
    padding: 3rem 2.5rem 4rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    min-height: 520px;
    overflow: hidden;
}
.pch-ceo__imgpanel::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.pch-ceo__circle {
    width: 260px;
    height: 260px;
    border-radius: 50%;
    border: 4px solid rgba(255,255,255,.25);
    overflow: hidden;
    position: relative;
    z-index: 2;
    margin-bottom: 1.5rem;
    box-shadow: 0 0 0 12px rgba(255,255,255,.08);
}
.pch-ceo__photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
}
.pch-ceo__nameplate {
    text-align: center;
    position: relative;
    z-index: 2;
}
.pch-ceo__fullname {
    font-family: var(--font-display);
    font-size: 1.4rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: .2rem;
}
.pch-ceo__jobtitle {
    font-size: .82rem;
    color: rgba(255,255,255,.7);
    font-weight: 500;
    letter-spacing: .06em;
    text-transform: uppercase;
}
.pch-ceo__ribbon {
    position: absolute;
    top: 2rem;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255,255,255,.15);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.25);
    color: #fff;
    padding: .35rem 1rem;
    border-radius: 50px;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    white-space: nowrap;
    z-index: 3;
}
.pch-ceo__deco-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,.05);
}
.pch-ceo__deco-circle--1 { width: 300px; height: 300px; bottom: -100px; left: -80px; }
.pch-ceo__deco-circle--2 { width: 180px; height: 180px; top: -40px; right: -50px; }

/* Right content panel */
.pch-ceo__content {
    padding: 3.5rem 3.5rem 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.pch-ceo__openquote {
    font-family: var(--font-display);
    font-size: 8rem;
    line-height: .6;
    color: var(--pc-blue);
    opacity: .12;
    margin-bottom: -.5rem;
    display: block;
}
.pch-ceo__quote {
    font-family: var(--font-display);
    font-size: 1.15rem;
    font-weight: 400;
    font-style: italic;
    line-height: 1.9;
    color: #3a4a5c;
    border: none;
    padding: 0;
    margin: .5rem 0 2rem;
}
.pch-ceo__divider {
    width: 48px;
    height: 3px;
    background: linear-gradient(90deg, var(--pc-blue), var(--pc-sky));
    border-radius: 2px;
    margin-bottom: 1.8rem;
}
.pch-ceo__sig-row {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}
.pch-ceo__sig-img {
    max-height: 55px;
    width: auto;
    opacity: .85;
    filter: brightness(0) saturate(100%) invert(21%) sepia(67%) saturate(1200%) hue-rotate(200deg);
}
.pch-ceo__sig-text {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 700;
    color: var(--pc-ink);
}
.pch-ceo__sig-role {
    font-size: .8rem;
    color: var(--pc-muted);
    font-weight: 400;
}

/* ════════════════════════════════════════════════════════
   TESTIMONIALS
════════════════════════════════════════════════════════ */
.pch-testi {
    background: linear-gradient(160deg, #0d1b2a 0%, #0a2a4a 100%);
    padding: 6rem 0;
    position: relative;
    overflow: hidden;
}
.pch-testi::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Ccircle cx='40' cy='40' r='1' fill='%230057b8' fill-opacity='.18'/%3E%3C/g%3E%3C/svg%3E");
}
.pch-testi__blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
}
.pch-testi__blob--1 {
    width: 400px; height: 400px;
    background: rgba(0,87,184,.25);
    top: -100px; left: -100px;
}
.pch-testi__blob--2 {
    width: 300px; height: 300px;
    background: rgba(0,180,216,.15);
    bottom: -60px; right: -60px;
}
.pch-testi-card {
    background: rgba(255,255,255,.06);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 24px;
    padding: 2.2rem 2rem;
    height: 100%;
    transition: background .3s, transform .3s, box-shadow .3s;
    position: relative;
}
.pch-testi-card:hover {
    background: rgba(255,255,255,.10);
    transform: translateY(-4px);
    box-shadow: 0 16px 48px rgba(0,0,0,.3);
}
.pch-testi-card__stars {
    display: flex;
    gap: .2rem;
    margin-bottom: 1rem;
}
.pch-testi-card__stars i { color: #f59e0b; font-size: .85rem; }
.pch-testi-card__quote {
    font-size: .97rem;
    line-height: 1.75;
    color: rgba(255,255,255,.85);
    font-style: italic;
    margin-bottom: 1.5rem;
    flex: 1;
}
.pch-testi-card__person {
    display: flex;
    align-items: center;
    gap: .9rem;
    border-top: 1px solid rgba(255,255,255,.1);
    padding-top: 1.2rem;
}
.pch-testi-card__avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255,255,255,.2);
    flex-shrink: 0;
}
.pch-testi-card__name {
    font-weight: 700;
    font-size: .95rem;
    color: #fff;
    line-height: 1.2;
}
.pch-testi-card__location {
    font-size: .8rem;
    color: rgba(255,255,255,.5);
}
.pch-testi-card__bigquote {
    position: absolute;
    top: 1.2rem;
    right: 1.5rem;
    font-family: var(--font-display);
    font-size: 4rem;
    line-height: 1;
    color: var(--pc-blue);
    opacity: .25;
    pointer-events: none;
}

/* ════════════════════════════════════════════════════════
   PANDACARE NEWS SECTION (Clickable Cards)
════════════════════════════════════════════════════════ */
.pc-panda-news {
    background: var(--pc-surface);
    padding: 5rem 0;
}
.panda-news-card {
    background: #fff;
    border-radius: 28px;
    overflow: hidden;
    transition: all .3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    height: 100%;
    cursor: pointer;
    border: 1px solid var(--pc-border);
}
.panda-news-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,87,184,0.12);
    border-color: rgba(0,87,184,0.3);
}
.panda-news-card__img {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    transition: transform .4s;
}
.panda-news-card:hover .panda-news-card__img { transform: scale(1.03); }
.panda-news-card__content {
    padding: 1.5rem;
}
.panda-news-card__badge {
    display: inline-block;
    background: var(--pc-blue-light);
    color: var(--pc-blue);
    font-size: .7rem;
    font-weight: 700;
    padding: .2rem .8rem;
    border-radius: 50px;
    margin-bottom: .75rem;
}
.panda-news-card__title {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 800;
    margin-bottom: .5rem;
    line-height: 1.4;
}
.panda-news-card__excerpt {
    color: var(--pc-muted);
    font-size: .9rem;
    line-height: 1.5;
}
.panda-news-card__link {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: var(--pc-blue);
    font-weight: 600;
    margin-top: 1rem;
    text-decoration: none;
    font-size: .85rem;
    transition: gap .2s;
}
.panda-news-card__link:hover { gap: .8rem; }

/* ════════════════════════════════════════════════════════
   FINAL CTA SECTION
════════════════════════════════════════════════════════ */
.pc-cta {
    position: relative;
    background: linear-gradient(135deg, var(--pc-blue) 0%, var(--pc-sky) 100%);
    padding: 5rem 0;
    overflow: hidden;
}
.pc-cta__blobs {
    position: absolute;
    inset: 0;
    overflow: hidden;
}
.blob--ca1 {
    width: 500px;
    height: 500px;
    background: rgba(255,255,255,0.1);
    top: -200px;
    right: -100px;
    filter: blur(80px);
}
.blob--ca2 {
    width: 400px;
    height: 400px;
    background: rgba(255,255,255,0.08);
    bottom: -150px;
    left: -80px;
    filter: blur(80px);
}
.pc-cta__pill {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #fff;
}
.pc-cta__title {
    font-family: var(--font-display);
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 800;
    color: #fff;
}
.pc-cta__sub {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.9);
}
.pc-btn--solid {
    background: #fff;
    color: var(--pc-blue) !important;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}
.pc-btn--solid:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    color: var(--pc-blue-dark) !important;
}
.pc-btn--ghost {
    background: transparent;
    color: #fff !important;
    border: 2px solid #fff;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}
.pc-btn--ghost:hover {
    background: #fff;
    color: var(--pc-blue) !important;
    transform: translateY(-3px);
}

/* ════════════════════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════════════════════ */
@media (max-width: 991px) {
    .pch-ceo__wrap { grid-template-columns: 1fr; }
    .pch-ceo__imgpanel { min-height: 360px; padding: 2.5rem 2rem 3rem; }
    .pch-ceo__circle { width: 200px; height: 200px; }
    .pch-ceo__content { padding: 2.5rem 2rem; }
    .pc-hero__stats { justify-content: center; }
}
@media (max-width: 575px) {
    .pch-ceo__content { padding: 2rem 1.5rem; }
    .pch-ceo__quote { font-size: 1rem; }
    .pc-hero__stats { gap: 1rem; }
    .pc-stat__num { font-size: 1.2rem; }
}
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════════ --}}
<section class="pc-hero">
    <div class="pc-hero__blobs" aria-hidden="true">
        <div class="blob blob--1"></div>
        <div class="blob blob--2"></div>
        <div class="blob blob--3"></div>
    </div>

    <div class="container-fluid position-relative px-lg-5">
        <div class="row align-items-center pc-hero__row g-4" style="min-height: 650px;"> <!-- Increased min-height for more vertical space -->
            
            <!-- Left content column -->
            <div class="col-lg-4 col-xl-3 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="pc-hero__badge mb-3">
                    <span class="pc-hero__badge-dot"></span>
                    Trusted by over 10,000 Nigerians
                </div>
                
                <h1 class="pc-hero__title mb-3">
                    In Pandacare, <span class="text-primary">Our Priority</span>
                    <span class="pc-hero__title-wave">Anytime. Anywhere.</span>
                </h1>
                
                <p class="pc-hero__lead mb-4">
                    Quality healthcare in the palm of your hand. Talk to doctors, get home care, emergency help, and more.
                </p>
                
                <div class="d-flex gap-3 flex-wrap">
                  
                    <a href="#services" class="btn btn-outline-primary btn-lg px-5 py-3 rounded-pill">
                        <i class="fas fa-arrow-down me-2"></i>See What We Offer
                    </a>
                </div>

                <div class="pc-hero__stats mt-5">
                    <div class="pc-stat">
                        <span class="pc-stat__num text-primary">10K+</span>
                        <span class="pc-stat__lbl">Active Users</span>
                    </div>
                    <div class="pc-stat__div"></div>
                    <div class="pc-stat">
                        <span class="pc-stat__num text-primary">24/7</span>
                        <span class="pc-stat__lbl">Support</span>
                    </div>
                    <div class="pc-stat__div"></div>
                    <div class="pc-stat">
                        <span class="pc-stat__num text-primary">100%</span>
                        <span class="pc-stat__lbl">Verified Doctors</span>
                    </div>
                </div>
            </div>

            <!-- Right image column - now bigger -->
            <div class="col-lg-8 col-xl-9" data-aos="fade-left">
                <div class="pc-hero__imgwrap h-100">
                    <div class="pc-hero__imgglow"></div>
                    <div class="position-relative h-100">
                        <img src="{{ asset('images/istockphoto.jpg') }}" 
                             alt="Doctor consulting patient"
                             class="pc-hero__img pc-hero__img--lg img-fluid w-100 h-100"
                             style="object-fit: cover; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     SERVICES — WordPress full-width coloured container
══════════════════════════════════════════════════════════ --}}
<section id="services" class="pc-services-wp">

    <div class="pc-services-wp__wave-top" aria-hidden="true">
        <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,35 C480,70 960,0 1440,35 L1440,0 L0,0 Z" fill="#ffffff"/>
        </svg>
    </div>

    <div class="pc-services-wp__inner">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="pch-tag">
                    <i class="fas fa-plus-circle"></i> What We Offer
                </div>
                <h2 class="pch-title">Healthcare Services<br><em>That Actually Care</em></h2>
                <p class="pch-sub">From virtual consultations to emergency response — we've got you covered</p>
            </div>

            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
                        <!-- Make the entire card clickable by wrapping with an anchor tag -->
                        <a href="{{ route('service.detail', $service->slug) }}" class="pch-svc-card-link" style="text-decoration: none; display: block; height: 100%;">
                            <div class="pch-svc-card">
                                <span class="pch-svc-card__num">0{{ $loop->iteration }}</span>
                                <div class="pch-svc-card__iconring">
                                    <i class="fas {{ $service->icon }}"></i>
                                </div>
                                <h3 class="pch-svc-card__name">{{ $service->name }}</h3>
                                <p class="pch-svc-card__desc">{{ $service->short_description }}</p>
                                <div class="pch-svc-card__link">
                                    Learn More <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     WHY US (FEATURES)
══════════════════════════════════════════════════════════ --}}
<section class="pc-features pc-section">
    <div class="pc-features__bg" aria-hidden="true">
        <div class="blob blob--f1"></div>
        <div class="blob blob--f2"></div>
        <div class="pc-features__dots"></div>
    </div>
    <div class="container position-relative">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="pch-tag pch-tag--light"><i class="fas fa-shield-alt"></i> Why Pandacare</div>
            <h2 class="pch-title pch-title--white">Why Thousands of Nigerians<br>Trust Us</h2>
            <p class="pch-sub pch-sub--light">Because your health deserves better than "good enough"</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up">
                <div class="pc-feat-card">
                    <div class="pc-feat-card__ring"><i class="fas fa-user-check"></i></div>
                    <h4 class="pc-feat-card__title">Verified Professionals</h4>
                    <p class="pc-feat-card__text">Every doctor and nurse is licensed and carefully vetted.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="pc-feat-card">
                    <div class="pc-feat-card__ring"><i class="fas fa-clock"></i></div>
                    <h4 class="pc-feat-card__title">24/7 Availability</h4>
                    <p class="pc-feat-card__text">Emergency help or quick advice — we're always here when you need us.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="pc-feat-card">
                    <div class="pc-feat-card__ring"><i class="fas fa-naira-sign"></i></div>
                    <h4 class="pc-feat-card__title">Transparent Pricing</h4>
                    <p class="pc-feat-card__text">No surprises. You know exactly what you're paying for.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="pc-feat-card">
                    <div class="pc-feat-card__ring"><i class="fas fa-lock"></i></div>
                    <h4 class="pc-feat-card__title">Secure &amp; Private</h4>
                    <p class="pc-feat-card__text">Your health information is encrypted and treated with utmost respect.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     ABOUT with LARGER IMAGE & AWARD BADGE
════════════════════════════════════════════════════════ --}}
<section class="pc-about pc-section">
    <div class="container">
        <div class="pc-about__inner">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="pc-about__imgwrap" style="display: flex; justify-content: center;">
                        <div style="position: relative; max-width: 600px; width: 100%;">
                            <img src="{{ asset('images/sen.jpg') }}"
                                 alt="The Pandacare team"
                                 style="width: 100%; height: auto; border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                            
                            <div class="pc-about__badge" style="position: absolute; bottom: -20px; right: -10px; background: white; border-radius: 60px; padding: 0.8rem 1.5rem; box-shadow: 0 12px 28px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 0.8rem;">
                                <i class="fas fa-award text-warning" style="font-size: 2rem;"></i>
                                <div>
                                    <div class="pc-about__badge-lbl" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">Award Winning</div>
                                    <div class="pc-about__badge-val" style="font-size: 1rem; font-weight: 800; color: var(--pc-blue);">Healthcare App 2024</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="pch-tag mb-3"><i class="fas fa-heart"></i> Our Story</div>
                    <h2 class="pch-title mb-4">About Pandacare</h2>
                    <p class="pc-about__lead mb-4">
                        Making quality healthcare simple, affordable, and accessible for every Nigerian.
                    </p>
                    <p class="pc-about__body mb-5">
                        We started with one belief: no one should struggle to see a doctor.
                        Pandacare connects you with trusted medical professionals — whether you need
                        a quick consultation from home or urgent ambulance service.
                    </p>
                    <a href="{{ route('about') }}" class="pc-btn pc-btn--dark">
                        Learn Our Story <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     TEAM SECTION
══════════════════════════════════════════════════════════ --}}
<section class="pc-team-moved">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="pch-tag"><i class="fas fa-users"></i> The People Behind It</div>
            <h2 class="pch-title">Meet Our Team</h2>
            <p class="pch-sub">Real people, real passion for your health</p>
        </div>

        @php
            $teamMembers = [
                [
                    'name'     => 'Dr. Anumiri Chidozie',
                    'role'     => 'Founder, Pandacare Ceo',
                    'img'      => 'team/ceo.jpg',
                    'linkedin' => '#',
                    'twitter'  => '#',
                ],
                [
                    'name'     => 'Dr Collins Ebogbue',
                    'role'     => 'Co Founder',
                    'img'      => 'team/2F4A0882-240x300.jpg',
                    'linkedin' => '#',
                    'twitter'  => '#',
                ],
                [
                    'name'     => 'Dr Samuel Oputeh',
                    'role'     => 'Co founder',
                    'img'      => 'team/2F4A0902-236x300.jpg',
                    'linkedin' => '#',
                    'twitter'  => '#',
                ],
                [
                    'name'     => 'Madueke Anayo',
                    'role'     => 'Digital lead',
                    'img'      => 'team/2F4A0876a-240x300.jpg',
                    'linkedin' => '#',
                    'twitter'  => '#',
                ],
            ];
        @endphp

        <div class="row g-4 justify-content-center">
            @foreach($teamMembers as $i => $member)
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="pc-team-card">
                        <div class="pc-team-card__imgwrap">
                            <img src="{{ asset('images/' . $member['img']) }}"
                                 alt="{{ $member['name'] }}"
                                 class="pc-team-card__img"
                                 onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($member['name']) }}&size=300&background=0057b8&color=fff&bold=true'">
                            <div class="pc-team-card__overlay">
                                <a href="{{ $member['linkedin'] }}" class="pc-team-card__social" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="{{ $member['twitter'] }}" class="pc-team-card__social" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                        <div class="pc-team-card__body">
                            <h4 class="pc-team-card__name">{{ $member['name'] }}</h4>
                            <p class="pc-team-card__role">{{ $member['role'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     CEO / FOUNDER — Premium split layout with image
══════════════════════════════════════════════════════════ --}}
<section class="pch-ceo">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="pch-tag"><i class="fas fa-user-tie"></i> Leadership</div>
            <h2 class="pch-title">A Word From Our Founder</h2>
            <p class="pch-sub">The vision and heart behind Pandacare</p>
        </div>

        @php
            $ceoName    = isset($ceo) ? $ceo->name    : 'Dr. Anumiri Chidozie';
            $ceoRole    = isset($ceo) ? $ceo->role    : 'Founder &amp; Chief Executive Officer';
            $ceoMessage = isset($ceo) ? $ceo->message : 'We built Pandacare because we believe every Nigerian deserves access to quality, affordable healthcare — not just those in Lagos or Abuja, but every person in every corner of this great nation. Our mission is to remove every barrier between you and the doctor you need. Whether it is 2 AM or a public holiday, Pandacare is here. I am proud of what our team has built, and more importantly, I am proud of the thousands of lives we have touched.';
        @endphp

        <div class="pch-ceo__wrap" data-aos="fade-up" data-aos-delay="100">

            <div class="pch-ceo__imgpanel">
                <div class="pch-ceo__deco-circle pch-ceo__deco-circle--1"></div>
                <div class="pch-ceo__deco-circle pch-ceo__deco-circle--2"></div>
                <div class="pch-ceo__ribbon">
                    <i class="fas fa-star me-1" style="color:#f59e0b"></i> Founder &amp; CEO
                </div>
                <div class="pch-ceo__circle">
                    <img src="{{ asset('images/ceo.jpg') }}"
                         alt="CEO of Pandacare"
                         class="pch-ceo__photo"
                         onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=CEO&size=500&background=003f8a&color=fff&bold=true'">
                </div>
                <div class="pch-ceo__nameplate">
                    <div class="pch-ceo__fullname">{{ $ceoName }}</div>
                    <div class="pch-ceo__jobtitle">Founder &amp; CEO, Pandacare</div>
                </div>
            </div>

            <div class="pch-ceo__content">
                <span class="pch-ceo__openquote">&ldquo;</span>
                <blockquote class="pch-ceo__quote">
                    {!! $ceoMessage !!}
                </blockquote>
                <div class="pch-ceo__divider"></div>
                <div class="pch-ceo__sig-row">
                    <img src="{{ asset('images/ceo-signature.png') }}"
                         alt="Signature of {{ $ceoName }}"
                         class="pch-ceo__sig-img"
                         onerror="this.style.display='none'">
                    <div>
                        <div class="pch-ceo__sig-text">{{ $ceoName }}</div>
                        <div class="pch-ceo__sig-role">{!! $ceoRole !!}, Pandacare</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     TESTIMONIALS
════════════════════════════════════════════════════════ --}}
<section class="pch-testi">
    <div class="pch-testi__blob pch-testi__blob--1"></div>
    <div class="pch-testi__blob pch-testi__blob--2"></div>

    <div class="container position-relative">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="pch-tag pch-tag--light"><i class="fas fa-comment-medical"></i> Patient Stories</div>
            <h2 class="pch-title pch-title--white">What Our Patients Say</h2>
            <p class="pch-sub pch-sub--light">Real stories from real Nigerians whose lives Pandacare has touched</p>
        </div>

        @php
            $testimonials = [
                [
                    'quote'    => 'I had a fever at 1 AM and could not find a hospital. I opened Pandacare, spoke with a doctor in 5 minutes, got a prescription and felt better by morning. This app literally saved my night.',
                    'name'     => 'Amaka Osei',
                    'location' => 'Lagos, Nigeria',
                    'avatar'   => 'https://i.pravatar.cc/150?img=47',
                    'stars'    => 5,
                ],
                [
                    'quote'    => 'The home care nurse Pandacare sent to my mother was professional, kind and on time. I was worried because she is elderly and I was travelling, but Pandacare gave me complete peace of mind.',
                    'name'     => 'Tunde Fashola',
                    'location' => 'Abuja, Nigeria',
                    'avatar'   => 'https://i.pravatar.cc/150?img=12',
                    'stars'    => 5,
                ],
                [
                    'quote'    => 'I used to drive 45 minutes to see my doctor for a simple consultation. With Pandacare I book a video call during my lunch break and I am done in 20 minutes. A complete game changer.',
                    'name'     => 'Chidinma Eze',
                    'location' => 'Enugu, Nigeria',
                    'avatar'   => 'https://i.pravatar.cc/150?img=32',
                    'stars'    => 5,
                ],
                [
                    'quote'    => 'The ambulance arrived within 12 minutes when my husband had a cardiac episode. The paramedics were trained and calm. I am convinced Pandacare saved his life that evening.',
                    'name'     => 'Fatima Bello',
                    'location' => 'Kano, Nigeria',
                    'avatar'   => 'https://i.pravatar.cc/150?img=25',
                    'stars'    => 5,
                ],
                [
                    'quote'    => 'I travel a lot for work so I need healthcare I can trust anywhere. Pandacare connects me with verified doctors no matter what city I am in. The pricing is fair and transparent too.',
                    'name'     => 'Emeka Nwosu',
                    'location' => 'Port Harcourt, Nigeria',
                    'avatar'   => 'https://i.pravatar.cc/150?img=8',
                    'stars'    => 5,
                ],
                [
                    'quote'    => 'My daughter had a rash and I was terrified. I uploaded photos and a dermatologist reviewed them and responded within the hour. Diagnosis was spot on. Excellent, fast and affordable service.',
                    'name'     => 'Grace Adeyemi',
                    'location' => 'Ibadan, Nigeria',
                    'avatar'   => 'https://i.pravatar.cc/150?img=44',
                    'stars'    => 5,
                ],
            ];
        @endphp

        <div class="row g-4">
            @foreach($testimonials as $i => $t)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 100 }}">
                    <div class="pch-testi-card d-flex flex-column">
                        <span class="pch-testi-card__bigquote">&rdquo;</span>
                        <div class="pch-testi-card__stars">
                            @for($s = 0; $s < $t['stars']; $s++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p class="pch-testi-card__quote flex-grow-1">&ldquo;{{ $t['quote'] }}&rdquo;</p>
                        <div class="pch-testi-card__person">
                            <img src="{{ $t['avatar'] }}"
                                 alt="{{ $t['name'] }}"
                                 class="pch-testi-card__avatar"
                                 onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ rawurlencode($t['name']) }}&size=96&background=0057b8&color=fff&bold=true'">
                            <div>
                                <div class="pch-testi-card__name">{{ $t['name'] }}</div>
                                <div class="pch-testi-card__location">
                                    <i class="fas fa-map-marker-alt me-1" style="color:#0057b8;font-size:.7rem"></i>{{ $t['location'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     PANDACARE NEWS (Clickable Cards)
════════════════════════════════════════════════════════ --}}
<section class="pc-panda-news">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="pch-tag"><i class="fas fa-newspaper"></i> Pandacare Updates</div>
            <h2 class="pch-title">Pandacare News & Stories</h2>
            <p class="pch-sub">Click any card to watch, read, or explore the latest from Pandacare</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                <div class="panda-news-card" onclick="window.location.href='{{ route('news.detail', 'pandacare-launches-247-ambulance-service') }}'">
                    <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?w=600&q=80" alt="Ambulance service" class="panda-news-card__img">
                    <div class="panda-news-card__content">
                        <span class="panda-news-card__badge"><i class="fas fa-video me-1"></i> Watch</span>
                        <h3 class="panda-news-card__title">Pandacare Launches 24/7 Ambulance Service in Lagos</h3>
                        <p class="panda-news-card__excerpt">Emergency response just got faster. See how our new fleet is saving lives.</p>
                        <div class="panda-news-card__link">Watch now <i class="fas fa-play-circle"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="panda-news-card" onclick="window.location.href='{{ route('news.detail', 'pandacare-receives-award-2024') }}'">
                    <img src="https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=600&q=80" alt="Award ceremony" class="panda-news-card__img">
                    <div class="panda-news-card__content">
                        <span class="panda-news-card__badge"><i class="fas fa-award me-1"></i> Read</span>
                        <h3 class="panda-news-card__title">Pandacare Wins "Best Healthcare App 2024"</h3>
                        <p class="panda-news-card__excerpt">We're honored to be recognized. Read our CEO's acceptance speech.</p>
                        <div class="panda-news-card__link">Read article <i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="panda-news-card" onclick="window.location.href='{{ route('news.detail', 'telemedicine-tips-from-pandacare-doctors') }}'">
                    <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&q=80" alt="Doctor consulting" class="panda-news-card__img">
                    <div class="panda-news-card__content">
                        <span class="panda-news-card__badge"><i class="fas fa-stethoscope me-1"></i> Tips</span>
                        <h3 class="panda-news-card__title">5 Telemedicine Tips from Pandacare Doctors</h3>
                        <p class="panda-news-card__excerpt">Get the most out of your virtual visit with these expert recommendations.</p>
                        <div class="panda-news-card__link">Read now <i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="panda-news-card" onclick="window.location.href='{{ route('news.detail', 'pandacare-partners-with-ncdc') }}'">
                    <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=600&q=80" alt="Partnership" class="panda-news-card__img">
                    <div class="panda-news-card__content">
                        <span class="panda-news-card__badge"><i class="fas fa-handshake me-1"></i> Announcement</span>
                        <h3 class="panda-news-card__title">Pandacare Partners with NCDC for Public Health Alerts</h3>
                        <p class="panda-news-card__excerpt">Stay informed with real‑time health alerts directly in the app.</p>
                        <div class="panda-news-card__link">Read more <i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                <div class="panda-news-card" onclick="window.location.href='{{ route('news.detail', 'patient-story-mother-and-child') }}'">
                    <img src="https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?w=600&q=80" alt="Mother and child" class="panda-news-card__img">
                    <div class="panda-news-card__content">
                        <span class="panda-news-card__badge"><i class="fas fa-heart me-1"></i> Story</span>
                        <h3 class="panda-news-card__title">Patient Story: How Pandacare Helped a Mother in Labour</h3>
                        <p class="panda-news-card__excerpt">A real‑life account of emergency care that made all the difference.</p>
                        <div class="panda-news-card__link">Watch video <i class="fas fa-play-circle"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                <div class="panda-news-card" onclick="window.location.href='{{ route('news.detail', 'pandacare-app-update-october') }}'">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=600&q=80" alt="App update" class="panda-news-card__img">
                    <div class="panda-news-card__content">
                        <span class="panda-news-card__badge"><i class="fas fa-mobile-alt me-1"></i> Update</span>
                        <h3 class="panda-news-card__title">What's New: Pandacare App Update (October 2024)</h3>
                        <p class="panda-news-card__excerpt">Explore the latest features, including prescription renewal and health tracking.</p>
                        <div class="panda-news-card__link">Read release notes <i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('news') }}" class="pc-btn pc-btn--blue">
                View All Pandacare News <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     FINAL CTA
════════════════════════════════════════════════════════ --}}
<section class="pc-cta">
    <div class="pc-cta__blobs" aria-hidden="true">
        <div class="blob blob--ca1"></div>
        <div class="blob blob--ca2"></div>
        <div class="pc-features__dots"></div>
    </div>
    <div class="container position-relative text-center" data-aos="fade-up">
        <div class="pc-cta__pill mb-4">🚀 Ready when you are</div>
        <h2 class="pc-cta__title mb-3">Start Your Health Journey Today</h2>
        <p class="pc-cta__sub mb-5">Download Pandacare and get quality care in minutes</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="https://play.google.com/store/apps/details?id=app.pandacare.com"
               class="pc-btn pc-btn--solid" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-google-play me-2"></i> Get on Android
            </a>
            <a href="https://apps.apple.com/ng/app/pandacare-app/id6755859705"
               class="pc-btn pc-btn--ghost" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-apple me-2"></i> Get on iOS
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    });
</script>
@endpush