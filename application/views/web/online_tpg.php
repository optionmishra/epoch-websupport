<div class="container">
    <div class="p-4">
        <h1 class="text-center">Test Paper Generator</h1>
    </div>
    <div class="mt-5 row">
        <?php if (empty($online_tpg_books)) : ?>
            <div class="text-center col-12">
                <h2 class="text-primary">Coming Soon!</h2>
                <p class="p-2">We're currently working to bring you the content. <br> Please check back for updates. <br>Thank you for your patience and understanding.</p>
            </div>
        <?php else : ?>
            <?php $current_series = null; ?>
            <?php foreach ($online_tpg_books as $book) : ?>
                <?php if ($current_series != $book->series_name) : ?>
                    <?php if ($current_series !== null) : ?>
    </div> <!-- Close the previous subject's book list -->
<?php endif; ?>
<div class="mt-4 mb-2 col-12">
    <h4><?= $book->series_name ?></h4> <!-- Display the subject name -->
</div>
<div class="col-12 row"> <!-- Start a new row for the books of this subject -->
    <?php $current_series = $book->series_name; ?>
<?php endif; ?>
<div class="col-sm-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url() . 'tpg/public/' . $book->book_id . '/' . $book->class_id ?>"><?= $book->name ?></a>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div> <!-- Close the last subject's book list -->
<?php endif; ?>
</div>
</div>
</div>