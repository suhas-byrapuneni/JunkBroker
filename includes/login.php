<!-- The Modal -->
<div class="modal fade" id="loginModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Administrator Login</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="includes/loginvalidation.php" method="post">
            <input type="text" class="form-control" name="Username" placeholder="Username"><br/>
            <input type="password" class="form-control" name="Password" placeholder="Password"><br/>
            <div class="loginContainer">
                <input type="submit" name="Login" class="loginSubmitBtn loginmodal-submit" value="Sign in">
            </div>
        </form>
    </div>
  </div>
</div>