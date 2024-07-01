<?php
    session_start();
    include 'connection.php';
    date_default_timezone_set('Asia/Manila');
    $user_id = $_SESSION['user_id'];

    // Function to get event session titles, dates, and times for a specific event
    function getEventSessionsInfo($connection, $event_id) {
        $sessionsInfo = array();
        $sql = "SELECT DISTINCT session_title, date, timeam, timepm FROM event_sessions WHERE event_id = '$event_id'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sessionsInfo[] = $row;
            }
        }
        return $sessionsInfo;
    }
?>
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
            <h2 class="mb-4 text-2xl tracking-tight font-bold text-gray-900 dark:text-white">Events</h2>
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/2">
                    <p class="text-xl font-semibold text-gray-800 mb-4">Confirm Delete</p>
                    <p class="text-gray-700 mb-4">Are you sure you want to delete this event?</p>
                    <div class="flex justify-end">
                        <button id="cancelDelete" class="mr-4 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 focus:outline-none">Cancel</button>
                        <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none">Delete</button>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/2">
                    <p class="text-xl font-semibold text-gray-800 mb-4">Edit Session</p>
                    <div class="mb-6">
                        <!-- Event Title -->
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Title</label>
                        <input type="text" id="default-input" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <!-- Session -->
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Session</label>
                        <input type="text" id="default-input" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <!-- Date -->
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                        <input type="text" id="default-input" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <!-- Time 1 -->
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time 1</label>
                        <input type="text" id="default-input" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <!-- Time 2 -->
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time 2</label>
                        <input type="text" id="default-input" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    
                        
                    </div><div class="flex justify-end">
                        <button id="cancelEdit" class="mr-4 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 focus:outline-none">Cancel</button>
                        <button id="saveEdit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none">Save Changes</button>
                    </div>
                </div>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Event Name</th>
                            <th scope="col" class="px-4 py-3">Session</th>
                            <th scope="col" class="px-4 py-3">Date</th>
                            <th scope="col" class="px-4 py-3">Time 1</th>
                            <th scope="col" class="px-4 py-3">Time 2</th>
                            <th scope="col" class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through events -->
                        <?php
                        $con = openConnection();
                        $strSql = "SELECT * FROM events WHERE user_id = '$user_id' AND event_status != 0 ORDER BY event_id DESC";
                        $events = getRecord($con, $strSql);
                        
                        foreach ($events as $event) {
                            $event_id = $event['event_id'];
                            $event_title = $event['event_title'];
                            
                            // Fetch event sessions for the current event
                            $eventSessions = getEventSessionsInfo($con, $event_id);
                            
                            // Display event row with event title and delete button
                            echo '<tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white align-top" rowspan="' . (count($eventSessions) + 1) . '">
                                        <div class="flex items-center">
                                            <!-- Delete Icon for event-->
                                            <button type="button" onclick="openDeleteModal()" class="ml-2 mr-2 text-red-600 hover:text-red-700 focus:outline-none">
                                                <svg fill="#ff1b00" height="10px" width="10px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 460.775 460.775" xml:space="preserve" stroke="#ff1b00"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55 c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55 c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505 c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55 l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719 c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"></path> </g></svg>
                                            </button>
                                            <span>' . $event_title . '</span>
                                        </div>
                                    </th>';
                            
                            // Loop through event sessions
                            foreach ($eventSessions as $session) {
                                $session_title = $session['session_title'];
                                $date = $session['date'];
                                $time_am = $session['timeam'];
                                $time_pm = $session['timepm'];
                                
                                // Display session details
                                echo '<td class="px-4 py-3">' . $session_title . '</td>
                                        <td class="px-4 py-3">' . $date . '</td>
                                        <td class="px-4 py-3">' . $time_am . '</td>
                                        <td class="px-4 py-3">' . $time_pm . '</td>
                                        <td class="px-4 py-3">
                                            <!-- Edit Button -->
                                            <button type="button" onclick="openEditModal()" class="w-full rounded-lg border border-orange-400 px-3 py-1 text-center text-sm font-medium text-orange-400 hover:bg-orange-400 hover:text-white focus:outline-none focus:ring-4 focus:ring-orange-300 dark:border-orange-400 dark:text-orange-400 dark:hover:bg-orange-400 dark:hover:text-white dark:focus:ring-orange-900 lg:w-auto">Edit</button>
                                            <!-- Delete Button -->
                                            <button type="button" onclick="openDeleteModal()" class="w-full rounded-lg border border-red-700 px-3 py-1 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900 lg:w-auto">Delete</button>
                                        </td>
                                    </tr>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>

                    
                </table>
            </div>

            <!-- PAGINATION -->
            <!-- <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
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
            </nav> -->
            </div>
        </section>

        
    </body>
</html>


<script>
    // Functions to open/close modals
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Event listeners for cancel and confirm actions
    document.getElementById('cancelDelete').addEventListener('click', function() {
        closeDeleteModal();
    });

    document.getElementById('confirmDelete').addEventListener('click', function() {
        // Add logic to handle delete action
        closeDeleteModal();
    });

    document.getElementById('cancelEdit').addEventListener('click', function() {
        closeEditModal();
    });

    document.getElementById('saveEdit').addEventListener('click', function() {
        // Add logic to handle save edit action
        closeEditModal();
    });
</script>

                