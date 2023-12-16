$(document).ready(function () {
  $("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});

$(document).ready(function () {
  var rowsPerPage = 5;
  var currentPage = 1;
  var $tableRows = $("#myTable tr");

  function showPage(page) {
    $tableRows.hide();
    var start = (page - 1) * rowsPerPage;
    var end = start + rowsPerPage;
    $tableRows.slice(start, end).show();
    $("#pageInfo").text("Page " + page);
  }

  showPage(currentPage);

  $("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $tableRows.each(function () {
      var rowText = $(this).text().toLowerCase();
      $(this).toggle(rowText.indexOf(value) > -1);
    });

    if (value === "") {
      rowsPerPage = 5;
      currentPage = 1;
      showPage(currentPage);
    } else {
      rowsPerPage = $tableRows.filter(":visible").length;
    }
  });

  $("#prevPage").on("click", function () {
    if (currentPage > 1) {
      currentPage--;
      showPage(currentPage);
      scrollTo(top);
    }
  });

  $("#nextPage").on("click", function () {
    var maxPage = Math.ceil($tableRows.length / rowsPerPage);
    if (currentPage < maxPage) {
      currentPage++;
      showPage(currentPage);
      scrollTo(top);
    }
  });
});
