<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// >>Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// >>Dashboard > pofile
Breadcrumbs::for('admin.profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('admin.profile'));
});

// >>Dashboard > pofile > Edit
Breadcrumbs::for('admin.profile.edit', function ($trail) {
    $trail->parent('admin.profile');
    $trail->push('Edit', route('admin.profile.edit'));
});

?>