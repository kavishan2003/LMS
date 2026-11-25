@extends('layouts.app')

@section('title', 'Login')

<div class="flex flex-col justify-center items-center h-screen">
    <div class="">

    </div>
    {{-- <a href="#" class="flex justify-center max-w-7xl ms-2 md:me-40">
        <i class="fa-solid fa-graduation-cap text-2xl" style="color: rgb(177, 151, 252);"></i>
        <span class="text-center text-3xl text-blue-900 font-semibold md:flex hidden">LEARNMS</span>
    </a> --}}
    <h1 class=" text-2xl mx-10">Login</h1>

    <div class="w-full max-w-xl mt-10 bg-neutral-primary-soft p-6 border border-default rounded-base shadow-xs">
        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <h5 class="text-xl font-semibold text-heading mb-6">Sign in to our platform</h5>
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-heading">Your email</label>
                <input type="email" name="email" id="email"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="example@company.com" />
                @error('email')
                    <span class="text-red-600 block text-sm my-3">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block mb-2.5 text-sm font-medium text-heading">Your password</label>
                <input type="password" name="password" id="password"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="•••••••••" />
                @error('password')
                    <span class="text-red-600 block text-sm my-3 ">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-start my-6">
                <div class="flex items-center">
                    <input id="checkbox-remember" type="checkbox" value=""
                        class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                    <label for="checkbox-remember" class="ms-2 text-sm font-medium text-heading">Remember me</label>
                </div>
                <a href="#" class="ms-auto text-sm font-medium text-fg-brand hover:underline">Lost Password?</a>
            </div>
            <button type="submit"
                class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none w-full mb-3">Login
                to your account
            </button>
            <div class="text-sm font-medium text-body">Not registered? <a href="{{ route('register') }}"
                    class="text-fg-brand hover:underline">Create account</a></div>
        </form>
    </div>

</div>
