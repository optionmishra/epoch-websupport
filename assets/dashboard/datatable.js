document.addEventListener("DOMContentLoaded", () => {
  const table = document.getElementById("resourcesTable");
  if (table) {
    new simpleDatatables.DataTable(table, {
      searchable: true,
      fixedHeight: false,
      perPage: 10,
      perPageSelect: [5, 10, 15, 20],
      labels: {
        placeholder: "Search resources...",
        perPage: "entries per page",
        noRows: "No resources found",
      },
    });
  }
});


// Function to validate form
function validateForm() {
  let isValid = true;

  // Remove any existing error messages
  $(".error-message").remove();

  // Validate each required field
  $('#Selform select[required="true"]').each(function () {
    const field = $(this);
    const fieldValue = field.val();

    // Check if the field is empty or has default placeholder value
    if (!fieldValue || fieldValue === "" || fieldValue === "Select") {
      isValid = false;

      // Create error message
      const errorMessage = $(
        '<div class="mt-1 error-message text-danger">Please select a value</div>',
      );

      // Insert error message after the field
      field.after(errorMessage);

      // Highlight the field
      field.addClass("border-danger");
    } else {
      // Remove highlight if field is valid
      field.removeClass("border-danger");
    }
  });

  // Also check the hidden field
  // const msubField = $("#msub_d");
  // if (!msubField.val()) {
  // 	isValid = false;
  // }

  return isValid;
}

// Instead of handling form submission, handle button click only
$("#searchBtn").on("click", function (e) {
  e.preventDefault();

  if (validateForm()) {
    // If form is valid, use the button's native submit behavior
    // by removing our event handler and clicking the button again

    // Store form reference
    const form = $("#Selform")[0];

    // Submit form through DOM API
    submitForm(form);
  } else {
    // Focus on the first invalid field
    $("#Selform select.border-danger").first().focus();
  }
});

function submitForm(element) {
  var data = new FormData(element) || {};
  var dataType = $(element).attr("data-type") || "json";
  var url = $(element).attr("action") || $(element).attr("href");
  var type = $(element).attr("method") || "get";
  $.ajax({
    url: url,
    type: type,
    dataType: dataType,
    data: data,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#pleasewait").modal("show");
    },
    success: function (data) {
      $("#pleasewait").modal("hide");
      if (data.type === "success") {
        location.reload();
        // toastr[data.type](data.message);
        // if (data.redirect) {
        // 	window.location.href = data.redirect;
        // }
      } else if (data.type === "error") {
        toastr[data.type](data.message);
      }
    },
    error: function (data) {
      console.log("unable to send request..");
    },
  });
}

// Remove error message when user makes a selection
$("#Selform select").on("change", function () {
  const field = $(this);
  if (field.val()) {
    field.removeClass("border-danger");
    field.next(".error-message").remove();
  }
});
