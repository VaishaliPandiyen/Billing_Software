const addItem = async () => {
  let container = document.getElementById("items-container");

  // Create a new item combo
  let newItem = document.createElement("div");
  let itemId = "item-" + (container.children.length + 1); // Generate unique ID for the new item
  newItem.id = itemId;
  // Create select element
  let select = document.createElement("select");
  select.name = "sale[s_item]";
  // Create quantity input and other elements

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let items = JSON.parse(xhr.responseText);
      // console.log(items); // Check if items array is populated
      newItem.appendChild(select);
      items.forEach((item) => {
        let option = document.createElement("option");
        option.value = item.f_name;
        option.textContent = item.f_name;
        // console.log(option); // Check if each option is correctly created
        select.appendChild(option);
    });
    newItem.innerHTML += `
    <input type="number" name="sale[s_quantity]" placeholder="Enter quantity"><p style="display: inline;">kg(s)</p>
    <button type="button" onclick="removeItem(this)">-</button><br><br>`;
    container.appendChild(newItem);
    }
  };

  xhr.open("GET", "../../../private/fetch_items.php", true);
  xhr.send();
};

// Function to remove the combo when "-" button is clicked
const removeItem = (button) => {
  let container = button.parentNode.parentNode;
  container.removeChild(button.parentNode);
};
