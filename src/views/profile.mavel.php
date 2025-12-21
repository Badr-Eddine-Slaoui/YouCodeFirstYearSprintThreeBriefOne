@layout('templates.layout')
<div class="min-h-screen flex items-center justify-center p-4 mt-10">
<div class="w-full max-w-6xl">
        <!-- Header -->
        
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Profile Overview -->
            <div class="lg:col-span-1">
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex flex-col items-center">
                        <!-- Profile Avatar -->
                        <div class="digitalwave-gradient w-32 h-32 rounded-full flex items-center justify-center text-white text-4xl font-bold mb-4">
                            BE
                        </div>
                        
                        <h2 class="text-2xl font-bold text-gray-800">@php echo $user->name @endphp </h2>
                        <p class="text-gray-600 mb-2">Senior Digital Strategist</p>
                        <p class="text-gray-500 text-sm mb-6">
                            <i class="far fa-envelope mr-1"></i>@php echo $user->email @endphp
                        </p>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 w-full mb-6">
                            <div class="text-center">
                                <div class="text-xl font-bold text-gray-800">24</div>
                                <div class="text-sm text-gray-500">Projects</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-gray-800">128</div>
                                <div class="text-sm text-gray-500">Connections</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-gray-800">98%</div>
                                <div class="text-sm text-gray-500">Completion</div>
                            </div>
                        </div>
                        
                        <!-- Member Since -->
                        <div class="text-center text-gray-500 text-sm">
                            <i class="far fa-calendar-alt mr-1"></i> Member since April 2023
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button class="w-full flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            <i class="fas fa-share-alt text-purple-600 mr-3"></i>
                            <span class="text-gray-700">Share Profile</span>
                        </button>
                        <button class="w-full flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            <i class="fas fa-download text-purple-600 mr-3"></i>
                            <span class="text-gray-700">Export Data</span>
                        </button>
                        <button class="w-full flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            <i class="fas fa-eye text-purple-600 mr-3"></i>
                            <span class="text-gray-700">View Activity</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Profile Details -->
            <div class="lg:col-span-2">
                <!-- Profile Edit Form -->
                <form action="@route('profileUpdate', ["user" => auth()->user()->id])" method="post" class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->getFlash('success') }}
                        </div>
                    @endif
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Profile Information</h2>
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                            <i class="fas fa-check-circle mr-1"></i> 92% Complete
                        </span>
                    </div>
                    
                    <form id="profileForm">
                        <!-- Full Name -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2" for="fullName">
                                Full Name
                            </label>
                            <div class="flex">
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="fullName"
                                        name="name" 
                                        value="@php echo $user->name @endphp "
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none transition"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2" for="email">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email"
                                    value="@php echo $user->email @endphp "
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none transition"
                                    required
                                >
                            </div>
                        </div>
                        
                        <!-- Job Title & Phone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="jobTitle">
                                    Job Title
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-briefcase text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="jobTitle" 
                                        value="Senior Digital Strategist"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none transition"
                                        required
                                    >
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="phone">
                                    Phone Number
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="tel" 
                                        id="phone" 
                                        value="+1 (555) 123-4567"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none transition"
                                    >
                                </div>
                            </div>
                        </div>
                        
                        <!-- Location -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2" for="location">
                                Location
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="location" 
                                    value="San Francisco, CA"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none transition"
                                >
                            </div>
                        </div>
                        
                        <!-- Bio -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2" for="bio">
                                Professional Bio
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <i class="fas fa-edit text-gray-400"></i>
                                </div>
                                <textarea 
                                    id="bio" 
                                    rows="4"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none transition resize-none"
                                >Digital strategy expert with over 8 years of experience in transforming businesses through innovative digital solutions. Passionate about creating impactful user experiences and driving growth through data-driven approaches.</textarea>
                            </div>
                        </div>
                        
                        <!-- Skills -->
                        <div class="mb-8">
                            <label class="block text-gray-700 font-medium mb-2" for="skills">
                                Key Skills
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-star text-gray-400"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="skills" 
                                    value="Digital Strategy, UX Design, Data Analytics, Project Management"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none transition"
                                >
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="flex flex-wrap gap-4">
                            <button 
                                type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:shadow-lg transition-all hover:-translate-y-0.5"
                            >
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                            <button 
                                type="button" 
                                id="cancelBtn"
                                class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition"
                            >
                                Cancel
                            </button>
                            <button 
                                type="button" 
                                class="px-6 py-3 text-purple-600 font-medium rounded-lg hover:bg-purple-50 transition"
                            >
                                <i class="fas fa-eye mr-2"></i> Preview Profile
                            </button>
                        </div>
                    </form>
                </form>
                
                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Recent Activity</h3>
                    
                    <div class="space-y-4">
                        <!-- Activity 1 -->
                        <div class="flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition">
                            <div class="digitalwave-gradient w-10 h-10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-file-upload text-white"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800">Project "Nexus" uploaded</h4>
                                <p class="text-gray-600 text-sm">You've uploaded the final design files for the Nexus project</p>
                            </div>
                            <div class="text-gray-500 text-sm">2 hours ago</div>
                        </div>
                        
                        <!-- Activity 2 -->
                        <div class="flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition">
                            <div class="digitalwave-gradient w-10 h-10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user-plus text-white"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800">New connection</h4>
                                <p class="text-gray-600 text-sm">You've connected with Sarah Johnson from TechFlow Inc.</p>
                            </div>
                            <div class="text-gray-500 text-sm">1 day ago</div>
                        </div>
                        
                        <!-- Activity 3 -->
                        <div class="flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition">
                            <div class="digitalwave-gradient w-10 h-10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800">Analytics report generated</h4>
                                <p class="text-gray-600 text-sm">Q3 Digital Performance report has been generated</p>
                            </div>
                            <div class="text-gray-500 text-sm">3 days ago</div>
                        </div>
                    </div>
                    
                    <!-- Password Section -->
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Password & Security</h4>
                        <div class="flex flex-wrap gap-4">
                            <button class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                <i class="fas fa-key mr-2"></i> Change Password
                            </button>
                            <button class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                <i class="fas fa-shield-alt mr-2"></i> Two-Factor Auth
                            </button>
                            <button class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                <i class="fas fa-history mr-2"></i> Login History
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Back to Dashboard -->
        <div class="text-center mt-10 mb-12">
            <a href="@route('index')" class="inline-flex items-center text-purple-600 hover:text-purple-800 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to Home
            </a>
        </div>
    </div>

    <script>
        // Form submission handler
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const jobTitle = document.getElementById('jobTitle').value;
            
            // Update profile display
            document.querySelector('.text-2xl.font-bold.text-gray-800').textContent = fullName;
            document.querySelector('.text-gray-600.mb-2').textContent = jobTitle;
            
            // Show success message
            showNotification('Profile updated successfully!', 'success');
        });
        
        // Cancel button handler
        document.getElementById('cancelBtn').addEventListener('click', function() {
            if(confirm('Are you sure you want to discard changes?')) {
                document.getElementById('profileForm').reset();
            }
        });
        
        // Notification function
        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium z-50 transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-2"></i>
                ${message}
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
        
        // Add focus styles to all inputs
        document.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('input-focus');
            });
            
            input.addEventListener('blur', function() {
                this.classList.remove('input-focus');
            });
        });
    </script>
    </div>
@endlayout