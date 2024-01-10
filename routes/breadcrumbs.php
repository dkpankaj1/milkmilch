<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// >>Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});


// >>Dashboard > categorie
Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Categorie', route('admin.categories.index'));
});

// >>Dashboard > categorie > create
Breadcrumbs::for('admin.categories.create', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push('Add', route('admin.categories.create'));
});

// >>Dashboard > categorie > edit
Breadcrumbs::for('admin.categories.edit', function ($trail,$category) {
    $trail->parent('admin.categories.index');
    $trail->push('Edit', route('admin.categories.edit',$category));
});



// >>Dashboard > riders
Breadcrumbs::for('admin.riders.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Rider', route('admin.riders.index'));
});

// >>Dashboard > riders > create
Breadcrumbs::for('admin.riders.create', function ($trail) {
    $trail->parent('admin.riders.index');
    $trail->push('Add', route('admin.riders.create'));
});


// >>Dashboard > riders > edit
Breadcrumbs::for('admin.riders.edit', function ($trail,$user) {
    $trail->parent('admin.riders.index');
    $trail->push('Edit', route('admin.riders.edit',$user));
});



// >>Dashboard > suppliers
Breadcrumbs::for('admin.suppliers.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Suppliers', route('admin.suppliers.index'));
});

// >>Dashboard > suppliers > create
Breadcrumbs::for('admin.suppliers.create', function ($trail) {
    $trail->parent('admin.suppliers.index');
    $trail->push('Add', route('admin.suppliers.create'));
});


// >>Dashboard > suppliers > edit
Breadcrumbs::for('admin.suppliers.edit', function ($trail,$user) {
    $trail->parent('admin.suppliers.index');
    $trail->push('Edit', route('admin.suppliers.edit',$user));
});


// >>Dashboard > user
Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('admin.users.index'));
});

// >>Dashboard > user > add
Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push('Add', route('admin.users.create'));
});

// >>Dashboard > user > edit
Breadcrumbs::for('admin.users.edit', function ($trail,$user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit', route('admin.users.edit',$user));
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