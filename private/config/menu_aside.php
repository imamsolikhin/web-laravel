<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'dashboard',
            'new-tab' => false,
        ],
        [
            'section' => 'Menu Klinik'
        ],
        [
            'title' => 'Marketing Klinik',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'submenu' => [
                [
                  'title' => 'Interaksi',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'clinic/interaksi'
                ],
                [
                  'title' => 'Lead',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'clinic/lead'
                ],
                [
                  'title' => 'Follow Up',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'clinic/followup'
                ],
                [
                  'title' => 'Reservasi',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'clinic/reservasi'
                ],
                [
                  'title' => 'Closing',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'clinic/closing'
                ],
            ],
        ],
        [
            'title' => 'Admin Klinik',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'submenu' => [
                [
                  'title' => 'Data Pasien',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Data Ramuan',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Kwitansi Bonus',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Closing klinik',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
            ],
        ],
        [
            'section' => 'Menu Produk'
        ],
        [
            'title' => 'Marketing Produk',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'submenu' => [
                [
                  'title' => 'Interaksi',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'product/interaksi'
                ],
                [
                  'title' => 'Lead',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'product/lead'
                ],
                [
                  'title' => 'Follow Up',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'product/followup'
                ],
                [
                  'title' => 'Transaksi',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'product/transaksi'
                ],
                [
                  'title' => 'Closing',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'product/closing'
                ],
            ],
        ],
        [
            'title' => 'Admin Produk',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'submenu' => [
                [
                  'title' => 'Bank Masuk',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Bank Keluar',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Omset Produk',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Kwitansi Bonus',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Closing Produk',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
            ],
        ],
        [
            'title' => 'Gudang Produk',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'submenu' => [
                [
                  'title' => 'Pengiriman Barang',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Barang Return',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Barang Masuk',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Barang Keluar',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Stock Opname',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
                [
                  'title' => 'Stock Produk',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => '#'
                ],
            ],
        ],
        [
            'section' => 'Menu Data'
        ],
        [
            'title' => 'Master Data',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'submenu' => [
                [
                  'title' => 'Advertise',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/ads'
                ],
                [
                  'title' => 'Bank',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/bank'
                ],
                [
                  'title' => 'City',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/city'
                ],
                [
                  'title' => 'Clinic',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/clinic'
                ],
                [
                  'title' => 'Company',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/company'
                ],
                [
                  'title' => 'Confirmation',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/confirmation'
                ],
                [
                  'title' => 'Courier',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/courier'
                ],
                [
                  'title' => 'Gender',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/gender'
                ],
                [
                  'title' => 'Interaction',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/interaction'
                ],
                [
                  'title' => 'Item Price',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/itemprice'
                ],
                [
                  'title' => 'Market',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/market'
                ],
                [
                  'title' => 'Payment Type',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/paymenttype'
                ],
                [
                  'title' => 'Periode',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/periode'
                ],
                [
                  'title' => 'Product',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/product'
                ],
                [
                  'title' => 'Shift Work',
                  'root' => true,
                  'icon' => 'media/svg/icons/Code/Terminal.svg',
                  'bullet' => 'dot',
                  'page' => 'master/shiftwork'
                ],
            ]
        ],
        [
            'section' => 'Settings'
        ],
        [
            'title' => 'User Management',
            'root' => true,
            'icon' => 'media/svg/icons/General/User.svg',
            'bullet' => 'dot',
            'page' => 'management/user'
        ],
        [
            'title' => 'Role & Permission',
            'root' => true,
            'icon' => 'media/svg/icons/General/Shield-check.svg',
            'bullet' => 'dot',
            'page' => 'management/role'
        ],
        [
            'title' => 'User Login History',
            'root' => true,
            'icon' => 'media/svg/icons/Code/Time-schedule.svg',
            'bullet' => 'dot',
            'page' => 'management/login-history'
        ],
        [
            'title' => 'Log Out',
            'root' => true,
            'icon' => 'media/svg/icons/Navigation/Sign-out.svg',
            'bullet' => 'dot',
            'page' => 'logout',
            'color' => 'red'
        ],
    ]

];
