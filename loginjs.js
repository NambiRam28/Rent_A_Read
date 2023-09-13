// const forms = document.querySelector(".forms"),
// pwShowHide = document.querySelectorAll(".eye-icon"),
// links = document.querySelectorAll(".link");

// pwShowHide.forEach(eyeIcon => {
// eyeIcon.addEventListener("click", () => {
//   let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
  
//   pwFields.forEach(password => {
//       if(password.type === "password"){
//           password.type = "text";
//           eyeIcon.classList.replace("bx-hide", "bx-show");
//           return;
//       }
//       password.type = "password";
//       eyeIcon.classList.replace("bx-show", "bx-hide");
//   })
  
// })
// })      

// links.forEach(link => {
// link.addEventListener("click", e => {
//  e.preventDefault(); 
//  forms.classList.toggle("show-signup");
// })
// })
const forms = document.querySelector(".forms"),
pwShowHide = document.querySelectorAll(".eye-icon"),
links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
eyeIcon.addEventListener("click", () => {
  let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
  
  pwFields.forEach(password => {
      if(password.type === "password"){
          password.type = "text";
          eyeIcon.classList.replace("bx-hide", "bx-show");
          return;
      }
      password.type = "password";
      eyeIcon.classList.replace("bx-show", "bx-hide");
  })
  
})
})      

links.forEach(link => {
link.addEventListener("click", e => {
 e.preventDefault(); 
 forms.classList.toggle("show-signup");
})
})


emailjs.init('ns7hKa-VWQb7ty8q0');

function generateRandomPassword() {
  const characters = '0123456789';
  let password = '';
  for (let i = 0; i < 6; i++) {
      const index = Math.floor(Math.random() * characters.length);
      password += characters.charAt(index);
  }
  return password;
}

function send_mail(event) {
      event.preventDefault();

      const serviceID = 'service_4hqr3gf';
      const templateID = 'template_dfbj1xj';

      const email = document.getElementById('email').value;
      const username = document.getElementById('username').value;
      const department = document.getElementById('department').value;
      const randomPassword = generateRandomPassword();

      const data = {
          to_email: email,
          generated_password: randomPassword
      };

      emailjs.send(serviceID, templateID, data)
          .then((response) => {
              console.log('Success : ', response);

              
              const formData = new FormData();
              formData.append('username', username);
              formData.append('email', email);
              formData.append('department', department);
              formData.append('randomPassword', randomPassword);

              fetch('signup.php', {
                  method: 'POST',
                  body: formData
              })
              .then(response => response.text())
              .then(data => {
                  console.log(data);
              
                  window.location.href = 'signup_success.php';
              })
              .catch(error => {
                  console.error('Error:', error);
              });
          })
          .catch((error) => {
              console.error('Failure:', error);
          });
  }