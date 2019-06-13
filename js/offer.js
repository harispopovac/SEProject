$(function() {
    getOffers();
  
    $("#createOfferForm").on("submit", function(e) {
      e && e.preventDefault();
      var form = $(this);
      $.ajax({
        type: "POST",
        url: "offers",
        data: form.serialize(),
        success: function() {
          getOffers();
          $("#addOfferModal").modal("toggle");
          form.find("input[type=text], input[type=number]").val("");
        }
      });
    });
  });
  
  const getOffers = function() {
    let limit = $("#pageSizeInput").val();
    let page = $("#pageNumberInput").val();
    let skip = limit * (page - 1);
    $.get("offers", { skip, limit }, function(data) {
      reloadTable(data);
    });
  };
  
  const actionButtons = function(id) {
    return `<button class="btn btn-secondary float-right" onclick="edit(${id})">Edit</button><button class="btn btn-danger mr-3 float-right" onclick="del(${id})">Delete</button>`;
  };
  
  const reloadTable = function(offers) {
    var table = $("#offers_table");
    table.find("tbody tr").remove();
    offers.forEach(function(offer) {
      table.append(
        `<tr><td> ${offer.id} </td><td> ${offer.name} </td><td> ${
          offer.description
        } </td><td> ${offer.price}  </td><td style="max-width:200px">${actionButtons(offer.id)}</td></tr>`
      );
    });
  };
  
  const addPage = function(num) {
    let page = $("#pageNumberInput").val();
    $("#pageNumberInput").val(Number(page) + num);
    getOffers();
  };
  
  const del = function(id) {
    $.ajax({
      type: "DELETE",
      url: "offers/" + id,
      success: function() {
        getOffers();
      }
    });
  };
  
  const edit = function(id) {
    $.ajax({
      type: "GET",
      url: "offers/" + id,
      success: function(data) {
        console.log(data);
      }
    });
  };
  