<div class="container py-5">
    <h2 class="text-center">Terms & Conditions</h2>
    <p class="text-muted text-center">Last Updated: <?= date('F d, Y') ?></p>

    <div class="terms-content">
        <h4>1. Introduction</h4>
        <p>Welcome to Insta Wipe. By accessing our website and using our services, you agree to comply with these Terms & Conditions.</p>

        <h4>2. Use of Our Services</h4>
        <p>When using our website, you agree to:</p>
        <ul>
            <li>Provide accurate and up-to-date information</li>
            <li>Not engage in fraudulent activities</li>
            <li>Respect intellectual property rights</li>
        </ul>

        <h4>3. Orders and Payments</h4>
        <p>All orders placed through our website are subject to availability. We reserve the right to refuse or cancel any order. Payment must be made in full before shipping.</p>

        <h4>4. Shipping and Returns</h4>
        <p>We aim to deliver products in a timely manner. If you are unsatisfied with your purchase, please refer to our
            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'privacy']) ?>">Privacy Policy</a> for return and refund details.
        </p>

        <h4>5. Limitation of Liability</h4>
        <p>We are not liable for any indirect, incidental, or consequential damages arising from your use of our services.</p>

        <h4>6. Modifications to Terms</h4>
        <p>We reserve the right to modify these Terms & Conditions at any time. Continued use of our website implies acceptance of the revised terms.</p>

        <h4>7. Contact Us</h4>
        <p>If you have any questions regarding these Terms & Conditions, please
            <a href="<?= $this->Url->build(['controller' => 'Enquiries', 'action' => 'add']) ?>">contact us</a>.
        </p>
    </div>
</div>

<style>
    .terms-content {
        max-width: 800px;
        margin: auto;
    }
    .terms-content h4 {
        margin-top: 20px;
        color: #000;
        font-weight: bold;
    }
</style>
