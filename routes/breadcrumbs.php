<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


// >>Dashboard > batches
Breadcrumbs::for('admin.batches.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Batches', route('admin.batches.index'));
});
// >>Dashboard > batches > add
Breadcrumbs::for('admin.batches.create', function ($trail) {
    $trail->parent('admin.batches.index');
    $trail->push('Add', route('admin.batches.create'));
});
// >>Dashboard > batches > edit
Breadcrumbs::for('admin.batches.edit', function ($trail, $batches) {
    $trail->parent('admin.batches.index');
    $trail->push('Edit', route('admin.batches.edit', $batches));
});


// >>Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});


// >>Dashboard > company
Breadcrumbs::for('admin.companys.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Companys', route('admin.companys.index'));
});

// >>Dashboard > currency
Breadcrumbs::for('admin.currencies.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Currency', route('admin.currencies.index'));
});
// >>Dashboard > currency > add
Breadcrumbs::for('admin.currencies.create', function ($trail) {
    $trail->parent('admin.currencies.index');
    $trail->push('Add', route('admin.currencies.create'));
});
// >>Dashboard > currency > edit
Breadcrumbs::for('admin.currencies.edit', function ($trail, $currency) {
    $trail->parent('admin.currencies.index');
    $trail->push('Edit', route('admin.currencies.edit', $currency));
});


// >>Dashboard > customers
Breadcrumbs::for('admin.customers.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Customer', route('admin.customers.index'));
});
// >>Dashboard > customers > create
Breadcrumbs::for('admin.customers.create', function ($trail) {
    $trail->parent('admin.customers.index');
    $trail->push('Add', route('admin.customers.create'));
});
// >>Dashboard > customers > edit
Breadcrumbs::for('admin.customers.edit', function ($trail, $customer) {
    $trail->parent('admin.customers.index');
    $trail->push('Edit', route('admin.customers.edit', $customer));
});


// >>Dashboard > categories
Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('admin.categories.index'));
});
// >>Dashboard > categories > create
Breadcrumbs::for('admin.categories.create', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push('Add', route('admin.categories.create'));
});
// >>Dashboard > categories > edit
Breadcrumbs::for('admin.categories.edit', function ($trail, $category) {
    $trail->parent('admin.categories.index');
    $trail->push('Edit', route('admin.categories.edit', $category));
});


// >>Dashboard > milk
Breadcrumbs::for('admin.milks.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Milk', route('admin.milks.index'));
});
// >>Dashboard > milk > add
Breadcrumbs::for('admin.milks.create', function ($trail) {
    $trail->parent('admin.milks.index');
    $trail->push('Add', route('admin.milks.create'));
});
// >>Dashboard > milk > edit
Breadcrumbs::for('admin.milks.edit', function ($trail, $milk) {
    $trail->parent('admin.milks.index');
    $trail->push('Edit', route('admin.milks.edit', $milk));
});


// >>Dashboard > milk-purchases
Breadcrumbs::for('admin.milk-purchases.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Milk Purchase', route('admin.milk-purchases.index'));
});
// >>Dashboard > milk-purchases > add
Breadcrumbs::for('admin.milk-purchases.create', function ($trail) {
    $trail->parent('admin.milk-purchases.index');
    $trail->push('Add', route('admin.milk-purchases.create'));
});
// >>Dashboard > milk-purchases > edit
Breadcrumbs::for('admin.milk-purchases.edit', function ($trail, $milk_purchases) {
    $trail->parent('admin.milk-purchases.index');
    $trail->push('Edit', route('admin.milk-purchases.edit', $milk_purchases));
});

// >>Dashboard > Milk purchase > report
Breadcrumbs::for('admin.purchase-report.index', function ($trail) {
    $trail->parent('admin.milk-purchases.index');
    $trail->push('Report', route('admin.purchase-report.index'));
});


// >>Dashboard > milk-storage
Breadcrumbs::for('admin.milk-storage.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Milk Storage', route('admin.milk-storage.index'));
});



// >>Dashboard > payment
Breadcrumbs::for('admin.payment.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Payments', route('admin.payment.index'));
});
// >>Dashboard > payment > create
Breadcrumbs::for('admin.payment.create', function ($trail) {
    $trail->parent('admin.payment.index');
    $trail->push('Generate', route('admin.payment.create'));
});
// >>Dashboard > payment > edit
Breadcrumbs::for('admin.payment.edit', function ($trail, $payment) {
    $trail->parent('admin.payment.index');
    $trail->push('Edit', route('admin.payment.edit', $payment));
});


// >>Dashboard > products
Breadcrumbs::for('admin.products.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Product', route('admin.products.index'));
});
// >>Dashboard > products > add
Breadcrumbs::for('admin.products.create', function ($trail) {
    $trail->parent('admin.products.index');
    $trail->push('Add', route('admin.products.create'));
});
// >>Dashboard > products > edit
Breadcrumbs::for('admin.products.edit', function ($trail, $product) {
    $trail->parent('admin.products.index');
    $trail->push('Edit', route('admin.products.edit', $product));
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
Breadcrumbs::for('admin.riders.edit', function ($trail, $user) {
    $trail->parent('admin.riders.index');
    $trail->push('Edit', route('admin.riders.edit', $user));
});

// >>Dashboard > sells
Breadcrumbs::for('admin.sells.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Sells', route('admin.sells.index'));
});
// >>Dashboard > sells > create
Breadcrumbs::for('admin.sells.create', function ($trail) {
    $trail->parent('admin.sells.index');
    $trail->push('Add', route('admin.sells.create'));
});
// >>Dashboard > sells > edit
Breadcrumbs::for('admin.sells.edit', function ($trail, $sells) {
    $trail->parent('admin.sells.index');
    $trail->push('Edit', route('admin.sells.edit', $sells));
});

// >>Dashboard > sells > edit
Breadcrumbs::for('admin.sell-report.index', function ($trail) {
    $trail->parent('admin.sells.index');
    $trail->push('Report', route('admin.sell-report.index'));
});

// >>Dashboard > stocks >report
Breadcrumbs::for('admin.stocks.report', function ($trail) {
    $trail->parent('admin.stocks.index');
    $trail->push('Report', route('admin.stocks.report'));
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
Breadcrumbs::for('admin.suppliers.edit', function ($trail, $user) {
    $trail->parent('admin.suppliers.index');
    $trail->push('Edit', route('admin.suppliers.edit', $user));
});

// >>Dashboard > stocks
Breadcrumbs::for('admin.stocks.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Stocks', route('admin.stocks.index'));
});


// ==================== transaction :: begin ===============

// >>Dashboard > payment
Breadcrumbs::for('admin.transaction.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Transaction', route('admin.transaction.index'));
});
// >>Dashboard > payment > create
Breadcrumbs::for('admin.transaction.create', function ($trail) {
    $trail->parent('admin.transaction.index');
    $trail->push('Create', route('admin.transaction.create'));
});
// >>Dashboard > payment > edit
Breadcrumbs::for('admin.transaction.edit', function ($trail, $transaction) {
    $trail->parent('admin.transaction.index');
    $trail->push('Edit', route('admin.transaction.edit', $transaction));
});

// >>Dashboard > payment > edit
Breadcrumbs::for('transaction-payment.edit', function ($trail, $transaction) {
    $trail->parent('admin.transaction.index');
    $trail->push('Edit', route('admin.transaction-payment.update', $transaction));
});

// >>Dashboard > payment > show
Breadcrumbs::for('admin.transaction.show', function ($trail, $transaction) {
    $trail->parent('admin.transaction.index');
    $trail->push('Show', route('admin.transaction.show', $transaction));
});

// ==================== transaction :: end =================

// ==================== transaction :: begin ===============

// >>Dashboard > payment
Breadcrumbs::for('admin.transaction-payment.index', function ($trail) {
    $trail->parent('admin.transaction.index');
    $trail->push('Transaction Payment', route('admin.transaction-payment.index'));
});
// >>Dashboard > payment > create
Breadcrumbs::for('admin.transaction-payment.create', function ($trail,$transaction) {
    $trail->parent('admin.transaction.index');
    $trail->push('Create Payment', route('admin.transaction-payment.create',$transaction));
});



// ==================== transaction :: end =================


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
Breadcrumbs::for('admin.users.edit', function ($trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit', route('admin.users.edit', $user));
});


// >>Dashboard > units
Breadcrumbs::for('admin.units.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Units', route('admin.units.index'));
});
// >>Dashboard > units > create
Breadcrumbs::for('admin.units.create', function ($trail) {
    $trail->parent('admin.units.index');
    $trail->push('Add', route('admin.units.create'));
});
// >>Dashboard > units > edit
Breadcrumbs::for('admin.units.edit', function ($trail, $unit) {
    $trail->parent('admin.units.index');
    $trail->push('Edit', route('admin.units.edit', $unit));
});





// >>Dashboard > profile
Breadcrumbs::for('admin.profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('admin.profile'));
});
// >>Dashboard > profile > Edit
Breadcrumbs::for('admin.profile.edit', function ($trail) {
    $trail->parent('admin.profile');
    $trail->push('Edit', route('admin.profile.edit'));
});
