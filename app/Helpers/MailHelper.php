<?php

namespace App\Helpers;

use App\Mail\TemplateEmail;
use App\Models\MailTemplate;
use App\Models\Template;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    public static function sendEmail(MailTemplate $template, $to, array $params = [], $timeout = null)
    {
        if ($timeout) {
            Mail::to($to->email)->later(
                $timeout,
                new TemplateEmail(
                    self::replaceParams($template->template, $params),
                    $template->name,
                    $to
                )
            );
        } else {
            Mail::to($to->email)->queue(
                new TemplateEmail(self::replaceParams($template->template, $params), $template->name, $to)
            );
        }
    }

    protected static function replaceParams(Template $mailTemplate, $params = [])
    {
        $html = $mailTemplate->body;

        foreach ($params as $key => $value) {
            $html = str_replace('[[' . $key . ']]', $value, $html);
        }
        $html = preg_replace_callback('/http[a-z0-9_\..-:\-]*?\s+/i',
            function($match)
            {
                return str_replace(' ', '%20', $match[0]);
            }
            , $html);

        return $html;
    }
}
