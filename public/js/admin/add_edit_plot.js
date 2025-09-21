console.log(plots);

let currentPlotIndex = null;
let tempX = 0,
    tempY = 0;

// Tooltip
const tooltip = document.getElementById("plotTooltip");

// Save
document.getElementById("savePlotBtn").onclick = function() {
    let idx = document.getElementById("plotIndex").value;
    let lotNum = document.getElementById("plotNumber").value;

    if (!lotNum.match(/^[0-9]+$/)) {
        Swal.fire("Error", "Plot Number must be numeric.", "error");
        return;
    }
    let formattedId = "Lot " + String(lotNum).padStart(2, '0');

    // Duplicate check
    let duplicate = plots.some((p, i) => p.id === formattedId && i != idx);
    if (duplicate) {
        Swal.fire("Error", formattedId + " already exists!", "error");
        return;
    }

    let plot = {
        id: formattedId,
        x: plots[idx]?.x || tempX,
        y: plots[idx]?.y || tempY,
        size: document.getElementById("plotSize").value,
        location: document.getElementById("plotLocation").value,
        dimensions: document.getElementById("plotDimensions").value,
        status: document.getElementById("plotStatus").value,
        type: document.getElementById("plotType").value || "default"
    };

    if (idx !== "") {
        plots[idx] = plot;
    } else {
        plots.push(plot);
    }

    savePlots();
};

// Delete
document.getElementById("deletePlotBtn").onclick = function() {
    let idx = document.getElementById("plotIndex").value;
    let lotName = plots[idx].id;

    Swal.fire({
        title: "Delete " + lotName + "?",
        text: "This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            plots.splice(idx, 1);
            savePlots();
        }
    });
};

// Save function
function savePlots() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    const saveUrl = document.querySelector('meta[name="plots-save-url"]').getAttribute("content");

    // Get hidden project/wing IDs from modal
    const projectId = document.querySelector(".pid").value;
    const wingId = document.querySelector(".wid").value;

    fetch(saveUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({
                plots: plots,
                wing: wingId, // ✅ matches controller
                project_id: projectId // ✅ matches controller
            })
        })
        .then(res => res.json())
        .then(data => {
            bootstrap.Modal.getInstance(document.getElementById('plotModal')).hide();
            renderMarkers();
            // `Plots for Project ${data.project_id}, Wing ${data.wing} updated successfully.`,

            Swal.fire({
			    title: "Saved!",
			    text: "Plots updated successfully.",
			    icon: "success",
			    timer: 1000,              // auto close after 2 seconds
			    showConfirmButton: false  // hides the OK button
			});

        })
        .catch(err => {
            console.error("Save failed", err);
            Swal.fire("Error", "Could not save plots. Please try again.", "error");
        });
}


function getPlotIcon(plot) {
    // normalize to lowercase
    const type   = (plot.type   || "").toLowerCase();
    const status = (plot.status || "").toLowerCase();

    // if type (house, parking, etc.) has an icon → use that
    if (type && window.plotIcons[type]) {
        return window.plotIcons[type];
    }

    // else use status (available, booked, reserved)
    if (status && window.plotIcons[status]) {
        return window.plotIcons[status];
    }

    // fallback
    return window.plotIcons.available;
}
let hideTimeout = null; // 👈 declare globally so all handlers can use it


function renderMarkers() {
    // remove old markers
    document.querySelectorAll(".plot-marker").forEach(m => m.remove());

    plots.forEach((p, i) => {
        let marker = document.createElement("img");
        marker.src = getPlotIcon(p); // ✅ always correct asset path
        marker.className = "plot-marker";
        marker.style.left = p.x + "px";
        marker.style.top = p.y + "px";

        // dataset
        marker.dataset.index = i;
        marker.dataset.number = p.id;
        marker.dataset.size = p.size;
        marker.dataset.location = p.location;
        marker.dataset.dimensions = p.dimensions;
        marker.dataset.status = p.status;
        marker.dataset.type = p.type || "default";

        // Tooltip
        marker.addEventListener("mouseenter", () => {
		  tooltip.style.display = "block";
		  tooltip.style.opacity = "1";
		  tooltip.innerHTML = `
		    <strong>${p.id}</strong><br>
		    Size: ${p.size}<br>
		    Location: ${p.location}<br>
		    Dimensions: ${p.dimensions}<br>
		    Status: ${p.status}<br>
		    Type: ${p.type}
		  `;
		});

		marker.addEventListener("mouseleave", () => {
		  hideTimeout = setTimeout(() => {
		    tooltip.style.opacity = "0";
		    setTimeout(() => tooltip.style.display = "none", 150); // wait for fade
		  }, 100);
		});


        marker.addEventListener("mousemove", (e) => {
		  clearTimeout(hideTimeout);
		  tooltip.style.display = "block";

		  // Get map container position
		  const mapRect = document.getElementById("map-container").getBoundingClientRect();

		  // Position tooltip relative to the map
		  tooltip.style.left = (e.clientX - mapRect.left + 10) + "px";
		  tooltip.style.top  = (e.clientY - mapRect.top + 10) + "px";
		});

        // Edit on click
        marker.addEventListener("click", () => {
            currentPlotIndex = i;
            document.getElementById("plotIndex").value = i;
            document.getElementById("plotNumber").value = p.id.replace("Lot ", "");
            document.getElementById("plotSize").value = p.size;
            document.getElementById("plotLocation").value = p.location;
            document.getElementById("plotDimensions").value = p.dimensions;
            document.getElementById("plotStatus").value = p.status;
            document.getElementById("plotType").value = p.type || "default";

            document.getElementById("plotModalTitle").innerText = "Edit Plot";
            document.getElementById("deletePlotBtn").style.display = "inline-block";

            new bootstrap.Modal(document.getElementById("plotModal")).show();
        });

        document.getElementById("map-container").appendChild(marker);
    });
}


// Add new plot by clicking map
document.getElementById("lot-map").addEventListener("click", function(e) {
    if (e.target.classList.contains("plot-marker")) return;
    let rect = this.getBoundingClientRect();
    tempX = e.clientX - rect.left;
    tempY = e.clientY - rect.top;
    currentPlotIndex = plots.length;

    document.getElementById("plotIndex").value = "";
    document.getElementById("plotNumber").value = "";
    document.getElementById("plotSize").value = "";
    document.getElementById("plotLocation").value = "";
    document.getElementById("plotDimensions").value = "";
    document.getElementById("plotStatus").value = "Available";
    document.getElementById("plotType").value = "default";

    document.getElementById("plotModalTitle").innerText = "Add Plot";
    document.getElementById("deletePlotBtn").style.display = "none";

    let modalEl = document.getElementById('plotModal');
    let modal = new bootstrap.Modal(modalEl);

    // Attach event BEFORE showing modal
    modalEl.addEventListener('shown.bs.modal', function () {
        document.getElementById("plotNumber").focus();
    }, { once: true });

    modal.show();
});


// Search
document.getElementById("applySearch").addEventListener("click", function() {
    let num = document.getElementById("searchNumber").value.trim().toLowerCase();
    let loc = document.getElementById("searchLocation").value.trim().toLowerCase();
    let status = document.getElementById("searchStatus").value;

    document.querySelectorAll(".plot-marker").forEach(marker => {
        let match = true;
        if (num && !marker.dataset.number.toLowerCase().includes(num)) match = false;
        if (loc && !marker.dataset.location.toLowerCase().includes(loc)) match = false;
        if (status && marker.dataset.status !== status) match = false;
        marker.style.display = match ? "block" : "none";
    });
});

// Initial render (for fresh session with no markers)
renderMarkers();