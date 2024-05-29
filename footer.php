<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kaapa:</title>
  <style>
    .footContainer {
      background-color: #e4f0d0;
      height: max-content;
      padding: 8px;
    }

    .social-icons {
      flex: 1;
    }

    .stay-connected {
      flex: 1;
      text-align: center;
      text-decoration: none;

    }

    .contact-info {
      flex: 1;
      text-align: center;
    }

    /* Styles for FAQ popup */
    .popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999;
      justify-content: center;
      align-items: center;
    }

    .popup.active {
      display: flex;
    }

    .popup .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    .popup .content {
      background-color: whitesmoke;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      text-align: center;
      position: relative;
    }

    .popup .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
    }

    .social-media-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  </style>
</head>

<body>
  <div class="footContainer">
    <footer class="d-flex justify-content-between align-items-center py-3 border-top">
      <div class="col-md-4 d-flex align-items-center social-icons">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <svg class="bi" width="10" height="24">
            <use xlink:href="#bootstrap" />
          </svg>
        </a>
        <div class="social-media-container">
          <div>
            <a href="https://www.facebook.com" target="_blank" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>

          </div>
          <span class="mb-3 mb-md-0 text-muted">Kaapa: 2024 Company, Inc</span>

        </div>
      </div>


      <div class="stay-connected">
        <h3>Stay Connected</h3>
        <p><a href="about.php">About Us</a></p>
        <p><a href="ourProducts.php">Our Products</a></p>
        <p><a href="#" id="faq">FAQ</a></p>

        <!-- Add the new popup box for FAQ -->
        <div class="popup" id="faq-popup">
          <div class="overlay"></div>
          <div class="content">
            <div class="close-btn" onclick="toggleFaqPopup()">&times;</div>
            <h2>FAQ!!!</h2>
            <p>
              <strong>Ordering and Shipping:</strong>
              <br>
              1. How do I place an order?
              <br>
              Select items, proceed to checkout, and follow prompts to complete purchase.
              <br>
              <strong>Returns and Refunds:</strong>
              <br>
              2. What is your return policy?
              <br>
              We offer hassle-free returns within 2 days of delivery for unused items in original packaging, providing a full refund.
              <br>
              <strong>Product Information:</strong>
              <br>
              3. Where can I find product details?
              <br>
              Detailed product descriptions and specifications are available on each product page.
              <br>
              <strong>Payment and Billing:</strong>
              <br>
              4. What payment methods do you accept?
              <br>
              We accept Khalti and cash on delivery payment methods.
              <br>
              <strong>Customer Support:</strong>
              <br>
              You can reach us via email, or phone for assistance with any questions or concerns.
            </p>
          </div>
        </div>
      </div>

      <div class="contact-info">
        <h3>Contact Us</h3>
        <p>Email: info@kaapa.np</p>
        <p>Phone: +1234567890</p>
        <p>Address: Kathmandu, Nepal</p>
      </div>
    </footer>
  </div>

  <script>
    function toggleFaqPopup() {
      var faqPopup = document.getElementById("faq-popup");
      faqPopup.classList.toggle("active");
    }
    document.getElementById("faq").addEventListener("click", function(event) {
      event.preventDefault();
      toggleFaqPopup();
    });
  </script>
</body>

</html>