$(function() {
    getProducts();
  
    $("#createProductForm").on("submit", function(e) {
      e && e.preventDefault();
      var form = $(this);
      $.ajax({
        type: "POST",
        url: "products",
        data: form.serialize(),
        success: function() {
          getProducts();
          $("#addProductModal").modal("toggle");
          form.find("input[type=text], input[type=number]").val("");
        }
      });
    });
  });
  
  const getProducts = function() {
    let limit = $("#pageSizeInput").val();
    let page = $("#pageNumberInput").val();
    let skip = limit * (page - 1);
    $.get("products", { skip, limit }, function(data) {
      reloadTable(data);
    });
  };
  
  const actionButtons = function(id) {
    return `<button class="btn btn-secondary float-right" onclick="edit(${id})">Edit</button><button class="btn btn-danger mr-3 float-right" onclick="del(${id})">Delete</button>`;
  };
  
  const reloadTable = function(products) {
    var table = $("#products_table");
    table.find("tbody tr").remove();
    products.forEach(function(product) {
      table.append(
        `<tr><td> ${product.id} </td><td> ${product.name} </td><td> ${
          product.description
        } </td><td> ${product.price}  </td><td style="max-width:200px">${actionButtons(product.id)}</td></tr>`
      );
    });
  };
  
  const addPage = function(num) {
    let page = $("#pageNumberInput").val();
    $("#pageNumberInput").val(Number(page) + num);
    getProducts();
  };
  
  const del = function(id) {
    $.ajax({
      type: "DELETE",
      url: "products/" + id,
      success: function() {
        getProducts();
      }
    });
  };
  
  const edit = function(id) {
    $.ajax({
      type: "GET",
      url: "products/" + id,
      success: function(data) {
        console.log(data);
      }
    });
  };
  