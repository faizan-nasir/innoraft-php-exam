// Function to load data on the items page from database.
function defaultLoad() {
  $.ajax({
    url: "ajax-defaultload.php",
    type: "POST",
    success: function (data) {
      $(".tbody").append(data);
    },
  });
}

$(window).on("load", defaultLoad);

// Function to delete stock.
function removeStock() {
  let id = $(this).data('id');
  $.ajax({
    url: "ajax-delete.php",
    type: "POST",
    data: {
      id: id,
    },
    success: function (data) {
      if (data == "1") {
        alert("Item Removed!");
        location.reload();
      }
      else {
        alert("Could not remove item!");
      }
    },
  });
}

$(document).on("click", ".loadBtn", removeStock);
