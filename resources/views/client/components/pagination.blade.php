<div>
    <!--[if BLOCK]><![endif]-->        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    <!--[if BLOCK]><![endif]-->                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                            « Previous
                        </span>
                    <!--[if ENDBLOCK]><![endif]-->
                </span>

                <span>
                    <!--[if BLOCK]><![endif]-->                        <button type="button" wire:click="nextPage('page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" wire:loading.attr="disabled" dusk="nextPage.before" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                            Next »
                        </button>
                    <!--[if ENDBLOCK]><![endif]-->
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm leading-5 text-gray-700 dark:text-gray-400">
                        <span>Showing</span>
                        <span class="font-medium">1</span>
                        <span>to</span>
                        <span class="font-medium">1</span>
                        <span>of</span>
                        <span class="font-medium">3</span>
                        <span>results</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rounded-md shadow-sm rtl:flex-row-reverse">
                        <span>

                            <!--[if BLOCK]><![endif]-->                                <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </span>
                            <!--[if ENDBLOCK]><![endif]-->
                        </span>


                        <!--[if BLOCK]><![endif]-->
                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->


                            <!--[if BLOCK]><![endif]-->                                <!--[if BLOCK]><![endif]-->                                    <span wire:key="paginator-page-page1">
                                        <!--[if BLOCK]><![endif]-->                                            <span aria-current="page">
                                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 cursor-default dark:bg-gray-800 dark:border-gray-600">1</span>
                                            </span>
                                        <!--[if ENDBLOCK]><![endif]-->
                                    </span>
                                                                    <span wire:key="paginator-page-page2">
                                        <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(2, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 2">
                                                2
                                            </button>
                                        <!--[if ENDBLOCK]><![endif]-->
                                    </span>
                                                                    <span wire:key="paginator-page-page3">
                                        <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(3, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 3">
                                                3
                                            </button>
                                        <!--[if ENDBLOCK]><![endif]-->
                                    </span>
                                <!--[if ENDBLOCK]><![endif]-->
                            <!--[if ENDBLOCK]><![endif]-->
                        <!--[if ENDBLOCK]><![endif]-->

                        <span>

                            <!--[if BLOCK]><![endif]-->                                <button type="button" wire:click="nextPage('page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" dusk="nextPage.after" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-r-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Next &amp;raquo;">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            <!--[if ENDBLOCK]><![endif]-->
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    <!--[if ENDBLOCK]><![endif]-->
</div>
