<?php
// Flash Messages
$this->load->view('web/dashboard/flash_messages');

// Get user data once
$userdata = $this->session->userdata();
$user_id = $userdata['user_id'] ?? null;
$user_type = $userdata['type'] ?? null;
$is_special_user = in_array($user_id, [222, 246]);
$category_name = $this->session->userdata('category_name');
$is_online_tpg = ($category_name === 'Online TPG');
$is_test_paper_gen = ($category_name === 'Test Paper Generator');
?>

<main class="container mx-auto min-h-[calc(100vh-4rem)]">
    <?php $this->load->view('web/dashboard/breadcrumb'); ?>
    <?php if ($is_special_user) { ?>
        <?php $this->load->view('web/dashboard/user_section_button', ['user_type' => $user_type]); ?>
    <?php } ?>

    <!-- Search Form -->
    <?php $this->load->view('web/dashboard/search_form', [
        'publication' => $publication,
        'selectable_subjects' => $selectable_subjects,
        'selectable_classes' => $selectable_classes,
        'selectable_books' => $selectable_books,
    ]); ?>


    <!--<div class="m-0 mx-4 flex flex-col md:flex-row justify-center gap-4">-->
        <!-- Sidebar Categories -->
        <div class="py-3 flex justify-center w-full">
            <?php $this->load->view('web/dashboard/category_sidebar', [
                'categories' => $user_type === 'Teacher' ? $selectable_categories : $category,
                'user_type' => $user_type,
            ]); ?>
        </div>

        <!-- Main Content Area -->
        <div class="p-0 m-0 flex justify-center w-full">
            <?php if ($is_online_tpg) { ?>
                <?php $this->load->view('web/dashboard/online_tpg_content', ['online_tpgs' => $online_tpgs]); ?>
            <?php } else { ?>
                <?php $this->load->view('web/dashboard/default_content', [
                    'default' => $default,
                    'is_test_paper_gen' => $is_test_paper_gen,
                ]); ?>
            <?php } ?>
        </div>
</main>
