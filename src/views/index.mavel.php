@layout('templates.layout')
    <!-- Hero Section -->
    <section class="w-[87%] h-fit m-auto mt-[100px] grid grid-cols-1 lg:grid-cols-2 gap-16">
        <div class="flex flex-col justify-center gap-8">
            <h1 class="text-[64px] lg:text-[84px] font-bold text-[#010205] leading-tight">
                Crafting <span class="hero-gradient">Digital Excellence</span>, <br> One Project at a Time
            </h1>
            <p class="text-[18px] lg:text-[16px] font-normal text-[#666] text-justify max-w-[550px] leading-relaxed">
                Welcome to NovaCraft Studio, where creativity meets technology. We're a dedicated team of 12 digital experts, passionate about transforming your ideas into exceptional digital experiences.
            </p>
            <div class="flex items-center gap-[32px] mt-8">
                <button class="group w-[220px] text-[16px] h-[56px] bg-[#0A66C2] hover:bg-[#0a5cad] text-white rounded-full font-semibold transition duration-300 flex items-center justify-center shadow-lg hover:shadow-xl">
                    Get Started
                    <i class="fa-solid fa-arrow-right ml-4 group-hover:translate-x-2 transition-transform duration-300"></i>
                </button>
                <a href="#our-work" class="text-[#010205] text-[18px] font-semibold hover:text-[#0A66C2] underline underline-offset-4 transition duration-300 flex items-center gap-2">
                    View Our Work
                    <i class="fa-solid fa-arrow-down text-sm"></i>
                </a>
            </div>
        </div>
        <div class="w-full">
            <img src="@asset('images/banner.jpg')" 
                     alt="Banner" 
                     class="w-full h-full object-contain rounded-lg">
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="w-[87%] h-[500px] m-auto mt-[100px] grid grid-cols-1 lg:grid-cols-2 gap-16">
        <div>
            <img src="@asset('images/scndbanner.jpg')" 
                     class="w-full h-full object-contain rounded-lg" 
                     alt="second banner">
        </div>
        <div class="flex flex-col justify-center gap-6 px-6 md:px-12">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-1 bg-[#0A66C2] rounded-full"></div>
                <span class="text-[#0A66C2] font-semibold text-sm uppercase tracking-wider">Our Services</span>
            </div>
            <h2 class="text-[48px] font-bold text-[#010205] leading-tight">What We Do?</h2>
            <p class="text-[18px] font-normal text-[#666] text-justify max-w-[600px] leading-relaxed">
                At NovaCraft Studio, we specialize in creating digital solutions that make an impact. Whether you're launching a new brand, building a web application, or reimagining your digital presence, our team has the expertise to deliver results that exceed expectations.
            </p>
            <h3 class="text-[40px] font-bold text-[#010205] mt-[40px]">Why Choose NovaCraft?</h3>
            <div class="space-y-4 mt-4">
                <div class="flex items-start gap-4 p-4 bg-blue-50/50 rounded-lg">
                    <div class="w-8 h-8 bg-[#0A66C2] rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-check text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[#010205] font-semibold">Personal Attention</p>
                        <p class="text-[#666] text-sm mt-1">With a close-knit team of 12, every project receives the focus it deserves.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-blue-50/50 rounded-lg">
                    <div class="w-8 h-8 bg-[#0A66C2] rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-handshake text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[#010205] font-semibold">Collaborative Process</p>
                        <p class="text-[#666] text-sm mt-1">We work alongside you, ensuring your vision guides every decision.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-blue-50/50 rounded-lg">
                    <div class="w-8 h-8 bg-[#0A66C2] rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-award text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[#010205] font-semibold">Quality Craftsmanship</p>
                        <p class="text-[#666] text-sm mt-1">We don't just deliver projects—we craft digital experiences that last.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted by Global Brands Section -->
    <section class="w-[87%] m-auto mt-[280px] text-center">
        <div class="flex items-center justify-center gap-3 mb-4">
            <div class="w-8 h-1 bg-[#0A66C2] rounded-full"></div>
            <span class="text-[#0A66C2] font-semibold text-sm uppercase tracking-wider">Partnerships</span>
            <div class="w-8 h-1 bg-[#0A66C2] rounded-full"></div>
        </div>
        <h2 class="text-[48px] font-bold text-[#010205] mb-8">Trusted by Global Brands</h2>
        <p class="text-[18px] font-normal text-[#666] max-w-[700px] mx-auto mb-16 leading-relaxed">
            We work with forward-thinking brands across industries. Our team brings cutting-edge solutions to help companies grow and scale in the digital world.
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-8 justify-center items-center py-8">
            <div class="brand-logo p-4 bg-gray-50 rounded-lg">
                <div class="h-12 flex items-center justify-center">
                    <span class="font-bold text-gray-700 text-xl">BRAND 01</span>
                </div>
            </div>
            <div class="brand-logo p-4 bg-gray-50 rounded-lg">
                <div class="h-12 flex items-center justify-center">
                    <span class="font-bold text-gray-700 text-xl">BRAND 02</span>
                </div>
            </div>
            <div class="brand-logo p-4 bg-gray-50 rounded-lg">
                <div class="h-12 flex items-center justify-center">
                    <span class="font-bold text-gray-700 text-xl">BRAND 03</span>
                </div>
            </div>
            <div class="brand-logo p-4 bg-gray-50 rounded-lg">
                <div class="h-12 flex items-center justify-center">
                    <span class="font-bold text-gray-700 text-xl">BRAND 04</span>
                </div>
            </div>
            <div class="brand-logo p-4 bg-gray-50 rounded-lg">
                <div class="h-12 flex items-center justify-center">
                    <span class="font-bold text-gray-700 text-xl">BRAND 05</span>
                </div>
            </div>
            <div class="brand-logo p-4 bg-gray-50 rounded-lg">
                <div class="h-12 flex items-center justify-center">
                    <span class="font-bold text-gray-700 text-xl">BRAND 06</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="w-[87%] m-auto mt-[100px]">
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="w-8 h-1 bg-[#0A66C2] rounded-full"></div>
                <span class="text-[#0A66C2] font-semibold text-sm uppercase tracking-wider">Testimonials</span>
                <div class="w-8 h-1 bg-[#0A66C2] rounded-full"></div>
            </div>
            <h2 class="text-[48px] font-bold text-[#010205] mb-4">What Our Clients Say</h2>
            <p class="text-[18px] font-normal text-[#666] max-w-[650px] mx-auto mb-8 leading-relaxed">
                Our clients trust us to deliver innovative solutions that enhance their digital presence. Here's what they have to say:
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="modern-card bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="text-[#0A66C2] text-2xl mb-4">"</div>
                <p class="text-[16px] text-[#666] mb-6 leading-relaxed">"NovaCraft Studio exceeded our expectations. Their team provided exceptional attention to detail and delivered a product that perfectly captured our brand's vision."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="font-bold text-[#0A66C2]">JD</span>
                    </div>
                    <div>
                        <h4 class="text-[18px] font-bold text-[#010205]">John Doe</h4>
                        <p class="text-[#666] text-sm">CEO, Example Company</p>
                    </div>
                </div>
            </div>
            <div class="modern-card bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="text-[#0A66C2] text-2xl mb-4">"</div>
                <p class="text-[16px] text-[#666] mb-6 leading-relaxed">"Working with NovaCraft was a game-changer for our business. Their team's creativity and expertise helped us achieve goals we didn't think were possible."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="font-bold text-[#0A66C2]">JS</span>
                    </div>
                    <div>
                        <h4 class="text-[18px] font-bold text-[#010205]">Jane Smith</h4>
                        <p class="text-[#666] text-sm">Marketing Director, Tech Innovators</p>
                    </div>
                </div>
            </div>
            <div class="modern-card bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="text-[#0A66C2] text-2xl mb-4">"</div>
                <p class="text-[16px] text-[#666] mb-6 leading-relaxed">"A fantastic experience from start to finish. The team was responsive, professional, and truly passionate about our project."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="font-bold text-[#0A66C2]">ML</span>
                    </div>
                    <div>
                        <h4 class="text-[18px] font-bold text-[#010205]">Michael Lee</h4>
                        <p class="text-[#666] text-sm">Founder, Creative Agency</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Signup Section -->
    <section class="w-[87%] m-auto mt-[100px] mb-[100px]">
        <div class="bg-gradient-to-r from-[#0A66C2] to-[#2367ab] py-16 px-8 rounded-xl shadow-2xl text-center">
            <h2 class="text-[48px] font-bold text-white mb-4">Stay Updated</h2>
            <p class="text-[18px] font-normal text-white/90 mb-8 max-w-2xl mx-auto">
                Subscribe to our newsletter for the latest updates, tips, and offers. Join our community of innovators.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-2xl mx-auto">
                <div class="relative flex-grow">
                    <input type="email" 
                           placeholder="Enter your email address" 
                           class="w-full p-4 text-[#010205] rounded-full shadow-lg border-0 focus:outline-none focus:ring-2 focus:ring-white/50 pl-6 pr-12">
                    <i class="fas fa-envelope absolute right-6 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <button class="bg-white text-[#010205] font-bold py-4 px-8 rounded-full transition-all duration-300 hover:bg-gray-100 hover:shadow-lg shadow-md whitespace-nowrap">
                    Subscribe Now
                </button>
            </div>
            <p class="text-white/70 text-sm mt-6">We respect your privacy. Unsubscribe anytime.</p>
        </div>
    </section>
@endlayout