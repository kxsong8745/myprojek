<?php 
    $ENABLE_ADD  = TRUE;
    $ENABLE_MANAGE  = TRUE;
    $ENABLE_DELETE  = TRUE;
?>
<?= form_open($this->uri->uri_string(), array('id' => 'frm_menu', 'name' => 'frm_menu')) ?>

<h1 class="text-center">User Profile</h1>

<h2>Your Information</h2>
<?php if (!empty($user)) : ?>
    <p><span class="fw-bold">Username:</span> <?= htmlspecialchars($user->USERNAME) ?></p>
    <p><span class="fw-bold">Email:</span> <?= htmlspecialchars($user->EMAIL) ?></p>
    <p><span class="fw-bold">Name:</span> <?= htmlspecialchars($user->R_NAME) ?></p>
    <p><span class="fw-bold">Role:</span> <?= htmlspecialchars($user->ROLE) ?></p>
<?php else : ?>
    <p class="text-danger">No user data found.</p>
<?php endif; ?>


<?= form_close() ?>

