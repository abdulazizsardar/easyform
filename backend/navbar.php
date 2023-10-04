<?php if ( ! defined( 'ABSPATH' ) ) exit;
?>
<h1 class="nav-tab-wrapper">
      <a href="?page=easyform-general-settings&tab=dashboard" class="nav-tab <?php echo ($active_tab === 'dashboard') ? 'nav-tab-active' : ''; ?>"><?php _e('Dashboard Settings', 'easyform'); ?></a>
      
</h1>

<!--  Backend Main features tab-1(dashboard) -->
<div class="tab-content <?php echo ($active_tab === 'dashboard') ? 'visible' : ''; ?>">
    
    <?php require_once('dashboard.php'); ?> 
</div>

