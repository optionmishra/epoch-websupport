$(document).ready(function () {
	var BASE_URL = document
		.querySelector('meta[name="base_url"]')
		.getAttribute("content");

	function getData() {
		// const board = $("#select_board").find(":selected").val();
		const publication = $("#select_publication").find(":selected").val();
		const subject = $("#select_subject").find(":selected").val();
		const classes = $("#select_classes").find(":selected").val();
		const book = $("#select_book").find(":selected").val();
		const category = $("input[name=select_category]:checked").val();
		// return { board, publication, subject, classes, book, category };
		return { publication, subject, classes, book, category };
	}

	async function updateDashboard(data) {
		$("#loader").removeClass("hidden").addClass("flex");

		const url = `${BASE_URL}admin_master/change_product2`;

		// Convert the data object to URL-encoded form data
		const formData = new URLSearchParams(data);

		const response = await fetch(url, {
			method: "POST",
			headers: { "Content-Type": "application/x-www-form-urlencoded" },
			body: formData, // Send URL-encoded form data
		});

		if (!response.ok) {
			$("#responseMessage").innerText = "Something went wrong";
			$("#loader").removeClass("flex").addClass("hidden");
			return;
		}
		const resData = await response.json();
		if (resData[0].length == 0) {
			$("#coming_soon").removeClass("hidden").addClass("flex");
			$("#loader").removeClass("flex").addClass("hidden");
		} else {
			$("#coming_soon").removeClass("flex").addClass("hidden");
			$("#loader").removeClass("flex").addClass("hidden");
		}
		console.log(resData);

		// const dashboardData = await response.json();
		// console.log(dashboardData);

		// updateDashboardHTML(dashboardData);
	}

	function updateDashboardHTML(dashboardData) {
		$("#loader").removeClass("flex").addClass("hidden");
		$("#dashboard-content").html(dashboardData.html);
	}

	$("select").on("change", function () {
		updateDashboard(getData());
	});
	$("input[name=select_category]").on("change", function () {
		updateDashboard(getData());
	});

	$("#select_subject").on("change", (e) => {
		const select_subjectID = $("#select_subject").find(":selected").val();

		fetch(base_url + "admin_master/getClasses/" + select_subjectID)
			.then((res) => res.json())
			.then((data) => {
				$("#select_classes").html(`<option value="">Select Class</option>`);
				data.forEach((item, key, arr) => {
					$("#select_classes").append(
						`<option value="${item.id}">${item.name}</option>`
					);
				});
			});
	});
	//   end
	$("#select_classes").on("change", (e) => {
		const select_subjectID = $("#select_subject").find(":selected").val();
		const classID = $("#select_classes").find(":selected").val();

		fetch(
			base_url + "admin_master/getSubjects/" + select_subjectID + "/" + classID
		)
			.then((res) => res.json())
			.then((data) => {
				$(".teacherMsubject").html(`<option value="">Select Book</option>`);
				data.forEach((item, key, arr) => {
					$(".teacherMsubject").append(
						`<option data-categories="${item.categories}" value="${item.id}">${item.name}</option>`
					);
				});
			});
	});
}); // Document ready
