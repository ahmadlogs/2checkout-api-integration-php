<!-- Footer -->
  <footer class="footer bg-light footer-bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">About</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">Copyright &copy;  2020 - <?php echo date('Y', time());?> <a href="https://ahmadlogs.wordpress.com/">Ahmadlogs</a> All rights reserved.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="https://www.facebook.com/ahmadlogs">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="https://twitter.com/ahmadlogs">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.youtube.com/channel/UCOXYfOHgu-C-UfGyDcu5sYw/">
                <i class="fab fa-youtube fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://ahmadlogs.wordpress.com/">
                <i class="fab fa-wordpress fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  
  <!-- Bootstrap core JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  
  <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
  
  <script>
        $(function() {
          // Pull in the public encryption key for our environment
          TCO.loadPubKey('production');
          $("#myCCForm").submit(function(e) {
              // Call our token request function
              tokenRequest();
              // Prevent form from submitting
              return false;
          });
      });
	  
      var tokenRequest = function() {
          // Setup token request arguments                
          var args = {
              sellerId: "<?php print TWOCHECKOUT_SELLER_ID; ?>",
              publishableKey: "<?php print TWOCHECKOUT_PUBLISHABLE_KEY;?>",
              ccNo: $("#ccNo").val(),
              cvv: $("#cvv").val(),
              expMonth: $("#expMonth").val(),
              expYear: $("#expYear").val()
          };
		  console.log(args);
          // Make the token request
          TCO.requestToken(successCallback, errorCallback, args);
      };
	  
      // Called when token created successfully.
      var successCallback = function(data) {
          var myForm = document.getElementById('myCCForm');
          // Set the token as the value for the token input
          myForm.token.value = data.response.token.token;
          // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
          myForm.submit();
      };
	  
      // Called when token creation fails.
      var errorCallback = function(data) {
          if (data.errorCode === 200) {
              tokenRequest();
          } else {
              alert(data.errorMsg);
          }
      };
	  
  </script>
</body>
</html>













