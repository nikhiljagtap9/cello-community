// ==================================================
// Global variables
// ==================================================
let plots = [];
let hideTimeout = null;
const tooltip = document.getElementById("plotTooltip");
let currentPlotIndex = null;

// ==================================================
// Utility: choose correct icon based on type/status
// ==================================================
function getPlotIcon(plot) {
    const type   = (plot.type   || "").toLowerCase();
    const status = (plot.status || "").toLowerCase();

    if (type && window.plotIcons[type]) {
        return window.plotIcons[type];
    }
    if (status && window.plotIcons[status]) {
        return window.plotIcons[status];
    }
    return window.plotIcons.available; // fallback
}

// ==================================================
// Render Markers
// ==================================================
function renderMarkers(wingId) {

    // ✅ Get project_id from hidden field
    let projectId = document.querySelector(".selected_proj_id").value;

    // Load freelancers dynamically
    loadFreelancers(projectId);

    const container = document.getElementById("map-container");
    if (!container) return;

    // remove old markers
    document.querySelectorAll(".plot-marker").forEach(m => m.remove());

    plots.forEach((p, i) => {
        let marker = document.createElement("img");
        marker.src = getPlotIcon(p);
        marker.className = "plot-marker";
        marker.style.left = p.x + "px";
        marker.style.top = p.y + "px";
        marker.style.position = "absolute"; // ensure absolute inside map

        // dataset
        marker.dataset.index = i;
        marker.dataset.number = p.id;
        marker.dataset.size = p.size;
        marker.dataset.location = p.location;
        marker.dataset.dimensions = p.dimensions;
        marker.dataset.status = p.status;
        marker.dataset.type = p.type || "default";

        // Tooltip events
        marker.addEventListener("mouseenter", () => {
            if (!tooltip) return;
            tooltip.style.display = "block";
            tooltip.style.opacity = "1";
            tooltip.innerHTML = `
                <strong>${p.id}</strong><br>
                Size: ${p.size || "N/A"}<br>
                Location: ${p.location || "N/A"}<br>
                Dimensions: ${p.dimensions || "N/A"}<br>
                Status: ${p.status || "Available"}
            `;
        });

        marker.addEventListener("mouseleave", () => {
            if (!tooltip) return;
            hideTimeout = setTimeout(() => {
                tooltip.style.opacity = "0";
                setTimeout(() => (tooltip.style.display = "none"), 150);
            }, 100);
        });

        marker.addEventListener("mousemove", (e) => {
            if (!tooltip) return;
            clearTimeout(hideTimeout);
            tooltip.style.display = "block";

            const mapRect = container.getBoundingClientRect();
            tooltip.style.left = (e.clientX - mapRect.left + 10) + "px";
            tooltip.style.top  = (e.clientY - mapRect.top + 10) + "px";
        });

        // Edit on click
        marker.addEventListener("click", () => {
            currentPlotIndex = i;

            // Fill modal fields with marker data
            document.getElementById("plotIndex").value       = p.id.replace("Lot ", "");
            document.getElementById("plotNumber").value      = p.id.replace("Lot ", "");
            document.getElementById("plotSize").value        = p.size || "";
            document.getElementById("plotLocation").value    = p.location || "";
            document.getElementById("plotDimensions").value  = p.dimensions || "";
            document.getElementById("plotStatus").value      = p.status || "Available";
            // document.getElementById("plotType").value        = p.type || "default";

            // ✅ show Wing name (if your JSON includes wingName or similar)
            let wingSelect   = document.getElementById("wingSelect");
            let selectedWing = wingSelect.options[wingSelect.selectedIndex];
            document.getElementById("plotWingName").value = selectedWing.dataset.name || "N/A";
            document.getElementById("plotWingId").value = selectedWing.value || "N/A";

            // Modal title & delete button
            document.getElementById("plotModalTitle").innerText = "Edit Plot " + p.id;
            // document.getElementById("deletePlotBtn").style.display = "inline-block";

            // Show Bootstrap modal
            new bootstrap.Modal(document.getElementById("plotModal")).show();
        });

        container.appendChild(marker);
    });
}

// ==================================================
// Dropdown Change Handler
// ==================================================
function initWingSelect() {
    const wingSelect = document.getElementById("wingSelect");
    if (!wingSelect) return;

    wingSelect.addEventListener("change", function () {
        let selected  = this.options[this.selectedIndex];
        let wingId    = this.value;
        let wingImage = selected.dataset.image;

        // Replace content inside map_wrap with image + container
        const mapWrap = document.querySelector(".map_wrap");
        if (wingImage) {
            mapWrap.innerHTML = `
              <div id="map-container" style="position:relative; display:inline-block;">
                <img src="${wingImage}" alt="Wing Image" style="max-width:100%; height:auto;" id="lot-map">
              </div>
            `;
        } else {
            mapWrap.innerHTML = "No image available";
            return;
        }

        // Fetch plots JSON for this wing
        fetch(`/wings/${wingId}/plots.json`)
            .then(res => res.json())
            .then(data => {
                plots = data;
                renderMarkers(wingId);
            })
            .catch(err => console.error("Error loading plots:", err));
    });

    // Trigger once on page load
    wingSelect.dispatchEvent(new Event("change"));
}

// ==================================================
// Init on DOM Ready
// ==================================================
document.addEventListener("DOMContentLoaded", () => {
    initWingSelect();
});

$(document).on('submit', '#assign_plot', function (e) {
    e.preventDefault();

    let $form = $(this); // reference to form

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to assign this plot?",
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

                        let wingId = $("#wingSelect").val(); // ✅ always current wing id
                        if (!wingId) {
                            console.warn("No wing selected");
                        }
                        
                        fetch(`/wings/${wingId}/plots.json`)
                        .then(res => res.json())
                        .then(data => {
                            plots = data;
                            renderMarkers(wingId);
                        })
                        .catch(err => console.error("Error loading plots:", err));

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

function loadFreelancers(projectId) {
    fetch(`/user/projects/${projectId}/freelancers`)
        .then(res => res.json())
        .then(data => {
            const tableWrap = document.getElementById("freelancerTableWrap");
            const formWrap  = document.getElementById("freelancerFormWrap");

            // Reset
            tableWrap.innerHTML = "";
            tableWrap.style.display = "none";
            formWrap.style.display  = "none";

            document.getElementById("f_a_id").value = "";
            document.getElementById("f_b_id").value = "";


            if (!data.status || !data.freelancers.length) {
                // Case: No freelancers → show full form (A & B)
                formWrap.style.display = "block";
                return;
            }

            let freelancers = data.freelancers;

            // Build table rows
            let rows = freelancers.map((f, i) => {
                if (i === 0) {
                    document.getElementById("f_a_id").value = f.user_id;
                }
                if (i === 1) {
                    document.getElementById("f_b_id").value = f.user_id;
                }

                return `
                    <tr>
                        <td>${i === 0 ? "Freelancer A" : "Freelancer B"}</td>
                        <td>${f.first_name ?? ""} ${f.last_name ?? ""}</td>
                        <td>${f.email ?? ""}</td>
                        <td>${f.phone ?? ""}</td>
                        <td>${f.address ?? ""}</td>
                        <td>${f.invitee_name ?? ""}</td>
                        <td>${f.invitee_email ?? ""}</td>
                        <td>${f.invitee_user_type ?? ""}</td>
                    </tr>
                `;
            }).join("");

            let table = `
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Invitee name</th>
                            <th>Invitee email</th>
                            <th>Invited By</th>
                        </tr>
                    </thead>
                    <tbody>${rows}</tbody>
                </table>
            `;

            // Show table
            tableWrap.innerHTML = table;
            tableWrap.style.display = "block";

            // Case: Only 1 freelancer → also show Freelancer B input form
            if (freelancers.length === 1) {
                formWrap.style.display = "block";

                // Hide Freelancer A tab, keep only B
                document.getElementById("freelancerA").style.display = "none";
                document.querySelector("#freelancer-a-tab").style.display = "none";

                // Activate Freelancer B tab
                let tabB = new bootstrap.Tab(document.querySelector('#freelancer-b-tab'));
                tabB.show();
            }
        })
        .catch(err => {
            console.error("Error loading freelancers:", err);
        });
}


$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $("#freelancerForm").on("submit", function (e) {
        e.preventDefault();

        let formData = $(this).serialize();
        let actionUrl = $(".action_url").val(); // 👈 get hidden input value

        $.ajax({
            url: actionUrl,  // use dynamic URL
            type: "POST",
            data: formData,
            success: function (res) {
                if (res.status === true) {
                    Swal.fire({
                        icon: "success",
                        title: "Assigned!",
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false,
                        didClose: () => {
                            location.reload(); // 👈 reload after Swal closes automatically
                        }
                    });

                    $("#freelancerForm")[0].reset();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = "";
                    $.each(errors, function (key, value) {
                        errorMsg += value[0] + "\n";
                    });
                    alert(errorMsg);
                } else {
                    alert("Unexpected error: " + xhr.status);
                }
            }
        });
    });
});
