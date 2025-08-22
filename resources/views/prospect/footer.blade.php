 <div id="frelanc_pop" class="modal img_pop">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Add Freelancer</h2>
      <div class="pop_divdr"></div>
      <div class="clear"></div>
      <div class="card-body" bis_skin_checked="1">
                  <div class="row" bis_skin_checked="1">
                     <div id="freelancerForm" class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                           <input type="hidden" name="freelancer_type" id="freelancer_type">
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >First Name</label>
                              <input type="text" class="form-control" id="modal_first_name" name="first_name" placeholder="Enter First Name">
                              <small id="modal_first_name_error" class="text-danger"></small>
                           </div>
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Last Name</label>
                              <input type="text" class="form-control" id="modal_last_name" name="last_name" placeholder="Enter Last Name">
                              <small id="modal_last_name_error" class="text-danger"></small>
                           </div>
                           <!-- <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Referral code</label>
                              <input type="text" class="form-control" id="modal_referral_code" name="referral_code"  placeholder="Enter Referral Code">
                              <small id="modal_referral_code_error" class="text-danger"></small>
                           </div> -->
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Address</label>
                              <input type="text" class="form-control" id="modal_address" name="address"  placeholder="Enter Address">
                              <small id="modal_address_error" class="text-danger"></small>
                           </div>
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Phone</label>
                              <input type="text" class="form-control" id="modal_phone" name="phone" placeholder="Enter Phone">
                              <small id="modal_phone_error" class="text-danger"></small>
                           </div>
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Email ID</label>
                              <input type="text" class="form-control" id="modal_email" name="email"  placeholder="Enter Email ID">
                              <small id="modal_email_error" class="text-danger"></small>
                           </div>

                           <div class="clear"></div>
                          
                           
                           <div class="clear"></div>

                           <button type="submit" onclick="saveFreelancerData()" class="btn btn-primary mb-4 submi_movi submi_movi_pop"  >
                              Add Freelancer
                           </button>
                     </div>
                  </div>
               </div>
    </div>
 </div>

  <script>
      // Open Modal
      function frelanc_add(type) {

        // Store type
        document.getElementById("freelancer_type").value = type;

        // Update modal title
        let titleText = type === 'A' ? "Add Freelancer A" : "Add Freelancer B";
        document.querySelector("#frelanc_pop h2").textContent = titleText;

        // Clear old errors
        clearModalErrors();

        // Reset all form fields
        // document.querySelectorAll('#frelanc_pop input').forEach(input => {
        //     input.value = '';
        // });

        // Show modal
        document.getElementById("frelanc_pop").style.display = "block";
      }

      // Close Modal
      function closeModal() {

        // Clear old errors
        clearModalErrors();
        document.getElementById("frelanc_pop").style.display = "none";
      }

    
      function clearModalErrors() {
          document.querySelectorAll('#frelanc_pop small.text-danger').forEach(el => el.textContent = '');
      }

        // Close if clicked outside modal content
        window.onclick = function(event) {
          let modal = document.getElementById("frelanc_pop");
          if (event.target === modal) {
            closeModal();
          }
        }

      function saveFreelancerData() {
        let type = document.getElementById('freelancer_type').value;
        let firstName = document.getElementById('modal_first_name').value.trim();
        let lastName = document.getElementById('modal_last_name').value.trim();
        let email = document.getElementById('modal_email').value.trim();
        let phone = document.getElementById('modal_phone').value.trim();
        let address = document.getElementById('modal_address').value.trim();

        let valid = true;
        clearModalErrors();

        if (!firstName) { document.getElementById('modal_first_name_error').textContent = "First name is required"; valid = false; }
        if (!lastName) { document.getElementById('modal_last_name_error').textContent = "Last name is required"; valid = false; }
        if (!email) { document.getElementById('modal_email_error').textContent = "Email is required"; valid = false; }
        if (!phone) { document.getElementById('modal_phone_error').textContent = "Phone is required"; valid = false; }
        if (!address) { document.getElementById('modal_address_error').textContent = "Address is required"; valid = false; }

        if (!valid) return;

        if (type === 'A') {
          document.getElementById('freelancer_a_first_name').value = document.getElementById('modal_first_name').value;
          document.getElementById('freelancer_a_last_name').value = document.getElementById('modal_last_name').value;
          document.getElementById('freelancer_a_email').value = document.getElementById('modal_email').value;
          document.getElementById('freelancer_a_phone').value = document.getElementById('modal_phone').value;
          document.getElementById('freelancer_a_address').value = document.getElementById('modal_address').value;
          // document.getElementById('freelancer_a_referral_code"').value = document.getElementById('modal_referral_code').value;
           document.getElementById('freelancer_a_message').textContent = `✅ ${firstName} ${lastName} added successfully!`;
        } 
        else if (type === 'B') {
          document.getElementById('freelancer_b_first_name').value = document.getElementById('modal_first_name').value;
          document.getElementById('freelancer_b_last_name').value = document.getElementById('modal_last_name').value;
          document.getElementById('freelancer_b_email').value = document.getElementById('modal_email').value;
          document.getElementById('freelancer_b_phone').value = document.getElementById('modal_phone').value;
          document.getElementById('freelancer_b_address').value = document.getElementById('modal_address').value;
          // document.getElementById('freelancer_b_referral_code"').value = document.getElementById('modal_referral_code').value;
          document.getElementById('freelancer_b_message').textContent = `✅ ${firstName} ${lastName} added successfully!`;
        }

        // Close modal
        closeModal();

        // Reset form fields
        document.querySelectorAll('#frelanc_pop input').forEach(input => {
            input.value = '';
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
      <script src="{{ asset('prospect/assets/js/plugins/popper.min.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/plugins/simplebar.min.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/plugins/bootstrap.min.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/plugins/i18next.min.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/plugins/i18nextHttpBackend.min.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/icon/custom-font.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/script.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/theme.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/multi-lang.js')}}"></script>
      <script src="{{ asset('prospect/assets/js/plugins/feather.min.js')}}"></script>
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