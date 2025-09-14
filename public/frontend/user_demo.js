$(document).on('submit', '.submit_modal', function (e) {
    e.preventDefault();

    let $form = $(this); // reference to form

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to assign this plot and freelancers?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, assign it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/user/projects/assign-freelancers-ajax", // 👈 your route
                method: "POST",
                data: $form.serialize(), // ✅ send all inputs in form
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    if (response.status) {
                        Swal.fire({
                            icon: "success",
                            title: "Assigned!",
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#plotModal').modal('hide');
                    } else {
                        Swal.fire("Error", response.message, "error");
                    }
                },
                error: function (xhr) {
                    let msg = "Something went wrong!";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    Swal.fire("Error", msg, "error");
                }
            });
        }
    });
});



document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".pt_click_modal").forEach(el => {
        el.addEventListener("click", function() {
            // Get values from data attributes
            let plotId = this.dataset.plotId;
            let plotName = this.dataset.plotName;
            let plotStatus = this.classList.contains("available_mrk") ? "Available" :
                this.classList.contains("sold_mrk") ? "Sold" :
                this.classList.contains("booked_mrk") ? "Booked" : "Unknown";

            let selectedOption = document.querySelector('.plot_lbel option:checked');
            let wingId = selectedOption.value;
            let wingName = selectedOption.getAttribute('data-name');
            let projectname = document.querySelector('.proj_name').value;
            // 👆 make sure your project input has data-project-id

            var ProjectId = $('.selected_proj_id').val();

            // Populate modal visible fields
            document.getElementById("modal-plot-id").textContent = plotId;
            document.getElementById("modal-plot-name").textContent = plotName;
            document.getElementById("modal-wing-id").textContent = wingName;
            document.getElementById("modal-proj-name").textContent = projectname;
            document.getElementById("modal-plot-status").textContent = plotStatus;

            // Populate hidden fields
            document.getElementById("hidden-plot-id").value = plotId;
            document.getElementById("hidden-wing-id").value = wingId;
            document.getElementById("hidden_project_id").value = ProjectId;

            // Show modal
            let myModal = new bootstrap.Modal(document.getElementById("plotModal"));
            myModal.show();
        });
    });
});
