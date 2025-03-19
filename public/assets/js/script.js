let products = [];
let editIndex = null;
//modal js
function openModal() {
    document.getElementById("modal").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("modal").classList.add("hidden");
    resetForm();
}

function openCart() {
    document.getElementById("cartModal").classList.remove("hidden");
    updateCart();
}

function closeCart() {
    document.getElementById("cartModal").classList.add("hidden");
}
// modal js end



// js for add productt
function addProduct() {
    let name = document.getElementById("productName").value;
    let price = document.getElementById("productPrice").value;

    if (name.trim() === "" || price.trim() === "") {
        alert("Product Name and Price are required!");
        return;
    }
    let newProduct = {
        name: name,
        price: parseFloat(price).toFixed(2)
    };

    if (editIndex === null) {
        products.push(newProduct);
    } else {
        products[editIndex] = newProduct;
        editIndex = null;
    }
    updateTable();
    resetForm();
    closeModal();
}

// Reset Form Fields
function resetForm() {
    document.getElementById("productName").value = "";
    document.getElementById("productPrice").value = "";
    document.getElementById("saveButton").innerText = "Save"; // Reset button text
}

//update table
function updateTable(filteredProducts = products) {
    console.log("In Update method",filteredProducts);
    let tableBody = document.getElementById("productTableBody");
    tableBody.innerHTML = "";
    filteredProducts.forEach((product, index) => {
        let row = `
            <tr class="text-center border-b">
                <td class="px-4 py-2 border">${index + 1}</td>
                <td class="px-4 py-2 border">${product.name}</td>
                <td class="px-4 py-2 border">$${product.price}</td>
                <td class="px-4 py-2 border">
                    <button onclick="addToCart(${index})" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                        + Add to Cart
                    </button>
                </td>
                <td class="px-4 py-2 border">
                    <button onclick="editProduct(${index})" class="bg-green-400 text-white px-4 py-2 rounded-md hover:bg-green-500 mx-3">
                        Edit
                    </button>
                    <button onclick="deleteProduct(${index})" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                        Delete
                    </button>
                </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}


// Edit Product
function editProduct(index) {
    let product = products[index];
    document.getElementById("productName").value = product.name;
    document.getElementById("productPrice").value = product.price;
    document.getElementById("saveButton").innerText = "Update";

    editIndex = index;
    openModal();
}

//delete product
function deleteProduct(index) {
    Swal.fire({
        title: "Are you sure?",
        text: "This product will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            products.splice(index, 1);
            updateTable();
            Swal.fire("Deleted!", "Product has been removed.", "success");
        }
    });
}
//js from product end


// js for product search start
function searchProduct() {
    let searchValue = document.getElementById("searchInput").value.toLowerCase();
    let filteredProducts = products.filter(product =>
        product.name.toLowerCase().includes(searchValue)
    );
    console.log("Filtered Products",filteredProducts);
    updateTable(filteredProducts);
}
// js for product search end


// cart functionality start
function addToCart(index) {
    let product = products[index];

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(product)
    })
    .then(response => response.json())
    .then(data => {
        Swal.fire({
            title: "Added to Cart!",
            text: data.message,
            icon: "success",
            timer: 2000,
            showConfirmButton: false
        });
        fetchCart();
    })
    .catch(error => console.error('Error:', error));
}

// fetch cart
function fetchCart() {
    fetch('/cart/get')
        .then(response => response.json())
        .then(data => {
            cart = data;
            document.getElementById("cartCount").textContent = cart.length;
            updateCart();
        })
        .catch(error => console.error('Error:', error));
}
//fetch cart end


// Update Cart Modal
function updateCart() {
    let cartItems = document.getElementById("cartItems");
    let totalPriceElement = document.getElementById("totalPrice");

    cartItems.innerHTML = "";
    let totalPrice = 0;

    cart.forEach((product, index) => {
        if(cart.length >=3){
            totalPrice += parseFloat(product.price) - parseFloat((product.price) * 10 ) / 100;
        }
        else{
            totalPrice += parseFloat(product.price);
        }
        let cartRow = `
            <div class="flex justify-between items-center py-2 border-b">
                <span>${product.name}</span>
                <span>$${product.price}</span>
                <button onclick="removeFromCart(${index})" class="text-red-600 text-xl">&times;</button>
            </div>
        `;
        cartItems.innerHTML += cartRow;
    });

    totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
}

// remove from cart
function removeFromCart(index) {
    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ index: index })
    })
    .then(response => response.json())
    .then(data => {
        Swal.fire({
            title: "Remove from Cart",
            text: data.message,
            icon: "success",
            timer: 2000,
            showConfirmButton: false
        });
        fetchCart();
    })
    .catch(error => console.error('Error:', error));
}
fetchCart();
// cart functionality end

