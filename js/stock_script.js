// Function to update profile changes.
function addStock() {
  let sname = $('input[name="stock"]').val();
  let price = $('input[name="price"]').val();

  if (sname == "" || price == "") {
    alert("Fill the fields to submit!");
  }
  else {
    $.ajax({
      url: "../ajax-add-stock.php",
      type: "POST",
      data: {
        stock: sname,
        price: price
      },
      success: function (data) {
        if (data == "1") {
          alert("Data added");
          location.reload();
        }
        else {
          alert("Try again");
        }
      },
      error: function () {
        alert("error");
      },
    });
  }
}

$(document).on("click", ".loadBtn", addStock);

// Function to load data on the items page added by user from database.
function defaultLoad() {
  $('.editForm').hide();
  $.ajax({
    url: "ajax-userload.php",
    type: "POST",
    success: function (data) {
      $(".tbody").append(data);
    },
  });
}

$(window).on("load", defaultLoad);

// Function to select the stock to edit.
function selectStock() {
  let id = $(this).data("id");
  $(".table").hide();
  $(".editForm").show();
  localStorage.setItem("id", id);
}

$(document).on("click", ".selectBtn", selectStock);

// Function to edit stock
function editStock() {
  let id = localStorage.getItem("id");
  let name = $('.stockname').val();
  let price = $('.stockprice').val();

  if (name == "" || price == "") {
    alert("Add details to update");
  }
  else {
    $.ajax({
      url: 'ajax-edit.php',
      type: "POST",
      data: {
        id: id,
        name: name,
        price: price
      },
      success: function (data) {
        if (data == "1") {
          alert("Updated");
        }
        else {
          alert("Try again");
        }
        $(".table").show();
        $(".editForm").hide();
        location.reload();
      }
    });
  }
}
$(document).on("click", ".editBtn", editStock);
