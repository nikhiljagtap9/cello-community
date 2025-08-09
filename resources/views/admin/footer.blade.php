 <div id="myModal_img" class="modal img_pop">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Project Image</h2>
      <img id="modalImage" src="" alt="Project Image">
    </div>

  <script>
    // Open Modal
    function openModal_img(imageUrl) {
      document.getElementById("modalImage").src = imageUrl;
      document.getElementById("myModal_img").style.display = "block";
    }

    // Close Modal
    function closeModal() {
      document.getElementById("myModal_img").style.display = "none";
    }

    // Close if clicked outside modal content
    window.onclick = function(event) {
      let modal = document.getElementById("myModal_img");
      if (event.target === modal) {
        closeModal();
      }
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
      <script src="{{ asset('admin/assets/js/plugins/popper.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/simplebar.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/bootstrap.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/i18next.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/i18nextHttpBackend.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/icon/custom-font.js')}}"></script>
      <script src="{{ asset('admin/assets/js/script.js')}}"></script>
      <script src="{{ asset('admin/assets/js/theme.js')}}"></script>
      <script src="{{ asset('admin/assets/js/multi-lang.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/feather.min.js')}}"></script>
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