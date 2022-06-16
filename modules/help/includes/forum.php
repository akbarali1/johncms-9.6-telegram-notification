<?php

/**
 * This file is part of JohnCMS Content Management System.
 *
 * @copyright JohnCMS Community
 * @license   https://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link      https://johncms.com JohnCMS Project
 */

declare(strict_types=1);

defined('_IN_JOHNCMS') || die('Error: restricted access');

$title = __('Forum rules');
$nav_chain->add($title);

echo $view->render(
    'help::forum_rules',
    [
        'title'      => $title,
        'page_title' => $title,
    ]
);
