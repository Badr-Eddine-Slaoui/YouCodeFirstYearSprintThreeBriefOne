@layout('templates.layout')
 <!-- Hero Section -->
    <div class="w-[68%] m-auto mx-auto px-4 pt-16 pb-12 md:pt-24 md:pb-16 grid md:grid-cols-2">
        <div class="text-left max-w-5xl mx-auto relative">
            <!-- Floating decorative elements -->
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-purple-300 rounded-full opacity-20 blur-3xl floating-shape"></div>
            <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-blue-300 rounded-full opacity-20 blur-3xl floating-shape" style="animation-delay: 2s;"></div>
            
            <div class="">
                <span class="inline-block text-purple-600 font-semibold text-sm uppercase tracking-wider mb-4">Get in Touch</span>
                <h1 class="text-5xl md:text-[90px] font-bold mb-6 leading-tight">
                    Ready to Start<br/>
                    <span class="text-gradient">Your Project?</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    We'd love to hear about your ideas and explore how NovaCraft Studio can help bring them to life.
                </p>
            </div>
        </div>
        <div>
          <img class="w-[90%] m-auto h-auto" src="@asset('images/fifthbanner.jpg')" alt="fifthbanner">
        </div>
    </div>

    <!-- Contact Methods Grid -->
    <div class="container mx-auto px-4 mb-20">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6">
            <!-- Email Card -->
            <div class="contact-card glass-card rounded-2xl p-8 text-center">
                <div class="w-16 h-16 accent-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">General Inquiries</h3>
                <a href="mailto:hello@novacraftstudio.com" class="text-purple-600 hover:text-purple-700 font-medium">hello@novacraftstudio.com</a>
                <p class="text-sm text-gray-500 mt-3">For general questions</p>
            </div>

            <!-- Projects Email Card -->
            <div class="contact-card glass-card rounded-2xl p-8 text-center">
                <div class="w-16 h-16 accent-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">New Projects</h3>
                <a href="mailto:projects@novacraftstudio.com" class="text-purple-600 hover:text-purple-700 font-medium">projects@novacraftstudio.com</a>
                <p class="text-sm text-gray-500 mt-3">Start your project with us</p>
            </div>

            <!-- Phone Card -->
            <div class="contact-card glass-card rounded-2xl p-8 text-center">
                <div class="w-16 h-16 accent-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Phone</h3>
                <a href="tel:+1234567890" class="text-purple-600 hover:text-purple-700 font-medium">+1 (234) 567-890</a>
                <p class="text-sm text-gray-500 mt-3">Mon-Fri, 9AM-6PM</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="container mx-auto px-4 mb-20">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-3 gap-8">
            <!-- Contact Form - Takes 2 columns -->
            <div class="lg:col-span-2">
                <div class="glass-card rounded-3xl p-8 md:p-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Send Us a Message</h2>
                    <p class="text-gray-600 mb-8">Fill out the form below and we'll get back to you within 24 hours</p>
                    
                    <div class="space-y-6">
                        <!-- Name and Email Row -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Your Name *</label>
                                <input type="text" class="form-input w-full px-4 py-3 rounded-xl border-2 border-purple-100" placeholder="John Doe" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Email Address *</label>
                                <input type="email" class="form-input w-full px-4 py-3 rounded-xl border-2 border-purple-100" placeholder="john@company.com" required>
                            </div>
                        </div>

                        <!-- Company Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Company Name</label>
                            <input type="text" class="form-input w-full px-4 py-3 rounded-xl border-2 border-purple-100" placeholder="Your Company">
                        </div>

                        <!-- Project Type and Budget Row -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Project Type</label>
                                <select class="form-select w-full px-4 py-3 rounded-xl border-2 border-purple-100">
                                    <option>Select a service</option>
                                    <option>Web Design/Development</option>
                                    <option>Branding</option>
                                    <option>Digital Marketing</option>
                                    <option>Mobile App</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Project Budget</label>
                                <select class="form-select w-full px-4 py-3 rounded-xl border-2 border-purple-100">
                                    <option>Select budget range</option>
                                    <option>Under $10k</option>
                                    <option>$10k - $25k</option>
                                    <option>$25k - $50k</option>
                                    <option>$50k+</option>
                                    <option>Not sure yet</option>
                                </select>
                            </div>
                        </div>

                        <!-- Project Description -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Tell us about your project *</label>
                            <textarea class="form-textarea w-full px-4 py-3 rounded-xl border-2 border-purple-100 h-32 resize-none" placeholder="Share your ideas, goals, and any specific requirements..." required></textarea>
                        </div>

                        <!-- How did you hear about us -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">How did you hear about us?</label>
                            <input type="text" class="form-input w-full px-4 py-3 rounded-xl border-2 border-purple-100" placeholder="Google, referral, social media...">
                        </div>

                        <!-- Submit Button -->
                        <button class="w-full accent-gradient text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center gap-3">
                            Send Message
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Office Hours -->
                <div class="glass-card rounded-3xl p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Office Hours</h3>
                    </div>
                    <div class="space-y-3 text-gray-600">
                        <div class="flex justify-between items-center py-2 border-b border-purple-100">
                            <span class="font-medium">Monday - Friday</span>
                            <span class="text-sm">9:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="font-medium">Saturday - Sunday</span>
                            <span class="text-sm text-gray-400">Closed</span>
                        </div>
                    </div>
                </div>

                <!-- Visit Our Studio -->
                <div class="glass-card rounded-3xl p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Visit Our Studio</h3>
                    </div>
                    <p class="text-gray-600 mb-4">Stop by for coffee and conversation about your project</p>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        123 Creative Avenue<br/>
                        Design District<br/>
                        New York, NY 10001
                    </p>
                    <button class="mt-6 w-full border-2 border-purple-200 text-purple-600 px-6 py-3 rounded-xl font-semibold hover:bg-purple-50 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        Get Directions
                    </button>
                </div>

                <!-- Quick Response Badge -->
                <div class="glass-card rounded-3xl p-8 text-center accent-gradient bg-opacity-10">
                    <div class="relative inline-block mb-4">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="absolute inset-0 bg-purple-400 rounded-full pulse-ring"></div>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900 mb-2">24-Hour Response</h4>
                    <p class="text-sm text-gray-600">We typically respond much sooner!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- What Happens Next Section -->
    <div class="container mx-auto px-4 mb-20">
        <div class="max-w-5xl mx-auto">
            <div class="glass-card rounded-3xl p-10 md:p-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 text-center">What Happens Next?</h2>
                <p class="text-gray-600 text-center mb-12 text-lg">Your journey with NovaCraft Studio</p>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Step 1 -->
                    <div class="step-item">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-12 h-12 step-number rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="text-xl font-bold text-white">1</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Quick Response</h3>
                        <p class="text-sm text-gray-600">We'll get back to you within 24 hours (usually much sooner)</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-item">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-12 h-12 step-number rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="text-xl font-bold text-white">2</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Initial Conversation</h3>
                        <p class="text-sm text-gray-600">We'll schedule a call or meeting to discuss your project in detail</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-item">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-12 h-12 step-number rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="text-xl font-bold text-white">3</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Proposal</h3>
                        <p class="text-sm text-gray-600">We'll develop a tailored proposal outlining our approach, timeline, and investment</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="step-item">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-12 h-12 step-number rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="text-xl font-bold text-white">4</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Collaboration</h3>
                        <p class="text-sm text-gray-600">Once approved, we'll kick off your project with our full team behind you</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container mx-auto px-4 mb-20">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 text-center">Frequently Asked Questions</h2>
            <p class="text-gray-600 text-center mb-12 text-lg">Quick answers to common questions</p>
            
            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="faq-item glass-card rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">How long does a typical project take?</h3>
                            <p class="text-gray-600">Project timelines vary based on scope and complexity. Most web projects take 6-12 weeks, while larger initiatives may take several months. We'll provide a detailed timeline in our proposal.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item glass-card rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Do you work with clients remotely?</h3>
                            <p class="text-gray-600">Absolutely! We work with clients locally and around the world, using video calls and collaboration tools to stay connected throughout the project.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item glass-card rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">What's your pricing structure?</h3>
                            <p class="text-gray-600">Every project is unique, so we provide custom quotes based on your specific needs and goals. We're happy to discuss budget during our initial conversation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endlayout