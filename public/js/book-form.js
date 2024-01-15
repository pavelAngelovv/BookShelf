const initDatepicker = () => {
  // Initialize datepicker with the specified format
  $('.js-datepicker').datepicker({
    format: 'yyyy-mm-dd'
  });
};

const initDatepickerIconListener = () => {
  // Attach an event listener to the datepicker icon
  $('.input-group-text').on('click', function () {
    // Focus on the nearest datepicker input when the icon is clicked
    $(this).closest('.input-group').find('.js-datepicker').focus();
  });
};

const addAuthorField = (container, index) => {
  // Get the prototype of a new author field
  let newAuthor = container.getAttribute('data-prototype');

  // Replace "__name__" with a unique index
  newAuthor = newAuthor.replace(/__name__/g, index);

  // Create a label for the added author field
  const newAuthorLabel = document.createElement('label');
  newAuthorLabel.innerHTML = 'Author #' + (index + 1);
  newAuthorLabel.style = 'margin-bottom: 7px;';

  // Append the new label to the authors collection container
  container.appendChild(newAuthorLabel);

  // Create a div element to hold the new author field
  const div = document.createElement('div');
  div.className = 'author-form';
  div.innerHTML = newAuthor;

  // Append the new author field to the authors collection container
  container.appendChild(div);
};

const initAuthorFields = () => {
  const authorsContainer = document.getElementById('authors-collection');

  // Check if we are on edit page
  if (isEditPage) {
    // If true edit page, populate existing author fields
    authors.forEach((author, index) => {
      addAuthorField(authorsContainer, index);
      document.getElementById(`book_authors_${index}_firstName`).value = author.firstName;
      document.getElementById(`book_authors_${index}_lastName`).value = author.lastName;
    });
  } else {
    // If it's false, add the first author field
    addAuthorField(authorsContainer, 0);
  }

  // Add event listener to the "Add Author" button
  const addAuthorButton = document.getElementById('add-author');
  if (addAuthorButton) {
    addAuthorButton.addEventListener('click', () => {
      // Get the current number of author fields
      const index = authorsContainer.getElementsByClassName('author-form').length;

      // Call the function to add one author field
      addAuthorField(authorsContainer, index);

      // Disable the "Add Author" button if there are 5 fields
      if (index + 1 === 5) {
        addAuthorButton.disabled = true;
      }

      // Enable "Add Author" button if one field is left
      if (authorsContainer.childElementCount > 2) {
        removeAuthorButton.disabled = false;
      }
    });
  }

  // Add event listener to the "Remove Author" button
  const removeAuthorButton = document.getElementById('remove-author');
  removeAuthorButton.disabled = true;

  if (removeAuthorButton) {
    removeAuthorButton.addEventListener('click', () => {
      // Get the last author field in the container
      const lastAuthorField = authorsContainer.lastElementChild;

      // Check if there is at least one author field to remove
      if (lastAuthorField && lastAuthorField.classList.contains('author-form')) {
        // Remove the last author field and its label
        authorsContainer.removeChild(lastAuthorField.previousElementSibling); // Remove label
        authorsContainer.removeChild(lastAuthorField); // Remove author field
      }

      // Disable the "Remove Author" button if there's only one field left
      if (authorsContainer.childElementCount === 2) {
        removeAuthorButton.disabled = true;
      }

      // Enable the "Add Author" button when a field is removed
      addAuthorButton.disabled = false;
    });
  }
};

document.addEventListener('DOMContentLoaded', () => {
  initDatepicker();
  initDatepickerIconListener();
  initAuthorFields();
});
