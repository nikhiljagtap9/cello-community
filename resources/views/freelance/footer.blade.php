 <div id="myModal_img" class="modal img_pop">
    <div class="modal-content">
      <span class="close" onclick="closeModal_img()">&times;</span>
      <h2>Project Image</h2>
      <img id="modalImage" src="" alt="Project Image">
    </div>
 </div>

<div id="frelanc_pop" class="modal img_pop">
   <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Add Prospect</h2>
      <div class="pop_divdr"></div>
      <div class="card-body">
         <form id="prospect_form" onsubmit="event.preventDefault(); saveProspectData();">
         <div class="row">
             <div id="modal_message" class="mt-3"></div>
            <div class="col-md-6">
               <label class="form-label">First Name</label>
               <input type="text" id="modal_first_name" class="form-control" name="first_name" placeholder="Enter First Name">
               <small id="modal_first_name_error" class="text-danger"></small>
            </div>
            <div class="col-md-6">
               <label class="form-label">Last Name</label>
               <input type="text" id="modal_last_name" class="form-control" name="last_name" placeholder="Enter Last Name">
               <small id="modal_last_name_error" class="text-danger"></small>
            </div> 
            <div class="col-md-6">
               <label class="form-label">Address</label>
               <input type="text" id="modal_address" class="form-control" name="address" placeholder="Enter Address">
               <small id="modal_address_error" class="text-danger"></small>
            </div>
            <div class="col-md-6">
               <label class="form-label">Phone</label>
               <input type="text" id="modal_phone" class="form-control" name="phone" placeholder="Enter Phone">
               <small id="modal_phone_error" class="text-danger"></small>
            </div>
            <div class="col-md-6">
               <label class="form-label">Email ID</label>
               <input type="email" id="modal_email" class="form-control" name="email" placeholder="Enter Email ID">
               <small id="modal_email_error" class="text-danger"></small>
            </div>
         </div>

         <button type="submit" class="btn btn-primary mt-3">Add Prospect</button>
        
         </form>
      </div>
   </div>
</div>


  <script>
    // Open Modal
    function openModal_img(imageUrl) {
      document.getElementById("modalImage").src = imageUrl;
      document.getElementById("myModal_img").style.display = "block";
    }

    // Close Modal
    function closeModal_img() {
      document.getElementById("myModal_img").style.display = "none";
    }

  </script>

    <script>
    // Open Modal
    function frelanc_add() {
      // Clear old errors
      clearModalErrors();
      document.getElementById("frelanc_pop").style.display = "block";
    }

    // Close Modal
    function closeModal() {
      // Clear old errors
      clearModalErrors();
      document.getElementById("frelanc_pop").style.display = "none";
    }

    
   function clearModalErrors() {
      document.querySelectorAll('#freelancer_modal small.text-danger').forEach(el => el.textContent = '');
   }

   // Close modal if clicked outside
   window.onclick = function(event) {
      let modalImg = document.getElementById("myModal_img");
      let modalProspect = document.getElementById("frelanc_pop");

      if (event.target === modalImg) {
         closeModal_img();
      }
      if (event.target === modalProspect) {
         closeModal();
      }
   }

   // Save Prospect Data (AJAX submit)
   function saveProspectData() {
      var form = $('#prospect_form');
      var formData = form.serialize(); // Serialize form data

      // Clear old errors and messages
      $('.text-danger').text('');
      $('#modal_message').html('').removeClass();

      $.ajax({
         url: "{{ route('freelancer.prospects.addProspects') }}",
         type: "POST",
         data: formData,
         headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
         },
         success: function(data) {
               if (data.success) {
                  // Show success message
                  $('#modal_message').addClass('alert alert-success').text(data.message);
                  form[0].reset(); // Reset form

                  // Hide message after 3 seconds
                  setTimeout(function() {
                     $('#modal_message').html('').removeClass();
                     closeModal(); // Close modal
                  }, 3000);
               }
         },
         error: function(xhr) {
            if (xhr.status === 422) {
               // Validation errors
               var errors = xhr.responseJSON.errors;
               $.each(errors, function(field, messages) {
                     $('#modal_' + field + '_error').text(messages[0]);
               });
            } else {
               // Show actual error message
               var errorMessage = '';

               if (xhr.responseJSON && xhr.responseJSON.message) {
                     errorMessage = xhr.responseJSON.message; // Laravel JSON error
               } else if (xhr.responseText) {
                     errorMessage = xhr.responseText; // fallback if HTML/plain text
               } else {
                     errorMessage = 'Unexpected error occurred!';
               }

               $('#modal_message')
                     .addClass('alert alert-danger')
                     .text(errorMessage);

               setTimeout(function() {
                     $('#modal_message').html('').removeClass();
               }, 5000);
            }
         }

      });
   }



</script>


  <footer class="pc-footer">
         <div class="footer-wrapper container-fluid">
            <div class="row">
               <div class="col-sm-6 my-1">
                  <p class="m-0">Made with &#9829; by Team <a href="#" target="_blank"> Cello Community</a></p>
               </div>
               
            </div>
         </div>
      </footer>
      <!-- Required Js -->
      <script src="{{ asset('freelance/assets/js/plugins/popper.min.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/plugins/simplebar.min.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/plugins/bootstrap.min.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/plugins/i18next.min.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/plugins/i18nextHttpBackend.min.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/icon/custom-font.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/script.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/theme.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/multi-lang.js')}}"></script>
      <script src="{{ asset('freelance/assets/js/plugins/feather.min.js')}}"></script>
      <script>
         layout_change('light');
      </script>
      <script>
         layout_sidebar_change('light');
      </script>
      <script>
         change_box_container('false');
      </script>
      <script>
         layout_caption_change('true');
      </script>
      <script>
         layout_rtl_change('false');
      </script>
      <script>
         preset_change('preset-1');
      </script>
      
   </body>
   <!-- [Body] end -->
</html>
@yield('scripts')