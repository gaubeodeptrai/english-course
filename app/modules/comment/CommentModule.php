<?php
namespace app\modules\comment;

class CommentModule extends \yii\easyii\components\Module
{
    public $settings = [
        'enableTitle' => false,
        'enableEmail' => true,
        'preModerate' => false,
        'enableCaptcha' => false,
        'mailAdminOnNewPost' => true,
        'subjectOnNewPost' => 'New message in the guestbook.',
        'templateOnNewPost' => '@app/modules/comment/mail/en/new_post',
        'frontendGuestbookRoute' => '/comment',
        'subjectNotifyUser' => 'Your post in the guestbook answered',
        'templateNotifyUser' => '@app/modules/comment/mail/en/notify_user'
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Member Comment and Review',
            'vn' => 'Bình luận & Đánh giá khóa học',
        ],
        'icon' => 'book',
        'order_num' => 80,
    ];
}