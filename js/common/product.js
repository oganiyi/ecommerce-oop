let sellForm = document.forms["sell_form"];

let category = sellForm["prod-category"];
let name = sellForm["prod-name"];
let brand = sellForm["prod-brand"];
let price = sellForm["prod-price"];
let quantity = sellForm["prod-quantity"];
let discount = sellForm["prod-discount"];
let description = sellForm["prod-description"];

let errors = {};
let categoryError = document.querySelector("#prod-categoryErr");
let nameError = document.querySelector("#prod-nameErr");
let brandError = document.querySelector("#prod-brandErr");
let priceError = document.querySelector("#prod-priceErr");
let quantityError = document.querySelector("#prod-quantityErr");
let discountError = document.querySelector("#prod-discountErr");
let descriptionError = document.querySelector("#prod-descriptionErr");
let imageError = document.querySelector("#imageErr");

function validateCategory(ctg) {
  ctg = ctg.value.trim();
  if (ctg === "") {
    errors.category = "Select a category for your product";
  } else {
    errors.category = "";
  }
  categoryError.innerHTML = errors.category;
}

function validateName(name) {
  name = name.value.trim();
  if (name === "") {
    errors.name = "Input the product's name";
  } else if (typeof name !== "string") {
    errors.name = "Name can only contain letters, numbers or characters";
  } else if (name.split(" ").length > 25) {
    errors.name = "Name cannot be greater than 25 words";
  } else {
    errors.name = "";
  }
  nameError.innerHTML = errors.name;
}

function validateBrand(brand) {
  brand = brand.value.trim();
  if (brand === "") {
    errors.brand = "Kindly input your brand";
  } else if (typeof brand !== "string") {
    errors.brand = "Brand can only contain letters, numbers or characters";
  } else if (brand.split(" ").length > 4) {
    errors.brand = "Brand cannot be greater than 5 words";
  } else {
    errors.brand = "";
  }
  brandError.innerHTML = errors.brand;
}

function validatePrice(price) {
  price = price.value.trim();
  if (price === "") {
    errors.price = "Input the price of your product";
  } else if (price <= 0) {
    errors.price = "Price cannot be zero or negative";
  } else if (isNaN(price) && !Number.isInteger(price)) {
    errors.price = "Only enter an integer";
  } else {
    errors.price = "";
  }
  priceError.innerHTML = errors.price;
}

function validateQuantity(qty) {
  qty = qty.value.trim();
  if (qty === "") {
    errors.quantity = "Input the available quantity of your product";
  } else if (qty < 1) {
    errors.quantity = "Quantity cannot be less than 1";
  } else if (isNaN(qty) && !Number.isInteger(qty)) {
    errors.quantity = "Only enter an integer";
  } else {
    errors.quantity = "";
  }
  quantityError.innerHTML = errors.quantity;
}

function validateDiscount(dis) {
  dis = dis.value.trim();
  if (dis === "") {
    errors.discount = "";
  } else if (dis < 0 || dis > 99) {
    errors.discount = "Discount cannot be negative or greater than 99";
  } else if (isNaN(dis) && !Number.isInteger(dis)) {
    errors.discount = "Only enter an integer";
  } else {
    errors.discount = "";
  }
  discountError.innerHTML = errors.discount;
}

function validateDescription(des) {
  des = des.value.trim();
  if (des === "") {
    errors.description = "Kindly input the description of your product";
  } else if (typeof des !== "string") {
    errors.description =
      "Description can only contain letters, numbers or characters";
  } else if (des.split(" ").length > 500) {
    errors.description = "Description cannot be greater than 500 words";
  } else {
    errors.description = "";
  }
  descriptionError.innerHTML = errors.description;
}

let btnAddMoreImages = sellForm["add-more-images"];

function removeImage(id) {
  let new_id = `image_${id}`;
  let dom = document.getElementById(new_id);
  dom.remove();
}

let i = 0;

btnAddMoreImages.addEventListener("click", () => {
  i++;
  let div_id = "image_" + i;
  let node = document.createElement("div");
  node.setAttribute("id", div_id);
  node.classList.add("col-sm-6", "my-3");

  let elementNode1 = document.createElement("input");
  let inputAttribute = {
    type: "file",
    id: "added_images[]",
    name: "added_images[]",
    class: "form-control p-3",
  };
  for (let attr in inputAttribute) {
    elementNode1.setAttribute(attr, inputAttribute[attr]);
  }

  let elementNode2 = document.createElement("small");
  elementNode2.classList.add("text-danger");
  elementNode2.setAttribute("id", "added_imagesErr[]");

  let elementNode3 = document.createElement("button");
  elementNode3.classList.add("btn", "btn-danger", "p-2", "mt-2");
  elementNode3.append("Remove");
  elementNode3.setAttribute("id", i);
  elementNode3.setAttribute("onclick", `removeImage(${i})`);

  node.append(elementNode1, elementNode2, elementNode3);

  btnAddMoreImages.parentNode.parentNode.appendChild(node);
});

sellForm.onsubmit = (e) => {
  e.preventDefault();
  validateCategory(category);
  validateName(name);
  validateBrand(brand);
  validatePrice(price);
  validateQuantity(quantity);
  validateDiscount(discount);
  validateDescription(description);

  let formData = new FormData(sellForm);

  fetch("../server/common/product.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
    });
};
