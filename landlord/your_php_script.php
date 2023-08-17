<!-- your_form.html -->
<form id="myForm">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" required>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>

  <input type="submit" value="Submit Form 1" data-action="process_form_1.php">
  <input type="submit" value="Submit Form 2" data-action="process_form_2.php">
</form>

<div id="responseContainer"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // Bind click event to each submit button
    $("input[type='submit']").click(function(e) {
      e.preventDefault(); // Prevent the default form submission

      // Get the clicked button's data-action attribute (PHP script URL)
      var phpScriptURL = $(this).data("action");

      // Serialize the form data
      var formData = $("#myForm").serialize();

      // Send the AJAX request to the corresponding PHP script
      $.post(phpScriptURL, formData, function(data) {
        // Update the content of the response container with the PHP script's output
        //$("#responseContainer").html(data);
        alert(data);
      }).fail(function() {
        alert("An error occurred while processing the form.");
      });
    });
  });
</script>

var contentMap = {
        <?php foreach($dateTime as $date) {?>
        "<?= $date['date']?>": [
            "<p><?= $date['time']?></p>",
        ],
        <?php } ?>
        "2023-08-11": "<p>Content for August 9, 2023</p>",
        // Add more content for other dates as needed
      };

      var selectedContent = contentMap[selectedDate] || "<p>No content available for the selected date.</p>";

      // Update the content container with the selected content
      $("#contentContainer").html(selectedContent);
    }