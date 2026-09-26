<?php

require_once __DIR__ . '/config/database.php';


// =====================================================
// FORM SUBMISSION
// =====================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = trim($_POST['full_name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $address   = trim($_POST['address'] ?? '');


    // Basic validation

    if ($full_name === '' || $email === '' || $phone === '' || $address === '') {

        header('Location: apply.now.php?error=empty');
        exit;
    }


    // Validate email

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        header('Location: apply.now.php?error=email');
        exit;
    }


    try {

        // Insert application into database

        $sql = "
            INSERT INTO applications
            (full_name, email, phone, address)
            VALUES
            (:full_name, :email, :phone, :address)
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':full_name' => $full_name,
            ':email'     => $email,
            ':phone'     => $phone,
            ':address'   => $address
        ]);


        // Redirect after successful submission

        header('Location: apply.now.php?success=1');
        exit;


    } catch (PDOException $e) {

        header('Location: apply.now.php?error=database');
        exit;
    }
}


include __DIR__ . '/includes/header.php';

?>

<main class="apply-page">


    <!-- =====================================================
         HERO BANNER
    ====================================================== -->

    <section
        class="apply-banner"
        style="
            background-image:
                linear-gradient(
                    rgba(74, 91, 104, 0.58),
                    rgba(74, 91, 104, 0.58)
                ),
                url('assets/images/about-bg.jpg');
        "
    >

        <div class="apply-banner-content reveal">

            <h1>
                GET STARTED WITH KHAN &amp; TEAMS EDUCATION
            </h1>

            <p>
                FILL OUT THIS FORM TO CONNECT WITH OUR STUDENT ADVISORS.
            </p>

        </div>

    </section>


    <!-- =====================================================
         APPLICATION FORM
    ====================================================== -->

    <section class="apply-main-section">

        <div class="apply-container">


            <div class="apply-form-card reveal">


                <!-- =====================================================
                     SUCCESS / ERROR MESSAGE
                ====================================================== -->

                <?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>

                    <div
                        style="
                            padding: 14px 18px;
                            margin-bottom: 25px;
                            border-radius: 8px;
                            background: #e8f7ee;
                            color: #176b3a;
                            border: 1px solid #b7e4c7;
                            font-size: 15px;
                        "
                    >
                        Your application has been submitted successfully.
                        Our student advisor will contact you soon.
                    </div>

                <?php endif; ?>


                <?php if (isset($_GET['error']) && $_GET['error'] === 'empty'): ?>

                    <div
                        style="
                            padding: 14px 18px;
                            margin-bottom: 25px;
                            border-radius: 8px;
                            background: #fff3cd;
                            color: #856404;
                            border: 1px solid #ffe69c;
                            font-size: 15px;
                        "
                    >
                        Please fill in all the required fields.
                    </div>

                <?php endif; ?>


                <?php if (isset($_GET['error']) && $_GET['error'] === 'email'): ?>

                    <div
                        style="
                            padding: 14px 18px;
                            margin-bottom: 25px;
                            border-radius: 8px;
                            background: #fff3cd;
                            color: #856404;
                            border: 1px solid #ffe69c;
                            font-size: 15px;
                        "
                    >
                        Please enter a valid email address.
                    </div>

                <?php endif; ?>


                <?php if (isset($_GET['error']) && $_GET['error'] === 'database'): ?>

                    <div
                        style="
                            padding: 14px 18px;
                            margin-bottom: 25px;
                            border-radius: 8px;
                            background: #f8d7da;
                            color: #842029;
                            border: 1px solid #f1aeb5;
                            font-size: 15px;
                        "
                    >
                        Something went wrong while saving your application.
                        Please try again.
                    </div>

                <?php endif; ?>


                <!-- =====================================================
                     FORM
                ====================================================== -->

                <form
                    action="apply.now.php"
                    method="post"
                    class="apply-form"
                >


                    <!-- Full Name -->

                    <div class="apply-form-group">

                        <label for="apply-name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="apply-name"
                            name="full_name"
                            required
                        >

                    </div>


                    <!-- Email -->

                    <div class="apply-form-group">

                        <label for="apply-email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="apply-email"
                            name="email"
                            required
                        >

                    </div>


                    <!-- Phone -->

                    <div class="apply-form-group">

                        <label for="apply-phone">
                            Phone Number
                        </label>

                        <input
                            type="tel"
                            id="apply-phone"
                            name="phone"
                            required
                        >

                    </div>


                    <!-- Address -->

                    <div class="apply-form-group">

                        <label for="apply-address">
                            Address
                        </label>

                        <textarea
                            id="apply-address"
                            name="address"
                            rows="5"
                            required
                        ></textarea>

                    </div>


                    <!-- Submit -->

                    <div class="apply-submit-wrap">

                        <button
                            type="submit"
                            class="apply-submit-btn"
                        >
                            Submit Request
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</main>


<?php

include __DIR__ . '/includes/footer.php';

?>