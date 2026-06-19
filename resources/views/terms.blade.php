@extends('layouts.app')

@section('content')
<div class="tc-wrap">

  <div class="tc-header">
    <p class="tc-eyebrow">Legal document · Version 2.0</p>
    <h1 class="tc-title">Terms & Conditions</h1>
    <p class="tc-subtitle">Pandacare is a technology platform connecting users with independent healthcare providers. By using Pandacare, you agree to these terms.</p>
  </div>

  <div class="tc-list">

    <div class="tc-item">
      <div class="tc-icon" style="background:#EAF3DE;">
        <i class="fas fa-stethoscope" style="color:#3B6D11;"></i>
      </div>
      <div class="tc-body">
        <p class="tc-label">01 — Provider responsibility</p>
        <p class="tc-text">All medical advice, diagnoses, treatments, and healthcare decisions are the sole responsibility of the healthcare provider and the user. Pandacare does not guarantee the quality, availability, accuracy, or outcome of any healthcare service obtained through the platform.</p>
      </div>
    </div>

    <div class="tc-item">
      <div class="tc-icon" style="background:#E6F1FB;">
        <i class="fas fa-shield-halved" style="color:#185FA5;"></i>
      </div>
      <div class="tc-body">
        <p class="tc-label">02 — Provider licensing</p>
        <p class="tc-text">Healthcare providers are solely responsible for maintaining valid licenses, certifications, professional indemnity coverage, and compliance with all applicable laws and professional standards. Providers remain fully liable for the services they deliver.</p>
      </div>
    </div>

    <div class="tc-item">
      <div class="tc-icon" style="background:#FAEEDA;">
        <i class="fas fa-user-check" style="color:#854F0B;"></i>
      </div>
      <div class="tc-body">
        <p class="tc-label">03 — User responsibilities</p>
        <p class="tc-text">Users must provide accurate information and use the platform lawfully. In case of a medical emergency, users must immediately contact emergency services or visit the nearest healthcare facility.</p>
      </div>
    </div>

    <div class="tc-item">
      <div class="tc-icon" style="background:#FCEBEB;">
        <i class="fas fa-triangle-exclamation" style="color:#A32D2D;"></i>
      </div>
      <div class="tc-body">
        <p class="tc-label">04 — Liability limitation</p>
        <p class="tc-text">To the maximum extent permitted by law, Pandacare shall not be liable for any loss, injury, claim, or damages arising from services provided by independent healthcare providers, or from a user's reliance on information obtained through the platform.</p>
      </div>
    </div>

    <div class="tc-item tc-item--last">
      <div class="tc-icon" style="background:#F1EFE8;">
        <i class="fas fa-gavel" style="color:#5F5E5A;"></i>
      </div>
      <div class="tc-body">
        <p class="tc-label">05 — Governing law</p>
        <p class="tc-text">These terms are governed by the laws of the Federal Republic of Nigeria. Continued use of Pandacare constitutes acceptance of these terms.</p>
      </div>
    </div>

  </div>

  <div class="tc-footer">
    <p class="tc-footer-text">By continuing to use Pandacare, you accept these terms and conditions.</p>
    <button class="tc-back-btn" onclick="window.history.back()">
      <i class="fas fa-arrow-left"></i> Go back
    </button>
  </div>

</div>

<style>
  .tc-wrap {
    max-width: 760px;
    margin: 0 auto;
    padding: 3rem 1.5rem;
  }

  .tc-header {
    margin-bottom: 2.5rem;
  }

  .tc-eyebrow {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    color: #888780;
    margin: 0 0 8px;
  }

  .tc-title {
    font-size: 28px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 12px;
    line-height: 1.2;
  }

  .tc-subtitle {
    font-size: 15px;
    color: #5F5E5A;
    margin: 0;
    line-height: 1.65;
    max-width: 600px;
  }

  .tc-list {
    border-top: 1px solid #e8e6e1;
  }

  .tc-item {
    display: flex;
    gap: 20px;
    padding: 1.5rem 0;
    border-bottom: 1px solid #e8e6e1;
  }

  .tc-item--last {
    border-bottom: none;
  }

  .tc-icon {
    flex-shrink: 0;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 2px;
  }

  .tc-icon i {
    font-size: 15px;
  }

  .tc-body {
    flex: 1;
  }

  .tc-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #888780;
    margin: 0 0 6px;
  }

  .tc-text {
    font-size: 15px;
    color: #444441;
    margin: 0;
    line-height: 1.7;
  }

  .tc-footer {
    margin-top: 2rem;
    padding: 1.25rem 1.5rem;
    background: #F1EFE8;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
  }

  .tc-footer-text {
    font-size: 14px;
    color: #5F5E5A;
    margin: 0;
    line-height: 1.5;
  }

  .tc-back-btn {
    flex-shrink: 0;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 20px;
    border-radius: 999px;
    border: 1px solid #D3D1C7;
    background: #fff;
    color: #2C2C2A;
    cursor: pointer;
    white-space: nowrap;
    transition: background 0.15s;
  }

  .tc-back-btn:hover {
    background: #e8e6e1;
  }

  .tc-back-btn i {
    margin-right: 6px;
  }
</style>
@endsection