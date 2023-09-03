    
  const addRoomButton = document.getElementById('add-room');
  const roomContainer = document.getElementById('room-container');

  addRoomButton.addEventListener('click', function(event) {
    event.preventDefault();

    const lastRoomFields = roomContainer.lastElementChild;
    const clonedRoomFields = lastRoomFields.cloneNode(true);
    

    // Clear input values and uncheck checkboxes of the cloned fields
    const clonedInputs = clonedRoomFields.querySelectorAll('input, select, textarea');
    clonedInputs.forEach(input => {
      if (input.type === 'checkbox') {
        input.checked = false; // Uncheck checkboxes
      } else {
        input.value = ''; // Reset other input values
      }
    });

    // Add delete button to the original fields only
    if (!clonedRoomFields.querySelector('.delete-room')) {
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete Room';
        deleteButton.classList.add('delete-room');
        clonedRoomFields.appendChild(deleteButton);
      }

    // Append the cloned fields
    roomContainer.appendChild(clonedRoomFields);
    });


  // Event delegation for delete buttons
  roomContainer.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-room')) {
      event.target.parentElement.remove();
    }
  });

  
