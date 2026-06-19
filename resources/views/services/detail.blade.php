@extends('layouts.app')

@section('title', $service->name . ' | Pandacare')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
:root {
    --bg:        #f4f7fb;
    --bg-card:   #ffffff;
    --bg-dark:   #0e1422;
    --ink:       #111827;
    --ink-2:     #374151;
    --ink-3:     #6b7280;
    --border:    #e5eaf2;
    --sky:       #0ea5e9;
    --sky-light: #e0f4fd;
    --cobalt:    #1d4ed8;
    --mint:      #10b981;
    --mint-light:#d1fae5;
    --warn:      #f59e0b;
    --purple:    #8b5cf6;
    --purple-light:#ede9fe;
    --orange:    #f97316;
    --orange-light:#ffedd5;
    --red:       #ef4444;
    --red-light: #fee2e2;
    --font:      'Sora', sans-serif;
    --serif:     'Lora', serif;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { background: var(--bg); }
.sdp { font-family: var(--font); color: var(--ink); background: var(--bg); }

/* ── Sticky bar ──────────────────────────────── */
.sticky-bar {
    position: fixed; top: 0; left: 0; right: 0; z-index: 999;
    background: rgba(255,255,255,0.94);
    backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--border);
    padding: 10px 0;
    transform: translateY(-100%); transition: transform 0.3s ease;
}
.sticky-bar.visible { transform: translateY(0); }
.sticky-bar-inner {
    max-width: 1100px; margin: 0 auto; padding: 0 20px;
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
}
.sticky-service-name {
    font-weight: 700; font-size: 0.9rem; color: var(--ink);
    display: flex; align-items: center; gap: 10px;
}
.sticky-service-name span { font-size: 0.75rem; color: var(--ink-3); font-weight: 400; }
.stars-row { display: flex; gap: 2px; color: var(--warn); font-size: 0.78rem; }

/* ── Page wrap ───────────────────────────────── */
.sdp-wrap { max-width: 1100px; margin: 0 auto; padding: 22px 20px 0; }

/* ── Breadcrumb ──────────────────────────────── */
.breadcrumb-row {
    display: flex; align-items: center; gap: 6px;
    font-size: 0.75rem; color: var(--ink-3); margin-bottom: 16px;
}
.breadcrumb-row a { color: var(--sky); text-decoration: none; }
.breadcrumb-row a:hover { text-decoration: underline; }

/* ── Hero row ────────────────────────────────── */
.hero-row {
    display: grid; grid-template-columns: 1fr auto;
    gap: 20px; align-items: flex-start;
    padding: 20px 22px; background: var(--bg-card);
    border: 1px solid var(--border); border-radius: 14px; margin-bottom: 12px;
}
.hero-left { display: flex; gap: 14px; align-items: flex-start; }
.hero-icon {
    width: 54px; height: 54px;
    background: linear-gradient(135deg, var(--cobalt), var(--sky));
    border-radius: 13px; display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.4rem; flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(29,78,216,0.22);
}
.hero-badge {
    display: inline-flex; align-items: center; gap: 5px;
    background: var(--mint-light); color: var(--mint);
    font-size: 0.68rem; font-weight: 600; letter-spacing: 0.05em;
    text-transform: uppercase; padding: 3px 9px; border-radius: 20px; margin-bottom: 5px;
}
.hero-badge::before {
    content: ''; width: 5px; height: 5px; background: var(--mint); border-radius: 50%;
    animation: pulse-dot 1.8s ease-in-out infinite;
}
@keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.3;transform:scale(0.6)} }
.hero-title {
    font-family: var(--serif); font-size: clamp(1.35rem, 2.5vw, 1.75rem);
    font-weight: 600; color: var(--ink); line-height: 1.2; margin-bottom: 5px;
}
.hero-sub { font-size: 0.88rem; color: var(--ink-3); line-height: 1.6; max-width: 500px; font-weight: 400; }
.hero-meta { display: flex; align-items: center; gap: 10px; margin-top: 8px; flex-wrap: wrap; }
.rating-txt { font-size: 0.77rem; color: var(--ink-3); }
.hero-pill {
    font-size: 0.72rem; color: var(--ink-3); background: var(--bg);
    border: 1px solid var(--border); padding: 2px 9px; border-radius: 20px;
    display: inline-flex; align-items: center; gap: 4px;
}
.hero-pill i { color: var(--sky); font-size: 0.65rem; }
.hero-cta-side { display: flex; flex-direction: column; align-items: flex-end; gap: 7px; min-width: 140px; }
.price-tag { font-size: 0.7rem; color: var(--ink-3); text-align: right; }
.price-tag strong { display: block; font-family: var(--serif); font-size: 1.3rem; color: var(--ink); font-weight: 600; line-height: 1; }
.btn-book-now {
    background: linear-gradient(135deg, var(--cobalt), var(--sky));
    color: white; padding: 10px 22px; border-radius: 9px; border: none;
    font-weight: 700; font-size: 0.85rem; cursor: pointer; font-family: var(--font);
    transition: all 0.22s; white-space: nowrap;
    display: flex; align-items: center; gap: 7px;
    box-shadow: 0 3px 14px rgba(29,78,216,0.28);
    width: 100%; justify-content: center;
}
.btn-book-now:hover { transform: translateY(-1px); box-shadow: 0 5px 18px rgba(29,78,216,0.36); }
.btn-book-now i { transition: transform 0.22s; font-size: 0.75rem; }
.btn-book-now:hover i { transform: translateX(3px); }
.guarantee-note { font-size: 0.68rem; color: var(--ink-3); text-align: center; display: flex; align-items: center; gap: 3px; }
.guarantee-note i { color: var(--mint); }

/* ── Info strip ──────────────────────────────── */
.info-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-bottom: 12px; }
.info-tile {
    background: var(--bg-card); border: 1px solid var(--border); border-radius: 11px;
    padding: 12px 14px; display: flex; gap: 10px; align-items: center; transition: border-color 0.2s;
}
.info-tile:hover { border-color: var(--sky); }
.info-tile-icon {
    width: 32px; height: 32px; background: var(--sky-light); border-radius: 8px;
    display: flex; align-items: center; justify-content: center; color: var(--cobalt); font-size: 0.82rem; flex-shrink: 0;
}
.info-tile-label { font-size: 0.67rem; color: var(--ink-3); margin-bottom: 1px; }
.info-tile-val { font-size: 0.83rem; font-weight: 600; color: var(--ink); }

/* ── Two-column layout ───────────────────────── */
.main-cols { display: grid; grid-template-columns: 1fr 284px; gap: 12px; align-items: flex-start; margin-bottom: 14px; }

/* ── Gallery ─────────────────────────────────── */
.gallery-block {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; overflow: hidden; margin-bottom: 10px;
}
.gallery-grid {
    display: grid; grid-template-columns: 2fr 1fr;
    grid-template-rows: 170px 110px; gap: 2px;
}
.g-item { overflow: hidden; position: relative; cursor: pointer; background: #dde3ed; }
.g-item:first-child { grid-row: 1/3; }
.g-item img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease, filter 0.25s; filter: brightness(0.97); }
.g-item:hover img { transform: scale(1.05); filter: brightness(1.03); }
.g-expand {
    position: absolute; bottom: 7px; right: 8px; width: 25px; height: 25px;
    background: rgba(0,0,0,0.5); border-radius: 5px;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 0.6rem; opacity: 0; transition: opacity 0.2s;
}
.g-item:hover .g-expand { opacity: 1; }
.gallery-counter {
    padding: 8px 12px; font-size: 0.72rem; color: var(--ink-3);
    border-top: 1px solid var(--border); display: flex; align-items: center; gap: 5px;
}

/* ── Cards shared ────────────────────────────── */
.content-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; padding: 18px 20px; margin-bottom: 10px;
}
.card-heading {
    font-size: 0.92rem; font-weight: 700; color: var(--ink);
    margin-bottom: 12px; display: flex; align-items: center; gap: 7px;
}
.card-heading i { color: var(--sky); font-size: 0.8rem; }
.content-card p { font-size: 0.88rem; line-height: 1.75; color: var(--ink-2); }

/* ── Benefits ────────────────────────────────── */
.benefits-list { display: grid; grid-template-columns: 1fr 1fr; gap: 7px; }
.benefit-item {
    display: flex; gap: 9px; align-items: flex-start;
    padding: 9px 11px; background: var(--bg); border-radius: 9px;
    border: 1px solid transparent; transition: border-color 0.2s, background 0.2s;
}
.benefit-item:hover { border-color: var(--sky); background: var(--sky-light); }
.benefit-check {
    width: 18px; height: 18px; background: var(--mint-light); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--mint); font-size: 0.55rem; flex-shrink: 0; margin-top: 1px;
}
.benefit-item p { font-size: 0.82rem; color: var(--ink-2); line-height: 1.5; margin: 0; }

/* ── Steps ───────────────────────────────────── */
.steps-list { display: flex; flex-direction: column; }
.step-row { display: flex; gap: 12px; align-items: flex-start; position: relative; }
.step-line {
    position: absolute; left: 15px; top: 32px; bottom: -8px;
    width: 2px; background: linear-gradient(180deg, var(--sky), transparent);
}
.step-dot {
    width: 30px; height: 30px; background: linear-gradient(135deg, var(--cobalt), var(--sky));
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    color: white; font-size: 0.72rem; font-weight: 700; flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(29,78,216,0.28); position: relative; z-index: 1;
}
.step-body { padding: 4px 0 18px; }
.step-body h4 { font-size: 0.87rem; font-weight: 600; color: var(--ink); margin-bottom: 2px; }
.step-body p  { font-size: 0.8rem; color: var(--ink-3); line-height: 1.55; }

/* ── Reviews ─────────────────────────────────── */
.reviews-header { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 14px; }
.big-rating { font-family: var(--serif); font-size: 2.4rem; font-weight: 600; color: var(--ink); line-height: 1; }
.rating-breakdown { flex: 1; }
.bar-row { display: flex; align-items: center; gap: 6px; font-size: 0.7rem; color: var(--ink-3); margin-bottom: 3px; }
.bar-track { flex: 1; height: 4px; background: var(--border); border-radius: 4px; overflow: hidden; }
.bar-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg, var(--warn), #fbbf24); }
.review-cards { display: flex; flex-direction: column; gap: 8px; }
.review-item { padding: 11px 13px; background: var(--bg); border-radius: 9px; border: 1px solid var(--border); }
.review-top { display: flex; align-items: center; gap: 7px; margin-bottom: 5px; }
.review-avatar {
    width: 26px; height: 26px; border-radius: 50%;
    background: linear-gradient(135deg, var(--cobalt), var(--sky));
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 0.6rem; font-weight: 700; flex-shrink: 0;
}
.review-name { font-size: 0.8rem; font-weight: 600; color: var(--ink); }
.review-date { font-size: 0.68rem; color: var(--ink-3); margin-left: auto; }
.review-stars { color: var(--warn); font-size: 0.68rem; }
.review-text { font-size: 0.8rem; color: var(--ink-2); line-height: 1.55; margin-top: 4px; }

/* ── Sidebar ─────────────────────────────────── */
.sidebar { display: flex; flex-direction: column; gap: 10px; }
.sidebar-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px; padding: 16px; }

.stat-row-s { display: flex; align-items: center; justify-content: space-between; padding-bottom: 11px; border-bottom: 1px solid var(--border); margin-bottom: 0; }
.stat-row-s:last-child { border-bottom: none; padding-bottom: 0; }
.stat-rows-list { display: flex; flex-direction: column; gap: 11px; }
.stat-label-s { font-size: 0.72rem; color: var(--ink-3); }
.stat-val-s { font-family: var(--serif); font-size: 1.2rem; font-weight: 600; color: var(--ink); }
.stat-bar { height: 4px; background: var(--border); border-radius: 4px; margin-top: 3px; overflow: hidden; width: 72px; }
.stat-bar-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg, var(--cobalt), var(--sky)); }

.sidebar-cta-card {
    background: linear-gradient(145deg, #0f172a, #1e3a5f);
    border-radius: 14px; padding: 18px 16px; text-align: center; position: relative; overflow: hidden;
}
.sidebar-cta-card::before {
    content: ''; position: absolute; width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(14,165,233,0.18) 0%, transparent 70%);
    top: -70px; right: -50px; border-radius: 50%;
}
.sidebar-cta-icon {
    width: 44px; height: 44px; background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1); border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    color: var(--sky); font-size: 1.1rem; margin: 0 auto 10px; position: relative; z-index: 1;
}
.sidebar-cta-card h4 { color: white; font-size: 0.92rem; font-weight: 700; margin-bottom: 5px; position: relative; z-index: 1; }
.sidebar-cta-card p { color: rgba(255,255,255,0.5); font-size: 0.75rem; margin-bottom: 14px; position: relative; z-index: 1; line-height: 1.5; }
.sidebar-cta-btn {
    background: white; color: #0f172a; border: none; width: 100%; padding: 9px;
    border-radius: 8px; font-weight: 700; font-size: 0.82rem; cursor: pointer;
    font-family: var(--font); transition: opacity 0.2s; position: relative; z-index: 1;
    display: flex; align-items: center; justify-content: center; gap: 5px;
}
.sidebar-cta-btn:hover { opacity: 0.88; }

.trust-list { display: flex; flex-direction: column; gap: 8px; }
.trust-item { display: flex; gap: 8px; align-items: center; font-size: 0.8rem; color: var(--ink-2); }
.trust-icon { color: var(--mint); font-size: 0.82rem; width: 14px; text-align: center; flex-shrink: 0; }

.avail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 6px; margin-top: 10px; }
.avail-slot {
    background: var(--bg); border: 1px solid var(--border); border-radius: 7px;
    padding: 6px 9px; font-size: 0.75rem; color: var(--ink-2); display: flex; align-items: center; gap: 5px;
}
.avail-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--mint); flex-shrink: 0; }
.avail-dot.busy { background: var(--warn); }

/* ── Bottom CTA ──────────────────────────────── */
.bottom-cta {
    background: linear-gradient(130deg, #1e3a8a 0%, #0ea5e9 100%);
    border-radius: 14px; padding: 26px 24px;
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    margin-bottom: 16px; position: relative; overflow: hidden;
}
.bottom-cta::after {
    content: ''; position: absolute; width: 240px; height: 240px;
    background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);
    top: -80px; right: -50px; border-radius: 50%;
}
.bottom-cta-left { flex: 1; position: relative; z-index: 1; }
.bottom-cta-left h3 { font-family: var(--serif); font-size: 1.2rem; font-weight: 600; color: white; margin-bottom: 4px; }
.bottom-cta-left p  { font-size: 0.83rem; color: rgba(255,255,255,0.7); }
.bottom-cta-right { position: relative; z-index: 1; flex-shrink: 0; }
.btn-cta-white {
    background: white; color: #1e3a8a; padding: 10px 24px; border-radius: 9px; border: none;
    font-weight: 700; font-size: 0.85rem; cursor: pointer; font-family: var(--font);
    transition: all 0.22s; display: flex; align-items: center; gap: 7px;
}
.btn-cta-white:hover { transform: translateY(-1px); box-shadow: 0 5px 16px rgba(0,0,0,0.2); }

/* ── Other services ──────────────────────────── */
.other-section { background: white; border-top: 1px solid var(--border); padding: 28px 0 36px; }
.other-section .inner { max-width: 1100px; margin: 0 auto; padding: 0 20px; }
.section-head { margin-bottom: 14px; }
.section-head h2 { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--ink); }
.section-head p  { font-size: 0.78rem; color: var(--ink-3); margin-top: 2px; }
.other-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
.other-card {
    background: var(--bg); border: 1px solid var(--border); border-radius: 12px; padding: 16px;
    transition: all 0.22s; display: flex; flex-direction: column; gap: 8px;
}
.other-card:hover { border-color: var(--sky); background: var(--sky-light); transform: translateY(-2px); box-shadow: 0 5px 16px rgba(14,165,233,0.1); }
.other-card-icon {
    width: 38px; height: 38px; background: white; border: 1px solid var(--border);
    border-radius: 9px; display: flex; align-items: center; justify-content: center;
    color: var(--cobalt); font-size: 0.95rem; transition: all 0.22s;
}
.other-card:hover .other-card-icon { background: var(--cobalt); color: white; border-color: transparent; }
.other-card h3 { font-size: 0.87rem; font-weight: 600; color: var(--ink); }
.other-card p  { font-size: 0.78rem; color: var(--ink-3); line-height: 1.5; flex: 1; }
.other-card a  { font-size: 0.78rem; font-weight: 600; color: var(--sky); text-decoration: none; display: flex; align-items: center; gap: 4px; }
.other-card:hover a { color: var(--cobalt); }
.other-price {
    font-size: 0.9rem; font-weight: 700; color: var(--cobalt); margin-top: 4px;
}
.other-price small { font-size: 0.65rem; font-weight: 400; color: var(--ink-3); }

/* ── Modals ──────────────────────────────────── */
.modal-wrap {
    display: none; position: fixed; inset: 0;
    background: rgba(15,23,42,0.72); backdrop-filter: blur(10px);
    z-index: 9999; align-items: center; justify-content: center; padding: 20px;
}
.modal-wrap.active { display: flex; }
.modal-box {
    background: white; border-radius: 18px; padding: 28px 24px;
    max-width: 380px; width: 100%; text-align: center;
    box-shadow: 0 28px 56px rgba(0,0,0,0.22);
    animation: popIn 0.28s cubic-bezier(0.4,0,0.2,1);
}
@keyframes popIn { from{opacity:0;transform:scale(0.94) translateY(10px)} to{opacity:1;transform:scale(1) translateY(0)} }
.modal-logo {
    width: 54px; height: 54px; background: linear-gradient(135deg, var(--cobalt), var(--sky));
    border-radius: 14px; display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.4rem; margin: 0 auto 14px;
}
.modal-box h3 { font-size: 1rem; font-weight: 700; color: var(--ink); margin-bottom: 5px; }
.modal-box p  { font-size: 0.82rem; color: var(--ink-3); margin-bottom: 18px; line-height: 1.55; }
.modal-store-btn {
    display: flex; align-items: center; justify-content: center; gap: 9px;
    width: 100%; padding: 11px 14px; border-radius: 9px; border: none;
    font-weight: 600; font-size: 0.85rem; cursor: pointer; font-family: var(--font);
    margin-bottom: 7px; transition: all 0.2s;
}
.modal-store-btn.apple  { background: #111; color: white; }
.modal-store-btn.google { background: var(--bg); color: var(--ink); border: 1px solid var(--border); }
.modal-store-btn:hover { opacity: 0.88; }
.modal-cancel { background: none; border: none; color: var(--ink-3); font-size: 0.8rem; cursor: pointer; margin-top: 6px; font-family: var(--font); transition: color 0.2s; }
.modal-cancel:hover { color: var(--ink); }

.img-modal-wrap { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.93); z-index: 9999; align-items: center; justify-content: center; }
.img-modal-wrap.active { display: flex; }
.img-modal-wrap img { max-width: 90vw; max-height: 88vh; object-fit: contain; border-radius: 10px; }

/* ── Responsive ──────────────────────────────── */
@media (max-width: 900px) {
    .main-cols { grid-template-columns: 1fr; }
    .sidebar { display: none; }
    .info-strip { grid-template-columns: repeat(2, 1fr); }
    .hero-row { grid-template-columns: 1fr; }
    .hero-cta-side { flex-direction: row; align-items: center; flex-wrap: wrap; }
    .other-grid { grid-template-columns: 1fr 1fr; }
    .bottom-cta { flex-direction: column; }
    .benefits-list { grid-template-columns: 1fr; }
}
@media (max-width: 560px) {
    .other-grid { grid-template-columns: 1fr; }
}
</style>

@php
    // Complete pricing and image data for all services with multiple name variations
    $servicePricing = [
        // Telemedicine variations
        'Telemedicine' => [
            'price' => '₦3,000',
            'price_detail' => 'per consultation',
            'icon' => 'fa-video',
            'color' => 'linear-gradient(135deg, #1d4ed8, #0ea5e9)',
            'image' => asset('images/service/tele/tele1.jpg'),
            'image' => asset('images/service/tele/tele2.jpg'),
            'image3' => asset('images/services/telemedicine-3.jpg'),
            'image4' => asset('images/services/telemedicine-4.jpg'),
        ],
        'Telemedicine Service' => [
            'price' => '₦3,000',
            'price_detail' => 'per consultation',
            'icon' => 'fa-video',
            'color' => 'linear-gradient(135deg, #1d4ed8, #0ea5e9)',
            'image' => asset('images/service/tele/tele1.jpg'),
            'image2' => asset('images/service/tele/tele.jpeg'),
            'image3' => asset('images/service/tele/tele3.jpg'),
            'image4' => asset('images/service/tele/tele2.jpg'),
        ],
        // Home care variations
        'Home care' => [
            'price' => '₦30,000',
            'price_detail' => 'per visit',
            'icon' => 'fa-home',
            'color' => 'linear-gradient(135deg, #10b981, #34d399)',
            'image' => asset('images/service/home/doctors.png'),
            'image2' => asset('images/service/home/telemedicine-2.jpg'),
            'image3' => asset('images/service/home/telemedicine-3.jpg'),
            'image4' => asset('images/service/home/telemedicine-4.jpg'),
        ],
        'Home Care' => [
            'price' => '₦30,000',
            'price_detail' => 'per visit',
            'icon' => 'fa-home',
            'color' => 'linear-gradient(135deg, #10b981, #34d399)',
            'image' => asset('images/service/home/doctors.png'),
            'image2' => asset('images/service/home/telemedicine-2.jpg'),
            'image3' => asset('images/service/home/hom1.jpg'),
            'image4' => asset('images/service/home/hom4.jpg'),
        ],
        'Home Care Service' => [
            'price' => '₦30,000',
            'price_detail' => 'per visit',
            'icon' => 'fa-home',
            'color' => 'linear-gradient(135deg, #10b981, #34d399)',
            'image' => asset('images/service/home/doctors.png'),
            'image2' => asset('images/service/home/hom2.jpg'),
            'image3' => asset('images/service/home/hom1.jpg'),
            'image4' => asset('images/service/home/hom4.jpg'),
        ],
        // Caregiving Service variations
        'Caregiving Service' => [
            'price' => '₦10,000',
            'price_detail' => 'per day',
            'icon' => 'fa-hands-helping',
            'color' => 'linear-gradient(135deg, #8b5cf6, #a78bfa)',
            'image' => asset('images/service/care/care3.jpg'),
            'image2' => asset('images/service/care/care2.jpg'),
            'image3' => asset('images/service/care/care1.jpg'),
            'image4' => asset('images/service/care/care4.jpg'),
        ],
        'Caregiving' => [
            'price' => '₦10,000',
            'price_detail' => 'per day',
            'icon' => 'fa-hands-helping',
            'color' => 'linear-gradient(135deg, #8b5cf6, #a78bfa)',
            'image' => asset('images/service/care/care2.jpg'),
            'image2' => asset('images/service/care/care3.jpg'),
            'image3' => asset('images/service/care/care1.jpg'),
            'image4' => asset('images/service/care/care4.jpg'),
        ],
        // Ambulance service variations
        'Ambulance service' => [
            'price' => '₦45,000',
            'price_detail' => 'per trip',
            'icon' => 'fa-ambulance',
            'color' => 'linear-gradient(135deg, #ef4444, #f87171)',
            'image' => asset('images/service/emge/ambee.jpeg'),
            'image2' => asset('images/service/emge/em4.jpg'),
            'image3' => asset('images/service/emge/em1.jpg'),
            'image4' => asset('images/service/emge/em5.jpg'),
        ],
        'Ambulance Service' => [
            'price' => '₦45,000',
            'price_detail' => 'per trip',
            'icon' => 'fa-ambulance',
            'color' => 'linear-gradient(135deg, #ef4444, #f87171)',
            'image' => asset('images/service/emge/em1.jpg'),
            'image2' => asset('images/service/emge/em.jpg'),
            'image3' => asset('images/service/emge/em.jpg'),
            'image4' => asset('images/service/emge/em.jpg'),
        ],
        'Ambulance' => [
            'price' => '₦45,000',
            'price_detail' => 'per trip',
            'icon' => 'fa-ambulance',
            'color' => 'linear-gradient(135deg, #ef4444, #f87171)',
            'image' => asset('images/service/emge/em1.jpg'),
            'image2' => asset('images/services/telemedicine-2.jpg'),
            'image3' => asset('images/services/telemedicine-3.jpg'),
            'image4' => asset('images/services/telemedicine-4.jpg'),
        ],
        // Locum service variations (including Medical Locum Service)
        'Locum service' => [
            'price' => '₦3,000',
            'price_detail' => 'per hour',
            'icon' => 'fa-user-md',
            'color' => 'linear-gradient(135deg, #f59e0b, #fbbf24)',
            'image' => asset('images/service/madi/med1.jpg'),
            'image2' => asset('images/service/madi/med2.jpg'),
            'image3' => asset('images/services/telemedicine-3.jpg'),
            'image4' => asset('images/services/telemedicine-4.jpg'),
        ],
        'Medical Locum Service' => [
            'price' => '₦3,000',
            'price_detail' => 'per hour',
            'icon' => 'fa-user-md',
            'color' => 'linear-gradient(135deg, #f59e0b, #fbbf24)',
            'image' => asset('images/service/madi/med1.jpg'),
            'image2' => asset('images/service/madi/med2.jpg'),
            'image3' => asset('images/service/madi/med3.jpg'),
            'image4' => asset('images/service/madi/med4.jpg'),
        ],
        'Locum' => [
            'price' => '₦3,000',
            'price_detail' => 'per hour',
            'icon' => 'fa-user-md',
            'color' => 'linear-gradient(135deg, #f59e0b, #fbbf24)',
            'image' => asset('images/service/madi/med1.jpg'),
            'image2' => asset('images/service/medi/med2.jpg'),
            'image3' => asset('images/service/medi/med3.jpg'),
            'image4' => asset('images/service/medi/med4.jpg'),
        ],
        // Physiotherapy variations
        'Physiotherapy' => [
            'price' => '₦35,000',
            'price_detail' => 'per visit',
            'icon' => 'fa-spa',
            'color' => 'linear-gradient(135deg, #0891b2, #06b6d4)',
            'image' => asset('images/services/telemedicine-1.jpg'),
            'image2' => asset('images/services/telemedicine-2.jpg'),
            'image3' => asset('images/services/telemedicine-3.jpg'),
            'image4' => asset('images/services/telemedicine-4.jpg'),
        ],
        'Physiotherapy Service' => [
            'price' => '₦35,000',
            'price_detail' => 'per visit',
            'icon' => 'fa-spa',
            'color' => 'linear-gradient(135deg, #0891b2, #06b6d4)',
            'image' => asset('images/service/pyth/py1.jpg'),
            'image2' => asset('images/service/pyth/py2.jpg'),
            'image3' => asset('images/service/pyth/py3.jpg'),
            'image4' => asset('images/service/pyth/py4.jpg'),
        ],
    ];
    
    // Helper function to get pricing data with fallback
    function getServicePricing($serviceName, $servicePricingArray) {
        // Try exact match first
        if (isset($servicePricingArray[$serviceName])) {
            return $servicePricingArray[$serviceName];
        }
        
        // Try case-insensitive matching
        $serviceNameLower = strtolower($serviceName);
        foreach ($servicePricingArray as $key => $value) {
            if (strtolower($key) === $serviceNameLower) {
                return $value;
            }
        }
        
        // Try partial matching for common patterns
        if (strpos($serviceNameLower, 'telemedicine') !== false) {
            return $servicePricingArray['Telemedicine'];
        }
        if (strpos($serviceNameLower, 'home care') !== false || strpos($serviceNameLower, 'homecare') !== false) {
            return $servicePricingArray['Home care'];
        }
        if (strpos($serviceNameLower, 'caregiving') !== false) {
            return $servicePricingArray['Caregiving Service'];
        }
        if (strpos($serviceNameLower, 'ambulance') !== false) {
            return $servicePricingArray['Ambulance service'];
        }
        if (strpos($serviceNameLower, 'locum') !== false || strpos($serviceNameLower, 'medical locum') !== false) {
            return $servicePricingArray['Medical Locum Service'];
        }
        if (strpos($serviceNameLower, 'physiotherapy') !== false || strpos($serviceNameLower, 'physio') !== false) {
            return $servicePricingArray['Physiotherapy'];
        }
        
        // Final fallback - return Telemedicine as default
        return $servicePricingArray['Telemedicine'];
    }
    
    // Get current service pricing data using the helper function
    $currentPricing = getServicePricing($service->name, $servicePricing);
    
    // Gallery images for current service
    $galleryImages = [
        $currentPricing['image'],
        $currentPricing['image2'],
        $currentPricing['image3'],
        $currentPricing['image4'],
    ];
    
    // Prepare other services with their pricing and icons
    $otherServicesWithPricing = [];
    if(isset($otherServices) && count($otherServices) > 0) {
        foreach($otherServices as $other) {
            $pricing = getServicePricing($other->name, $servicePricing);
            $otherServicesWithPricing[] = [
                'service' => $other,
                'price' => $pricing['price'],
                'price_detail' => $pricing['price_detail'],
                'icon' => $pricing['icon']
            ];
        }
    }
@endphp

<!-- Sticky bar -->
<div class="sticky-bar" id="stickyBar">
    <div class="sticky-bar-inner">
        <div class="sticky-service-name">
            <div class="stars-row">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            </div>
            {{ $service->name }} <span>· Pandacare</span>
        </div>
        <button class="btn-book-now" style="width:auto;padding:8px 20px;font-size:0.8rem;">Book Now</button>
    </div>
</div>

<div class="sdp">
<div class="sdp-wrap">

    <!-- Breadcrumb -->
    <div class="breadcrumb-row">
        <a href="{{ route('home') }}">Home</a>
        <span style="color:var(--border);font-size:0.6rem;"><i class="fas fa-chevron-right"></i></span>
        <a href="{{ route('home') }}#services">Services</a>
        <span style="color:var(--border);font-size:0.6rem;"><i class="fas fa-chevron-right"></i></span>
        <span>{{ $service->name }}</span>
    </div>

    <!-- Hero -->
    <div class="hero-row">
        <div class="hero-left">
            <div class="hero-icon" style="background: {{ $currentPricing['color'] }};"><i class="fas {{ $currentPricing['icon'] }}"></i></div>
            <div>
                <div class="hero-badge">Active · Available Now</div>
                <h1 class="hero-title">{{ $service->name }}</h1>
                <p class="hero-sub">{{ $service->short_description }}</p>
                <div class="hero-meta">
                    <div class="stars-row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                    <span class="rating-txt">4.8 (124 reviews)</span>
                    <span class="hero-pill"><i class="fas fa-clock"></i> Same-day</span>
                    <span class="hero-pill"><i class="fas fa-shield-alt"></i> Verified pros</span>
                </div>
            </div>
        </div>
        <div class="hero-cta-side">
            <div class="price-tag">
                {{ $currentPricing['price'] }}
                <strong>{{ $currentPricing['price_detail'] }}</strong>
            </div>
            <button class="btn-book-now">Book Now <i class="fas fa-arrow-right"></i></button>
            <div class="guarantee-note"><i class="fas fa-check-circle"></i> Free cancellation</div>
        </div>
    </div>

    <!-- Info strip -->
    <div class="info-strip">
        <div class="info-tile">
            <div class="info-tile-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div><div class="info-tile-label">Coverage</div><div class="info-tile-val">Lagos & Abuja</div></div>
        </div>
        <div class="info-tile">
            <div class="info-tile-icon"><i class="fas fa-clock"></i></div>
            <div><div class="info-tile-label">Response</div><div class="info-tile-val">Under 30 mins</div></div>
        </div>
        <div class="info-tile">
            <div class="info-tile-icon"><i class="fas fa-user-check"></i></div>
            <div><div class="info-tile-label">Professionals</div><div class="info-tile-val">200+ Vetted</div></div>
        </div>
        <div class="info-tile">
            <div class="info-tile-icon"><i class="fas fa-redo"></i></div>
            <div><div class="info-tile-label">Repeat Clients</div><div class="info-tile-val">78%</div></div>
        </div>
    </div>

    <!-- Main two-column -->
    <div class="main-cols">
        <!-- Left -->
        <div>
            <!-- Gallery -->
            <div class="gallery-block">
                <div class="gallery-grid">
                    @foreach($galleryImages as $i => $img)
                    <div class="g-item">
                        <img src="{{ $img }}" alt="{{ $service->name }} image {{ $i+1 }}" onclick="openImageModal(this.src)">
                        <div class="g-expand"><i class="fas fa-expand"></i></div>
                    </div>
                    @endforeach
                </div>
                <div class="gallery-counter"><i class="fas fa-images"></i> {{ count($galleryImages) }} photos · tap to enlarge</div>
            </div>

            <!-- About -->
            <div class="content-card">
                <div class="card-heading"><i class="fas fa-info-circle"></i> About this service</div>
                <p>{{ $service->full_description }}</p>
            </div>

            <!-- Benefits -->
            @if($service->benefits && count($service->benefits) > 0)
            <div class="content-card">
                <div class="card-heading"><i class="fas fa-star"></i> Key Benefits</div>
                <div class="benefits-list">
                    @foreach($service->benefits as $benefit)
                    <div class="benefit-item">
                        <div class="benefit-check"><i class="fas fa-check"></i></div>
                        <p>{{ $benefit }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- How it works -->
            <div class="content-card">
                <div class="card-heading"><i class="fas fa-route"></i> How it works</div>
                <div class="steps-list">
                    <div class="step-row">
                        <div class="step-dot">1<div class="step-line"></div></div>
                        <div class="step-body">
                            <h4>Request the Service</h4>
                            <p>Fill in your details, location and preferred time slot through the app.</p>
                        </div>
                    </div>
                    <div class="step-row">
                        <div class="step-dot">2<div class="step-line"></div></div>
                        <div class="step-body">
                            <h4>We Match a Professional</h4>
                            <p>Our system pairs you with a vetted, nearby expert within minutes.</p>
                        </div>
                    </div>
                    <div class="step-row">
                        <div class="step-dot">3</div>
                        <div class="step-body">
                            <h4>Service Delivered</h4>
                            <p>Track arrival in real-time and rate your experience after.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="content-card">
                <div class="card-heading"><i class="fas fa-comment-alt"></i> Customer Reviews</div>
                <div class="reviews-header">
                    <div>
                        <div class="big-rating">4.8</div>
                        <div class="stars-row" style="margin-top:4px;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                        <div style="font-size:0.7rem;color:var(--ink-3);margin-top:3px;">124 reviews</div>
                    </div>
                    <div class="rating-breakdown">
                        @foreach([['5','72%'],['4','18%'],['3','6%'],['2','3%'],['1','1%']] as $r)
                        <div class="bar-row">
                            <span>{{ $r[0] }}★</span>
                            <div class="bar-track"><div class="bar-fill" style="width:{{ $r[1] }}"></div></div>
                            <span>{{ $r[1] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="review-cards">
                    @foreach([['AI','Adaeze I.','2d ago','Great experience! The professional arrived on time and did a thorough job. Will definitely book again.'],['TM','Tunde M.','1w ago','Very professional team. Easy booking process. Highly recommend Pandacare.']] as $rv)
                    <div class="review-item">
                        <div class="review-top">
                            <div class="review-avatar">{{ $rv[0] }}</div>
                            <div class="review-name">{{ $rv[1] }}</div>
                            <div class="review-date">{{ $rv[2] }}</div>
                        </div>
                        <div class="review-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <div class="review-text">{{ $rv[3] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Stats -->
            <div class="sidebar-card">
                <div class="card-heading" style="margin-bottom:12px;"><i class="fas fa-chart-bar"></i> Service Stats</div>
                <div class="stat-rows-list">
                    <div class="stat-row-s">
                        <div><div class="stat-label-s">Happy Clients</div><div class="stat-val-s">500+</div></div>
                        <div><div class="stat-bar"><div class="stat-bar-fill" style="width:85%"></div></div></div>
                    </div>
                    <div class="stat-row-s">
                        <div><div class="stat-label-s">Satisfaction</div><div class="stat-val-s">98%</div></div>
                        <div><div class="stat-bar"><div class="stat-bar-fill" style="width:98%"></div></div></div>
                    </div>
                    <div class="stat-row-s">
                        <div><div class="stat-label-s">Availability</div><div class="stat-val-s">24 / 7</div></div>
                        <div><div class="stat-bar"><div class="stat-bar-fill" style="width:100%"></div></div></div>
                    </div>
                </div>
            </div>

            <!-- Today's slots -->
            <div class="sidebar-card">
                <div class="card-heading"><i class="fas fa-calendar-alt"></i> Today's Slots</div>
                <div class="avail-grid">
                    <div class="avail-slot"><div class="avail-dot"></div>9:00 AM</div>
                    <div class="avail-slot"><div class="avail-dot"></div>11:00 AM</div>
                    <div class="avail-slot"><div class="avail-dot busy"></div>1:00 PM</div>
                    <div class="avail-slot"><div class="avail-dot"></div>3:00 PM</div>
                    <div class="avail-slot"><div class="avail-dot"></div>5:00 PM</div>
                    <div class="avail-slot"><div class="avail-dot busy"></div>7:00 PM</div>
                </div>
                <div style="font-size:0.68rem;color:var(--ink-3);margin-top:7px;display:flex;gap:10px;">
                    <span><span style="color:var(--mint)">●</span> Open</span>
                    <span><span style="color:var(--warn)">●</span> Filling</span>
                </div>
            </div>

            <!-- Dark CTA -->
            <div class="sidebar-cta-card">
                <div class="sidebar-cta-icon"><i class="fas fa-calendar-check"></i></div>
                <h4>Book {{ $service->name }}</h4>
                <p>Matched with a pro in under 30 minutes.</p>
                <button class="sidebar-cta-btn btn-book-now"><i class="fas fa-bolt"></i> Book Instantly</button>
            </div>

            <!-- Trust -->
            <div class="sidebar-card">
                <div class="card-heading" style="margin-bottom:10px;"><i class="fas fa-shield-alt"></i> Why Pandacare</div>
                <div class="trust-list">
                    <div class="trust-item"><i class="fas fa-check-circle trust-icon"></i> Background-checked professionals</div>
                    <div class="trust-item"><i class="fas fa-check-circle trust-icon"></i> Secure in-app payment</div>
                    <div class="trust-item"><i class="fas fa-check-circle trust-icon"></i> Service quality guarantee</div>
                    <div class="trust-item"><i class="fas fa-check-circle trust-icon"></i> 24/7 customer support</div>
                    <div class="trust-item"><i class="fas fa-check-circle trust-icon"></i> Free cancellation policy</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom CTA banner -->
    <div class="bottom-cta">
        <div class="bottom-cta-left">
            <h3>Ready to book {{ $service->name }}?</h3>
            <p>Download the Pandacare app and get your first booking done in minutes.</p>
        </div>
        <div class="bottom-cta-right">
            <button class="btn-cta-white btn-book-now"><i class="fas fa-calendar-check"></i> Book Now</button>
        </div>
    </div>

</div><!-- /sdp-wrap -->
</div><!-- /sdp -->

<!-- Other services -->
@if(count($otherServicesWithPricing) > 0)
<div class="other-section">
    <div class="inner">
        <div class="section-head">
            <h2>Other Services</h2>
            <p>Explore more professional services on Pandacare</p>
        </div>
        <div class="other-grid">
            @foreach($otherServicesWithPricing as $item)
            @php $other = $item['service']; @endphp
            <div class="other-card">
                <div class="other-card-icon"><i class="fas {{ $item['icon'] }}"></i></div>
                <h3>{{ $other->name }}</h3>
                <p>{{ Str::limit($other->short_description, 70) }}</p>
                <div class="other-price">{{ $item['price'] }} <small>{{ $item['price_detail'] }}</small></div>
                <a href="{{ route('service.detail', $other->slug) }}">Learn more <i class="fas fa-arrow-right" style="font-size:0.65rem;"></i></a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Login Modal -->
<div id="loginModal" class="modal-wrap">
    <div class="modal-box">
        <div class="modal-logo"><i class="fas fa-user-circle"></i></div>
        <h3>Login Required</h3>
        <p>Please log in to continue booking. Open the Pandacare app to proceed.</p>
        <button onclick="redirectToStore()" class="modal-store-btn apple">
            <i class="fab fa-apple" style="font-size:1.1rem;"></i> Continue on App Store
        </button>
        <button onclick="redirectToStore()" class="modal-store-btn google">
            <i class="fab fa-google-play" style="font-size:1rem;"></i> Continue on Play Store
        </button>
        <button onclick="closeLoginModal()" class="modal-cancel">Cancel</button>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="img-modal-wrap" onclick="closeImageModal()">
    <img id="modalImage" src="" alt="Full size">
</div>

@push('scripts')
<script>
    const stickyBar = document.getElementById('stickyBar');
    window.addEventListener('scroll', () => {
        stickyBar.classList.toggle('visible', window.scrollY > 180);
    });

    function redirectToStore() {
        const ua = navigator.userAgent.toLowerCase();
        if(ua.indexOf('android') !== -1) {
            window.location.href = "https://play.google.com/store/apps/details?id=app.pandacare.com";
        } else if(/(ipad|iphone|ipod)/i.test(ua)) {
            window.location.href = "https://apps.apple.com/ng/app/pandacare-app/id6755859705";
        } else {
            window.location.href = "https://play.google.com/store/apps/details?id=app.pandacare.com";
        }
    }
    function openLoginModal()  { document.getElementById('loginModal').classList.add('active'); }
    function closeLoginModal() { document.getElementById('loginModal').classList.remove('active'); }
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.add('active');
    }
    function closeImageModal() { document.getElementById('imageModal').classList.remove('active'); }

    document.querySelectorAll('.btn-book-now').forEach(btn => btn.addEventListener('click', openLoginModal));
    document.querySelectorAll('.btn-login').forEach(btn => btn.addEventListener('click', openLoginModal));

    document.addEventListener('keydown', e => {
        if(e.key === 'Escape') { closeLoginModal(); closeImageModal(); }
    });
    document.getElementById('loginModal').addEventListener('click', function(e) {
        if(e.target === this) closeLoginModal();
    });
</script>
@endpush
@endsection