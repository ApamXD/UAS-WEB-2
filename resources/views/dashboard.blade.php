<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Profile Header Card -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <!-- Top accent bar -->
                <div style="height:4px; background: linear-gradient(to right, #D4AF37, #F5E27A, #D4AF37);"></div>
                <div class="p-8">
                    <div class="flex items-center gap-6">
                        <!-- Avatar -->
                        <div class="flex-shrink-0 w-20 h-20 rounded-full flex items-center justify-center shadow-lg"
                             style="background: linear-gradient(135deg, #D4AF37, #f0c040);">
                            <span class="text-3xl font-extrabold text-gray-900">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <!-- Info -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ Auth::user()->name }}
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 mt-0.5">
                                {{ Auth::user()->email }}
                            </p>
                            <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                                  style="background: rgba(212,175,55,0.15); color: #D4AF37; border: 1px solid rgba(212,175,55,0.4);">
                                {{ Auth::user()->role ?? 'admin' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Info -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h4 class="text-base font-semibold uppercase tracking-wider text-gray-400 mb-6"
                        style="border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 12px;">
                        Informasi Akun
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nama Lengkap -->
                        <div class="p-5 rounded-lg dark:bg-gray-700/50 bg-gray-50">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Nama Lengkap</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        </div>
                        <!-- Email -->
                        <div class="p-5 rounded-lg dark:bg-gray-700/50 bg-gray-50">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Alamat Email</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ Auth::user()->email }}</p>
                        </div>
                        <!-- Akun Dibuat -->
                        <div class="p-5 rounded-lg dark:bg-gray-700/50 bg-gray-50">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Akun Dibuat</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ Auth::user()->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                        <!-- Status Verifikasi -->
                        <div class="p-5 rounded-lg dark:bg-gray-700/50 bg-gray-50">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Status Verifikasi</p>
                            @if(Auth::user()->email_verified_at)
                                <p class="text-base font-semibold" style="color: #22c55e;">✓ Terverifikasi</p>
                            @else
                                <p class="text-base font-semibold" style="color: #ef4444;">✗ Belum Terverifikasi</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h4 class="text-base font-semibold uppercase tracking-wider text-gray-400 mb-6"
                        style="border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 12px;">
                        Pengaturan Akun
                    </h4>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex items-center gap-2 font-bold px-5 py-3 rounded-lg transition-all"
                           style="background:#D4AF37; color:#111;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Profil
                        </a>
                        <a href="{{ route('admin.cars.index') }}"
                           class="inline-flex items-center gap-2 font-bold px-5 py-3 rounded-lg transition-all dark:bg-gray-700 bg-gray-200 dark:text-white text-gray-900 dark:hover:bg-gray-600 hover:bg-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Kelola Inventaris
                        </a>
                        <a href="{{ route('front.home') }}"
                           class="inline-flex items-center gap-2 font-bold px-5 py-3 rounded-lg transition-all dark:bg-gray-700 bg-gray-200 dark:text-white text-gray-900 dark:hover:bg-gray-600 hover:bg-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Lihat Website
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
