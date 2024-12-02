
 // Get the select element and the input field
 const typeSelect = document.getElementById('type');
 const studentNumberInput = document.getElementById('student_number');

 // Function to toggle the input field
 function toggleInput() {
     if (typeSelect.value === 'non_student') {
         studentNumberInput.disabled = true; // Disable input
         studentNumberInput.value = '';      // Clear the input value
         studentNumberInput.placeholder = "Not Applicable";
         console.log(typeSelect.value);

     } else {
         studentNumberInput.disabled = false; // Enable input
         console.log(typeSelect.value);
     }
 }

 // Add event listener to the select element
 typeSelect.addEventListener('change', toggleInput);

 // Call the function once to set the initial state
 toggleInput();