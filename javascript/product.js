
    // dropdownmenu 
    
    const dropdown1 = document.getElementById('dropdown1');
    const dropdown2 = document.getElementById('dropdown2');
    const dropdown3 = document.getElementById('dropdown3');
    const price = document.getElementById('price');
    const addToCartBtn = document.getElementById('addToCart');

    let quantity = 0;
    let itemPrice = 0;
    dropdown1.addEventListener("click", () => {

        const pricePerUnit = document.getElementById('hiddenPrice');
        itemPrice = pricePerUnit.value;
        price.innerText = `Total cost: ${itemPrice} €`;
        quantity = 1;
        addToCartBtn.innerHTML = `Add to cart <i class="bi bi-cart">`;
    })

    dropdown2.addEventListener("click", () => {

        const pricePerUnit = document.getElementById('hiddenPrice');
        quantity = 3;
        itemPrice = pricePerUnit.value * quantity;
        price.innerText = `Total cost: ${itemPrice} €`;
        
    })

    dropdown3.addEventListener("click", () => {

        const pricePerUnit = document.getElementById('hiddenPrice');
        quantity = 5;
        itemPrice = pricePerUnit.value * quantity;
        price.innerText = `Total cost: ${itemPrice} €`;
        
    })

    // add item into cart

    const itemId = document.getElementById('hiddenId');

    addToCartBtn.onclick = (e) => {
        e.preventDefault();
        fetch('add_item_into_cart.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: itemId.value,
                quantity: quantity
            })
        }).then((response) => {
            return response.json();
        }).then((myJson) => {
            addToCartBtn.innerText = 'Item Added!';
            addToCartBtn.disabled = true;     
        })
    }