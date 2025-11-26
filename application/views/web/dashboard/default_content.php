<div class="w-full p-4">
    <?php if (empty($default)) { ?>
        <div class="flex justify-center items-center h-64 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
            <p class="text-red-500 text-2xl font-semibold">Coming Soon...</p>
        </div>
    <?php } else { ?>
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md overflow-hidden p-4 overflow-x-auto">
            <table id="resourcesTable" class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 dark:text-white uppercase bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 font-semibold">Book</th>
                        <th class="px-4 sm:px-6 py-3 font-semibold">Title</th>
                        <th class="px-4 sm:px-6 py-3 font-semibold">Class</th>
                        <th class="px-4 sm:px-6 py-3 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($default as $def) { ?>
                        <tr class="bg-white hover:bg-gray-50 dark:bg-gray-900 hover:dark:bg-gray-800 transition-colors duration-200">
                            <td class="px-4 sm:px-6 py-4">
                                <div class="h-20 w-16 flex-shrink-0">
                                    <img class="h-full w-full object-cover rounded shadow-sm border border-gray-200"
                                         src="<?= empty($def->book_image) ? 'assets/img/3.png' : "assets/bookicon/{$def->book_image}" ?>"
                                         alt="Book Cover">
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                <div class="text-base font-medium text-gray-900 dark:text-white"><?= $def->title ?></div>
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs text-center font-medium bg-blue-100 text-blue-800">
                                    <?= $this->session->userdata('class_name') ?>
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                <div class="flex flex-col sm:flex-row gap-2 justify-center items-center">
                                    <a href="<?= base_url("analytics/download_websupport/{$def->id}") ?>"
                                       target="_blank"
                                       class="inline-flex items-center px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-all shadow-sm">
                                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Download
                                    </a>

                                    <?php if ($is_test_paper_gen) { ?>
                                        <a href="<?= base_url('query/teacher-question') ?>"
                                           target="_blank"
                                           class="inline-flex items-center px-3 py-2 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 transition-all shadow-sm">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Ask Question
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
