<?php
    $url = $_SERVER['REQUEST_URI'];
?>

<div class="border-end bg-dark" id="sidebar-wrapper">
    <div class="list-group lust-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-dark p-3 <?php if($url === '/customer-profile/') { print 'active'; } ?>" href="/customer-profile">Profile</a>
        <a class="list-group-item list-group-item-action list-group-item-dark p-3 <?php if($url === '/customer-orders/') { print 'active'; } ?>"  href="/customer-orders">Orders</a>
        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="<?php echo wp_logout_url(); ?>">Log out</a>
    </div>
</div>