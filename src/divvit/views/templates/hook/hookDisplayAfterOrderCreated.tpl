<script>
    divvit.orderPlaced({
        order: {
            products: [
                {foreach name=aussen item=product from=$ORDER_PRODUCTS}
                {
                    id: "{$product['id']|escape:'htmlall':'UTF-8'}",
                    name: "{$product['name']|escape:'htmlall':'UTF-8'}",
                    category: "[{$product['category']|escape:'htmlall':'UTF-8'}]",
                    quantity: "{$product['quantity']|escape:'htmlall':'UTF-8'}",
                    price: "{$product['price']|escape:'htmlall':'UTF-8'}",
                    currency: "{$product['currency']|escape:'htmlall':'UTF-8'}",
                },
                {/foreach}
            ],
            orderId: "{$ORDER_DETAILS['id']|escape:'htmlall':'UTF-8'}",
            total: "{$ORDER_DETAILS['total']|escape:'htmlall':'UTF-8'}",
            currency: "{$ORDER_DETAILS['currency']|escape:'htmlall':'UTF-8'}",
            totalProductsNet: "{$ORDER_DETAILS['totalProductsNet']|escape:'htmlall':'UTF-8'}",
            shipping: "{$ORDER_DETAILS['shipping']|escape:'htmlall':'UTF-8'}",
            customer:{
                idFields: {
                    email: "{$ORDER_DETAILS['userMail']|escape:'htmlall':'UTF-8'}"
                },
                name: "{$ORDER_DETAILS['userName']|escape:'htmlall':'UTF-8'}"
            }
        }
    });
</script>