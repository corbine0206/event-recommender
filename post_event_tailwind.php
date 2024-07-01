<!DOCTYPE>
<html>
    <head>
        <title>Demand Gen</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="/tailwind.config.js"></script>
    </head>
        
    </head>
   
    <body class="transition-colors duration-300 ease-in-out dark:bg-gray-800" id="body">
        
        <!-- Sidebar -->
        <?php include 'sidebar_tailwind.php'; ?>
        
        <!-- Events -->
        <section class="p-4 sm:ml-64 ">
            <h2 class="mb-4 text-2xl tracking-tight font-bold text-gray-900 dark:text-white">Post Event</h2>
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                <!-- TABLE -->
                <div class="mb-6">
                    <button id="toggleTable" class="w-full px-4 py-2 font-bold text-left text-gray-900 bg-gray-200 rounded dark:bg-gray-800 dark:text-white focus:outline-none">
                        Event Name
                        <span id="toggleIcon" class="float-right">▼</span>
                    </button>
                
                    <div id="collapsibleTable" class="overflow-x-auto mt-2 hidden">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Participant</th>
                                    <th scope="col" class="px-4 py-3">Attended Sessions</th>
                                    <th scope="col" class="px-4 py-3">Recommended Products</th>
                                    <th scope="col" class="px-4 py-3">Comments</th>
                                    <th scope="col" class="px-4 py-3">Suggestions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">Participant</td>
                                    <!-- Attended Sessions -->
                                    <td class="px-4 py-3">
                                        <!-- Session 1 -->
                                        <div class="absolute py-1 top-7 content-center sm:relative sm:right-auto sm:top-auto">
                                            <span class="inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                                Attended Session 1
                                            </span>
                                        </div>
                                        <!-- Session 2 -->
                                        <div class="absolute py-1 right-0 top-7 content-center sm:relative sm:right-auto sm:top-auto">
                                            <span class="inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                                Attended Session 2
                                            </span>
                                        </div>
                                        <!-- Session 3 -->
                                        <div class="absolute py-1 right-0 top-7 content-center sm:relative sm:right-auto sm:top-auto">
                                            <span class="inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                                Attended Session 3
                                            </span>
                                        </div>
                                    </td>
                                    <!-- Recommended Products -->
                                    <td class="px-4 py-3">
                                        <!-- Product 1 -->
                                        <div class="absolute py-1 right-0 top-7 content-center sm:relative sm:right-auto sm:top-auto">
                                            <span class="inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                Recommended Prodcut 1
                                            </span>
                                        </div>
                                        <!-- Product 2 -->
                                        <div class="absolute py-1 right-0 top-7 content-center sm:relative sm:right-auto sm:top-auto">
                                            <span class="inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                Recommended Prodcut 2
                                            </span>
                                        </div>
                                        <!-- Product 3 -->
                                        <div class="absolute py-1 right-0 top-7 content-center sm:relative sm:right-auto sm:top-auto">
                                            <span class="inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                Recommended Prodcut 3
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">Comments</td>
                                    <td class="px-4 py-3">Suggestions</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PAGINATION -->
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </body>
    <script>
        document.getElementById('toggleTable').addEventListener('click', function() {
            const table = document.getElementById('collapsibleTable');
            const icon = document.getElementById('toggleIcon');
            if (table.classList.contains('hidden')) {
                table.classList.remove('hidden');
                icon.textContent = '▲';
            } else {
                table.classList.add('hidden');
                icon.textContent = '▼';
            }
        });
    </script>
</html>
