// Global
//#region Initialization
$(document).ready(function () {
  $('.sidenav').sidenav(); // Init header (navbar)
  $('.tooltipped').tooltip(); // Init tooltip
  $('.dropdown-trigger').dropdown(); // Init dropdown
  $('input#productName, textarea#productDescription').characterCounter(); // Counter
  $('.materialboxed').materialbox(); // Material box
});
//#endregion

//#region Modal
var modalButton = '.modal .modalContent button.btn.close';
function OpenModal(text, closeEnabled) {
  // Open Modal
  $('.modal .modalContent p.output').html(text);
  $('.modal').removeClass('hide');

  if (closeEnabled) {
    $(modalButton).removeClass('disabled');
  } else {
    $(modalButton).addClass('disabled');
  }
}

function CloseModal() {
  $('.modal').addClass('hide');
}

$('.modal .modalContent button.close').click(function () {
  $('.modal').addClass('hide');
});
//#endregion

//#region loading Modal
function OpenLoadingModal() {
  // Open loading modal
  $('.loadingModal').removeClass('hide');
}

function CloseLoadingModal() {
  $('.loadingModal').addClass('hide');
}
//#endregion

//#region Captcha
function Captcha(token) {
  // Captcha success
  captchaDone = true;
  OpenLoadingModal();

  call = $('#recaptcha-callback').val();

  if (call == 0) { // Signin
    Signin(token);
    $('.userBar > .userContainer > .userInfoContainer  .signinButton').addClass('disabled');
  } else if (call == 1) { // Signup
    Signup(token);
    $('.signup .signupContainer .signupButton').addClass('disabled');
  } else if (call == 2) { // New product
    AddProduct(token);
    $(addProductButton).addClass('disabled');
  } else if (call == 3) { // Edit product
    EditProduct(token);
    $(editProductButton).addClass('disabled');
  }

  setTimeout(function () {
    captchaDone = false;
  }, 200);
}

function ResetButton(call) {
  if (call == 0) {
    ResetSigninButton();
  } else if (call == 1) {
    ResetSignupButton();
  } else if (call == 2) {
    $(addProductButton).removeClass('disabled');
  } else if (call == 3) {
    $(editProductButton).removeClass('disabled');
  }
}

//#region Token timer
var tokenTimer;
var maxTokenTimer = 30;
var resendTimer;
function TokenTimer(tokenType) {
  tokenTimer = maxTokenTimer; // Reset

  // 0 - Activation
  if (tokenType === 0) {
    clearInterval(resendTimer);
    resendTimer = setInterval(function () {
      if (tokenTimer >= 0) {
        $('.signup .signupContainer .activationResendTokenButton').html('Resend Token (' + tokenTimer-- + ')');
      } else {
        // Timer ends
        // Enable button
        clearInterval(resendTimer);
        $('.signup .signupContainer .activationResendTokenButton').removeClass('disabled');
        tokenTimer = maxTokenTimer;
        $('.signup .signupContainer .activationResendTokenButton').html('Resend Token (' + tokenTimer + ')');
      }
    }, 1000);
  }

  if (tokenType === 1) {
    clearInterval(resendTimer);
    resendTimer = setInterval(function () {
      if (tokenTimer >= 0) {
        $('.changeEmailResendTokenButton').html('Resend Token (' + tokenTimer-- + ')');
      } else {
        // Timer ends
        // Enable button
        clearInterval(resendTimer);
        $('.changeEmailResendTokenButton').removeClass('disabled');
        tokenTimer = maxTokenTimer;
        $('.changeEmailResendTokenButton').html('Resend Token (' + tokenTimer + ')');
      }
    }, 1000);
  }
}
//#endregion

//#region Regenerate and resend token
function RegenerateAndResendToken(tokenType, email) {
  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'resendtoken',
      'tokenType': tokenType,
      'email': email
    },

    success: function (result) {
      if (result['status'] != 1) {
        // Show messages (problem)
        switch (tokenType) {
          case 0:
            $(activationTokenResult).addClass('fieldWarning');
            $(activationTokenResult).html(result['message']); break; // Activation
          case 1:
            $(changeEmailResendTokenResult).addClass('fieldWarning');
            $(changeEmailResendTokenResult).html(result['message']); break; // Change email
        }
      } else if (result['status'] == 1) {
        switch (tokenType) {
          case 0:
            $(activationTokenResult).removeClass('fieldWarning');
            $(activationTokenResult).html('Email sent'); break; // Activation
          case 1:
            $(changeEmailResendTokenResult).removeClass('fieldWarning');
            $(changeEmailResendTokenResult).html('Email sent');
            break; // Change email
        }
      }
    }
  });
}
//#endregion

// Content list (cards)
//#region New product hover
$('.addCard').on('mouseover', function () {
  $('.addCard').css('cursor', 'pointer')
});

$('.addCard').on('mouseout', function () {
  $('.addCard').css('cursor', 'default')
});
//#endregion

//#region Delete card
$(document).on('mouseover', 'i.deleteCard', function () {
  $(this).css('cursor', 'pointer')
});

$(document).on('mouseout', 'i.deleteCard', function () {
  $(this).css('cursor', 'default')
});

$(document).on('click', 'i.deleteCard', function () {
  $(this).closest('.col').remove();
  numOfImage++;

  if ($('#newProductPage').length) {
    UpdateAddProductButton();
    $(imageBrowser).val(null);

  }

  if ($('#editProductPage').length) {
    UpdateEditProductButton();
    $(imageBrowser).val(null);
  }
});
//#endregion

// Header.php
//#region User box / signin bar
// Check if 'My Account' tab is hoevered on the signin bar
var onHover;
var animationSpeed = 100; // In ms
$('.accountButton').click(function () {
  if (!onHover) {
    ShowUserInfo();
    loginError = false;

    if (window.innerWidth > 768)
      $(signinEmailInput).first().focus();
  } else {
    HideUserInfo();
    loginError = false;
  }
});

$('.accountButton').mouseover(function () {
  if (window.innerWidth > 768) {
    $(signinEmailInput).first().focus();
    ShowUserInfo();
    loginError = false;
  }
});

$('.userContainer').mouseover(function () {
  if (window.innerWidth > 768) {
    ShowUserInfo();
    loginError = false;
  }
});

$('.back').click(function () {
  HideUserInfo();
  loginError = false;
})

$('.back').mouseover(function () {
  if (window.innerWidth > 768) {
    HideUserInfo();
    loginError = false;
  }
});

function ShowUserInfo() {
  onHover = true;
  // Fadein
  if (!$('.userBar > .userContainer > .userInfoContainer').hasClass('showInfoContainer')) {
    $('.userBar > .userContainer > .userInfoContainer').animate({ 'opacity': '1' }, animationSpeed);
    $('.back').removeClass('hide');
  }

  // Add class
  $('.userBar > .userContainer > .userInfoContainer').addClass('showInfoContainer');
}

function HideUserInfo() {
  if (!loginError) {
    onHover = false;
    // Delay to avoid showInfoContainer disappearing when moving from userContainer to userInfoContainer
    setTimeout(function () {
      if (!onHover) {
        $('.userBar > .userContainer > .userInfoContainer').animate({ 'opacity': '0' }, animationSpeed);
        $('.back').addClass('hide');

        // Remove showInfoContainer after animation isd one
        setTimeout(function () {
          $('.userBar > .userContainer > .userInfoContainer').removeClass('showInfoContainer');
          onHover = false;
        }, animationSpeed);
      }
    }, animationSpeed);
  }
}

// Detect mobile scrollbar (disable userInfoContainer)
$('body').on('touchmove', function () {
  if ($('.userBar > .userContainer > .userInfoContainer').hasClass('showInfoContainer')) {
    $('.userBar > .userContainer > .userInfoContainer').animate({ 'opacity': '0' }, animationSpeed);
    $('.back').addClass('hide');

    // Remove showInfoContainer after animation isd one
    setTimeout(function () {
      $('.userBar > .userContainer > .userInfoContainer').removeClass('showInfoContainer');
      onHover = false;
    }, animationSpeed);
  }
});
//#endregion

// Signin.php =====
//#region Sign in email input
var signinEmailInput = '.userBar > .userContainer > .userInfoContainer input.signinEmailInput';
var signinPasswordInput = '.userBar > .userContainer > .userInfoContainer input.signinPasswordInput';
var signinEmail = "";
var signinEmailOk = false;
var signinPassword = "";
var keepLoggedin = false;
var loginError = false;

var re = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
$(signinEmailInput).on('input', function () {
  signinEmail = $(signinEmailInput).val();
  $('#signinResult').html('');

  if (signinEmail.match(re)) {
    signinEmailOk = true;

    $(signinEmailInput).removeClass('invalid');
    $(signinEmailInput).addClass('valid');
  }
  else {
    if (signinEmail.length > 0) {
      signinEmailOk = false;

      $(signinEmailInput).removeClass('valid');
      $(signinEmailInput).addClass('invalid');
    }
  }

  CheckSigninInput();
});
//#endregion

//#region Sign in password input
$(signinPasswordInput).on('input', function () {
  signinPassword = $(signinPasswordInput).val();
  $('#signinResult').html('');

  if (signinPassword != "") {
    $(signinPasswordInput).removeClass('invalid');
    $(signinPasswordInput).addClass('valid');
  } else {
    $(signinPasswordInput).removeClass('valid');
    $(signinPasswordInput).addClass('invalid');
  }

  CheckSigninInput();
});
//#endregion

//#region Sign in button validation
function CheckSigninInput() {
  if (signinEmail != "" && signinEmailOk && signinPassword != "") {
    $('.userBar > .userContainer > .userInfoContainer .signinButton').removeClass('disabled');
  } else {
    $('.userBar > .userContainer > .userInfoContainer .signinButton').addClass('disabled');
  }
}
//#endregion

//#region Sign in button
// Signin button pressed
$('.userBar > .userContainer > .userInfoContainer .signinButton').click(function () {
  $('#signinResult').html('');

  // Get remmeber me value
  keepLoggedin = $('.userBar > .userContainer > .userInfoContainer .keepLoggedin').is(":checked") ? true : false;

  $('#recaptcha-callback').val(0);
  grecaptcha.execute();
});

function Signin(token) {
  // Check database
  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'signin',
      'token': token,
      'email': signinEmail,
      'password': signinPassword,
      'keeploggedin': keepLoggedin
    },
    success: function (result) {
      if (result['status'] === 1) {
        location.reload();
      } else if (result['status'] === 2) {
        // Redirect to activation page
        window.location.href = "activation.php?e=" + result['email'], true;
      } else {
        CloseLoadingModal();
        $('#signinResult').html(result['message']);
        ResetSigninButton();
        loginError = true;
      }

      // Reset google recaptcha
      //grecaptcha.reset();
    },

    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus); alert("Error: " + errorThrown); alert("Data: " + this.data);
      ResetSignupButton();
      CloseLoadingModal();
    }
  });
}

function ResetSigninButton() {
  if (signinEmail != "" && signinEmailOk && signinPassword != "")
    $('.userBar > .userContainer > .userInfoContainer .signinButton').removeClass('disabled');
}
//#endregion

//#region Sign out
$('.userBar > .userContainer > .userInfoContainer .signoutButton').click(function () {
  $.ajax({
    type: 'POST',
    url: 'php/signout.php',
    data: {
      'signout': true
    },

    success: function () {
      location.reload();
    }
  });
});
//#endregion

//#region Sign up
if ($('#signup').length) {
  // Check if signup.php loaded
  // Fix autofocus (due to header having autofocus)
  $('.signup .signupContainer input').first().focus();
}

// Check passwrd & repeatPassword
var signupNameOk = false;
var signupUsersignupNameOk = false;
var signupPasswordOk = false;
var signupEmailOk = false;

var phpURL = 'php/sphonestore.php';
//#endregion

// signup.php =====
//#region Sign up name input ==
// Execute when user is typing name
var nameInput = '.signup .signupContainer .nameInput';
var fullName = "";
$(nameInput).on('input', function () {
  fullName = $(nameInput).val();

  if (fullName != "") {
    signupNameOk = true;
    $(nameInput).addClass('valid');
    $(nameInput).removeClass('invalid');
  }
  else {
    signupNameOk = false;
    $(nameInput).removeClass('valid');
    $(nameInput).addClass('invalid');
  }

  SubmitButton();
});
//#endregion

//#region Sign up email input ==
var emailFormatCorrect = false;
var re = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

var emailInput = '.signup .signupContainer .emailInput';
var emailFieldResult = '.signup .signupContainer #emailFieldResult';
var emailInputDisabled = '.signup .signupContainer .emailInputDisabled';
var email = "";
$(emailInput).on({
  // Execute when user is typing email
  input: function () {
    signupEmailOk = false;
    email = $(emailInput).val();

    HideEmailInputError();
    if (email.match(re)) {
      emailFormatCorrect = true;
    } else {
      emailFormatCorrect = false;
    }

    SubmitButton();
  },

  // Execute when input is unfocused
  focusout: function () {
    email = $(emailInput).val();
    $(emailInputDisabled).val(email);

    if (emailFormatCorrect) {
      // On change
      HideEmailInputError();

      $(emailFieldResult).html('Checking email validity');

      // Disable email input
      // Switch
      $(emailInput).addClass('hide');
      $(emailInputDisabled).removeClass('hide');

      // Check email validity & on database
      $.ajax({
        type: 'POST',
        url: phpURL,
        dataType: 'json',
        data: {
          'call': 'checkemail',
          'email': email
        },
        success: function (result) {
          $(emailFieldResult).html(result['message']);
          if (result['status'] === 1) {
            HideEmailInputError();

            $(emailInputDisabled).addClass('valid');
            $(emailFieldResult).html('Email is valid!');
            signupEmailOk = true;

            SubmitButton();
          }
          else {
            // Add invalid class
            ShowEmailInputError();
            $(emailFieldResult).html(result['message']);

            signupEmailOk = false;

            // Switch
            $(emailInput).removeClass('hide');
            $(emailInputDisabled).addClass('hide');
          }
        }
      });
    } else {
      // Add invalid class
      ShowEmailInputError();
      $(emailFieldResult).html('Invalid email format!');
      signupEmailOk = false;
    }

    SubmitButton();
  }
});
function ShowEmailInputError() {
  $(emailInput).addClass('invalid');
  $(emailFieldResult).addClass('fieldWarning');
  $(emailFieldResult).html('');
}

function HideEmailInputError() {
  $(emailInput).removeClass('invalid');
  $(emailFieldResult).removeClass('fieldWarning');
  $(emailFieldResult).html('');
}
//#endregion

//#region Sign up username input ==
var usernameInput = '.signup .signupContainer .usernameInput';
var usernameFieldResult = '.signup .signupContainer #usernameFieldResult';
var usernameInputDisabled = '.signup .signupContainer .usernameInputDisabled';
var username = "";
$(usernameInput).on({
  // Execute when user is typing username
  input: function () {
    $(usernameInput).removeClass('invalid');
    $(usernameInput).removeClass('valid');
    $(usernameFieldResult).html('');

    signupUsersignupNameOk = false;

    SubmitButton();
  },

  // Execute when input is unfocused
  focusout: function () {
    username = $(usernameInput).val();
    $(usernameInputDisabled).val(username);

    if (username.length >= 8) {
      // Check illgal character
      if (/[ !@#$%^&*()+\-=\[\]{};':'\\|,.<>\/?]/g.test(username)) {
        ShowUsernameInputError();

        $(usernameFieldResult).html('No space or illegal character')
        return; // Dont execute anything after this line
      }

      // On change
      HideUsernameInputError();

      $(usernameFieldResult).html('Checking username availability');

      // Switch
      $(usernameInput).addClass('hide');
      $(usernameInputDisabled).removeClass('hide');

      // Check database
      $.ajax({
        type: 'POST',
        url: phpURL,
        dataType: 'json',
        data: {
          'call': 'checkusername',
          'username': username
        },
        success: function (result) {
          $(usernameFieldResult).html(result['message']);

          if (result['status'] == 1) {
            $(usernameFieldResult).html('Username available');
            $(usernameInput).addClass('valid');
            signupUsersignupNameOk = true;

            SubmitButton();
          }
          else {
            // Add invalid class
            $(usernameInput).addClass('invalid');
            $(usernameFieldResult).addClass('fieldWarning');

            signupUsersignupNameOk = false;
          }

          // Switch
          $(usernameInput).removeClass('hide');
          $(usernameInputDisabled).addClass('hide');
        }
      });
    } else {
      // Add invalid class (character length under 8)
      ShowUsernameInputError();

      $(usernameFieldResult).html('8 Characters min');
      signupUsersignupNameOk = false;
    }

    SubmitButton();
  }
});

function ShowUsernameInputError() {
  $(usernameInput).addClass('invalid');
  $(usernameFieldResult).addClass('fieldWarning');
  $(usernameFieldResult).html('');
}

function HideUsernameInputError() {
  $(usernameInput).removeClass('invalid');
  $(usernameFieldResult).removeClass('fieldWarning');
  $(usernameFieldResult).html('');
}
//#endregion

//#region Sign up Password input
var passwordInput = '.signup .signupContainer .passwordInput';
var passwordFieldResult = '.signup .signupContainer #passwordFieldResult';
var repeatPasswordInput = '.signup .signupContainer .repeatPasswordInput';

var passwordInputShow = '.signup .signupContainer .passwordInputShow';
var repeatPasswordInputShow = '.signup .signupContainer .repeatPasswordInputShow';

var password = "";
var repeatPassword = "";
$(passwordInput).on('input', function () {
  password = $(passwordInput).val();
  $(passwordInputShow).val(password);

  $(passwordInput).removeClass('valid');
  $(passwordInput).removeClass('invalid');

  $(repeatPasswordInput).removeClass('valid');
  $(repeatPasswordInput).removeClass('invalid');

  PasswordCheck();
});

$(passwordInputShow).on('input', function () {
  password = $(passwordInputShow).val();
  $(passwordInput).val(password);

  $(passwordInputShow).removeClass('valid');
  $(passwordInputShow).removeClass('invalid');

  $(repeatPasswordInputShow).removeClass('valid');
  $(repeatPasswordInputShow).removeClass('invalid');

  PasswordCheck();
});

function PasswordCheck() {
  if (password.length >= 8) {
    HidePasswordInputError();
    if (/[ $()_+\-=\[\]{};':'\\|,.<>\/?]/g.test(password)) {
      ShowPasswordInputError();

      $(passwordFieldResult).html('No space or illegal character');
      return; // Dont execute anything after this line
    }

    if (password == repeatPassword) {
      PasswordCorrect();
    } else {
      ResetPasswordCorrect();
      ShowRepeatPasswordInputError();

      $(passwordFieldResult).html('Password not the same!');
      signupPasswordOk = false;
    }
  } else {
    // Add invalid class (character length under 8)
    ResetPasswordCorrect();
    ShowPasswordInputError();

    $(passwordFieldResult).html('8 Characters min');
    signupPasswordOk = false;
  }

  SubmitButton();
}

// Change mouse cursor on hover
$('.signup .signupContainer .showPassword').on('mouseover', function () {
  $('.signup .signupContainer .showPassword').css('cursor', 'pointer')
});

$('.signup .signupContainer .showPassword').on('mouseout', function () {
  $('.signup .signupContainer .showPassword').css('cursor', 'default')
});

// Show password text
$('.signup .signupContainer .showPassword').click(function (e) {
  // Show password
  e.preventDefault();
  if (!$(passwordInput).hasClass('hide')) {
    $('.signup .signupContainer .showPassword .seePassword').addClass('pressed');
    // Switch
    $(passwordInput).addClass('hide');
    $(passwordInputShow).removeClass('hide');

    // Re-focus on input
    $(passwordInputShow).first().focus();

    // tabindex fix
    $(passwordInput).prop('tabIndex', -1);
    $(passwordInputShow).prop('tabIndex', 0);
  } else {
    $('.signup .signupContainer .showPassword .seePassword').removeClass('pressed');
    // Remove
    // Switch
    $(passwordInput).removeClass('hide');
    $(passwordInputShow).addClass('hide');

    // Re-focus on input
    $(passwordInput).first().focus();

    // tabindex fix
    $(passwordInput).prop('tabIndex', 0);
    $(passwordInputShow).prop('tabIndex', -1);
  }
});

function ShowPasswordInputError() {
  $(passwordInput).addClass('invalid');
  $(passwordInputShow).addClass('invalid');

  $(passwordFieldResult).addClass('fieldWarning');
  $(passwordFieldResult).html('');
}

function HidePasswordInputError() {
  $(passwordInput).removeClass('invalid');
  $(passwordInputShow).removeClass('invalid');

  $(passwordFieldResult).removeClass('fieldWarning');
  $(passwordFieldResult).html('');
}

//#endregion

//#region Sign up repeat password ==
$(repeatPasswordInput).on('input', function () {
  repeatPassword = $(repeatPasswordInput).val();
  $(repeatPasswordInputShow).val(repeatPassword);

  ReapeatPasswordCheck();
});

$(repeatPasswordInputShow).on('input', function () {
  repeatPassword = $(repeatPasswordInputShow).val();
  $(repeatPasswordInput).val(repeatPassword);

  ReapeatPasswordCheck();
});

function ReapeatPasswordCheck() {
  if (password.length >= 8) {
    if (repeatPassword != password) {
      ResetPasswordCorrect();
      ShowRepeatPasswordInputError();

      $('#passwordFieldResult').html('Password not the same!');
      signupPasswordOk = false;
    }
    else {
      PasswordCorrect();
    }

    SubmitButton();
  } else {
    ResetPasswordCorrect();
  }
}

function ShowRepeatPasswordInputError() {
  $(passwordFieldResult).addClass('fieldWarning');

  $(repeatPasswordInput).addClass('invalid');
  $(repeatPasswordInputShow).addClass('invalid');
}

function HideRepeatPasswordInputError() {
  $(passwordFieldResult).removeClass('fieldWarning');

  $(repeatPasswordInput).removeClass('invalid');
  $(repeatPasswordInputShow).removeClass('invalid');
}

// Password and repeat password same
function PasswordCorrect() {
  ResetPasswordCorrect();

  $(passwordFieldResult).html('');
  $(passwordFieldResult).removeClass('fieldWarning');

  $(passwordInput).addClass('valid');
  $(passwordInputShow).addClass('valid');

  $(repeatPasswordInput).addClass('valid');
  $(repeatPasswordInputShow).addClass('valid');

  signupPasswordOk = true;
}

function ResetPasswordCorrect() {
  $(passwordInput).removeClass('valid');
  $(passwordInputShow).removeClass('valid');

  $(repeatPasswordInput).removeClass('valid');
  $(repeatPasswordInputShow).removeClass('valid');

  signupPasswordOk = false;
}

// Change mouse cursor on hover
$('.signup .signupContainer .showRepeatPassword').on('mouseover', function () {
  $('.signup .signupContainer .showRepeatPassword').css('cursor', 'pointer')
});

$('.signup .signupContainer .showRepeatPassword').on('mouseout', function () {
  $('.signup .signupContainer .showRepeatPassword').css('cursor', 'default')
});

// Show repeat password text
$('.signup .signupContainer .showRepeatPassword').click(function (e) {
  // Switch
  e.preventDefault();
  if (!$(repeatPasswordInput).hasClass('hide')) {
    $('.signup .signupContainer .showRepeatPassword .seePassword').addClass('pressed');
    // Switch
    $(repeatPasswordInput).addClass('hide');
    $(repeatPasswordInputShow).removeClass('hide');

    // Re-focus on input
    $(repeatPasswordInputShow).first().focus();

    // tabindex fix
    $(repeatPasswordInput).prop('tabIndex', -1);
    $(repeatPasswordInputShow).prop('tabIndex', 0);
  } else {
    // Remove
    $('.signup .signupContainer .showRepeatPassword .seePassword').removeClass('pressed');
    // Switch
    $(repeatPasswordInput).removeClass('hide');
    $(repeatPasswordInputShow).addClass('hide');

    // Re-focus on input
    $(repeatPasswordInput).first().focus();

    // tabindex fix
    $(repeatPasswordInput).prop('tabIndex', 0);
    $(repeatPasswordInputShow).prop('tabIndex', -1);
  }
});
//#endregion

//#region Signup button validation
function SubmitButton() {
  if (signupNameOk && signupEmailOk && signupUsersignupNameOk && signupPasswordOk)
    $('.signup .signupContainer .signupButton').removeClass('disabled');
  else
    $('.signup .signupContainer .signupButton').addClass('disabled');
}
//#endregion

//#region Signup button
// Sign up button pressed
$('.signup .signupContainer .signupButton').click(function () {
  $('#recaptcha-callback').val(1);
  grecaptcha.execute();
});

function ResetSignupButton() {
  if (signupNameOk && signupEmailOk && signupUsersignupNameOk && signupPasswordOk)
    $('.signup .signupContainer .signupButton').removeClass('disabled');
}

function Signup(token) {
  // Check database
  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'signup',
      'token': token,
      'name': fullName,
      'email': email,
      'username': username,
      'password': password,
      'repeatPassword': repeatPassword
    },
    success: function (result) {
      if (result['status'] === 1) {
        // Redirect to activation page
        window.location.href = "activation.php?e=" + result['email'], true;
      } else {
        CloseLoadingModal();
        OpenModal(result['message'], true);
        ResetSignupButton();
      }

      // Reset google recaptcha
      grecaptcha.reset();
    },

    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus); alert("Error: " + errorThrown); alert("Data: " + this.data);
      ResetSignupButton();
      CloseLoadingModal();
    }
  });
}
//#endregion

// activation.php =====
//#region Activation
var re = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
var activationEmailInput = '.signup .signupContainer .activationEmailInput';
var activationEmailInputDisabled = '.signup .signupContainer .activationEmailInputDisabled';
var activationEmailFieldResult = '.signup .signupContainer #activationEmailFieldResult';
var activationEmail = "";
var activationEmailOk = false;
if ($("#activation").length > 0) {
  // Check if activation.php loaded
  $(document).ready(function () {
    activationEmail = $(activationEmailInput).val();
    activationToken = $(activationTokenInput).val();

    if (activationEmail != "") {
      if (activationEmail.match(re)) {
        // Switch
        $(activationEmailInput).addClass('hide');
        $(activationEmailInputDisabled).removeClass('hide');

        // Check if email is valid
        CheckActivationEmail();
      } else {
        $(activationEmailInput).addClass('invalid');
        $(activationEmailFieldResult).html('Invalid email format');
      }
    }
  });
}
//#endregion

//#region Activation email
var re = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
$(activationEmailInput).on({
  input: function () {
    activationEmail = $(activationEmailInput).val();
    $(activationEmailFieldResult).removeClass('fieldWarning');

    $(activationEmailFieldResult).html('');
    $(activationEmailInput).removeClass('invalid');
  },

  focusout: function () {
    activationEmail = $(activationEmailInput).val();

    if (activationEmail.match(re)) {
      // Switch
      $(activationEmailInput).addClass('hide');
      $(activationEmailInputDisabled).removeClass('hide');

      // Check if email is valid
      CheckActivationEmail();
    } else {
      $(activationEmailInput).addClass('invalid');
      $(activationEmailFieldResult).addClass('fieldWarning');
      $(activationEmailFieldResult).html('Invalid email format');
    }
  }
});
//#endregion

//#region Check activation email
function CheckActivationEmail() {
  $(activationEmailInputDisabled).val(activationEmail);
  $(activationEmailFieldResult).html('Checking email');

  // Check email in database
  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'checkactivationemail',
      'email': activationEmail
    },
    success: function (result) {
      if (result['status'] === 1) {
        $(activationEmailInput).addClass('valid');
        $(activationEmailInputDisabled).addClass('valid');
        activationEmailOk = true;

        $(activationEmailFieldResult).html('Email valid');

        $(activationTokenInput).removeClass('hide');

        CheckActivationToken();

        // Enable resend timer
        TokenTimer(0);
      } else {
        $(activationEmailInput).addClass('invalid');
        $(activationEmailFieldResult).addClass('fieldWarning');
        $(activationEmailFieldResult).html('Email not registered');

        // Switch
        $(activationEmailInput).removeClass('hide');
        $(activationEmailInputDisabled).addClass('hide');
      }
    }
  });
}
//#endregion

//#region Activation token input
var activationTokenInput = '.signup .signupContainer .activationTokenInput';
var activationTokenInputDisabled = '.signup .signupContainer .activationTokenInputDisabled';
var activationFieldResult = '.signup .signupContainer #activationFieldResult';
var activationToken = "";
var activationTokenOk = false;
// Activation token
$(activationTokenInput).on({
  input: function () {
    activationToken = $(activationTokenInput).val();
    $(activationFieldResult).removeClass('fieldWarning');
    $(activationFieldResult).html('');
    $(activationTokenInput).removeClass('invalid');

    if (activationToken.length >= 60) {
      CheckActivationToken();
    }
  },

  focusout: function () {
    activationToken = $(activationTokenInput).val();
  }
});
//#endregion

//#region Check activation token
function CheckActivationToken() {
  if (activationEmailOk && activationToken.length >= 60) {
    $(activationTokenInputDisabled).val(activationToken);
    // Switch
    $(activationTokenInput).addClass('hide');
    $(activationTokenInputDisabled).removeClass('hide');

    OpenLoadingModal();

    // Check email in database
    $.ajax({
      type: 'POST',
      url: phpURL,
      dataType: 'json',
      data: {
        'call': 'checktoken',
        'type': 0,
        'email': activationEmail,
        'token': activationToken
      },

      success: function (result) {
        if (result['status'] === 0) {
          CloseLoadingModal();

          $(activationFieldResult).addClass('fieldWarning');
          $(activationFieldResult).html(result['message']);
          $(activationTokenInput).addClass('invalid');

          // Switch
          $(activationTokenInput).removeClass('hide');
          $(activationTokenInputDisabled).addClass('hide');

          // Reset token input
          $(activationTokenInput).val('');
          activationToken = $(activationTokenInput).val();
          $(activationTokenInput).first().focus();
        } else if (result['status'] === 1) {
          // Activate account
          $.ajax({
            type: 'POST',
            url: phpURL,
            dataType: 'json',
            data: {
              'call': 'activateaccount',
              'email': activationEmail
            },
            success: function (result) {
              if (result['status'] === 1) {
                CloseLoadingModal();
                OpenModal("Account activated, please login", true);
                TokenTimer(99);
              } else {
                CloseLoadingModal();

                $(activationFieldResult).addClass('fieldWarning');
                $(activationFieldResult).html(result['message']);
                $(activationTokenInput).addClass('invalid');

                // Switch
                $(activationTokenInput).removeClass('hide');
                $(activationTokenInputDisabled).addClass('hide');
              }
            }
          });
        } else {
          CloseLoadingModal();

          $(activationFieldResult).addClass('fieldWarning');
          $(activationFieldResult).html(result['message']);
          $(activationTokenInput).addClass('invalid');

          // Switch
          $(activationTokenInput).removeClass('hide');
          $(activationTokenInputDisabled).addClass('hide');
        }
      }
    });
  }
}
//#endregion

//#region Activation resend
var activationTokenResult = '.signup .signupContainer #activationTokenResult';
// Regenerate & resend token button
$('.signup .signupContainer .activationResendTokenButton').click(function (e) {
  e.preventDefault();
  $('.signup .signupContainer .activationResendTokenButton').addClass('disabled');
  // Reset timer
  TokenTimer(0);

  // Resend failed
  $(activationTokenResult).html('');
  RegenerateAndResendToken(0, activationEmail)
});
//#endregion

// profile.php =====
//#region Change email modal control
var changeEmailModal = '.changeEmailModal';

$('.changeEmail').on('click', function () {
  $(changeEmailModal).removeClass('hide');
  $(changeEmailInput).focus().on();
});

$('.changeEmailModal .closeBtn').on('click', function () {
  // Remove error
  $(changeEmailInput).removeClass('invalid');
  $(changeEmailFieldResult).removeClass('fieldWarning');
  $(changeEmailFieldResult).html('');

  $(changeEmailModal).addClass('hide');
});
//#endregion

//#region Change email
var changeEmailInput = '.changeEmailInput';
var changeEmailInputDisabled = '.changeEmailInputDisabled';
var changeEmailFieldResult = '#changeEmailFieldResult';
var changeEmail;
var changeEmailOk = false;

var re = /^(([^<>()[\]\\.,;:\s@\']+(\.[^<>()[\]\\.,;:\s@\']+)*)|(\'.+\'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
$(changeEmailInput).on({
  input: function () {
    changeEmail = $(changeEmailInput).val();
    $(changeEmailFieldResult).removeClass('fieldWarning');

    $(changeEmailFieldResult).html('');
    $(changeEmailInput).removeClass('invalid');
  },

  focusout: function () {
    changeEmail = $(changeEmailInput).val();

    if (changeEmail.match(re)) {
      // Switch
      $(changeEmailInput).addClass('hide');
      $(changeEmailInputDisabled).removeClass('hide');

      // Check if email is valid
      CheckChangeEmail();
    } else {
      if (changeEmail.length > 0) {
        $(changeEmailInput).addClass('invalid');
        $(changeEmailFieldResult).addClass('fieldWarning');
        $(changeEmailFieldResult).html('Invalid email format');
      }
    }
  }
});
//#endregion

//#region Check change email
function CheckChangeEmail() {
  $(changeEmailInputDisabled).val(changeEmail);
  $(changeEmailFieldResult).html('Checking email');

  // Check email in database
  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'checkemail',
      'email': changeEmail
    },
    success: function (result) {
      $(changeEmailFieldResult).html('Sending mail');
      if (result['status'] === 1) {
        var oldEmail = $('.oldEmail').val();

        $(changeEmailTokenInput).removeClass('hide');
        RegenerateAndResendToken(1, oldEmail);
        $(changeEmailFieldResult).html('');
        changeEmailOk = true;
        // Enable resend timer
        TokenTimer(1);

        // Token focus
        $(changeEmailTokenInput).first().focus();

      } else {
        // Add invalid class
        $(changeEmailInput).addClass('invalid');
        $(changeEmailFieldResult).addClass('fieldWarning')

        $(changeEmailFieldResult).html(result['message']);

        // Switch
        $(changeEmailInput).removeClass('hide');
        $(changeEmailInputDisabled).addClass('hide');
      }
    }
  });
}
//#endregion

//#region Regenerate & resend token button
var changeEmailResendTokenResult = '#changeEmailResendTokenResult';
$('.changeEmailResendTokenButton').click(function (e) {
  e.preventDefault();
  $('.changeEmailResendTokenButton').addClass('disabled');
  // Reset timer
  TokenTimer(1);

  // Resend
  var oldEmail = $('.oldEmail').val();
  RegenerateAndResendToken(1, oldEmail);
});
//#endregion

//#region New email token input
var changeEmailTokenInput = '.changeEmailTokenInput';
var changeEmailTokenInputDisabled = '.changeEmailTokenInputDisabled';
var changeEmailTokenFieldResult = '#changeEmailTokenFieldResult';
var changeEmailToken = "";
var changeEmailTokenOk = false;
// Activation token
$(changeEmailTokenInput).on({
  input: function () {
    changeEmailToken = $(changeEmailTokenInput).val();
    $(changeEmailTokenFieldResult).removeClass('fieldWarning');
    $(changeEmailTokenFieldResult).html('');

    $(changeEmailTokenInput).removeClass('invalid');
    if (changeEmailToken.length >= 60) {
      CheckNewEmailToken();
    }
  },

  focusout: function () {
    $(changeEmailTokenFieldResult).html('');
    $(changeEmailResendTokenResult).html('');
  }
});
//#endregion

//#region Check activation token
function CheckNewEmailToken() {
  var oldEmail = $('.oldEmail').val();

  if (changeEmailOk && changeEmailToken.length >= 60) {
    $(changeEmailTokenInputDisabled).val(changeEmailToken);
    // Switch
    $(changeEmailTokenInput).addClass('hide');
    $(changeEmailTokenInputDisabled).removeClass('hide');

    OpenLoadingModal();

    // Check email in database
    $.ajax({
      type: 'POST',
      url: phpURL,
      dataType: 'json',
      data: {
        'call': 'checktoken',
        'type': 1,
        'email': oldEmail,
        'token': changeEmailToken
      },

      success: function (result) {
        if (result['status'] === 0) {
          CloseLoadingModal();

          $(changeEmailTokenFieldResult).addClass('fieldWarning');
          $(changeEmailTokenFieldResult).html(result['message']);
          $(changeEmailTokenInput).addClass('invalid');

          // Switch
          $(changeEmailTokenInput).removeClass('hide');
          $(changeEmailTokenInputDisabled).addClass('hide');

          // Reset token input
          $(changeEmailTokenInput).val('');
          changeEmailToken = $(changeEmailTokenInput).val();
          $(changeEmailTokenInput).first().focus();
        } else if (result['status'] === 1) {
          // Activate account
          $.ajax({
            type: 'POST',
            url: phpURL,
            dataType: 'json',
            data: {
              'call': 'changeemail',
              'email': changeEmail,
              'oldemail': oldEmail
            },
            success: function (result) {
              if (result['status'] === 1) {
                location.reload();
              } else {
                $(changeEmailTokenFieldResult).addClass('fieldWarning');
                $(changeEmailTokenFieldResult).html(result['message']);
                $(changeEmailTokenInput).addClass('invalid');

                // Switch
                $(changeEmailTokenInput).removeClass('hide');
                $(changeEmailTokenInputDisabled).addClass('hide');
              }
            }
          });
        } else {
          CloseLoadingModal();

          $(changeEmailTokenFieldResult).addClass('fieldWarning');
          $(changeEmailTokenFieldResult).html(result['message']);
          $(changeEmailTokenInput).addClass('invalid');

          // Switch
          $(changeEmailTokenInput).removeClass('hide');
          $(changeEmailTokenInputDisabled).addClass('hide');
        }
      }
    });
  }
}
//#endregion

// newproduct.php && editproduct.php =====
//#region New product image
var numOfImage = 5;
var maxByte = 1048576; // 1 MB
$('#imageBrowser').change(function () {
  if ($('#imageBrowser').get(0).files.length <= numOfImage) {
    var fileExtension = ['png', 'jpg'];
    for (var i = 0; i < $('#imageBrowser').get(0).files.length; i++) {
      var ext = $('#imageBrowser').get(0).files[i].name.split('.').pop().toLowerCase();
      if ($.inArray(ext, fileExtension) == -1) {
        $(imageBrowser).val(null);
        OpenModal("Image #" + (i + 1) + ": ." + ext + " is an invalid format, please use this format: " + fileExtension.join(', '), true);
        return;
      }
    }

    for (var i = 0; i < $('#imageBrowser').get(0).files.length; i++) {
      if ($('#imageBrowser')[0].files[i].size > maxByte) {
        $(imageBrowser).val(null);
        OpenModal('Image #' + (i + 1) + ': File is more than 1MB', true);
        return;
      }
    }

    for (var i = 0; i < $('#imageBrowser').get(0).files.length; ++i) {
      var reader = new FileReader();

      reader.onload = function (e) {
        var cardImageTemplate =
          "<div class='col s2'>" +
          "<div class='cardContent'>" +
          "<img src='" + e.target.result + "' class='cardImage materialboxed uploadImage'>" +
          "<i class='material-icons deleteCard'>close</i>" +
          "</div>" +
          "</div>"

        $('.imagePreview').append(cardImageTemplate);
        numOfImage--;
        $('.materialboxed').materialbox();
        UpdateAddProductButton();

      }

      reader.readAsDataURL($('#imageBrowser').get(0).files[i]);
    }
  } else {
    OpenModal('Max of 5 images', true);
  }

});
//#endregion

//#region New product name input
var productNameInput = '.productName';
var productName = '';
$(productNameInput).on('input focusout', function () {
  productName = $(productNameInput).val();

  if (productName.length == 0 || productName.length > 128)
    $(productNameInput).addClass('invalid');
  else
    $(productNameInput).removeClass('invalid')

  UpdateAddProductButton();
});
//#endregion

//#region New product SKU input
var productSKUInput = '.productSKU';
var productSKU = '';
$(productSKUInput).on('input focusout', function () {
  productSKU = $(productSKUInput).val();

  if (productSKU.length == 0 || productSKU.length > 16)
    $(productSKUInput).addClass('invalid');
  else
    $(productSKUInput).removeClass('invalid')

  UpdateAddProductButton();
});
//#endregion

//#region New product stock input
var productStockInput = '.productStock';
var productStock = 0;
var productStockOk;

var reN = new RegExp('^[0-9]+$');
$(productStockInput).on('input focusout', function () {
  productStock = $(productStockInput).val();

  if ($(productStockInput).val().length == 0) {
    $(productStockInput).addClass('invalid');
    productStockOk = false;
  } else if (productStock.match(reN)) {
    if (productStock >= 0 && productStock <= 9999) {
      $(productStockInput).removeClass('invalid')
      productStockOk = true;
    }
    else {
      $(productStockInput).addClass('invalid');
      productStockOk = false;
    }
  }

  UpdateAddProductButton();
});
//#endregion

//#region New product description input
var productDescriptionInput = '.productDescription';
var productDescription = '';
$(productDescriptionInput).on('input focusout', function () {
  productDescription = $(productDescriptionInput).val();

  if (productDescription.length == 0 || productDescription.length > 2048)
    $(productDescriptionInput).addClass('invalid');
  else
    $(productDescriptionInput).removeClass('invalid')

  UpdateAddProductButton();
});
//#endregion

//#region New product condition input
var productCondition;
$("input[name='productCondition']").on('click', function () {
  productCondition = $(this).val();
  UpdateAddProductButton();
});
//#endregion

//#region New product price input
var productPriceInput = '.productPrice';
var productPrice = 0;
var productPriceOk;

var reN = new RegExp('^[0-9]+$');
$(productPriceInput).on('input focusout', function () {
  productPrice = $(productPriceInput).val();

  if (productPrice.length == 0 || productPrice.length > 11) {
    $(productPriceInput).addClass('invalid');
    productPriceOk = false;
  } else if (productPrice.match(reN)) {
    if (productPrice >= 1000) {
      $(productPriceInput).removeClass('invalid')
      productPriceOk = true;
    }
    else {
      $(productPriceInput).addClass('invalid');
      productPriceOk = false;
    }
  }

  UpdateAddProductButton();
});
//#endregion

//#region New product weight input
var productWeightInput = '.productWeight';
var productWeight = 0;
var productWeightOk;

var reN = new RegExp('^[0-9]+$');
$(productWeightInput).on('input focusout', function () {
  productWeight = $(productWeightInput).val();

  if (productWeight.length == 0 || productWeight.length > 11) {
    $(productWeightInput).addClass('invalid');
    productWeightOk = false;
  } else if (productWeight.match(reN)) {
    if (productWeight >= 1) {
      $(productWeightInput).removeClass('invalid')
      productWeightOk = true;
    } else {
      $(productWeightInput).addClass('invalid');
      productWeightOk = false;
    }
  }

  UpdateAddProductButton();
});
//#endregion

//#region Add product button
var addProductButton = '.addProductButton';
function UpdateAddProductButton() {
  UpdateEditProductButton();

  if (numOfImage < 5 && (productName.length > 0 && productName.length <= 128) && (productSKU.length > 0 && productSKU.length <= 16) && productStockOk && (productDescription.length > 0 && productDescription.length <= 2048) && productCondition > 0 && productPriceOk && productWeightOk) {
    $(addProductButton).removeClass('disabled');
  } else {
    $(addProductButton).addClass('disabled');
  }
}

var newProductFieldWarning = '#newProductFieldWarning';
$(addProductButton).on('click', function () {
  $('#recaptcha-callback').val(2);
  grecaptcha.execute();
});

//#endregion

//#region Add product
var newProductFieldResult = '#newProductFieldWarning';
function AddProduct(token) {
  $(newProductFieldResult).html('');
  var userId = $('.userid').val();

  OpenLoadingModal();

  var imgData = [];
  $('.uploadImage').each(function () {
    imgData.push($(this).attr('src'));
  })

  var imgDataString = JSON.stringify(imgData);

  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'addproduct',
      'token': token,
      'userid': userId,
      'imagedata': imgDataString,
      'productname': productName,
      'productsku': productSKU,
      'productstock': productStock,
      'productdescription': productDescription,
      'productcondition': productCondition,
      'productprice': productPrice,
      'productweight': productWeight
    },
    success: function (result) {
      if (result['status'] === 1) {
        window.location.href = "shop.php";
      } else {
        CloseLoadingModal();

        $(newProductFieldResult).html(result['message']);
        $(addProductButton).removeClass('disabled');

        // Reset google recaptcha
        //grecaptcha.reset();
      }
    },

    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus); alert("Error: " + errorThrown); alert("Data: " + this.data);
      ResetSignupButton();
      CloseLoadingModal();
    }
  });
}
//#endregion

//#region Index
var sortInput = '#sort';
var sort;

if ($('#index').length) {
  sort = $(sortInput).val();

  IndexQuery();
}
//#endregion

//#region Live query
var searchInput = '#searchBar';
var search;

$(searchInput).on('focusout', function () {
  search = $(searchInput).val();

  IndexQuery();
});
//#endregion

//#region Ajax query
function IndexQuery() {
  $('.indexListing').empty();

  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'showquery',
      'type': 0,
      'search': search,
      'sort': sort
    },
    success: function (result) {
      for (let i = 0; i < result.length; i++) {
        var prod = result[i][0];
        var id = prod['productid'];
        var prodName = prod['name'];

        var prodStock = prod['stock'];
        var prodPrice = 'Rp ' + prod['price'].format(2, 3, '.', ',');
        var img = jQuery.parseJSON(prod['image']);
        var prodImage = img[0];

        var cardImageTemplate =
          '<div class="col s6 m4 l3">' +
          '<a href="product.php?id=' + id + '">' +
          '<div class="cardContent">' +
          '<img src=" ' + prodImage.substr(3) + '" class="cardImage">' +

          '<div class="cardInfo">' +
          '<div class="cardInfoContent">' +
          '<h6 class="truncate">' + prodName + '</h6>' +
          '<hr>' +
          '<p class="smaller-text truncate">' + prodPrice + '</p>' +
          '<p class="smaller-text truncate">Stock: ' + prodStock + '</p>' +
          ' </div>' +
          '</div>' +
          '</div>' +
          '</a>' +
          '</div>'

        $('.indexListing').append(cardImageTemplate);
      }
    }
  });
}

Number.prototype.format = function (n, x, s, c) {
  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
    num = this.toFixed(Math.max(0, ~~n));

  return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};
//#endregion

//#region Edit product
if ($('#editProductPage').length) {
  var productId = $('.productid').val();

  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'showquery',
      'type': 1,
      'id': productId
    },
    success: function (result) {
      var imgJson = jQuery.parseJSON(result[0][0]['image']);
      for (let i = 0; i < imgJson.length; i++) {
        var cardImageTemplate =
          "<div class='col s2'>" +
          "<div class='cardContent'>" +
          "<img src='" + imgJson[i].substr(3) + "' class='cardImage materialboxed uploadImage'>" +
          "<i class='material-icons deleteCard'>close</i>" +
          "</div>" +
          "</div>"

        $('.imagePreview').append(cardImageTemplate);
        $('.materialboxed').materialbox();
        numOfImage--;
      }

      var prodData = result[0][0];
      $(productNameInput).val(prodData['name']);
      productName = $(productNameInput).val();

      $(productSKUInput).val(prodData['sku']);
      productSKU = $(productSKUInput).val();

      $(productStockInput).val(prodData['stock']);
      productStock = $(productStockInput).val();
      productStockOk = true;

      $(productDescriptionInput).val(prodData['description']);
      productDescription = $(productDescriptionInput).val();
      $(productDescriptionInput).trigger('autoresize');

      $("input[name='productCondition'][value=" + prodData['productcondition'] + "]").prop('checked', true);
      productCondition = prodData['productcondition'];

      $(productPriceInput).val(prodData['price']);
      productPrice = $(productPriceInput).val();
      productPriceOk = true;

      $(productWeightInput).val(prodData['weight']);
      productWeight = $(productWeightInput).val();
      productWeightOk = true;

      M.updateTextFields();
      M.textareaAutoResize($(productDescriptionInput))

      UpdateEditProductButton();
    },

    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus); alert("Error: " + errorThrown); alert("Data: " + this.data);
      CloseLoadingModal();
    }
  });
}
//#endregion

//#region Add product button
var editProductButton = '.editProductButton';
function UpdateEditProductButton() {
  if (numOfImage < 5 && (productName.length > 0 && productName.length <= 128) && (productSKU.length > 0 && productSKU.length <= 16) && productStockOk && (productDescription.length > 0 && productDescription.length <= 2048) && productCondition > 0 && productPriceOk && productWeightOk) {
    $(editProductButton).removeClass('disabled');
  } else {
    $(editProductButton).addClass('disabled');
  }
}

var editProductFieldWarning = '#editProductFieldWarning';
$(editProductButton).on('click', function () {
  $('#recaptcha-callback').val(3);
  grecaptcha.execute();
});

//#endregion

//#region Edit product
var editProductFieldResult = '#editProductFieldWarning';
function EditProduct(token) {
  $(editProductFieldResult).html('');
  var productId = $('.productid').val();
  var userId = $('.userid').val();

  OpenLoadingModal();

  var imgData = [];
  $('.uploadImage').each(function () {
    imgData.push($(this).attr('src'));
  })

  var imgDataString = JSON.stringify(imgData);
  console.log(imgDataString);

  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'editproduct',
      'token': token,
      'productid': productId,
      'userid': userId,
      'imagedata': imgDataString,
      'productname': productName,
      'productsku': productSKU,
      'productstock': productStock,
      'productdescription': productDescription,
      'productcondition': productCondition,
      'productprice': productPrice,
      'productweight': productWeight
    },
    success: function (result) {
      if (result['status'] === 1) {
        window.location.href = "shop.php";
      } else {
        CloseLoadingModal();

        $(editProductFieldResult).html(result['message']);
        $(editProductButton).removeClass('disabled');

        // Reset google recaptcha
        grecaptcha.reset();
      }
    },

    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus); alert("Error: " + errorThrown); alert("Data: " + this.data);
      CloseLoadingModal();
    }
  });
}
//#endregion

//#region Delte button
var deleteButton = '.deleteButton';

$(deleteButton).on('click', function () {
  var productId = $('.productid').val();
  var userId = $('.userid').val();


  OpenLoadingModal();
  $.ajax({
    type: 'POST',
    url: phpURL,
    dataType: 'json',
    data: {
      'call': 'deleteproduct',
      'productid': productId,
      'userid': userId
    },
    success: function (result) {
      if (result['status'] === 1) {
        window.location.href = "shop.php";
      } else {
        CloseLoadingModal();

        $(editProductFieldResult).html(result['message']);
        $(editProductButton).removeClass('disabled');
      }
    }
  });
});
//#endregion