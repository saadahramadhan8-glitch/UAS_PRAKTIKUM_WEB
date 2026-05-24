<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-2xl text-slate-800 leading-tight">

                Profile Saya

            </h2>

            {{-- BACK BUTTON --}}
            <a
                href="/dashboard"
                class="
                    px-5 py-2 rounded-xl
                    bg-slate-200 hover:bg-slate-300
                    text-slate-700 font-medium
                    transition
                "
            >

                ← Kembali

            </a>

        </div>

    </x-slot>

    <div class="py-10 bg-slate-100 min-h-screen">

        <div class="max-w-6xl mx-auto px-4 space-y-8">

            {{-- PROFILE HEADER --}}
            <div
                class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8"
            >

                <div class="flex flex-col md:flex-row items-center gap-6">

                    {{-- AVATAR --}}
                    <div
                        class="
                            w-24 h-24 rounded-full
                            bg-emerald-500 text-white
                            flex items-center justify-center
                            text-4xl font-bold
                        "
                    >

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                    {{-- INFO --}}
                    <div>

                        <h1 class="text-3xl font-bold text-slate-800">

                            {{ auth()->user()->name }}

                        </h1>

                        <p class="text-slate-500 mt-1">

                            {{ auth()->user()->email }}

                        </p>

                        {{-- ROLE --}}
                        <div class="mt-3">

                            <span
                                class="
                                    px-4 py-2 rounded-full
                                    bg-emerald-100 text-emerald-700
                                    text-sm font-semibold
                                "
                            >

                                {{ ucfirst(auth()->user()->role) }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

            {{-- UPDATE PROFILE --}}
            <div
                class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8"
            >

                <div class="max-w-3xl">

                    <h2 class="text-2xl font-bold text-slate-800 mb-2">

                        Informasi Profile

                    </h2>

                    <p class="text-slate-500 mb-8">

                        Update informasi akun dan email kamu.

                    </p>

                    @include('profile.partials.update-profile-information-form')

                </div>

            </div>

            {{-- UPDATE PASSWORD --}}
            <div
                class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8"
            >

                <div class="max-w-3xl">

                    <h2 class="text-2xl font-bold text-slate-800 mb-2">

                        Ubah Password

                    </h2>

                    <p class="text-slate-500 mb-8">

                        Gunakan password yang kuat agar akun lebih aman.

                    </p>

                    @include('profile.partials.update-password-form')

                </div>

            </div>

            {{-- DELETE ACCOUNT --}}
            <div
                class="bg-white rounded-3xl shadow-sm border border-red-200 p-8"
            >

                <div class="max-w-3xl">

                    <h2 class="text-2xl font-bold text-red-500 mb-2">

                        Hapus Akun

                    </h2>

                    <p class="text-slate-500 mb-8">

                        Setelah akun dihapus, semua data akan hilang permanen.

                    </p>

                    @include('profile.partials.delete-user-form')

                </div>

            </div>

        </div>

    </div>

</x-app-layout>