let sellForm = document.forms["sell_form"];

let category = sellForm["prod-category"];
let name = sellForm["prod-name"];
let brand = sellForm["prod-brand"];
let price = sellForm["prod-price"];
let quantity = sellForm["prod-quantity"];
let discount = sellForm["prod-discount"];
let description = sellForm["prod-description"];
let image = sellForm["prod-image"];
let addedImages = document.getElementsByName("added_images[]");

let errors = {};
let categoryError = document.querySelector("#prod-categoryErr");
let nameError = document.querySelector("#prod-nameErr");
let brandError = document.querySelector("#prod-brandErr");
let priceError = document.querySelector("#prod-priceErr");
let quantityError = document.querySelector("#prod-quantityErr");
let discountError = document.querySelector("#prod-discountErr");
let descriptionError = document.querySelector("#prod-descriptionErr");
let imageError = document.querySelector("#imageErr");
let addedImagesError = document.getElementsByName("added_imagesErr");

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
  } else if (isNaN(price) && !Number.isInteger(price)) {
    errors.price = "Only enter an integer";
  } else if (price <= 0) {
    errors.price = "Price cannot be zero or negative";
  } else {
    errors.price = "";
  }
  priceError.innerHTML = errors.price;
}

function validateQuantity(qty) {
  qty = qty.value.trim();
  if (qty === "") {
    errors.quantity = "Input the available quantity of your product";
  } else if (isNaN(qty) && !Number.isInteger(qty)) {
    errors.quantity = "Only enter an integer";
  } else if (qty < 1) {
    errors.quantity = "Quantity cannot be less than 1";
  } else {
    errors.quantity = "";
  }
  quantityError.innerHTML = errors.quantity;
}

function validateDiscount(dis) {
  dis = dis.value.trim();
  if (dis === "") {
    errors.discount = "";
  } else if (isNaN(dis) && !Number.isInteger(dis)) {
    errors.discount = "Only enter an integer";
  } else if (dis < 0 || dis > 99) {
    errors.discount = "Discount cannot be negative or greater than 99";
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

function validateImage(img) {
  img = img.value.trim();
  let allowedExt = ["jpg", "jpeg", "png"];
  let splitImageArray = img.split(".");
  if (img === "") {
    errors.image = "Upload your product's image";
  } else if (
    !allowedExt.includes(splitImageArray[splitImageArray.length - 1])
  ) {
    errors.image = "Only upload jpg, jpeg and png format";
  } else {
    errors.image = "";
  }
  imageError.innerHTML = errors.image;
}

function validateAddedImages(img) {
  if (img.length > 0) {
    // console.log(img.length);
    // img.forEach((value, key) => {
    //   console.log(value.files.item(i).name);
    // });
    j = 0;
    for (let eachImg of img) {
      eachImg = eachImg.value.trim();
      // console.log(eachImg);
      let allowedExt = ["jpg", "jpeg", "png"];
      let splitImageArray = eachImg.split(".");

      if (eachImg === "") {
        errors.addedImagesError = "Upload your product's additional image<br>";
      } else if (
        !allowedExt.includes(splitImageArray[splitImageArray.length - 1])
      ) {
        errors.addedImagesError = "Only upload jpg, jpeg and png format<br>";
      } else {
        errors.addedImagesError = "";
      }
      addedImagesError[j].innerHTML = errors.addedImagesError;
      j++;
    }
  }
}

let btnAddMoreImages = sellForm["add-more-images"];

function removeImage(id) {
  let new_id = `image_${id}`;
  let dom = document.getElementById(new_id);
  dom.remove();
}

let i = 1;

btnAddMoreImages.addEventListener("click", () => {
  let div_id = "image_" + i;
  let node = document.createElement("div");
  node.setAttribute("id", div_id);
  node.classList.add("col-sm-6", "my-3");

  let elementNode1 = document.createElement("input");
  let inputAttribute = {
    type: "file",
    id: `added_images_${i}`,
    name: "added_images[]",
    class: "form-control p-3",
  };
  for (let attr in inputAttribute) {
    elementNode1.setAttribute(attr, inputAttribute[attr]);
  }

  let elementNode2 = document.createElement("small");
  elementNode2.classList.add("text-danger");
  elementNode2.setAttribute("id", `added_imagesErr_${i}`);
  elementNode2.setAttribute("name", "added_imagesErr");

  let elementNode3 = document.createElement("button");
  elementNode3.classList.add("btn", "btn-danger", "p-2", "mt-2");
  elementNode3.append("Remove");
  elementNode3.setAttribute("id", i);
  elementNode3.setAttribute("onclick", `removeImage(${i})`);

  node.append(elementNode1, elementNode2, elementNode3);

  btnAddMoreImages.parentNode.parentNode.appendChild(node);
  i++;
});

async function validateProduct() {
  validateCategory(category);
  validateName(name);
  validateBrand(brand);
  validatePrice(price);
  validateQuantity(quantity);
  validateDiscount(discount);
  validateDescription(description);
  validateImage(image);
  validateAddedImages(addedImages);
  let formData = new FormData(sellForm);

  try {
    const response = await fetch("../server/common/product.php", {
      method: "POST",
      body: formData,
    });
    if (response.status >= 200 && response.status <= 299) {
      const data = await response.json();
      console.log(data);

      if (data.categoryError) {
        categoryError.innerHTML = data.categoryError;
      }
      if (data.nameError) {
        nameError.innerHTML = data.nameError;
      }
      if (data.brandError) {
        brandError.innerHTML = data.brandError;
      }
      if (data.priceError) {
        priceError.innerHTML = data.priceError;
      }
      if (data.quantityError) {
        quantityError.innerHTML = data.quantityError;
      }
      if (data.discountError) {
        discountError.innerHTML = data.discountError;
      }
      if (data.descriptionError) {
        descriptionError.innerHTML = data.descriptionError;
      }
      if (data.imageError) {
        imageError.innerHTML = data.imageError;
      }
      if (data.addedImagesError) {
        for (let k = 0; k < addedImagesError.length; k++) {
          if (!data.addedImagesError[k]) {
            continue;
          }
          addedImagesError[k].innerHTML = data.addedImagesError[k];
        }
      }
    } else {
      console.log(response.status, response.statusText);
    }
  } catch (error) {
    console.log(error);
  }
}

sellForm.onsubmit = (e) => {
  e.preventDefault();
  validateProduct();
};
