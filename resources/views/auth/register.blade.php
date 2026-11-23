@extends('layouts.app')

@section('title', 'Register')


{{-- <div class="flex flex-col justify-center items-center h-screen"> --}}

<h1 class=" text-2xl mx-10 text-center my-10">Register</h1>


{{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-disc list-inside text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif --}}

<form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data"
    class="max-w-5xl border border-default rounded-base shadow-xs mx-auto px-6 mt-10">
    @csrf

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
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
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

    <!-- Profile Photo -->
    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-heading" for="profile_photo">Profile photo (optional)</label>
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
        class="text-white mb-8 bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-5 py-2.5 px-10 focus:outline-none">
        Submit
    </button>
</form>

{{-- </div> --}}
