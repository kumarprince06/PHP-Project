// checkout.js

// Create a Stripe client
const stripe = Stripe('your_publishable_key'); // Replace with your Stripe publishable key

// Create an instance of Elements
const elements = stripe.elements();

// Create a card element
const cardElement = elements.create('card');
cardElement.mount('#card-element');

// Handle real-time validation errors from the card element
cardElement.on('change', event => {
    const displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission
document.getElementById('checkout-button').addEventListener('click', async (event) => {
    event.preventDefault(); // Prevent default form submission

    // Fetch the client secret from your backend
    const response = await fetch('/checkout', { // Update this URL to match your backend route
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ userId: 'USER_ID', amount: <?php echo $totalAmount; ?> }) // Replace with the actual user ID
    });

    const data = await response.json();

    if (data.error) {
        alert(data.error);
        return;
    }

    // Confirm the payment using the client secret
    const { error } = await stripe.confirmCardPayment(data.clientSecret, {
        payment_method: {
            card: cardElement,
            billing_details: {
                name: 'Card Holder Name', // Add billing details as needed
            },
        },
    });

    if (error) {
        // Show error to your customer
        alert(error.message);
    } else {
        // Payment succeeded
        alert('Payment successful!');
        // Optionally redirect or update the UI here
        window.location.href = "<?php echo URLROOT; ?>/userController/dashboard"; // Redirect to dashboard or another page
    }
});
