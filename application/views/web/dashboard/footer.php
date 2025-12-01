<footer class="bg-[#2E3092] text-white py-10">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between gap-8">
            <!-- Column 1: About -->
            <div class="w-full sm:w-1/4">
                <h3 class="text-xl font-semibold mb-4"><?= $siteName ?></h3>
                <p class="text-sm leading-relaxed">
                    We are dedicated to providing the best services. Our mission is to connect people and simplify processes through innovative solutions.
                </p>
            </div>

            <!-- Column 2: Quick Links -->
            <!--<div>
                <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">Home</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">About Us</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">Services</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">Blog</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">Contact Us</a></li>
                </ul>
            </div>-->

            <!-- Column 3: Legal & Resources -->
            <!--<div>
                <h3 class="text-xl font-semibold mb-4">Legal & Resources</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">FAQ</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition duration-300">Support</a></li>
                </ul>
            </div>-->

            <!-- Column 4: Contact & Social -->
            <div class="w-full sm:w-1/4">
                <h3 class="text-xl font-semibold mb-4">Get in Touch</h3>
                <p class="text-sm mb-4">
                    Email: <a href="mailto:<?= $email1[0]->value ?>" class="hover:underline"><?= $email1[0]->value ?></a><br>
                    Phone: <a href="tel:<?= $mobile1[0]->value ?>" class="hover:underline"><?= $mobile1[0]->value ?></a><br>
                    Address: <?= $address[0]->value ?>
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white transition duration-300 text-2xl" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-300 hover:text-white transition duration-300 text-2xl" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-300 hover:text-white transition duration-300 text-2xl" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-gray-300 hover:text-white transition duration-300 text-2xl" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm">
            &copy; <?= date('Y') ?> <?= $siteName ?>. All rights reserved.
        </div>
    </div>
</footer>


<!-- //Main wrapper -->
<div class="modal" id="pleasewait" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content" style="width:100px;height:100px;border-radius:50%;background-color:#fff;margin:50% auto;">
			<div class="modal-body">
				<img class="fit-image" src="<?= base_url('assets/img/tp-gif.gif') ?>" style="object-fit:none;">
			</div>
		</div>
	</div>
</div>
<!-- JS Files -->
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/active.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/plugins/pace.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.form.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/plugins/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/sweetalert2.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/toastr.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/smooth-submit.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js') ?>"></script>
<script type="module" src="<?= base_url('assets/js/simple-datatables.js') ?>"></script>
<script type="module" src="<?= base_url('assets/dashboard/datatable.js') ?>"></script>
<script src="<?= base_url('assets/dashboard/script.js') ?>"></script>
</body>
</html>
