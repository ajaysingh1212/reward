<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 27,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 28,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 32,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 33,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 34,
                'title' => 'reward_data_access',
            ],
            [
                'id'    => 35,
                'title' => 'row_data_create',
            ],
            [
                'id'    => 36,
                'title' => 'row_data_edit',
            ],
            [
                'id'    => 37,
                'title' => 'row_data_show',
            ],
            [
                'id'    => 38,
                'title' => 'row_data_delete',
            ],
            [
                'id'    => 39,
                'title' => 'row_data_access',
            ],
            [
                'id'    => 40,
                'title' => 'winner_create',
            ],
            [
                'id'    => 41,
                'title' => 'winner_edit',
            ],
            [
                'id'    => 42,
                'title' => 'winner_show',
            ],
            [
                'id'    => 43,
                'title' => 'winner_delete',
            ],
            [
                'id'    => 44,
                'title' => 'winner_access',
            ],
            [
                'id'    => 45,
                'title' => 'campaign_create',
            ],
            [
                'id'    => 46,
                'title' => 'campaign_edit',
            ],
            [
                'id'    => 47,
                'title' => 'campaign_show',
            ],
            [
                'id'    => 48,
                'title' => 'campaign_delete',
            ],
            [
                'id'    => 49,
                'title' => 'campaign_access',
            ],
            [
                'id'    => 50,
                'title' => 'web_setting_access',
            ],
            [
                'id'    => 51,
                'title' => 'web_page_create',
            ],
            [
                'id'    => 52,
                'title' => 'web_page_edit',
            ],
            [
                'id'    => 53,
                'title' => 'web_page_show',
            ],
            [
                'id'    => 54,
                'title' => 'web_page_delete',
            ],
            [
                'id'    => 55,
                'title' => 'web_page_access',
            ],
            [
                'id'    => 56,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
