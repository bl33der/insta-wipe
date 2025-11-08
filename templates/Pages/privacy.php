<div class="container py-5">
    <h2 class="text-center">Privacy Policy</h2>
    <p class="text-muted text-center">Last Updated: <?= date('F d, Y') ?></p>

    <div class="privacy-content">
        <h4>1. Introduction</h4>
        <p>Welcome to Insta Wipe. We respect your privacy and are committed to protecting your personal data. This Privacy Policy outlines how we collect, use, and safeguard your information.</p>

        <h4>2. Information We Collect</h4>
        <p>We collect the following types of information:</p>
        <ul>
            <li>Personal Identification Information (Name, email address, phone number, etc.)</li>
            <li>Order and payment details</li>
            <li>Usage data and analytics</li>
        </ul>

        <h4>3. How We Use Your Information</h4>
        <p>Your data is used to:</p>
        <ul>
            <li>Process orders and payments</li>
            <li>Improve customer service and website experience</li>
            <li>Send promotional emails and updates (with your consent)</li>
            <li>Comply with legal obligations</li>
        </ul>

        <h4>4. Data Protection and Security</h4>
        <p>We implement security measures to protect your data from unauthorized access, disclosure, or alteration.</p>

        <h4>5. Cookies and Tracking Technologies</h4>
        <p>Our website uses cookies to enhance user experience. You can manage your cookie preferences in your browser settings.</p>

        <h4>6. Third-Party Sharing</h4>
        <p>We do not sell or share your personal data with third parties, except as required by law or for essential business operations.</p>

        <h4>7. Your Rights</h4>
        <p>You have the right to access, update, or delete your personal data. Contact us to exercise these rights.</p>

        <h4>8. Contact Us</h4>
        <p>If you have any questions regarding our Privacy Policy, please <a href="<?= $this->Url->build(['controller' => 'Enquiries', 'action' => 'add']) ?>">contact us</a>.</p>
    </div>
</div>

<style>
    .privacy-content {
        max-width: 800px;
        margin: auto;
    }
    .privacy-content h4 {
        margin-top: 20px;
        color: #000;
        font-weight: bold;
    }
</style>
