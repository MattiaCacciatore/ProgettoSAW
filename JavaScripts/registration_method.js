function registrationInputs() {

    
    const registrationData = sessionStorage.getItem("registration_data");
    const errorsRegistration = sessionStorage.getItem("errors_registration");
    const registrationDataObj = registrationData ? JSON.parse(registrationData) : {};
    const errorsRegistrationObj = errorsRegistration ? JSON.parse(errorsRegistration) : {};

    // Check if the first name is already saved in the registration data
    const firstname = registrationDataObj.hasOwnProperty("firstname") ? registrationDataObj.firstname : "";
    const firstnameLabel = `<label for="firstname">Nome</label><br>`;
    const firstnameInput = `<input type="text" id="firstname" name="firstname" value="${firstname}"><br><br>`;

    // Check if the last name is already saved in the registration data
    const lastname = registrationDataObj.hasOwnProperty("lastname") ? registrationDataObj.lastname : "";
    const lastnameLabel = `<label for="lastname">Cognome</label><br>`;
    const lastnameInput = `<input type="text" id="lastname" name="lastname" value="${lastname}"><br><br>`;

    // Check if the email is already saved in the registration data and if it's a valid email
    const email = registrationDataObj.hasOwnProperty("email") ? registrationDataObj.email : "";
    const invalidEmail = errorsRegistrationObj.hasOwnProperty("invalid_email");
    const emailLabel = `<label for="email">Email</label><br>`;
    const emailInput = `<input type="email" id="email" name="email" value="${email}"><br><br>`;

    // Create the HTML for password and confirm password fields
    const passLabel = `<label for="pass">Password:</label><br>`;
    const passInput = `<input type="password" id="pass" name="pass"><br><br>`;
    const confirmLabel = `<label for="confirm">Conferma Password:</label><br>`;
    const confirmInput = `<input type="password" id="confirm" name="confirm"><br><br>`;

    // Construct the complete HTML for registration inputs
    const registrationInputsHTML = `
        ${firstnameLabel}
        ${firstnameInput}
        ${lastnameLabel}
        ${lastnameInput}
        ${emailLabel}
        ${emailInput}
        ${passLabel}
        ${passInput}
        ${confirmLabel}
        ${confirmInput}
    `;

    return registrationInputsHTML;
}