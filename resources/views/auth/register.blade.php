<x-app-layout title="Register">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8 relative overflow-hidden">
        <!-- Subtle background accents -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-cyan-100 to-transparent rounded-full blur-3xl opacity-30 -z-10"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-blue-100 to-transparent rounded-full blur-3xl opacity-30 -z-10"></div>

        <div class="w-full max-w-2xl relative z-10">
            <!-- Header -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-600 shadow-lg mb-5 ring-4 ring-blue-100">
                    <span class="text-3xl font-black text-white">BT</span>
                </div>
                <h1 class="text-4xl font-black text-slate-900 mb-3">Join Us Today</h1>
                <p class="text-slate-600 text-lg">Start your Bangladesh travel adventure</p>
            </div>

            <!-- Form Container -->
            <div class="bg-slate-200 rounded-2xl shadow-xl border border-slate-300 overflow-hidden backdrop-blur-sm">
                <!-- Form Header Accent Bar -->
                <div class="h-2 bg-gradient-to-r from-blue-500 via-cyan-500 to-blue-500"></div>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="p-8 space-y-6">
    @csrf
                    <!-- Name Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="firstName" class="block text-sm font-bold text-slate-800 mb-3">First Name</label>
                            <input type="text" id="firstName" name="firstName" required placeholder="John" class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-slate-500 text-slate-900 font-medium hover:border-slate-400">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-bold text-slate-800 mb-3">Last Name</label>
                            <input type="text" id="lastName" name="lastName" required placeholder="Doe" class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-slate-500 text-slate-900 font-medium hover:border-slate-400">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-800 mb-3">Email Address</label>
                        <input type="email" id="email" name="email" required placeholder="you@example.com" class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-slate-500 text-slate-900 font-medium hover:border-slate-400">
                    </div>

                    <!-- Password Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-800 mb-3">Password</label>
                            <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-slate-500 text-slate-900 font-medium hover:border-slate-400">
                        </div>
                        <div>
                            <label for="confirmPassword" class="block text-sm font-bold text-slate-800 mb-3">Confirm Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="••••••••" class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-slate-500 text-slate-900 font-medium hover:border-slate-400">
                        </div>
                    </div>

                    <!-- Phone & DOB -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block text-sm font-bold text-slate-800 mb-3">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required placeholder="+880 1..." class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-slate-500 text-slate-900 font-medium hover:border-slate-400">
                        </div>
                        <div>
                            <label for="dob" class="block text-sm font-bold text-slate-800 mb-3">Date of Birth</label>
                            <input type="date" id="dob" name="dob" required class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-900 font-medium hover:border-slate-400">
                        </div>
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-bold text-slate-800 mb-3">Username</label>
                        <input type="text" id="username" name="username" required placeholder="Choose your unique username" class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-slate-500 text-slate-900 font-medium hover:border-slate-400">
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-bold text-slate-800 mb-3">Bio <span class="text-red-500">*</span> <span class="text-xs font-normal text-slate-600">(Min 50 words)</span></label>
                        <textarea id="bio" name="bio" minlength="50" required placeholder="Tell us about yourself and your travel interests..." class="w-full px-5 py-3 border-2 border-slate-300 rounded-xl bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-slate-500 text-slate-900 font-medium min-h-28 resize-none hover:border-slate-400"></textarea>
                    </div>

                    <!-- Profile Picture -->
                    <div>
                        <label for="profilePic" class="block text-sm font-bold text-slate-800 mb-3">Profile Picture</label>
                        <input type="file" id="profilePic" name="profilePic" accept="image/*" required class="hidden" onchange="updateFileName(this)">
                        <label for="profilePic" class="flex flex-col items-center justify-center w-full px-6 py-10 border-2 border-dashed border-slate-400 rounded-2xl cursor-pointer hover:border-blue-500 hover:bg-blue-100 transition-all group bg-white">
                            <div class="text-center">
                                <div class="text-5xl mb-3 group-hover:scale-110 transition-transform duration-200">📸</div>
                                <p class="text-sm font-bold text-slate-700">Click to upload or drag & drop</p>
                                <p class="text-xs text-slate-600 mt-1">PNG, JPG, GIF (max 10MB)</p>
                            </div>
                        </label>
                        <p id="fileName" class="text-xs text-slate-600 mt-3">No file chosen</p>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full mt-8 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold py-3 rounded-xl hover:from-blue-700 hover:to-cyan-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95">
                        Create Account
                    </button>

                    <!-- Info -->
                    <div class="text-center pt-4 border-t border-slate-200">
                        <p class="text-xs text-slate-600">Takes less than 2 minutes ⚡</p>
                    </div>
                </form>
            </div>

            <!-- Trust Section -->
            <div class="mt-8 bg-white/70 backdrop-blur-sm rounded-xl p-6 border border-slate-200 text-center">
                <p class="text-xs font-bold text-slate-700 mb-4 uppercase tracking-widest">Trusted by travelers</p>
                <div class="flex justify-around items-center">
                    <div>
                        <p class="text-xl font-black text-blue-600">10K+</p>
                        <p class="text-xs text-slate-600 font-semibold">Members</p>
                    </div>
                    <div class="h-10 w-px bg-slate-300"></div>
                    <div>
                        <p class="text-xl font-black text-cyan-600">50+</p>
                        <p class="text-xs text-slate-600 font-semibold">Destinations</p>
                    </div>
                    <div class="h-10 w-px bg-slate-300"></div>
                    <div>
                        <p class="text-xl font-black text-blue-600">⭐ 4.8</p>
                        <p class="text-xs text-slate-600 font-semibold">Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileName = document.getElementById('fileName');
            if (input.files && input.files[0]) {
                fileName.textContent = '✓ ' + input.files[0].name;
                fileName.classList.add('text-green-600', 'font-semibold');
            }
        }

        const fileInput = document.getElementById('profilePic');
        const fileLabel = fileInput.parentElement;
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => fileLabel.addEventListener(e, e => e.preventDefault()));
        ['dragenter', 'dragover'].forEach(e => fileLabel.addEventListener(e, () => fileLabel.classList.add('border-blue-500', 'bg-blue-50')));
        ['dragleave', 'drop'].forEach(e => fileLabel.addEventListener(e, () => fileLabel.classList.remove('border-blue-500', 'bg-blue-50')));
        fileLabel.addEventListener('drop', (e) => { fileInput.files = e.dataTransfer.files; updateFileName(fileInput); });
    </script>
</x-app-layout>