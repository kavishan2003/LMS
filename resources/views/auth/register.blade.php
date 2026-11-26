@extends('layouts.app')

@section('title', 'Register')

<h1 class=" text-2xl mx-10 text-center my-20">Register</h1>

<form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data"
    class="max-w-5xl border border-default rounded-base shadow-xs mx-auto my-10 px-6 mt-10">
    @csrf
    <h1 class="text-xl mt-5 font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
        Create an account
    </h1>

    <!-- Full Name -->
    <div class="mb-6 mt-6">
        <label for="full_name" class="block mb-2 text-sm font-medium text-heading">Full name</label>
        <input type="text" name="name" id="full_name" value="{{ old('name') }}"
            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
            placeholder="Ex : Herath Mudiyanselage Kavidu" />
        @error('name')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-heading">Email address</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"
            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
            placeholder="kavidu@example.com" />
        @error('email')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Grid Section: Phone, DOB, Gender, Role -->
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <!-- Phone Number -->
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-heading">Phone number</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                placeholder="0771234567" />
            @error('phone')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date of Birth (DOB) -->
        <div>
            <label for="dob" class="block mb-2 text-sm font-medium text-heading">Date of birth</label>
            <input type="date" name="dob" id="dob" value="{{ old('dob') }}"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" />
            @error('dob')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gender Selection -->
        <div>
            <label for="gender" class="block mb-2 text-sm font-medium text-heading">Gender</label>
            <select name="gender" id="gender"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role Selection (Teacher / Student) -->
        <div>
            <label for="role" class="block mb-2 text-sm font-medium text-heading">Role</label>
            <select name="role" id="role"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select role</option>
                <option value="Student" {{ old('role') == 'Student' ? 'selected' : '' }}>Student</option>
                <option value="Teacher" {{ old('role') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
            </select>
            @error('role')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Grid Section: Password & Confirm Password -->
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <!-- Password -->
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-heading">Password</label>
            <input type="password" name="password" id="password"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                placeholder="•••••••••" />
            @error('password')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-heading">Confirm
                password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                placeholder="•••••••••" />
            @error('password_confirmation')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Password Strength Indicator (Theme Matched) -->
    <div id="password-strength-box"
        class="mb-6 p-3.5 bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs hidden">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-heading">Password strength</span>
            <span id="strength-label" class="text-xs font-semibold text-body">Weak</span>
        </div>

        <!-- 4-Segment Progress Bar -->
        <div class="grid grid-cols-4 gap-2 mb-3">
            <div id="bar-1" class="h-1.5 rounded-full bg-gray-300 transition-colors duration-300"></div>
            <div id="bar-2" class="h-1.5 rounded-full bg-gray-300 transition-colors duration-300"></div>
            <div id="bar-3" class="h-1.5 rounded-full bg-gray-300 transition-colors duration-300"></div>
            <div id="bar-4" class="h-1.5 rounded-full bg-gray-300 transition-colors duration-300"></div>
        </div>

        <!-- Requirements Checklist -->
        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 text-xs text-body">
            <li id="req-length" class="flex items-center gap-1.5">
                <span class="dot w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                At least 8 characters
            </li>
            <li id="req-upper" class="flex items-center gap-1.5">
                <span class="dot w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                One uppercase letter (A-Z)
            </li>
            <li id="req-number" class="flex items-center gap-1.5">
                <span class="dot w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                One number (0-9)
            </li>
            <li id="req-special" class="flex items-center gap-1.5">
                <span class="dot w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                One special character (!@#$...)
            </li>
        </ul>
    </div>

    <!-- Profile Photo -->
    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-heading" for="profile_photo">Profile photo
            (optional)</label>
        <input name="profile_photo" id="profile_photo" type="file" accept="image/*"
            class="cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2 shadow-xs placeholder:text-body"
            aria-describedby="file_input_help">
        <p class="mt-1 text-xs text-body" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
        @error('profile_photo')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Login Link -->
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm font-medium text-heading">
            Already have an account?
            <a href="{{ route('login') }}" class="text-fg-brand underline hover:underline">Login here</a>.
        </p>
    </div>

    <!-- Submit Button -->
    <button type="submit"
        class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none w-full mb-3">
        Create an account
    </button>

</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const strengthBox = document.getElementById('password-strength-box');
        const strengthLabel = document.getElementById('strength-label');
        const matchMsg = document.getElementById('password-match-msg');

        const bars = [
            document.getElementById('bar-1'),
            document.getElementById('bar-2'),
            document.getElementById('bar-3'),
            document.getElementById('bar-4')
        ];

        const requirements = {
            length: {
                el: document.getElementById('req-length'),
                regex: /.{8,}/
            },
            upper: {
                el: document.getElementById('req-upper'),
                regex: /[A-Z]/
            },
            number: {
                el: document.getElementById('req-number'),
                regex: /[0-9]/
            },
            special: {
                el: document.getElementById('req-special'),
                regex: /[^A-Za-z0-9]/
            }
        };

        passwordInput.addEventListener('input', function() {
            const val = passwordInput.value;

            // Password type කරන්න පටන් ගත්තම විතරක් box එක පෙන්නනවා
            if (val.length > 0) {
                strengthBox.classList.remove('hidden');
            } else {
                strengthBox.classList.add('hidden');
            }

            let score = 0;

            // එක් එක් condition එක check කිරීම
            for (const key in requirements) {
                const item = requirements[key];
                const dot = item.el.querySelector('.dot');

                if (item.regex.test(val)) {
                    score++;
                    item.el.classList.remove('text-body');
                    item.el.classList.add('text-green-600', 'font-medium');
                    dot.classList.remove('bg-gray-400');
                    dot.classList.add('bg-green-600');
                } else {
                    item.el.classList.add('text-body');
                    item.el.classList.remove('text-green-600', 'font-medium');
                    dot.classList.add('bg-gray-400');
                    dot.classList.remove('bg-green-600');
                }
            }

            // Strength level එක අනුව පාට සහ label එක වෙනස් කිරීම
            const levels = [{
                    label: 'Very Weak',
                    color: 'bg-red-500',
                    text: 'text-red-600'
                },
                {
                    label: 'Weak',
                    color: 'bg-red-500',
                    text: 'text-red-600'
                },
                {
                    label: 'Fair',
                    color: 'bg-yellow-400',
                    text: 'text-yellow-600'
                },
                {
                    label: 'Good',
                    color: 'bg-blue-500',
                    text: 'text-blue-600'
                },
                {
                    label: 'Strong',
                    color: 'bg-green-500',
                    text: 'text-green-600'
                }
            ];

            const current = levels[score];
            strengthLabel.textContent = current.label;
            strengthLabel.className = `text-xs font-semibold ${current.text}`;

            bars.forEach((bar, index) => {
                bar.className = 'h-1.5 rounded-full transition-colors duration-300';
                if (index < score) {
                    bar.classList.add(current.color);
                } else {
                    bar.classList.add('bg-gray-300');
                }
            });

            checkPasswordMatch();
        });

        // Confirm password එක ගැලපෙනවද කියලා real-time check කිරීම
        confirmInput.addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const pass = passwordInput.value;
            const confirm = confirmInput.value;

            if (confirm.length === 0) {
                matchMsg.classList.add('hidden');
                return;
            }

            matchMsg.classList.remove('hidden');
            if (pass === confirm) {
                matchMsg.textContent = '✓ Passwords match';
                matchMsg.className = 'mt-1.5 text-xs text-green-600 font-medium';
            } else {
                matchMsg.textContent = '✗ Passwords do not match';
                matchMsg.className = 'mt-1.5 text-xs text-red-600 font-medium';
            }
        }
    });
</script>
