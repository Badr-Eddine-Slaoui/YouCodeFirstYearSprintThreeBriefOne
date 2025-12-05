@layout('templates.layout')
<!-- Hero Section with Animated Elements -->
    <div class="container mx-auto px-4 pt-16 pb-12 md:pt-24 md:pb-20">
        <div class="text-center max-w-5xl mx-auto relative">
            <!-- Floating decorative elements -->
            <div class="absolute top-0 left-0 w-32 h-32 bg-purple-200 rounded-full opacity-20 blur-3xl floating-card"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 bg-blue-200 rounded-full opacity-20 blur-3xl floating-card" style="animation-delay: 1s;"></div>
            
            <div class="relative z-10">
                <span class="inline-block text-purple-600 font-semibold text-sm uppercase tracking-wider mb-4">About NovaCraft Studio</span>
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Where <span class="text-gradient">Passion</span><br/>
                    Meets <span class="text-gradient">Precision</span>
                </h1>
                <img class="w-[80%] m-auto h-auto" src="@asset('images/thbanner.jpg')" alt="thbanner">
                <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    A digital creative agency built on the belief that exceptional work comes from exceptional people working together.
                </p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="container mx-auto px-4 mb-20">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-card rounded-3xl p-8 text-center transform hover:scale-105 transition-transform duration-300">
                    <div class="stat-number text-gradient mb-2">12</div>
                    <p class="text-gray-600 text-lg font-medium">Team Members</p>
                    <p class="text-gray-500 text-sm mt-2">Passionate Experts</p>
                </div>
                <div class="glass-card rounded-3xl p-8 text-center transform hover:scale-105 transition-transform duration-300">
                    <div class="stat-number text-gradient mb-2">100%</div>
                    <p class="text-gray-600 text-lg font-medium">Dedicated</p>
                    <p class="text-gray-500 text-sm mt-2">To Your Success</p>
                </div>
                <div class="glass-card rounded-3xl p-8 text-center transform hover:scale-105 transition-transform duration-300">
                    <div class="stat-number text-gradient mb-2">∞</div>
                    <p class="text-gray-600 text-lg font-medium">Possibilities</p>
                    <p class="text-gray-500 text-sm mt-2">When We Collaborate</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Story Section with Visual Timeline -->
    <div class="container mx-auto px-4 mb-24">
        <div class="max-w-4xl mx-auto">
            <div class="glass-card rounded-3xl p-10 md:p-16">
                <div class="flex items-start gap-6 mb-8">
                    <div class="w-12 h-12 accent-gradient rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Story</h2>
                    </div>
                </div>
                
                <div class="space-y-6 text-gray-600 text-lg leading-relaxed border-l-2 border-purple-200 pl-8 ml-6">
                    <p>
                        We founded NovaCraft Studio with a simple yet powerful vision: <span class="text-gray-900 font-semibold">to create a place where creativity and technology work in perfect harmony</span>. We've deliberately kept our team small and focused, allowing us to maintain the quality, attention to detail, and personal relationships that larger agencies often sacrifice for scale.
                    </p>
                    <p>
                        Every project that comes through our doors receives the collective expertise of our entire team. We believe in <span class="text-gray-900 font-semibold">collaboration over silos, quality over quantity, and relationships over transactions</span>.
                    </p>
                    <div class="timeline-dot w-3 h-3 bg-purple-500 rounded-full -ml-[41px] mt-6"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="container mx-auto px-4 mb-24">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Team</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    12 passionate professionals united by a shared commitment to excellence
                </p>
            </div>
            
            <div class="glass-card rounded-3xl p-10 md:p-16">
                <div class="grid md:grid-cols-2 gap-8 mb-10">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Creative Thinkers</h3>
                            <p class="text-gray-600">Designers who craft experiences that resonate and inspire</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Technical Experts</h3>
                            <p class="text-gray-600">Developers who build robust, scalable solutions</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Strategic Minds</h3>
                            <p class="text-gray-600">Strategists who align solutions with your goals</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Dedicated Partners</h3>
                            <p class="text-gray-600">Project managers who ensure seamless delivery</p>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-purple-100 pt-8">
                    <p class="text-lg text-gray-600 leading-relaxed">
                        What makes us different is our commitment to working as an integrated unit. When you work with NovaCraft, <span class="text-gray-900 font-semibold">you're not just hiring an individual—you're gaining access to a full team of experts</span> who bring their specialized knowledge to your project.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="container mx-auto px-4 mb-24">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Approach</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Great digital work starts with great relationships. We invest time in understanding your business before taking action.
                </p>
            </div>
            
            <div class="grid md:grid-cols-5 gap-6">
                <!-- Step 1 -->
                <div class="step-card glass-card rounded-2xl p-6 text-center">
                    <div class="w-16 h-16 accent-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-white">1</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Discovery</h3>
                    <p class="text-sm text-gray-600">We listen, ask questions, and immerse ourselves in your world</p>
                </div>
                
                <!-- Step 2 -->
                <div class="step-card glass-card rounded-2xl p-6 text-center">
                    <div class="w-16 h-16 accent-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-white">2</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Strategy</h3>
                    <p class="text-sm text-gray-600">We develop a clear roadmap aligned with your objectives</p>
                </div>
                
                <!-- Step 3 -->
                <div class="step-card glass-card rounded-2xl p-6 text-center">
                    <div class="w-16 h-16 accent-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-white">3</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Creation</h3>
                    <p class="text-sm text-gray-600">We design and build with attention to every detail</p>
                </div>
                
                <!-- Step 4 -->
                <div class="step-card glass-card rounded-2xl p-6 text-center">
                    <div class="w-16 h-16 accent-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-white">4</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Collaboration</h3>
                    <p class="text-sm text-gray-600">We keep you involved and informed throughout</p>
                </div>
                
                <!-- Step 5 -->
                <div class="step-card glass-card rounded-2xl p-6 text-center">
                    <div class="w-16 h-16 accent-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-white">5</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Delivery</h3>
                    <p class="text-sm text-gray-600">We launch with confidence and provide ongoing support</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="container mx-auto px-4 mb-24">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Values</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    The principles that guide every decision we make
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Value 1 -->
                <div class="value-card glass-card rounded-2xl p-8 border-2 border-transparent">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Quality First</h3>
                            <p class="text-gray-600 leading-relaxed">We never compromise on the excellence of our work. Every pixel, every line of code, every interaction matters.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Value 2 -->
                <div class="value-card glass-card rounded-2xl p-8 border-2 border-transparent">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Transparency</h3>
                            <p class="text-gray-600 leading-relaxed">Open communication and honest feedback guide everything we do. No surprises, just clarity.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Value 3 -->
                <div class="value-card glass-card rounded-2xl p-8 border-2 border-transparent">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Innovation</h3>
                            <p class="text-gray-600 leading-relaxed">We stay current with technology while focusing on timeless design principles that endure.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Value 4 -->
                <div class="value-card glass-card rounded-2xl p-8 border-2 border-transparent">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Partnership</h3>
                            <p class="text-gray-600 leading-relaxed">Your success is our success—we're in this together, committed for the long haul.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="container mx-auto px-4 pb-24">
        <div class="max-w-4xl mx-auto">
            <div class="glass-card rounded-3xl p-12 md:p-16 text-center relative overflow-hidden">
                <!-- Decorative gradient overlay -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute top-0 left-0 w-full h-full accent-gradient"></div>
                </div>
                
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Let's Create Something<br/>
                        <span class="text-gradient">Amazing Together</span>
                    </h2>
                    <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                        We're always excited to connect with new clients and explore how we can help bring your digital projects to life.
                    </p>
                    <button class="accent-gradient text-white px-10 py-5 rounded-2xl font-semibold text-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 inline-flex items-center gap-3">
                        Get in Touch
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endlayout
