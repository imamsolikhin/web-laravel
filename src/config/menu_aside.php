<?php
// Aside menu
if(APP_BRANCH == "Clinic"){
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
            [
                'title' => 'Log Out',
                'root' => true,
                'icon' => 'media/svg/icons/Navigation/Sign-out.svg',
                'bullet' => 'dot',
                'page' => 'logout',
                'color' => 'red'
            ],
      ],
  ];

}

if(APP_BRANCH == "Marketing Clinic"){
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
            'title' => 'Interaksi',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'bullet' => 'dot',
            'page' => 'clinic/interaksi'
          ],
          [
            'title' => 'Lead',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'bullet' => 'dot',
            'page' => 'clinic/lead'
          ],
          [
            'title' => 'Follow Up',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'bullet' => 'dot',
            'page' => 'clinic/followup'
          ],
          [
            'title' => 'Reservasi',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'bullet' => 'dot',
            'page' => 'clinic/reservation'
          ],
          [
            'title' => 'Closing',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Commode2.svg',
            'bullet' => 'dot',
            'page' => 'clinic/closing'
          ],
          [
              'title' => 'Log Out',
              'root' => true,
              'icon' => 'media/svg/icons/Navigation/Sign-out.svg',
              'bullet' => 'dot',
              'page' => 'logout',
              'color' => 'red'
          ],
      ],
  ];

}

if(APP_BRANCH == "Marketing Product"){

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
                    'page' => 'warehouse/delyvery-order'
                  ],
                  [
                    'title' => 'Barang Return',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/delyvery-return'
                  ],
                  [
                    'title' => 'Barang Masuk',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/inventory-in'
                  ],
                  [
                    'title' => 'Barang Keluar',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/inventory-out'
                  ],
                  [
                    'title' => 'Stock Opname',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/stock-opname'
                  ],
                  [
                    'title' => 'Laporan Produk',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/report-warehouse'
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
              'title' => 'Log Out',
              'root' => true,
              'icon' => 'media/svg/icons/Navigation/Sign-out.svg',
              'bullet' => 'dot',
              'page' => 'logout',
              'color' => 'red'
          ],
      ]

  ];
}


if(APP_BRANCH == "Management"){
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
                    'page' => 'clinic/reservation'
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
                    'title' => 'Dashboard Klinik',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'clinic/dashboard'
                  ],
                  [
                    'title' => 'Kunjungan Pasien',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'clinic/visit-patient'
                  ],
                  [
                    'title' => 'Data Pasien',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'clinic/patient'
                  ],
                  [
                    'title' => 'Laporan Data Pasien',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'clinic/report-patient'
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
                    'title' => 'Penjualan Produk',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'product/sales-order'
                  ],
                  [
                    'title' => 'Return Produk',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'product/sales-return'
                  ],
                  [
                    'title' => 'Bank Masuk',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'finance/bank-received'
                  ],
                  [
                    'title' => 'Bank Keluar',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'finance/bank-payment'
                  ],
                  [
                    'title' => 'Omset Produk',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'finance/omset'
                  ],
                  [
                    'title' => 'Kwitansi Bonus',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'finance/sales-reward'
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
                    'page' => 'warehouse/delivery-order'
                  ],
                  [
                    'title' => 'Barang Return',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/delivery-return'
                  ],
                  [
                    'title' => 'Barang Masuk',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/inventory-in'
                  ],
                  [
                    'title' => 'Barang Keluar',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/inventory-out'
                  ],
                  [
                    'title' => 'Stock Opname',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/stock-opname'
                  ],
                  [
                    'title' => 'Laporan Gudang',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'warehouse/report-warehouse'
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
                    'title' => 'Visit Status',
                    'root' => true,
                    'icon' => 'media/svg/icons/Code/Terminal.svg',
                    'bullet' => 'dot',
                    'page' => 'master/visit-status'
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
                    'page' => 'master/item-price'
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
                    'page' => 'master/payment-type'
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
              'title' => 'Menu',
              'root' => true,
              'icon' => 'media/svg/icons/General/Shield-check.svg',
              'bullet' => 'dot',
              'page' => 'management/menu'
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
}