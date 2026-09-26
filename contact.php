<?php

require_once __DIR__ . '/config/database.php';


// =====================================================
// FORM SUBMISSION
// =====================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form_type = $_POST['form_type'] ?? '';

    try {

        // =================================================
        // PARTNER APPLICATION
        // =================================================

        if ($form_type === 'partner') {

            $full_name   = trim($_POST['full_name'] ?? '');
            $agency_name = trim($_POST['agency_name'] ?? '');
            $country     = trim($_POST['country'] ?? '');
            $phone       = trim($_POST['phone'] ?? '');
            $email       = trim($_POST['email'] ?? '');
            $experience  = trim($_POST['experience'] ?? '');
            $agreement   = isset($_POST['agreement']) ? 1 : 0;


            // ---------------------------------------------
            // VALIDATION
            // ---------------------------------------------

            if (
                $full_name === '' ||
                $agency_name === '' ||
                $country === '' ||
                $phone === '' ||
                $email === ''
            ) {

                header(
                    'Location: contact.php?error=partner_required#partner-application'
                );
                exit;
            }


            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                header(
                    'Location: contact.php?error=partner_email#partner-application'
                );
                exit;
            }


            if ($agreement !== 1) {

                header(
                    'Location: contact.php?error=partner_agreement#partner-application'
                );
                exit;
            }


            // ---------------------------------------------
            // INSERT PARTNER APPLICATION
            // ---------------------------------------------

            $stmt = $pdo->prepare("
                INSERT INTO partner_applications
                (
                    company_name,
                    contact_person,
                    email,
                    experience,
                    phone,
                    country,
                    status,
                    notes
                )
                VALUES
                (
                    :company_name,
                    :contact_person,
                    :email,
                    :experience,
                    :phone,
                    :country,
                    'new',
                    :notes
                )
            ");


            $stmt->execute([

                ':company_name'   => $agency_name,
                ':contact_person' => $full_name,
                ':email'          => $email,
                ':experience'     => $experience,
                ':phone'          => $phone,
                ':country'        => $country,
                ':notes'          => 'Agreement accepted: Yes'

            ]);


            header(
                'Location: contact.php?success=partner#partner-application'
            );
            exit;
        }


        // =================================================
        // CONTACT MESSAGE
        // =================================================

        if ($form_type === 'contact') {

            $full_name    = trim($_POST['full_name'] ?? '');
            $email        = trim($_POST['email'] ?? '');
            $phone        = trim($_POST['phone'] ?? '');
            $destination  = trim($_POST['destination'] ?? '');
            $message      = trim($_POST['message'] ?? '');
            $ppp_interest = isset($_POST['ppp_interest']) ? 1 : 0;


            // ---------------------------------------------
            // VALIDATION
            // ---------------------------------------------

            if (
                $full_name === '' ||
                $email === '' ||
                $phone === ''
            ) {

                header(
                    'Location: contact.php?error=contact_required#contact-form'
                );
                exit;
            }


            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                header(
                    'Location: contact.php?error=contact_email#contact-form'
                );
                exit;
            }


            // ---------------------------------------------
            // INSERT CONTACT MESSAGE
            // ---------------------------------------------

            $stmt = $pdo->prepare("
                INSERT INTO contact_messages
                (
                    full_name,
                    email,
                    phone,
                    destination,
                    message,
                    ppp_interest,
                    status
                )
                VALUES
                (
                    :full_name,
                    :email,
                    :phone,
                    :destination,
                    :message,
                    :ppp_interest,
                    'new'
                )
            ");


            $stmt->execute([

                ':full_name'    => $full_name,
                ':email'        => $email,
                ':phone'        => $phone,
                ':destination'  => $destination,
                ':message'      => $message,
                ':ppp_interest' => $ppp_interest

            ]);


            header(
                'Location: contact.php?success=contact#contact-form'
            );
            exit;
        }


    } catch (PDOException $e) {

        header('Location: contact.php?error=database');
        exit;
    }
}


include __DIR__ . '/includes/header.php';

?>


<main class="contact-page">


    <!-- =====================================================
         CONTACT HERO
    ====================================================== -->

    <section
        class="contact-banner"
        style="
            background-image:
                linear-gradient(
                    rgba(74, 91, 104, 0.58),
                    rgba(74, 91, 104, 0.58)
                ),
                url('assets/images/about-bg.jpg');
        "
    >

        <div class="contact-banner-content reveal">

            <h1>
                CONTACT US &amp; PARTNER PROGRAM
            </h1>

            <p>
                GET IN TOUCH WITH OUR TEAM OR EXPLORE PARTNERSHIP OPPORTUNITIES
            </p>

        </div>

    </section>


    <!-- =====================================================
         CONTACT MAIN SECTION
    ====================================================== -->

    <section class="contact-main-section">

        <div class="contact-container">


            <!-- =================================================
                 PAGE HEADING
            ================================================== -->

            <div class="contact-heading reveal">

                <h2>
                    Contact Us
                </h2>

                <div class="contact-heading-line"></div>

                <p>
                    Join our network of education agents and grow your
                    business with Khan &amp; Teams
                </p>

            </div>


            <!-- =================================================
                 MAIN TWO COLUMN AREA
            ================================================== -->

            <div class="contact-layout">


                <!-- =================================================
                     LEFT COLUMN
                ================================================== -->

                <div class="contact-left">


                    <!-- =============================================
                         PAYMENT INFORMATION
                    ============================================== -->

                    <article class="contact-card payment-card reveal">

                        <div class="card-heading">

                            <i class="fa-solid fa-credit-card"></i>

                            <h3>
                                Payment Information
                            </h3>

                        </div>

                        <p class="card-intro">
                            Use the details below to make your payment.
                            Please send a screenshot once payment is completed.
                        </p>


                        <div class="payment-grid">


                            <!-- BANK -->

                            <div class="payment-box">

                                <div class="payment-box-header bank-header">

                                    <i class="fa-solid fa-building-columns"></i>

                                    <span>
                                        BANK ACCOUNT
                                    </span>

                                </div>


                                <div class="payment-details">

                                    <div>
                                        <span>Account Name</span>
                                        <strong>Khan &amp; Teams Education</strong>
                                    </div>

                                    <div>
                                        <span>Bank Name</span>
                                        <strong>United Trust Bank PLC</strong>
                                    </div>

                                    <div>
                                        <span>Branch</span>
                                        <strong>Nawabganj Branch</strong>
                                    </div>

                                    <div>
                                        <span>Account No.</span>
                                        <strong>0128214100002000</strong>
                                    </div>

                                    <div>
                                        <span>Routing No.</span>
                                        <strong>255158554</strong>
                                    </div>

                                    <div>
                                        <span>SWIFT Code</span>
                                        <strong>UTBLBDDH</strong>
                                    </div>

                                </div>

                            </div>


                            <!-- BKASH -->

                            <div class="payment-box">

                                <div class="payment-box-header bkash-header">

                                    <i class="fa-solid fa-mobile-screen-button"></i>

                                    <span>
                                        BKASH MERCHANT
                                    </span>

                                </div>


                                <div class="payment-details">

                                    <div>
                                        <span>Merchant Name</span>
                                        <strong>Khan &amp; Teams Education</strong>
                                    </div>

                                    <div>
                                        <span>Merchant Number</span>
                                        <strong>01805757448</strong>
                                    </div>

                                </div>


                                <div class="contact-details-box">

                                    <p>
                                        CONTACT DETAILS
                                    </p>

                                    <strong>
                                        +8801629-139064
                                    </strong>

                                    <strong>
                                        +8801805-757448
                                    </strong>

                                </div>


                                <div class="payment-warning">

                                    <i class="fa-solid fa-triangle-exclamation"></i>

                                    <span>
                                        Please send payment screenshot once payment is completed.
                                    </span>

                                </div>

                            </div>

                        </div>

                    </article>


                    <!-- =============================================
                         B2B AGENT PROGRAMME
                    ============================================== -->

                    <article class="contact-card b2b-card reveal">

                        <div class="card-heading">

                            <i class="fa-solid fa-handshake"></i>

                            <h3>
                                B2B Agent Programme
                            </h3>

                        </div>

                        <p class="b2b-intro">
                            Join Khan &amp; Teams' network of trusted
                            education partners and benefit from our
                            comprehensive support system designed to help
                            you grow your business while maintaining the
                            highest standards of compliance and ethics.
                        </p>


                        <h4>
                            Program Benefits
                        </h4>


                        <div class="benefit-list">


                            <div class="benefit-item">

                                <div class="benefit-icon">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </div>

                                <div>

                                    <h5>
                                        Compliance Umbrella
                                    </h5>

                                    <p>
                                        Operate under Khan &amp; Teams'
                                        established compliance framework
                                        with full regulatory support and guidance.
                                    </p>

                                </div>

                            </div>


                            <div class="benefit-item">

                                <div class="benefit-icon">
                                    <i class="fa-solid fa-chart-line"></i>
                                </div>

                                <div>

                                    <h5>
                                        Free CRM Access
                                    </h5>

                                    <p>
                                        Get exclusive access to our customized
                                        CRM system for lead tracking, document
                                        management, and client relationship management.
                                    </p>

                                </div>

                            </div>


                            <div class="benefit-item">

                                <div class="benefit-icon">
                                    <i class="fa-solid fa-calculator"></i>
                                </div>

                                <div>

                                    <h5>
                                        ROI Calculator
                                    </h5>

                                    <p>
                                        Use our specialized tools to help clients
                                        calculate return on investment for their
                                        education abroad.
                                    </p>

                                </div>

                            </div>


                            <div class="benefit-item">

                                <div class="benefit-icon">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>

                                <div>

                                    <h5>
                                        Compliance Training
                                    </h5>

                                    <p>
                                        Receive comprehensive training on ethical
                                        practices, documentation requirements,
                                        and industry regulations.
                                    </p>

                                </div>

                            </div>


                            <div class="benefit-item">

                                <div class="benefit-icon">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </div>

                                <div>

                                    <h5>
                                        Transparent Revenue Sharing
                                    </h5>

                                    <p>
                                        Clear and fair commission structure with
                                        timely payments and complete transparency.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </article>


                    <!-- =============================================
                         PARTNER APPLICATION
                    ============================================== -->

                    <article
                        class="partner-card reveal"
                        id="partner-application"
                    >

                        <h3>
                            Partner Application Form
                        </h3>


                        <form
                            class="partner-form"
                            action=""
                            method="post"
                        >

                            <input
                                type="hidden"
                                name="form_type"
                                value="partner"
                            >


                            <div class="form-row">


                                <div class="form-group">

                                    <label for="partner-name">
                                        Full Name <span>*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="partner-name"
                                        name="full_name"
                                        required
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="agency-name">
                                        Agency Name <span>*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="agency-name"
                                        name="agency_name"
                                        required
                                    >

                                </div>


                            </div>


                            <div class="form-row">


                                <div class="form-group">

                                    <label for="partner-country">
                                        Country <span>*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="partner-country"
                                        name="country"
                                        required
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="partner-phone">
                                        Phone Number <span>*</span>
                                    </label>

                                    <input
                                        type="tel"
                                        id="partner-phone"
                                        name="phone"
                                        required
                                    >

                                </div>


                            </div>


                            <div class="form-group">

                                <label for="partner-email">
                                    Email Address <span>*</span>
                                </label>

                                <input
                                    type="email"
                                    id="partner-email"
                                    name="email"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="experience">
                                    Years of Experience in Education Consulting
                                </label>

                                <select
                                    id="experience"
                                    name="experience"
                                >

                                    <option value="">
                                        Select Experience
                                    </option>

                                    <option value="less-than-1">
                                        Less than 1 year
                                    </option>

                                    <option value="1-3">
                                        1 - 3 years
                                    </option>

                                    <option value="3-5">
                                        3 - 5 years
                                    </option>

                                    <option value="5-10">
                                        5 - 10 years
                                    </option>

                                    <option value="10+">
                                        10+ years
                                    </option>

                                </select>

                            </div>


                            <label class="checkbox-row">

                                <input
                                    type="checkbox"
                                    name="agreement"
                                    value="1"
                                    required
                                >

                                <span>
                                    I agree to adhere to Khan &amp; Teams'
                                    compliance policies, ethical guidelines,
                                    and professional standards
                                </span>

                            </label>


                            <button
                                type="submit"
                                class="contact-action-btn"
                            >
                                Apply to Become a Partner Agent
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>


                        </form>

                    </article>

                </div>


                <!-- =================================================
                     RIGHT COLUMN
                ================================================== -->

                <aside class="contact-right">


                    <!-- =============================================
                         CONTACT FORM CARD
                    ============================================== -->

                    <div
                        class="contact-form-card reveal"
                        id="contact-form"
                    >

                        <h3>
                            Contact Us
                        </h3>


                        <form
                            action=""
                            method="post"
                            class="main-contact-form"
                        >

                            <input
                                type="hidden"
                                name="form_type"
                                value="contact"
                            >


                            <div class="form-group">

                                <label for="contact-name">
                                    Full Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="contact-name"
                                    name="full_name"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="contact-email">
                                    Email Address <span>*</span>
                                </label>

                                <input
                                    type="email"
                                    id="contact-email"
                                    name="email"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="contact-phone">
                                    Phone Number <span>*</span>
                                </label>

                                <input
                                    type="tel"
                                    id="contact-phone"
                                    name="phone"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="destination">
                                    Destination Interest
                                </label>

                                <select
                                    id="destination"
                                    name="destination"
                                >

                                    <option value="">
                                        Select Destination
                                    </option>

                                    <option value="uk">
                                        United Kingdom
                                    </option>

                                    <option value="australia">
                                        Australia
                                    </option>

                                    <option value="canada">
                                        Canada
                                    </option>

                                    <option value="new-zealand">
                                        New Zealand
                                    </option>

                                    <option value="malaysia">
                                        Malaysia
                                    </option>

                                    <option value="thailand">
                                        Thailand
                                    </option>

                                    <option value="other">
                                        Other
                                    </option>

                                </select>

                            </div>


                            <div class="form-group">

                                <label for="message">
                                    Message
                                </label>

                                <textarea
                                    id="message"
                                    name="message"
                                    rows="5"
                                    placeholder="Tell us about your requirements..."
                                ></textarea>

                            </div>


                            <label class="checkbox-row contact-interest">

                                <input
                                    type="checkbox"
                                    name="ppp_interest"
                                    value="1"
                                >

                                <span>
                                    I'm interested in PPP 2026 –
                                    Professional Practice Programme
                                </span>

                            </label>


                            <button
                                type="submit"
                                class="send-message-btn"
                            >

                                Send Message

                                <i class="fa-solid fa-paper-plane"></i>

                            </button>


                        </form>


                        <!-- Quick buttons -->

                        <div class="quick-actions">

                            <a
                                href="#contact-form"
                                class="quick-btn"
                            >
                                Free Profile Evaluation
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>


                            <a
                                href="#contact-form"
                                class="quick-btn"
                            >
                                Book Consultation
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>


                            <a
                                href="#partner-application"
                                class="quick-btn purple"
                            >
                                Apply for PPP 2026
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>


                        <p class="terms-text">

                            By submitting this form, you acknowledge our
                            <a href="#">
                                Privacy Policy
                            </a>
                            and
                            <a href="#">
                                Terms &amp; Conditions.
                            </a>

                        </p>


                        <!-- Chattogram Office -->

                        <div class="office-info">

                            <h4>
                                <i class="fa-solid fa-location-dot"></i>
                                Chattogram Office
                            </h4>

                            <p>
                                Hazari Lane, Shahid Jane Alam Road, Muradpur
                            </p>

                            <p>
                                <i class="fa-solid fa-phone"></i>
                                +880 1629-139064
                            </p>

                        </div>

                    </div>

                </aside>

            </div>

        </div>

    </section>

</main>


<!-- =====================================================
     SUCCESS POPUP
====================================================== -->

<?php if (isset($_GET['success'])): ?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    <?php if ($_GET['success'] === 'partner'): ?>

        alert(
            'Partner application submitted successfully!'
        );

    <?php elseif ($_GET['success'] === 'contact'): ?>

        alert(
            'Your message has been sent successfully!'
        );

    <?php endif; ?>

});

</script>

<?php endif; ?>


<!-- =====================================================
     ERROR POPUP
====================================================== -->

<?php if (isset($_GET['error'])): ?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    <?php if ($_GET['error'] === 'partner_required'): ?>

        alert(
            'Please fill in all required partner application fields.'
        );

    <?php elseif ($_GET['error'] === 'partner_email'): ?>

        alert(
            'Please enter a valid partner email address.'
        );

    <?php elseif ($_GET['error'] === 'partner_agreement'): ?>

        alert(
            'Please accept the compliance and professional standards agreement.'
        );

    <?php elseif ($_GET['error'] === 'contact_required'): ?>

        alert(
            'Please fill in your name, email and phone number.'
        );

    <?php elseif ($_GET['error'] === 'contact_email'): ?>

        alert(
            'Please enter a valid email address.'
        );

    <?php elseif ($_GET['error'] === 'database'): ?>

        alert(
            'Something went wrong while saving your information. Please try again.'
        );

    <?php endif; ?>

});

</script>

<?php endif; ?>


<?php

include __DIR__ . '/includes/footer.php';

?>