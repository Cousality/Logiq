@extends('Frontend.layouts.master')

@section('content')
<div class="bg-gray-100 py-10">

    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Frequently Asked Questions</h1>

        {{-- FAQ Accordion Section --}}
        <div class="space-y-4">

            @php
                $faqs = [
                    [
                        'q' => 'How do I place an order on LogIQ?',
                        'a' => 'You can browse our puzzles, add items to your basket, and proceed to checkout where you’ll enter your delivery and payment details.'
                    ],
                    [
                        'q' => 'Do I need an account to make a purchase?',
                        'a' => 'No — you can checkout as a guest. However, creating an account allows you to track past orders and save your wishlist.'
                    ],
                    [
                        'q' => 'What payment methods do you accept?',
                        'a' => 'We offer secure payments through PayPal, Visa, Mastercard, Apple Pay, and Google Pay.'
                    ],
                    [
                        'q' => 'How long does delivery take?',
                        'a' => 'Delivery times vary by location, but most orders arrive within 3–5 working days.'
                    ],
                    [
                        'q' => 'Can I return or exchange an item?',
                        'a' => 'Yes — items can be returned within 14 days if they are in original condition. Contact our support team to begin a return.'
                    ],
                    [
                        'q' => 'What if an item arrives damaged?',
                        'a' => 'If your order arrives damaged or incomplete, contact us immediately and we’ll replace it at no extra cost.'
                    ],
                    [
                        'q' => 'Do you offer international shipping?',
                        'a' => 'Currently, we ship only within the UK, but international shipping may be added in the future.'
                    ],
                    [
                        'q' => 'How can I contact customer support?',
                        'a' => 'You can reach us through the contact form on the website or by emailing our support team.'
                    ],
                    [
                        'q' => 'Are your puzzles suitable for all ages?',
                        'a' => 'Yes — we offer puzzles ranging from beginner-friendly to advanced, suitable for children and adults.'
                    ],
                    [
                        'q' => 'What should I do if I can’t solve a puzzle I bought?',
                        'a' => 'Many puzzles include solution guides or hint sheets. If yours doesn’t, contact us and we can provide tips or a digital solution file where available.'
                    ],
                    [
                        'q' => 'Do you restock sold-out puzzles?',
                        'a' => 'Yes — many popular puzzles are restocked regularly. You can check the product page or add it to your wishlist to be notified when it’s back in stock.'
                    ],
                ];
            @endphp

            @foreach($faqs as $index => $faq)
                <div x-data="{ open: false }" class="border border-gray-300 rounded-lg">
                    <button @click="open = !open"
                        class="w-full px-4 py-3 flex justify-between items-center text-left text-gray-800 font-semibold">
                        {{ $faq['q'] }}
                        <span x-show="!open">+</span>
                        <span x-show="open">−</span>
                    </button>

                    <div x-show="open" x-collapse class="px-4 pb-3 text-gray-600">
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Submit Question Form --}}
        <div class="mt-10 p-6 bg-gray-50 border rounded-lg shadow-sm">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Still need help?</h2>
            <p class="text-gray-600 mb-4">If you couldn’t find your question above, feel free to submit your own.</p>

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="#" onsubmit="alert('Your question has been received (demo).');">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <input type="text" name="name" placeholder="Your Name"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>

                    <input type="email" name="email" placeholder="Your Email"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <textarea name="message" placeholder="Your Question"
                    class="w-full border border-gray-300 rounded px-3 py-2 mb-4 h-32" required></textarea>

                <button type="submit"
                    class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">
                    Submit Question
                </button>
            </form>
        </div>

    </div>

</div>

@endsection
