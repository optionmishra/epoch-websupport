document.addEventListener("DOMContentLoaded", function () {
	const showPasswordCheckbox = document.querySelector("#showPassword");

	showPasswordCheckbox.addEventListener("change", function () {
		const passwordInput = document.querySelector("#password");
		passwordInput.type = showPasswordCheckbox.checked ? "text" : "password";
	});

	// Get modal elements
	const forgotPasswordForm = document.getElementById("forgotPasswordForm");
	const responseMessage = document.getElementById("responseMessage");
	const route = forgotPasswordForm.getAttribute("action");

	// Handle form submission
	forgotPasswordForm.addEventListener("submit", (e) => {
		e.preventDefault(); // Prevent default form submission

		// Get the email value
		const email = document.getElementById("recoveryEmail").value;

		fetch(route, {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({ email }),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.type == "success") {
					responseMessage.textContent = data.message;
					responseMessage.classList.remove("hidden");
					responseMessage.classList.add("text-green-500");
				} else {
					responseMessage.textContent = data.message;
					responseMessage.classList.remove("hidden");
					responseMessage.classList.add("text-red-500");
				}
			});
	});
});
