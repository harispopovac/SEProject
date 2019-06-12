$(function() {
    getTrainers();
  
    $("#createTrainerForm").on("submit", function(e) {
      e && e.preventDefault();
      var form = $(this);
      $.ajax({
        type: "POST",
        url: "trainers",
        data: form.serialize(),
        success: function() {
          getTrainers();
          $("#addTrainerModal").modal("toggle");
          form.find("input[type=text], input[type=number]").val("");
        }
      });
    });
  });
  
  const getTrainers = function() {
    let limit = $("#pageSizeInput").val();
    let page = $("#pageNumberInput").val();
    let skip = limit * (page - 1);
    $.get("trainers", { skip, limit }, function(data) {
      reloadTable(data);
    });
  };
  
  const actionButtons = function(id) {
    return `<button class="btn btn-secondary float-right" onclick="edit(${id})">Edit</button><button class="btn btn-danger mr-3 float-right" onclick="del(${id})">Delete</button>`;
  };
  
  const reloadTable = function(trainers) {
    var table = $("#trainers_table");
    table.find("tbody tr").remove();
    trainers.forEach(function(trainer) {
      table.append(
        `<tr><td> ${trainer.id} </td><td> ${trainer.name} </td><td> ${
          trainer.basic_info
        } </td><td> ${trainer.email}  </td><td style="max-width:200px">${actionButtons(trainer.id)}</td></tr>`
      );
    });
  };
  
  const addPage = function(num) {
    let page = $("#pageNumberInput").val();
    $("#pageNumberInput").val(Number(page) + num);
    getTrainers();
  };
  
  const del = function(id) {
    $.ajax({
      type: "DELETE",
      url: "trainers/" + id,
      success: function() {
        getTrainers();
      }
    });
  };
  
  const edit = function(id) {
    $.ajax({
      type: "GET",
      url: "trainers/" + id,
      success: function(data) {
        console.log(data);
      }
    });
  };
  