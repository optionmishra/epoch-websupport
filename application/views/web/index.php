<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $siteName ?></title>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url(
                                  "assets/revamp/fontawesome/css/all.min.css",
                                ) ?>">
  <link rel="stylesheet" href="<?= base_url("assets/revamp/css/style.css") ?>" />
  <script src="<?= base_url("assets/revamp/js/script.js") ?>" defer></script>
</head>

<body data-theme="light" class="font-inter">
  <div class="flex justify-center min-h-screen flex-wrap">
    <!--Left-->
    <div class="relative min-h-screen hidden md:flex items-end md:w-1/2 2xl:w-4/7">
      <div class="min-h-screen h-full bg-[#094391] w-52"></div>
      <div class="absolute top-[-4rem] left-64">
        <img src="<?= base_url("assets/home/img/2.png") ?>" />
      </div>
      <div class="absolute bottom-0 left-4">
        <img src="<?= base_url("assets/home/img/5.png") ?>" />
      </div>
      <div class="absolute top-10 right-[-4rem]">
        <img src="<?= base_url("assets/home/img/7.png") ?>" />
      </div>
      <div class="ml-[10rem] relative">
        <div class="absolute left-1/2 transform -translate-x-1/2 z-10 w-full">
          <img src="<?= base_url("assets/home/img/9.png") ?>" />
        </div>
        <div class="z-20 relative">
          <img src="<?= base_url("assets/home/img/1.png") ?>" />
        </div>
      </div>
    </div>
    <!--Right-->
    <div class="w-full md:w-1/2 2xl:w-3/7 flex justify-center items-end relative overflow-hidden">
      <div class="absolute scale-[0.6] top-[-6rem] right-[-6rem] z-10"><img src="<?= base_url("assets/home/img/3.png") ?>" /></div>
      <div class="absolute scale-[0.6] bottom-[-4rem] right-[-2rem] sm:right-5 z-10"><img src="<?= base_url("assets/home/img/4.png") ?>" /></div>
      <div class="flex flex-col my-5 2xl:mb-20 px-5 z-20">
        <div
          class="flex justify-center mb-5 rounded-md w-full">
          <img class="max-h-48 max-w-48" src="<?= base_url("assets/img/" . $logo["file_name"]) ?>" alt="logo" />
        </div>
        <div class="text-center 2xl:my-10">
          <h1 class="text-3xl font-bold">
            <spam class="text-gray-800">Welcome to </spam>
            <spam class="text-[#0267B1]"><?= $siteName ?></spam>
          </h1>
          <small class="font-semibold text-sm text-gray-500">
            Your gateway to seamless web support starts
            here!
          </small>
        </div>
        <div class="mt-5 w-full sm:w-10/12 mx-auto">
          <form action="<?= base_url("web/process") ?>" method="post">
            <div class="flex flex-col gap-1 mb-5">
              <label
                class="font-semibold text-[#0267B1] ml-5"
                for="email">Email
                <span class="text-sm text-[#0267B1]">
                  *
                </span>
              </label>
              <input
                class="px-4 py-3 rounded-full focus:border-[#0267B1] outline-[#0267B1] bg-[#E1F2F2]"
                id="email"
                type="email"
                name="username"
                required />
              <!--placeholder="Enter your email address" -->
            </div>
            <div class="flex flex-col gap-1 mb-5">
              <label
                class="font-semibold text-[#0267B1] ml-5"
                for="password">
                Password
                <span class="text-sm text-[#0267B1]">
                  *
                </span>
              </label>
              <input
                class="px-4 py-3 rounded-full focus:border-[#0267B1] outline-[#0267B1] bg-[#E1F2F2]"
                id="password"
                type="password"
                name="password"
                required />
              <!--placeholder="Enter your password" -->
            </div>

            <div
              class="flex flex-col justify-between mb-5 sm:flex-row gap-y-2">
              <div
                class="flex items-center justify-center gap-1">
                <input
                  class="w-5 h-5 cursor-pointer accent-[#0267B1] rounded-lg"
                  type="checkbox"
                  id="showPassword" />
                <label
                  class="cursor-pointer"
                  for="showPassword">Show Password</label>
              </div>
              <div
                class="flex items-center justify-center">
                <button onclick="forgotPasswordModal.showModal()" type="button" class="font-semibold text-[#0267B1] hover:text-accent">Forgot your Password?</button>
              </div>
            </div>

            <?php if ($this->session->flashdata("error")) { ?>
              <div class="flex justify-center py-2 mb-5 ">
                <strong class="text-red-600"><?= $this->session->flashdata("error") ?></strong>
              </div>
              <?php $this->session->unset_userdata("error"); ?>
            <?php } ?>

            <div class="flex justify-center my-6">
              <button type="submit" class="text-white bg-[#0267B1] hover:bg-accent focus:ring-4 focus:ring-accent font-bold text-xl rounded-full py-3 px-10 focus:outline-none transition-colors duration-300 ease-in-out uppercase">Log In</button>
            </div>
          </form>
        </div>
        <div class="mb-5 text-center">
          <p class="text-[#0267B1] font-semibold">
            Don't have an account?
          </p>
          <div class="flex gap-5 my-5 justify-center">
            <button
              class="px-4 py-2 font-semibold text-white transition-colors duration-300 ease-in-out rounded-full hover:bg-accent bg-[#5CC6D0]">
              <a href="<?= base_url("teacher-registration") ?>">I'm a Teacher</a>
            </button>
            <button
              class="px-4 py-2 font-semibold text-white transition-colors duration-300 ease-in-out rounded-full hover:bg-accent bg-[#5CC6D0]">
              <a href="<?= base_url("student-registration") ?>">I'm a Student</a>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Forgot Password Modal -->
  <dialog id="forgotPasswordModal" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold text-primary">Forgot your Password?</h3>
      <form method="dialog">
        <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
      </form>
      <form class="my-5" id="forgotPasswordForm" action="<?= base_url(
                                                            "admin_master/check_forgot",
                                                          ) ?>" method="post">
        <div class="flex flex-col gap-1 mb-5">
          <label
            class="font-semibold text-secondary"
            for="recoveryEmail">Email
            <span class="text-sm text-accent">
              *
            </span>
          </label>
          <input
            class="px-4 py-2 border border-gray-300 rounded-md focus:border-accent outline-accent"
            id="recoveryEmail"
            type="email"
            name="email"
            placeholder="Enter your email address"
            required />
        </div>
        <div class="my-5">
          <p id="responseMessage"></p>
        </div>
        <div class="modal-action">
          <button type="submit" class="text-white transition-colors duration-300 ease-in-out btn bg-primary hover:bg-accent">Submit</button>
        </div>
      </form>
    </div>
  </dialog>
</body>

</html>