
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

<style>
    .app-title { position: relative; }
    .ttl-btn {
        position: absolute;
        right: 18px;
        top: 5px;
        padding: 5px 36px;
        background-color: #79b6f7;
    }
    .app-content{
        height: calc(100vh - 55px);
    }
</style>

<main class="app-content d-flex flex-column justify-content-start">
    <!-- Header Section -->
    <div class="app-title">
        <?php $this->load->view('web/dashboard/breadcrumb'); ?>
        <?php if ($is_special_user): ?>
            <?php $this->load->view('web/dashboard/user_section_button', ['user_type' => $user_type]); ?>
        <?php endif; ?>
    </div>

    <!-- Search Form -->
    <?php $this->load->view('web/dashboard/search_form', [
        'publication' => $publication,
        'selectable_subjects' => $selectable_subjects,
        'selectable_classes' => $selectable_classes,
        'selectable_books' => $selectable_books
    ]); ?>

    <div class="m-0 mx-4 row justify-content-center">
        <!-- Sidebar Categories -->
        <div class="py-3 row justify-content-center col-md-3 col-sm-12">
            <?php $this->load->view('web/dashboard/category_sidebar', [
                'categories' => $user_type === 'Teacher' ? $selectable_categories : $category,
                'user_type' => $user_type
            ]); ?>
        </div>

        <!-- Main Content Area -->
        <div class="p-0 m-0 row justify-content-center col-md-9 col-sm-12">
            <div class="p-0 mt-3 col-md-11 justify-content-center">
                <div class="row justify-content-center">
                    <table id="srch_tbl" class="table table-striped table-bordered" style="width:100%;float:left;">
                        <thead style="display:none;">
                            <tr><th>Name</th></tr>
                        </thead>
                        <tbody class="row" id="webSupportsTable">
                            <?php if ($is_online_tpg): ?>
                                <?php $this->load->view('web/dashboard/online_tpg_content', ['online_tpgs' => $online_tpgs]); ?>
                            <?php else: ?>
                                <?php $this->load->view('web/dashboard/default_content', [
                                    'default' => $default,
                                    'is_test_paper_gen' => $is_test_paper_gen
                                ]); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
