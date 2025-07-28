    <footer class="bg-gray-800 text-gray-300 text-sm py-4">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    <div class="text-white mb-2">
                        <h3 class="text-xl font-bold">VNTECH <span class="text-blue-400">SERVICES</span></h3>
                        <p class="text-xs"><?= esc($config->website_intro ?? '') ?></p>
                    </div>
                    <p class="text-xs">Địa chỉ: <?= esc($config->address ?? '') ?></p>
                    </div>

                <div class="flex items-center space-x-6 text-center md:text-right">
                    <div class="mr-4">
                        <a href="<?= esc($config->youtube ?? '') ?>" class="hover:text-red-500">
                            <svg class="w-10 h-10 inline-block" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.78 22 12 22 12s0 3.22-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.594.418-7.814.418-7.814.418s-6.22 0-7.814-.418a2.505 2.505 0 0 1-1.768-1.768C2 15.22 2 12 2 12s0-3.22.418-4.814a2.505 2.505 0 0 1 1.768-1.768C5.78 2 12 2 12 2s6.22 0 7.812.418ZM9.545 15.568V8.432L15.818 12l-6.273 3.568Z" clip-rule="evenodd" />
                            </svg>
                            <span class="block text-xs">You Tube</span>
                        </a>
                    </div>
                    <div class="text-xs">
                        <p>Email: <a href="mailto:<?= esc($config->email ?? '') ?>" class="hover:text-blue-400"><?= esc($config->email ?? '') ?></a></p>
                        <p>Homepage: <a href="http://<?= esc($config->domain ?? '') ?>" target="_blank" class="hover:text-blue-400"><?= esc($config->domain ?? '') ?></a></p>
                    </div>
                </div>
            </div>
          <!--   <div class="border-t border-gray-700 mt-6 pt-4 text-center text-xs text-gray-500">
                <p>&copy; <script>document.write(new Date().getFullYear())</script> <?= esc($config->website_name ?? '') ?>. All Rights Reserved.</p>
            </div> -->
        </div>
    </footer>