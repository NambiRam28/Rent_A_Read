<!-- <!DOCTYPE html>
<html>

<head>
    <title>Send Mail</title>
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script>
        emailjs.init('IxCFVBLx8jvBB1bJ0');
    </script>

</head>

<body>
    <form onsubmit="send_mail(event)">
        Recipient Email:
        <input type="email" id="email" name="email" required>
        <input type="password" id="subject" name="subject" required>
        <input type="submit" value="Send Email">
    </form>
</body>
<script>
    function send_mail(event) {

        event.preventDefault();

        const serviceID = 'service_ri20ciw';
        const templateID = 'template_yl4sq4d';

        const data = {
            email: document.getElementById('email').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value,
        };

        emailjs.send(serviceID, templateID, data)
            .then((response) => {
                console.log('Success : ', response);
            })
            .catch((error) => {
                console.error('Failure :', error);
            });
    }
</script>

</html> -->



    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script>
        emailjs.init('IxCFVBLx8jvBB1bJ0');
    </script>

<script>
   
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

            const serviceID = 'service_ri20ciw';
            const templateID = 'template_t616nlm';

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
    </script>