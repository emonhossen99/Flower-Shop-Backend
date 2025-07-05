<?php

use Modules\EmailTemplate\App\Models\EmailTemplate;


if (!function_exists('status')) {
    function status($status)
    {
        if ($status == 0) {
            $badgeClass = 'bg-warning';
            $badgeTitle =  __f('Status Pending Title');
        } else if ($status == 1) {
            $badgeClass = 'bg-success';
            $badgeTitle =  __f('Status Publish Title');
        } else if ($status == 2) {
            $badgeClass = 'bg-danger';
            $badgeTitle =  __f('Status Cancel Title');
        } else if ($status == 3) {
            $badgeClass = 'bg-primary';
            $badgeTitle = __f('Status Sell Title');
        } else if ($status == 4) {
            $badgeClass = 'bg-info';
            $badgeTitle = __f('Status Rejected Title');
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('target')) {
    function target($target)
    {
        if ($target == 0) {
            $badgeClass = 'bg-success';
            $badgeTitle = __f('Target Same Page Title');
        } else {
            $badgeClass = 'bg-warning';
            $badgeTitle = __f('Target New Page Title');
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('direction')) {
    function direction($direction)
    {
        if ($direction == 'ltr') {
            $badgeClass = 'bg-success';
            $badgeTitle = __f('Left To Right Title');
        } else {
            $badgeClass = 'bg-warning';
            $badgeTitle = __f('Right To Left Title');
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('defaultCheck')) {
    function defaultCheck($defaultCheck)
    {
        if ($defaultCheck == '1') {
            $badgeClass = 'bg-success';
            $badgeTitle = __f('Status Active Title');
        } else {
            $badgeClass = 'bg-warning';
            $badgeTitle = __f('Status Disabled Title');
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}


if (!function_exists('__f')) {
    function __f($key, $replace = [], $locale = null)
    {
        $line = __($key, $replace, $locale);
        return $line === $key ? '---' : $line;
    }
}



if (!function_exists('currency')) {
    function currency()
    {
        return  config('settings.currency') ?? '$';
    }
}

if (!function_exists('homepageshowstatus')) {
    function homepageshowstatus($status)
    {
        if ($status == 0) {
            $badgeClass = 'bg-warning';
            $badgeTitle = __f('No Text');
        } else if ($status == 1) {
            $badgeClass = 'bg-success';
            $badgeTitle = __f('Yes Text');
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('reviewstar')) {
    function reviewstar($star)
    {
        if ($star == 1) {
            return '<i class="fa-solid fa-star text-warning"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>';
        } else if ($star == 2) {
            return '<i class="fa-solid fa-star text-warning"></i> <i class="fa-solid fa-star text-warning"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>';
        } else if ($star == 3) {
            return '<i class="fa-solid fa-star text-warning"></i> <i class="fa-solid fa-star text-warning"></i> <i class="fa-solid fa-star text-warning"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>';
        } else if ($star == 4) {
            return '<i class="fa-solid fa-star text-warning"></i> <i class="fa-solid fa-star text-warning"></i> <i class="fa-solid fa-star text-warning"></i> <i class="fa-solid fa-star text-warning"></i><i class="fa-regular fa-star"></i>';
        } else {
            return '<i class="fa-solid fa-star text-warning"></i> <i class="fa-solid fa-star text-warning"></i> <i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i>';
        }
    }
}
if (!function_exists('getCarouselOptions')) {
    function getCarouselOptions()
    {
        $owlOptions = [
            'nav' => true,
            'dots' => true,
            'margin' => 20,
            'loop' => true,
            'autoplay' => true,
            'autoplayTimeout' => 3000,
            'responsive' => [
                0 => ['items' => 1],
                480 => ['items' => 2],
                768 => ['items' => 2],
                992 => ['items' => 3],
                1280 => ['items' => 3],
            ],
        ];
        return $owlOptions;
    }
}

if (!function_exists('btntaget')) {
    function btntaget($status)
    {
        if ($status == 1) {
            $badgeClass = 'bg-warning';
            $badgeTitle = __f('Target New Page Title');
        } else if ($status == 0) {
            $badgeClass = 'bg-success';
            $badgeTitle = __f('Target Same Page Title');
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('purchase_type')) {
    function purchase_type($status)
    {
        if ($status == 1) {
            $badgeClass = 'bg-success';
            $badgeTitle =  __f('Purchase Supplier Title');
        } else if ($status == 0) {
            $badgeClass = 'bg-primary';
            $badgeTitle =  __f('Purchase Local Title');
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('convertToLocaleNumber')) {
    function convertToLocaleNumber($number)
    {
        $locale = app()->getLocale() ?? 'en';
        $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $number = (float) $number;
        if ($locale === 'bn') {
            return str_replace($englishDigits, $banglaDigits, number_format($number));
        }

        return number_format($number);
    }
}
if (!function_exists('getCarouselOptions')) {
    function getCarouselOptions()
    {
        $shownav = config('settings.productnavbarshowchosevalue') == 1 ? false : true;
        $showdotted = config('settings.productdottedshowchosevalue') == 1 ? false : true;
        $cardnumber = config('settings.number_of_card_show_in_home') ?? 4;
        $owlOptions = [
            'nav' => $shownav,
            'dots' => $showdotted,
            'margin' => 20,
            'loop' => true,
            'autoplay' => true,
            'autoplayTimeout' => 3000,
            'responsive' => [
                0 => ['items' => 1],
                480 => ['items' => 2],
                768 => ['items' => 3],
                992 => ['items' => 4],
                1280 => ['items' => $cardnumber],
            ],
        ];
        return $owlOptions;
    }
}
if (!function_exists('getBrandCarouselOptions')) {
    function getBrandCarouselOptions()
    {
        $shownav = config('settings.brandnavbarshowchosevalue') == 1 ? false : true;
        $showdotted = config('settings.branddottedshowchosevalue') == 1 ? false : true;
        $cardnumber = config('settings.number_of_card_show_in_home_brand') ?? 6;
        $owlOptions = [
            'nav' => $shownav,
            'dots' => $showdotted,
            'margin' => 20,
            'loop' => true,
            'autoplay' => true,
            'autoplayTimeout' => 3000,
            'responsive' => [
                0 => ['items' => 1],
                480 => ['items' => 2],
                768 => ['items' => 3],
                992 => ['items' => 4],
                1280 => ['items' => $cardnumber],
            ],
        ];
        return $owlOptions;
    }
}

if (!function_exists('formatDateToBangla')) {
    function formatDateToBangla($date)
    {
        $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $banglaMonths = [
            'January' => 'জানুয়ারি',
            'February' => 'ফেব্রুয়ারি',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'আগস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর',
        ];

        $day = $date->format('d');
        $month = $date->format('F');

        $banglaDay = str_replace($englishDigits, $banglaDigits, $day);
        $banglaMonth = $banglaMonths[$month] ?? $month;
        return $banglaDay . ' ' . $banglaMonth;
    }
}

if (!function_exists('formatDateToBanglaWithYear')) {
    function formatDateToBanglaWithYear($date)
    {
        $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $banglaMonths = [
            'January' => 'জানুয়ারি',
            'February' => 'ফেব্রুয়ারি',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'আগস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর',
        ];

        $day = $date->format('d');
        $month = $date->format('F');
        $year = $date->format('y');

        $banglaDay = str_replace($englishDigits, $banglaDigits, $day);
        $banglaMonth = $banglaMonths[$month] ?? $month;
        $banglaYear = str_replace($englishDigits, $banglaDigits, $year);

        return $banglaDay . ' ' . $banglaMonth . ' ,' . $banglaYear;
    }
}

if (!function_exists('formatDateByLocale')) {
    function formatDateByLocale($date)
    {
        $locale = app()->getLocale() ?? 'en';
        $months_bn = [
            '01' => 'জানুয়ারি',
            '02' => 'ফেব্রুয়ারি',
            '03' => 'মার্চ',
            '04' => 'এপ্রিল',
            '05' => 'মে',
            '06' => 'জুন',
            '07' => 'জুলাই',
            '08' => 'আগস্ট',
            '09' => 'সেপ্টেম্বর',
            '10' => 'অক্টোবর',
            '11' => 'নভেম্বর',
            '12' => 'ডিসেম্বর',
        ];

        $months_en = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bangla  = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        [$day, $month, $year] = explode('-', $date);

        if ($locale === 'bn') {
            $day = str_replace($english, $bangla, ltrim($day, '0'));
            $monthName = $months_bn[$month];
            $year = str_replace($english, $bangla, $year);
            return "{$day} {$monthName} {$year}";
        } else {
            $day = ltrim($day, '0');
            $monthName = $months_en[$month];
            return "{$day} {$monthName} {$year}";
        }
    }
}


if (!function_exists('orderStatus')) {
    function orderStatus($status)
    {
        if ($status == 1) {
            $badgeClass = 'bg-info';
            $badgeTitle = __f('Pending Title');
        } else if ($status == 2) {
            $badgeClass = 'bg-success';
            $badgeTitle = __f('Processing Title');
        } else if ($status == 3) {
            $badgeClass = 'bg-secondary';
            $badgeTitle = __f('On The Way Title');
        } else if ($status == 4) {
            $badgeClass = 'bg-warning';
            $badgeTitle = __f('On Hold Title');
        } else if ($status == 5) {
            $badgeClass = 'bg-primary';
            $badgeTitle = __f('Complate Title');
        } else {
            $badgeClass = 'bg-danger';
            $badgeTitle = __f('Cancel Title');
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('productType')) {
    function productType($type)
    {
        if ($type == 0) {
            $badgeClass = 'bg-warning';
            $badgeTitle = 'Single';
        } else {
            $badgeClass = 'bg-success';
            $badgeTitle = 'Variable';
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('manageCustomerStatus')) {
    function manageCustomerStatus($status)
    {
        if ($status == 0) {
            $badgeClass = 'bg-danger';
            $badgeTitle = 'Blocked';
        } else {
            $badgeClass = 'bg-success';
            $badgeTitle = 'Actived';
        }
        return '<span class="badge badge-sm ' . $badgeClass . ' py-1 px-2">' . $badgeTitle . '</span>';
    }
}

if (!function_exists('productreview')) {
    function productreview($review)
    {
        if ($review == 5) {
            $data =
                '<i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>';
        } else if ($review == 4) {
            $data =
                '<i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star"></i>';
        } else if ($review == 3) {
            $data =
                '<i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>';
        } else if ($review == 2) {
            $data =
                '<i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>';
        } else {
            $data =
                '<i class="fa-solid fa-star text-warning"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>';
        }

        return $data;
    }
}


// For form short code show
if (!function_exists('emalTemplateShortcodeConverter')) {
    function emalTemplateShortcodeConverter($template)
    {
        if ($template == 'NEW_USER_MAIL') {
            $shortcodeName = '[name], [email], [role-name], [verify-token-button], [verify-token]';
        } elseif ($template == 'NEW_USER_NOTIFICATION_MAIL') {
            $shortcodeName = '[name], [email], [role-name], [full-profile-button]';
        } elseif ($template == 'USER_APPROVE_MAIL') {
            $shortcodeName = '[name], [email], [account-login-button], [role-name]';
        } elseif ($template == 'PASSWORD_RESET_MAIL') {
            $shortcodeName = '[name], [email], [reset-password-button], [reset-token]';
        } elseif ($template == 'NEW_DOCTOR_MAIL') {
            $shortcodeName = '[name], [email], [redirect-dashboard-button]';
        } elseif ($template == 'PACKAGE_ACTIVATE_NOTIFICATION') {
            $shortcodeName = '[name], [email], [redirect-orders-button]';
        }
        return $shortcodeName;
    }
}

// For form body button short code convarter
if (!function_exists('emailTemplateBodyShortCodeForm')) {
    function emailTemplateBodyShortCodeForm($template_name, $body)
    {
        if ($template_name == 'NEW_USER_MAIL') {
            $button = "<a href='' class='account-button' target='_blank'><span class='account-span'><span style='font-size: 18px; line-height: 21.6px;'>Click Here To Verify Email </span></span></a>";
            $shortcode = str_replace('[verify-token-button]', $button, $body);
        } elseif ($template_name == 'NEW_USER_NOTIFICATION_MAIL') {
            $button = "<a href='' class='account-button' target='_blank'><span class='account-span'><span style='font-size: 18px; line-height: 21.6px;'>View Full Profile</span></span></a>";
            $shortcode = str_replace('[full-profile-button]', $button, $body);
        } elseif ($template_name == 'USER_APPROVE_MAIL') {
            $button = "<a href='' class='account-button' target='_blank'><span class='account-span'><span style='font-size: 18px; line-height: 21.6px;'>Login to your profile</span></span></a>";
            $shortcode = str_replace('[account-login-button]', $button, $body);
        } elseif ($template_name == 'PASSWORD_RESET_MAIL') {
            $button = "<a href='' class='account-button' target='_blank'><span class='account-span'><span style='font-size: 18px; line-height: 21.6px;'>Reset Password</span></span></a>";
            $shortcode = str_replace('[reset-password-button]', $button, $body);
        } elseif ($template_name == 'NEW_DOCTOR_MAIL') {
            $button = "<a href='' class='account-button' target='_blank'><span class='account-span'><span style='font-size: 18px; line-height: 21.6px;'>Go To Dashboard</span></span></a>";
            $shortcode = str_replace('[redirect-dashboard-button]', $button, $body);
        } elseif ($template_name == 'PACKAGE_ACTIVATE_NOTIFICATION') {
            $button = "<a href='' class='account-button' target='_blank'><span class='account-span'><span style='font-size: 18px; line-height: 21.6px;'>Got To Order List</span></span></a>";
            $shortcode = str_replace('[redirect-orders-button]', $button, $body);
        }
        return $shortcode;
    }
}

if (!function_exists('emailSubjectTemplate')) {
    function emailSubjectTemplate($template, $request)
    {
        $data = EmailTemplate::where('name', '=', $template)->first();
        $shortcode = str_replace('[name]', $request->full_name, $data->subject);
        $shortcode = str_replace('[email]', $request->email, $shortcode);
        $shortcode = str_replace('[role-name]', $request->roleName, $shortcode);
        $shortcode = str_replace('[redirect-dashboard-button]', $request->dashboard, $shortcode);
        return $shortcode;
    }
}

if (!function_exists('emailBodyTemplate')) {
    function emailBodyTemplate($template, $request)
    {
        // verify button
        $emailVerifyBtn = '<a href="' . htmlspecialchars($request->button_url) . '" class="account-button" target="_blank" ><span class="account-span"><span style="font-size: 18px; line-height: 21.6px;">' . $request->button_title . '</span></span></a>';

        $emailNotyBtn = '<a href="' . $request->button_url_noty . '" class="account-button" target="_blank" ><span class="account-span"><span style="font-size: 18px; line-height: 21.6px;">' . $request->button_title_noty . '</span></span></a>';

        $emailApprovedBtn = '<a href="' . $request->button_url_approve . '" class="account-button" target="_blank" ><span class="account-span"><span style="font-size: 18px; line-height: 21.6px;">' . $request->button_title_approve . '</span></span></a>';

        $emailResetBtn = '<a href="' . $request->button_reset_url . '" class="account-button" target="_blank" ><span class="account-span"><span style="font-size: 18px; line-height: 21.6px;">' . $request->button_reset_title . '</span></span></a>';

        $appointmentViewBtn = '<a href="' . $request->appointment_button_url . '" class="account-button" target="_blank" ><span class="account-span"><span style="font-size: 18px; line-height: 21.6px;">' . $request->appointment_button_title . '</span></span></a>';
        $newpatientViewBtn = '<a href="' . $request->new_patient_btn_url . '" class="account-button" target="_blank" ><span class="account-span"><span style="font-size: 18px; line-height: 21.6px;">' . $request->new_patient_btn_title . '</span></span></a>';

        $verifyToken = '<a href="' . $request->button_url . '" target="_blank" >' . $request->button_url . '</a>';

        $data = EmailTemplate::where('name', '=', $template)->first();

        $shortcode = str_replace('[name]', $request->full_name, $data->body);
        $shortcode = str_replace('[email]', $request->email, $shortcode);
        $shortcode = str_replace('[role-name]', $request->roleName, $shortcode);
        $shortcode = str_replace('[appointment_date]', $request->appointment_date, $shortcode);
        $shortcode = str_replace('[appointment_time]', $request->appointment_time, $shortcode);
        $shortcode = str_replace('[appointment_location]', $request->appointment_location, $shortcode);
        $shortcode = str_replace('[doctor_name]', $request->doctor_name, $shortcode);
        $shortcode = str_replace('[bullding_name]', $request->bullding_name, $shortcode);
        $shortcode = str_replace('[room_no]', $request->room_no, $shortcode);
        $shortcode = str_replace('[contact_email]', $request->contact_email, $shortcode);
        $shortcode = str_replace('[company_name]', $request->company_name, $shortcode);
        $shortcode = str_replace('[account_created_date]', $request->account_created_date, $shortcode);
        $shortcode = str_replace('[admin_name]', $request->admin_name, $shortcode);
        $shortcode = str_replace('[app_name]', $request->app_name, $shortcode);

        // Button Replace
        $shortcode = str_replace('[new_patient_btn]', $newpatientViewBtn, $shortcode);
        $shortcode = str_replace('[view-appointmetn-button]', $appointmentViewBtn, $shortcode);
        $shortcode = str_replace('[verify-token-button]', $emailVerifyBtn, $shortcode);
        $shortcode = str_replace('[full-profile-button]', $emailNotyBtn, $shortcode);
        $shortcode = str_replace('[account-login-button]', $emailApprovedBtn, $shortcode);
        $shortcode = str_replace('[reset-password-button]', $emailResetBtn, $shortcode);
        $shortcode = str_replace('[redirect-orders-button]', $emailNotyBtn, $shortcode);
        $shortcode = str_replace('[redirect-dashboard-button]', $emailVerifyBtn, $shortcode);
        $shortcode = str_replace('[verify-token]', $verifyToken, $shortcode);
        $shortcode = str_replace('[reset-token]', $verifyToken, $shortcode);
        return $shortcode;
    }
}

if (!function_exists('emailHeadingTemplate')) {
    function emailHeadingTemplate($template, $request)
    {
        $data = EmailTemplate::where('name', '=', $template)->first();
        $shortcode = str_replace('[name]', $request->full_name, $data->heading);
        $shortcode = str_replace('[email]', $request->email, $shortcode);
        $shortcode = str_replace('[role-name]', $request->roleName, $shortcode);

        return $shortcode;
    }
}
