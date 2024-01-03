let selectMenu = document.querySelector("#products");
let heading = document.querySelector(".right h2");
let container = document.querySelector(".product-wrapper");

selectMenu.addEventListener("change", function () {
    let categoryName = this.value;
    heading.innerHTML = this[this.selectedIndex].text;

    let http = new XMLHttpRequest();


    http.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);

            let out = "";

            for (let item of response) {
                out += `
                
                <td>${item.title}</td> 
                <td>${item.description}</td>
                <td>${item.price}</td>
                <td>${item.title}</td>
                <td><img src="<?= SITEURL; ?>images/food/${item.image_name}" alt="${item.title}" width="100px"></td>
                <td>${item.featured}</td>
                <td>${item.active}</td>
                <td>
                <a href="<?= SITEURL; ?>admin/update-food.php?id=${item.id}" class="btn-secondary">Update food</a>
            <a href="<?= SITEURL; ?>admin/delete-food.php?id=${item.id}&image_name=${item.image_name}" class="btn-danger">Delete food</a>
                
            </td>
         
                `;

            }
            container.innerHTML = out;
        }
    }

    http.open('POST', "script.php");

    http.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    http.send("category=" + categoryName);

});
