@extends('layouts.app')

@section('title', 'Terms, Privacy & Refund Policy - Wasemoo Shop')

@section('content')
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sm:p-12 lg:p-16">
            
            <div class="text-center mb-14 border-b border-gray-100 pb-8">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-4">Terms & Policies</h1>
                <p class="text-lg text-gray-500 font-medium">Effective Date: {{ date('F j, Y') }}</p>
            </div>

            <div class="prose prose-indigo max-w-none text-gray-600 leading-loose">
                <h2 class="text-2xl font-bold text-gray-900 mt-2 mb-4">1. Introduction</h2>
                <p class="mb-8">
                    Welcome to Wasemoo Shop. We operate a specialized electronic platform offering premium cyber security exam preparations, study guides, and comprehensive summaries ranging from beginner to advanced levels across all major global certifications. By accessing or using our services, you agree to be bound by the following terms of service, privacy policy, and refund policy.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">2. Privacy Policy</h2>
                <p class="mb-8">
                    We are committed to protecting your privacy. We collect only the necessary information (such as your name, email, and contact details) strictly to process your orders and improve your experience on our platform. Your personal data is securely stored and will never be sold, rented, or distributed to third parties without your explicit consent, except where required by law.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4 border-l-4 border-indigo-600 pl-4 bg-indigo-50/50 py-3 rounded-r-lg">3. Refund & Cancellation Policy (Strictly Non-Refundable)</h2>
                <p class="mb-4 text-gray-800 font-medium leading-relaxed">
                    Due to the nature of our products, all items available for purchase on Wasemoo Shop are <strong>strictly digital, non-tangible, and instantly downloadable</strong>. 
                </p>
                <p class="mb-4">
                    Because digital goods are irrevocably transferred and accessed immediately upon purchase, <strong>we do not offer refunds, exchanges, or cancellations under any circumstances once the digital product has been purchased and delivered.</strong> 
                </p>
                <p class="mb-8">
                    Please carefully review the full product descriptions, certification relevance, and material level (beginner to advanced) before completing your transaction. If you experience technical difficulties accessing your purchased files or believing your download link is defective, please contact our support team immediately, and we will ensure you receive the access you paid for.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">4. Intellectual Property Rights</h2>
                <p class="mb-8">
                    All study materials, exam preparations, cyber security summaries, and digital content provided on this platform are the exclusive intellectual property of Wasemoo Shop. They are provided for your personal, non-commercial use only to aid in your exam preparation. You may not distribute, reproduce, share, publicly broadcast, or resell any materials purchased from our website. Any violation of this clause may result in immediate termination of access and potential legal action.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">5. Contact Information</h2>
                <p class="mb-8">
                    If you have any questions regarding these terms, our privacy practices, or your digital purchase, please contact us. We are dedicated to ensuring your thorough success in your cyber security certification journey.
                </p>
            </div>
            
        </div>
    </div>
</div>
@endsection
