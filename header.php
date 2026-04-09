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
                <a href="<?php echo $base_url; ?>/task/tasks.php">Tasks</a> | 
                <a href="<?php echo $base_url; ?>/user/create.php">User Create</a> | 
                <a href="<?php echo $base_url; ?>/task/create.php">Task Create</a>
                <?php if($_SESSION == TRUE): ?>
                <p><a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a></p>
                <?php else: ?>
                <p><a href="<?php echo $base_url; ?>/login.php">Inloggen</a></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div>
                        <a href="<?= $base_url; ?>/user/read.php?id=<?= htmlspecialchars($_SESSION['user_id']) ?>">
                            Account inzien
                        </a>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
</header>