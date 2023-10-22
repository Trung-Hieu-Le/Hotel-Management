var bookbox = document.getElementById("guestdetailpanel");

    openbookbox = () =>{
      bookbox.style.display = "flex";
    }
    closebox = () =>{
      bookbox.style.display = "none";
    }


var price = 0;
function calculatePrice() {
  var meal = document.getElementsByName("Meal")[0].value;

  //Sử dụng câu lệnh switch để tính giá tiền tương ứng với từng loại đặt bữa
  switch (meal) {
    case "Room only":
      price = 0;
      break;
    case "Breakfast":
      price = 50;
      break;
    case "Half Board":
      price = 150;
      break;
    case "Full Board":
      price = 70;
      break;
    default:
      price = 0;
      break;
  }

  //Hiển thị giá tiền tính được
  document.getElementById("price").innerHTML = "$" + price.toFixed(2);
}

//thêm sự kiện onchange vào select "Meal"
document.getElementsByName("Meal")[0].onchange = calculatePrice;
