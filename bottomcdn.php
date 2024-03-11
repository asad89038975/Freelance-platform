<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="logout.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- functionalityy to show password -->
<script>
  $(document).ready(function(){
    $('#show_password').on(
      'click', function(){
        var passwordField = $('#password');
        var passwordFieldType = passwordField.attr('type');

        if (passwordFieldType == 'password') {
          passwordField.attr('type', 'text');
          $(this).removeClass('bi bi-eye-fill').addClass('bi bi-eye-slash-fill');
        }else{
          passwordField.attr('type', 'password');
          $(this).removeClass('bi bi-eye-slash-fill').addClass('bi bi-eye-fill');
        }

      }
    )

  });
</script>
<!-- functionality for checking if email already exist -->
 <script>
    $(document).ready(function(){
      $('#email').blur(function(){
        var email = $(this).val();
        $.ajax({
          url: "check.php",
          method: "POST",
          data: {email: email},
          dataType: "text",
          success: function(html){
            $('#availability').html(html);
          }
        })
      })
    });
  </script>
