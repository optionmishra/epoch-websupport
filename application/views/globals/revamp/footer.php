<footer class="text-white bg-[#111]">
  <div class="container py-20 mx-auto">
    <div class="flex flex-col gap-10 sm:gap-5 sm:flex-row">
      <div class="w-full sm:w-1/3">
        <h1 class="px-5 pb-5 text-2xl font-bold text-center sm:text-start"><?= $siteName ?></h1>
        <ul class="flex flex-col gap-2 ms-10">

          <li class="flex items-center gap-2">
            <i class="fas fa-location"></i>
            <?= $address[0]->value ?>
          </li>
          <li class="flex items-center gap-2">
            <i class="fas fa-phone"></i>
            <a
              href="tel:<?= $mobile1[0]->value ?>"><?= $mobile1[0]->value ?></a>
          </li>
          <li class="flex items-center gap-2">
            <i class="fas fa-brands fa-whatsapp"></i>
            <a
              href="whatsapp://send?phone=<?= $mobile1[0]->value ?>"><?= $mobile1[0]->value ?></a>
          </li>
          <li class="flex items-center gap-2">
            <i class="fas fa-envelope"></i>
            <a
              href="mailto:<?= $email1[0]->value ?>"><?= $email1[0]->value ?></a>
          </li>
        </ul>
      </div>
      <div class="w-full sm:w-1/3">
        <?php if ($_ENV['FOOTER_NAV  ']) : ?>
          <ul class="flex flex-col w-1/2 gap-2 mx-auto">
            <li>
              <a class="{{ request()->routeIs('web.home') ? 'text-white hover:underline decoration-brightOrange lg:px-2' : 'p-0 transition duration-200 hover:underline decoration-brightOrange text-white/60 hover:text-white/80 hover:ease-in-out focus:text-white/80 active:text-white/80 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2' }}"
                aria-current="page" href="{{ route('web.home') }}">Home</a>
            </li>
            <li>
              <a class="{{ request()->routeIs('web.about') ? 'text-white hover:underline decoration-brightOrange lg:px-2' : 'p-0 transition duration-200 hover:underline decoration-brightOrange text-white/60 hover:text-white/80 hover:ease-in-out focus:text-white/80 active:text-white/80 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2' }}"
                href="{{ route('web.about') }}">About Us</a>
            </li>
            <li>
              <a class="{{ request()->routeIs('') ? 'text-white hover:underline decoration-brightOrange lg:px-2' : 'p-0 transition duration-200 hover:underline decoration-brightOrange text-white/60 hover:text-white/80 hover:ease-in-out focus:text-white/80 active:text-white/80 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2' }}"
                href="#">Shop Online</a>
            </li>
            <li>
              <a class="{{ request()->routeIs('') ? 'text-white hover:underline decoration-brightOrange lg:px-2' : 'p-0 transition duration-200 hover:underline decoration-brightOrange text-white/60 hover:text-white/80 hover:ease-in-out focus:text-white/80 active:text-white/80 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2' }}"
                href="/websupport/">Web Support</a>
            </li>
            <li>
              <a class="{{ request()->routeIs('web.contact') ? 'text-white hover:underline decoration-brightOrange lg:px-2' : 'p-0 transition duration-200 hover:underline decoration-brightOrange text-white/60 hover:text-white/80 hover:ease-in-out focus:text-white/80 active:text-white/80 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2' }}"
                href="{{ route('web.contact') }}">Contact Us</a>
            </li>
          </ul>
        <?php endif; ?>
      </div>

      <div class="flex justify-center w-full text-center sm:w-1/3">
        <div class="w-full flex flex-col items-center gap-2">
          <h1 class="px-5 pb-5 text-2xl font-bold text-center sm:text-start">Get in touch!</h1>
          <a href="whatsapp://send?phone=<?= $mobile1[0]->value ?>" data-twe-ripple-init
            data-twe-ripple-color="light"
            class="rounded-full bg-green-600 flex items-center justify-center w-14 h-14 leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg">
            <i class="fab fa-whatsapp fa-2xl"></i></a>
        </div>
      </div>

    </div>
  </div>

  <div class="py-2 text-center text-white bg-black">
    <p class="text-sm">
      Copyright &copy; <?= date('Y') ?> <?= $siteName ?> | All Rights Reserved.
    </p>
  </div>
</footer>