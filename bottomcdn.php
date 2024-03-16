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
<script>
  $(document).ready(function(){
    $('#show_repassword').on(
      'click', function(){
        var passwordField = $('#repassword');
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
  <!-- auto suggestion input -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $('#skill_name').keyup(function(){
        var query = $(this).val();
        if (query != '') {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: {query:query},
                success:function(data){
                    $('#skillsList').fadeIn();
                    $('#skillsList').html(data);
                }
            });
        }
    });

    $(document).on('click', 'li', function(){
        var selectedValue = $(this).text();
        var currentValue = $('#skill_name').val();
        
        // Append the selected value with a comma if the field is not empty
        if (currentValue !== '') {
            $('#skill_name').val(currentValue + ', ' + selectedValue);
        } else {
            $('#skill_name').val(selectedValue);
        }
        
        $('#skillsList').fadeOut();
        
        // Append selected value to selectedValues div with a close button
        $('#selectedValues').append('<span class="selected-value">' + selectedValue + '<button class="remove-value">X</button></span>');
    });

    // Remove value when close button is clicked
    $(document).on('click', '.remove-value', function(){
        $(this).parent().remove();
        updateSkillInput();
    });

    $('#skill_name').on('change', function(){
        updateSkillInput();
    });

    function updateSkillInput() {
        var selectedValues = [];
        $('.selected-value').each(function(){
            selectedValues.push($(this).text());
        });
        $('#skill_name').val(selectedValues.join(', '));
    }
});
</script>


