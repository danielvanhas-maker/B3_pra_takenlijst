<?php
if(session_status() == PHP_SESSION_NONE){
    // Start Session it is not started yet
    session_start();
}?>
<header>
    <div class="header-content">
        <div class="wrapper">
        <img src="<?php echo $base_url; ?>/images/logo-big-v3.png" alt="Het logo van DeveloperLand met een draaimolen, kasteel, achtbaan en tot slot een gezin op de voorgrond." class="logo hidden-on-sm">
        
        </div>
            <nav>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (!empty($_SESSION['user_admin'])): ?>
                        <a href="<?php echo $base_url; ?>/user/create.php">Gebruiker aanmaken</a> |
                        <a href="<?php echo $base_url; ?>/user/users.php">Gebruikers beheren</a> |
                        <a href="<?php echo $base_url; ?>/task/tasksAdmin.php">Taken</a> |
                    <?php else: ?>
                        <a href="<?php echo $base_url; ?>/task/tasks.php">Taken</a> |
                    <?php endif; ?>
                    <a href="<?php echo $base_url; ?>/task/create.php">Taak aanmaken</a> |
                    <a href="<?= $base_url; ?>/user/read.php?id=<?= htmlspecialchars($_SESSION['user_id']) ?>">
                        Account inzien
                    </a> |
                    <a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a>
                <?php endif; ?>
                </nav>
        </div>
</header>