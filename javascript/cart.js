
    //changing the quantity of products

    const changeQuantity = document.querySelectorAll('.changeQuantity');
    let itemId;
    
    for (i=0;i<changeQuantity.length;i++) {
        changeQuantity[i].addEventListener('click', (e) => {
            itemId = e.target.id;
            
            const dropdown1 = document.getElementById('dropdown1' + itemId);
            dropdown1.addEventListener('click', (e) => {
                changeProductQuantity('1');
            })

            const dropdown2 = document.getElementById('dropdown2' + itemId);
            dropdown2.addEventListener('click', (e) => {
                changeProductQuantity('3');
            })

            const dropdown3 = document.getElementById('dropdown3' + itemId);
            dropdown3.addEventListener('click', (e) => {
                changeProductQuantity('5');
            
            })

            console.log(itemId)
            
            function changeProductQuantity(newQuantity) {

                fetch('change_product_quantity.php', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: itemId,
                        newQuantity: newQuantity,
                    })
                    }).then((response) => {
                        return response.json();
                    }).then((myJson) => {
                        document.location.reload();
                    })
            }
        })      
    }
        
    // deleting item from cart

    const deleteItemFromCartBtn = document.querySelectorAll('.deleteItem');
    let cartItem;

    for (i=0;i<deleteItemFromCartBtn.length;i++) {
        deleteItemFromCartBtn[i].addEventListener('click', (e) => {

            cartItem = e.target.id;
           
            console.log(cartItem);
            const idOfCartItemToBeDeleted = document.getElementById('hidden' + cartItem);

            fetch('do_delete_item_from_cart.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: idOfCartItemToBeDeleted.value,
            })
        }).then((response) => {
            return response.json();
        }).then((myJson) => {
            document.location.reload()
        })
    })
}