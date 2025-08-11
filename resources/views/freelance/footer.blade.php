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
      <h2>Add Prospects</h2>
      <div class="pop_divdr"></div>
      <div class="clear"></div>
      <div class="card-body" bis_skin_checked="1">
                  <div class="row" bis_skin_checked="1">
                     <div class="col-md-12 comn_md comn_md" bis_skin_checked="1">
                        <form>
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >First Name</label>
                              <input type="text" class="form-control"  placeholder="Enter First Name">
                           </div>
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Last Name</label>
                              <input type="text" class="form-control"  placeholder="Enter Last Name">
                           </div>
                           
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Address</label>
                              <input type="text" class="form-control"  placeholder="Enter Address">
                           </div>
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Phone</label>
                              <input type="text" class="form-control"  placeholder="Enter Phone">
                           </div>
                           <div class="col-md-6" bis_skin_checked="1">
                              <label class="form-label" >Email ID</label>
                              <input type="text" class="form-control"  placeholder="Enter Email ID">
                           </div>

                           <div class="clear"></div>
                          
                           
                           <div class="clear"></div>

                           <button type="submit" class="btn btn-primary mb-4 submi_movi submi_movi_pop"  >Add Prospects</button>
                        </form>
                     </div>
                  </div>
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

    // Close if clicked outside modal content
    window.onclick = function(event) {
      let modal = document.getElementById("myModal_img");
      if (event.target === modal) {
        closeModal_img();
      }
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
         document.getElementById('freelancer_a_referral_code"').value = document.getElementById('modal_referral_code').value;
      } 
      else if (type === 'B') {
         document.getElementById('freelancer_b_first_name').value = document.getElementById('modal_first_name').value;
         document.getElementById('freelancer_b_last_name').value = document.getElementById('modal_last_name').value;
         document.getElementById('freelancer_b_email').value = document.getElementById('modal_email').value;
         document.getElementById('freelancer_b_phone').value = document.getElementById('modal_phone').value;
         document.getElementById('freelancer_b_address').value = document.getElementById('modal_address').value;
         document.getElementById('freelancer_b_referral_code"').value = document.getElementById('modal_referral_code').value;
      }

       closeModal();
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
      <script src="{{ asset('user/assets/js/plugins/popper.min.js')}}"></script>
      <script src="{{ asset('user/assets/js/plugins/simplebar.min.js')}}"></script>
      <script src="{{ asset('user/assets/js/plugins/bootstrap.min.js')}}"></script>
      <script src="{{ asset('user/assets/js/plugins/i18next.min.js')}}"></script>
      <script src="{{ asset('user/assets/js/plugins/i18nextHttpBackend.min.js')}}"></script>
      <script src="{{ asset('user/assets/js/icon/custom-font.js')}}"></script>
      <script src="{{ asset('user/assets/js/script.js')}}"></script>
      <script src="{{ asset('user/assets/js/theme.js')}}"></script>
      <script src="{{ asset('user/assets/js/multi-lang.js')}}"></script>
      <script src="{{ asset('user/assets/js/plugins/feather.min.js')}}"></script>
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