<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?= base_url() ?>">
	<title><?= $siteName ?> | Dashboard</title>
	<link rel="stylesheet" href="<?= base_url('assets/revamp/css/style.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/datatable.css')?>">
</head>
<body class="dark:bg-black">
    <header class="bg-[#2E3092] min-h-16 font-normal text-white p-2">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center justify-center">
            <div class="border-2 bg-white rounded-md p-1">
                <img src="<?= base_url('assets/img/'.$logo['file_name']) ?>" alt="" class="max-h-12">
            </div>
        </div>
        <div class="flex flex-wrap justify-center gap-4 items-center">
            <a href="logout" class="hover:underline">Logout</a>
            <p class="text-sm md:text-base">Teacher Code: <?= $user->teacher_code?></p>
            <div class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-full border-2 border-white overflow-hidden bg-gray-200">
                    <img src="<?= 'assets/img/'.$user->dp ?>" class="h-full w-full object-cover"/>
                </div>
                <p class="text-sm md:text-base">Hi, <?= $user->fullname ?></p>
            </div>
        </div></div>
    </header>
