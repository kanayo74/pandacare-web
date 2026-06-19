@extends('layouts.app')

@section('content')
	<style>
		.pp-wrap {
			max-width: 760px;
			margin: 0 auto;
			padding: 3rem 1.5rem;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
		.pp-header { margin-bottom: 2.5rem; }
		.pp-eyebrow {
			font-size: 11px;
			font-weight: 600;
			letter-spacing: 0.09em;
			text-transform: uppercase;
			color: #888780;
			margin: 0 0 8px;
		}
		.pp-title {
			font-size: 28px;
			font-weight: 600;
			color: #1a1a1a;
			margin: 0 0 12px;
			line-height: 1.2;
		}
		.pp-subtitle {
			font-size: 15px;
			color: #5F5E5A;
			margin: 0;
			line-height: 1.65;
			max-width: 600px;
		}
		.pp-list { border-top: 1px solid #e8e6e1; }
		.pp-item {
			display: flex;
			gap: 20px;
			padding: 1.5rem 0;
			border-bottom: 1px solid #e8e6e1;
		}
		.pp-item--last { border-bottom: none; }
		.pp-icon {
			flex-shrink: 0;
			width: 34px;
			height: 34px;
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-top: 2px;
		}
		.pp-icon i { font-size: 15px; }
		.pp-body { flex: 1; }
		.pp-label {
			font-size: 11px;
			font-weight: 600;
			letter-spacing: 0.07em;
			text-transform: uppercase;
			color: #888780;
			margin: 0 0 6px;
		}
		.pp-text {
			font-size: 15px;
			color: #444441;
			margin: 0;
			line-height: 1.7;
		}
		.pp-sublist {
			margin: 8px 0 0;
			padding-left: 18px;
			font-size: 14px;
			color: #5F5E5A;
			line-height: 1.8;
		}
		.pp-footer {
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
		.pp-footer-text {
			font-size: 14px;
			color: #5F5E5A;
			margin: 0;
			line-height: 1.5;
		}
		.pp-back-btn {
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
		.pp-back-btn:hover { background: #e8e6e1; }
		.pp-back-btn i { margin-right: 6px; }
	</style>
	
	<div class="pp-wrap">
		
		<div class="pp-header">
			<p class="pp-eyebrow">Legal document · Version 1.0</p>
			<h1 class="pp-title">Privacy Policy</h1>
			<p class="pp-subtitle">Pandacare is committed to protecting your personal and medical information. This policy explains what we collect, how we use it, and your rights as a user.</p>
		</div>
		
		<div class="pp-list">
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#E6F1FB;">
					<i class="fas fa-database" style="color:#185FA5;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">01 — Information we collect</p>
					<p class="pp-text">We collect the following categories of data to provide our services:</p>
					<ul class="pp-sublist">
						<li><strong>Personal data</strong> — full name, date of birth, gender, email, phone number</li>
						<li><strong>Medical & health data</strong> — history, diagnoses, prescriptions, consultation notes, care plans</li>
						<li><strong>Location data</strong> — real-time GPS for ambulance dispatch and home care matching</li>
						<li><strong>Payment data</strong> — processed securely via third-party gateways; raw card data is never stored</li>
						<li><strong>Device & technical data</strong> — device type, OS, IP address, session logs, crash reports</li>
						<li><strong>Communication data</strong> — video/audio from telemedicine sessions and in-app messages</li>
					</ul>
				</div>
			</div>
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#EAF3DE;">
					<i class="fas fa-circle-check" style="color:#3B6D11;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">02 — How we use your information</p>
					<p class="pp-text">Your data is used to provide and improve our healthcare services, match you with qualified professionals, dispatch emergency ambulances with real-time tracking, maintain your medical records and prescriptions, process payments, send appointment reminders, and comply with Nigerian healthcare and data protection regulations.</p>
				</div>
			</div>
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#FAEEDA;">
					<i class="fas fa-share-nodes" style="color:#854F0B;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">03 — How we share your information</p>
					<p class="pp-text">We do not sell your personal data. We may share it only with:</p>
					<ul class="pp-sublist">
						<li>Licensed healthcare providers on our platform, strictly for your care</li>
						<li>Partner healthcare facilities for referrals or transfers</li>
						<li>Payment processors to complete transactions securely</li>
						<li>Emergency services when your life or safety is at risk</li>
						<li>Regulatory authorities when required by Nigerian law (NDPC, FMOH)</li>
						<li>Third-party service providers (cloud hosting, analytics) under strict data agreements</li>
					</ul>
				</div>
			</div>
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#FCEBEB;">
					<i class="fas fa-heart-pulse" style="color:#A32D2D;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">04 — Medical data & confidentiality</p>
					<p class="pp-text">Your health information is classified as sensitive personal data under the Nigeria Data Protection Act (NDPA) 2023. All medical consultations are strictly confidential between you and your provider. Healthcare professionals are bound by medical confidentiality obligations, and records are only accessible to providers directly involved in your care.</p>
				</div>
			</div>
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#F1EFE8;">
					<i class="fas fa-lock" style="color:#5F5E5A;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">05 — Data storage & security</p>
					<p class="pp-text">Your data is stored on secured, encrypted servers. We use SSL/TLS encryption for all data in transit, restrict sensitive data access to authorized personnel only, and conduct regular security audits. In the event of a data breach, we will notify affected users within 72 hours as required by the NDPA.</p>
				</div>
			</div>
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#EEEDFE;">
					<i class="fas fa-clock-rotate-left" style="color:#534AB7;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">06 — Data retention</p>
					<p class="pp-text">We retain your data for as long as your account is active or as required by Nigerian medical and legal regulations. You may request deletion of your account and data, subject to legal retention obligations — medical records may be retained for a minimum period under Nigerian health law.</p>
				</div>
			</div>
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#E1F5EE;">
					<i class="fas fa-scale-balanced" style="color:#0F6E56;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">07 — Your rights</p>
					<p class="pp-text">Under the NDPA 2023, you have the right to access, correct, delete, and port your personal data, object to certain uses, and withdraw consent at any time. To exercise any of these rights, contact us at <strong>privacy@pandacare.ng</strong>.</p>
				</div>
			</div>
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#FAEEDA;">
					<i class="fas fa-cookie-bite" style="color:#854F0B;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">08 — Cookies & tracking</p>
					<p class="pp-text">Our app and website may use cookies and similar technologies to improve your experience and analyze usage. You can control cookie preferences through your browser or device settings at any time.</p>
				</div>
			</div>
			
			<div class="pp-item">
				<div class="pp-icon" style="background:#FCEBEB;">
					<i class="fas fa-child" style="color:#A32D2D;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">09 — Children's privacy</p>
					<p class="pp-text">Pandacare is not intended for users under the age of 18 without parental or guardian consent. We do not knowingly collect data from minors. If you believe a minor has provided us with personal data, please contact us immediately.</p>
				</div>
			</div>
			
			<div class="pp-item pp-item--last">
				<div class="pp-icon" style="background:#F1EFE8;">
					<i class="fas fa-gavel" style="color:#5F5E5A;"></i>
				</div>
				<div class="pp-body">
					<p class="pp-label">10 — Governing law & changes</p>
					<p class="pp-text">This policy is governed by the laws of the Federal Republic of Nigeria and the Nigeria Data Protection Act (NDPA) 2023. We may update this policy from time to time and will notify you of significant changes via the app or email. Continued use of Pandacare constitutes acceptance of the updated policy.</p>
				</div>
			</div>
		
		</div>
		
		<div class="pp-footer">
			<p class="pp-footer-text">By continuing to use Pandacare, you acknowledge and accept this privacy policy.</p>
			<button class="pp-back-btn" onclick="window.history.back()">
				<i class="fas fa-arrow-left"></i> Go back
			</button>
		</div>
	
	</div>
@endsection
