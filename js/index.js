$(function() {
    getGyms();
  
    $("#createGymForm").on("submit", function(e) {
      e && e.preventDefault();
      var form = $(this);
      $.ajax({
        type: "POST",
        url: "gyms",
        data: form.serialize(),
        success: function() {
          getGyms();
          $("#addGymModal").modal("toggle");
          form.find("input[type=text], input[type=number]").val("");
        }
      });
    });
  });
  
  const getGyms = function() {
    let limit = $("#pageSizeInput").val();
    let page = $("#pageNumberInput").val();
    let skip = limit * (page - 1);
    $.get("gyms", { skip, limit }, function(data) {
      reloadTable(data);
    });
  };
  
  const actionButtons = function(id) {
    return `<button class="btn btn-secondary float-right" onclick="edit(${id})">Edit</button><button class="btn btn-danger mr-3 float-right" onclick="del(${id})">Delete</button>`;
  };
  
  const reloadTable = function(gyms) {
    var table = $("#gyms_table");
    table.find("tbody tr").remove();
    gyms.forEach(function(gym) {
      table.append(
        `<tr><td> ${gym.id} </td><td> ${gym.name} </td><td> ${
          gym.address
        } </td><td> ${gym.basic_info}  </td><td style="max-width:200px">${actionButtons(gym.id)}</td></tr>`
      );
    });
  };
  
  const addPage = function(num) {
    let page = $("#pageNumberInput").val();
    $("#pageNumberInput").val(Number(page) + num);
    getGyms();
  };
  
  const del = function(id) {
    $.ajax({
      type: "DELETE",
      url: "gyms/" + id,
      success: function() {
        getGyms();
      }
    });
  };
  
  const edit = function(id) {
    $.ajax({
      type: "GET",
      url: "gyms/" + id,
      success: function(data) {
        console.log(data);
      }
    });
  };
  