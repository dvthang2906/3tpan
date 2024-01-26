<footer class="text-white" style="background-color: #4D9BC1">
    <div class="max-w-screen-xl py-8 px-2 sm:px-4 lg:px-6 flex flex-col xl:flex-row justify-between">
        <div class="space-y-4 mb-4 xl:mb-0">
            <img class="h-24" src="{{ asset('images/logo3.png') }}" alt="Company Logo">
            <!-- Kích thước logo giảm xuống -->
            <p class="text-black text-base">
                あなたの日本語力成長を加速するトップテクノロジーソリューションを提供します。
            </p>
        </div>
        <div class="flex flex-col sm:flex-row justify-end">
            <div class="mb-4 sm:mr-4">
                <h4 class="text-sm leading-5 font-semibold tracking-wider text-black uppercase">
                    連絡先
                </h4>
                <ul class="mt-2 space-y-2">
                    <li>
                        <a href="{{ route('about') }}" class="text-base text-black hover:text-white">
                            サポートチーム
                        </a>
                    </li>
                    <!-- More links -->
                </ul>
            </div>
            <div>
                <h4 class="text-sm leading-5 font-semibold tracking-wider text-black uppercase">
                    サポートセンター
                </h4>
                <ul class="mt-2 space-y-2">
                    <li>
                        <a href="{{ route('contact') }}" class="text-base text-black hover:text-white">
                            ヘルプセンター
                        </a>
                    </li>
                    <!-- More links -->
                </ul>
            </div>
        </div>
    </div>
</footer>
