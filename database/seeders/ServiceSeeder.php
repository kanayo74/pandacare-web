<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Medical Locum Service',
                'slug' => 'medical-locum-service',
                'description' => 'Reliable, qualified medical professionals to fill staffing gaps in your facility. Our locum service connects healthcare facilities with verified, experienced medical professionals for temporary placements.',
                'short_description' => 'Pandacare provides a reliable and efficient Medical Locum Service designed to support healthcare facilities with qualified professionals on a temporary basis. We connect hospitals, clinics, and care providers with experienced medical personnel to ensure uninterrupted, 
                 high-quality patient care—whenever and wherever it’s needed.All professionals undergo a strict verification process to ensure they meet regulatory and professional standards.',
                'icon' => 'fa-user-md',
                'image' => 'services/locum.jpg',
                'features' => ['Verified professionals', 'Flexible scheduling', 'Quality assurance', 'Emergency coverage'],
                'price_range' => '₦50,000 - ₦200,000',
                'order' => 1
            ],
            [
                'name' => 'Home Care Service',
                'slug' => 'home-care-service',
                'description' => 'Professional medical care delivered to your home. Our skilled nurses and healthcare professionals provide post-surgery care, chronic illness management, medication administration, and wound care in the comfort of your home.',
                'short_description' => 'Our home care service is designed to meet a wide range of medical and non-medical needs. Whether it’s short-term post-hospital care or long-term support for chronic conditions,
                 Pandacare ensures patients receive expert attention without the need to visit a healthcare facility.',
                'icon' => 'fa-home',
                'image' => 'services/home-care.jpg',
                'features' => ['Post-surgery care', 'Medication management', 'Wound care', 'Chronic illness support'],
                'price_range' => '₦30,000 - ₦150,000',
                'order' => 2
            ],
            [
                'name' => 'Caregiving Service',
                'slug' => 'caregiving-service',
                'description' => 'Compassionate support for daily living. Our trained caregivers provide companionship, personal care, mobility assistance, and daily living support for elderly individuals, people with disabilities, and those recovering from illness.',
                'short_description' => 'Our caregiving service focuses on personalized assistance tailored to each individual’s needs.
                 We support clients who require help due to age, illness, disability, or recovery, ensuring they receive attentive and respectful care at all times.',
                'icon' => 'fa-heart',
                'image' => 'services/caregiving.jpg',
                'features' => ['Companionship', 'Personal care', 'Mobility assistance', 'Meal preparation'],
                'price_range' => '₦25,000 - ₦120,000',
                'order' => 3
            ],
            [
                'name' => 'Telemedicine Service',
                'slug' => 'telemedicine-service',
                'description' => 'Connect with licensed doctors via video or audio calls from anywhere. Get instant medical advice, prescriptions, and follow-up care without leaving your home. Secure, private consultations with verified healthcare professionals.',
                'short_description' => 'Our telemedicine service enables real-time medical consultations using phone or video, making healthcare more accessible and efficient. Whether you need medical advice, diagnosis, or follow-up care, 
                 Pandacare connects you with trusted professionals from the comfort of your home.',
                'icon' => 'fa-video',
                'image' => 'services/telemedicine.jpg',
                'features' => ['Video consultations', 'E-prescriptions', 'Medical records', '24/7 availability'],
                'price_range' => '₦5,000 - ₦20,000',
                'order' => 4
            ],
            [
                'name' => 'Emergency Ambulance Service',
                'slug' => 'emergency-ambulance-service',
                'description' => 'One-tap ambulance request with real-time tracking. Our emergency response team is available 24/7 to provide immediate medical transportation with professional, equipped ambulances and trained paramedics.',
                'short_description' => 'Our ambulance service ensures that patients receive immediate medical attention and are transported safely to the nearest appropriate healthcare facility. 
                Whether it’s a critical emergency or urgent medical transfer, Pandacare is always ready to respond.',
                'icon' => 'fa-ambulance',
                'image' => 'services/ambulance.jpg',
                'features' => ['Real-time tracking', '24/7 availability', 'Trained paramedics', 'Emergency equipment'],
                'price_range' => '₦15,000 - ₦50,000',
                'order' => 5
            ],
            [
                'name' => 'Physiotherapy Service',
                'slug' => 'physiotherapy-service',
                'description' => 'Personalized rehabilitation and recovery plans delivered at your home or clinic. Our certified physiotherapists provide injury recovery support, pain management, mobility improvement, and post-surgery rehabilitation.',
                'short_description' => 'We provide expert physiotherapy services tailored to each patient’s condition and recovery goals.
                 From rehabilitation after injury or surgery to managing chronic pain and mobility challenges, Pandacare ensures high-quality therapeutic care.',
                'icon' => 'fa-hand-peace',
                'image' => 'services/physiotherapy.jpg',
                'features' => ['Home visits', 'Personalized plans', 'Pain management', 'Recovery support'],
                'price_range' => '₦20,000 - ₦80,000',
                'order' => 6
            ],
        ];
        
        foreach ($services as $service) {
            Service::create($service);
        }
    }
}