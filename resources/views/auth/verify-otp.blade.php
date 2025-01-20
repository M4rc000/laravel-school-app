<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OTP Verification</title>
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <style>
          /* Import Google font - Poppins */
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }
      body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #4070f4;
      }
      :where(.container, form, .input-field, header) {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      .container {
        background: #fff;
        padding: 30px 65px;
        border-radius: 12px;
        row-gap: 20px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      }
      .container header {
        height: 65px;
        width: 65px;
        background: #4070f4;
        color: #fff;
        font-size: 2.5rem;
        border-radius: 50%;
      }
      .container h4 {
        font-size: 1.25rem;
        color: #333;
        font-weight: 500;
      }
      form .input-field {
        flex-direction: row;
        column-gap: 10px;
      }
      .input-field input {
        height: 45px;
        width: 42px;
        border-radius: 6px;
        outline: none;
        font-size: 1.125rem;
        text-align: center;
        border: 1px solid #ddd;
      }
      .input-field input:focus {
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
      }
      .input-field input::-webkit-inner-spin-button,
      .input-field input::-webkit-outer-spin-button {
        display: none;
      }
      form button {
        margin-top: 25px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        border: none;
        padding: 9px 0;
        cursor: pointer;
        border-radius: 6px;
        pointer-events: none;
        background: #6e93f7;
        transition: all 0.2s ease;
      }
      form button.active {
        background: #4070f4;
        pointer-events: auto;
      }
      form button:hover {
        background: #0e4bf1;
      }
   </style>
  </head>
  <body>
    <div class="container">
      <header>
        <i class="bx bxs-check-shield"></i>
      </header>
      <h4>Enter OTP Code</h4>
      <form action="verification-sendOTP" method="POST">
        @csrf
      <div class="input-field">
          <input type="text" name="user_id" id="user_id" value="{{ $user->id }}" style="display: none"/>
          <input type="number" name="input-satu" id="input-satu"/>
          <input type="number" name="input-dua" id="input-dua" disabled />
          <input type="number" name="input-tiga" id="input-tiga" disabled />
          <input type="number" name="input-empat" name="input-empat" disabled />
        </div>
        <button type="submit">Verify OTP</button>
      </form>
    <br>
    <a href="#" id="resendLink">Resend OTP <span id="resend"></span></a>
    </div>

    <script src="{{ asset('assets/vendor/js/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/sweetalert/sweetalert.js') }}"></script>
    <script>
       const inputs = document.querySelectorAll("input"),
        button = document.querySelector("button");

      // iterate over all inputs
      inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
          // This code gets the current input element and stores it in the currentInput variable
          // This code gets the next sibling element of the current input element and stores it in the nextInput variable
          // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
          const currentInput = input,
            nextInput = input.nextElementSibling,
            prevInput = input.previousElementSibling;

          // if the value has more than one character then clear it
          if (currentInput.value.length > 1) {
            currentInput.value = "";
            return;
          }
          // if the next input is disabled and the current value is not empty
          //  enable the next input and focus on it
          if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
            nextInput.removeAttribute("disabled");
            nextInput.focus();
          }

          // if the backspace key is pressed
          if (e.key === "Backspace") {
            // iterate over all inputs again
            inputs.forEach((input, index2) => {
              // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
              // and the previous element exists, set the disabled attribute on the input and focus on the previous element
              if (index1 <= index2 && prevInput) {
                input.setAttribute("disabled", true);
                input.value = "";
                prevInput.focus();
              }
            });
          }
          //if the fourth input( which index number is 3) is not empty and has not disable attribute then
          //add active class if not then remove the active class.
          if (!inputs[3].disabled && inputs[3].value !== "") {
            button.classList.add("active");
            return;
          }
          button.classList.remove("active");
        });
      });

      //focus the first input which index is 0 on window load
      window.addEventListener("load", () => inputs[0].focus());

      $(document).ready(function () {
        $('#resendLink').click(function (e) {
          e.preventDefault(); // Prevent default behavior of <a> tag

          loadingAnimation();

          const resendLink = $(this);
          resendLink.html('Resend OTP in (3:00) remaining'); // Change body of this element

          const user_id = {{ $user->id }}; // Pass the user's ID

          // Disable the link to prevent multiple clicks
          resendLink.css('pointer-events', 'none');

          // Start a countdown timer (3 minutes = 180 seconds)
          let timer = 180;
          const countdown = setInterval(function () {
              timer--;
              const minutes = Math.floor(timer / 60);
              const seconds = timer % 60;
              resendLink.html(`Resend OTP in (${minutes}:${seconds < 10 ? '0' : ''}${seconds}) remaining`);
              
              if (timer <= 0) {
                  clearInterval(countdown);
                  resendLink.html('Resend OTP').css('pointer-events', 'auto'); // Re-enable the link
              }
          }, 1000);

          $.ajax({
              url: '<?= env('APP_URL') . '/auth/resend-otp'; ?>',
              type: 'post',
              dataType: 'json',
              data: {
                user_id: user_id,
                _token: $('input[name="_token"]').val(), 
              },
              success: function (res) {
                if (res.status === 'success_resend_otp') {
                    Swal.fire({
                        title: "Success",
                        html: res.message,
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        html: "Failed to send new OTP",
                        icon: "error"
                    });
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire({
                  title: "Error",
                  html: "An error occurred while resending the OTP.",
                  icon: "error"
                });
              }
          });
        });

      @if (session()->has('success_registration'))   
        Swal.fire({
            title: "Success",
            html: "Registration successful! Please check your email <strong>{{ session('success_registration') }}</strong> to verify your account.",
            icon: "success"
        });
      @endif
      @if ($success_send_otp)   
        Swal.fire({
            title: "Success",
            html: `{{ $success_send_otp }}`,
            icon: "success"
        });
      @endif
    });
    </script>
  </body>
</html>