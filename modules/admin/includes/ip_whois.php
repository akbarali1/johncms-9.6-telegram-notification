<?php

/**
 * This file is part of JohnCMS Content Management System.
 *
 * @copyright JohnCMS Community
 * @license   https://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link      https://johncms.com JohnCMS Project
 */

declare(strict_types=1);

defined('_IN_JOHNADM') || die('Error: restricted access');

$ip = $request->getQuery('ip', '', FILTER_VALIDATE_IP);
$nav_chain->add('IP Whois');

/**
 * @param $whoisserver
 * @param $domain
 * @return bool|string
 */
function whoisQuery($whoisserver, $domain)
{
    $port = 43;
    $timeout = 5;
    $fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout);

    if (! $fp) {
        return false;
    }

    fwrite($fp, $domain . "\r\n");
    $out = '';

    while (! feof($fp)) {
        $out .= fgets($fp);
    }

    fclose($fp);
    $res = '';

    if ((strpos(strtolower($out), 'error') === false) && (strpos(strtolower($out), 'not allocated') === false)) {
        $rows = explode("\n", $out);
        foreach ($rows as $row) {
            $row = trim($row);
            if (($row != '') && ($row[0] != '#') && ($row[0] != '%')) {
                $res .= $row . "\n";
            }
        }
    }

    return $res;
}

if ($ip) {
    $whoisservers = [
        //"whois.afrinic.net",         // Africa - returns timeout error :-(
        'whois.lacnic.net',            // Latin America and Caribbean - returns data for ALL locations worldwide :-)
        'whois.apnic.net',             // Asia/Pacific only
        'whois.arin.net',              // North America only
        'whois.ripe.net',               // Europe, Middle East and Central Asia only
    ];

    $results = [];

    foreach ($whoisservers as $whoisserver) {
        $result = whoisQuery($whoisserver, $ip);
        if ($result && ! in_array($result, $results)) {
            $results[$whoisserver] = $result;
        }
    }

    $res = 'RESULTS FOUND: ' . count($results);

    foreach ($results as $whoisserver => $result) {
        $res .= "\n\n-------------\nLookup results for " . $ip . ' from ' . $whoisserver . " server:\n\n" . $result;
    }

    $array = [
        '%'              => '#',
        'inetnum:'       => '<strong class="red">inetnum:</strong>',
        'netname:'       => '<strong class="green">netname:</strong>',
        'descr:'         => '<strong class="red">descr:</strong>',
        'country:'       => '<strong class="red">country:</strong>',
        'admin-c:'       => '<strong class="gray">admin-c:</strong>',
        'tech-c:'        => '<strong class="gray">tech-c:</strong>',
        'status:'        => '<strong class="gray">status:</strong>',
        'mnt-by:'        => '<strong class="gray">mnt-by:</strong>',
        'mnt-lower:'     => '<strong class="gray">mnt-lower:</strong>',
        'mnt-routes:'    => '<strong class="gray">mnt-routes:</strong>',
        'source:'        => '<strong class="gray">source:</strong>',
        'role:'          => '<strong class="gray">role:</strong>',
        'address:'       => '<strong class="green">address:</strong>',
        'e-mail:'        => '<strong class="green">e-mail:</strong>',
        'nic-hdl:'       => '<strong class="gray">nic-hdl:</strong>',
        'org:'           => '<strong class="gray">org:</strong>',
        'person:'        => '<strong class="green">person:</strong>',
        'phone:'         => '<strong class="green">phone:</strong>',
        'remarks:'       => '<strong class="gray">remarks:</strong>',
        'route:'         => '<strong class="red"><b>route:</b></strong>',
        'origin:'        => '<strong class="gray">origin:</strong>',
        'organisation:'  => '<strong class="gray">organisation:</strong>',
        'org-name:'      => '<strong class="red"><b>org-name:</b></strong>',
        'org-type:'      => '<strong class="gray">org-type:</strong>',
        'abuse-mailbox:' => '<strong class="red"><b>abuse-mailbox:</b></strong>',
        'mnt-ref:'       => '<strong class="gray">mnt-ref:</strong>',
        'fax-no:'        => '<strong class="green">fax-no:</strong>',
        'NetType:'       => '<strong class="gray">NetType:</strong>',
        'Comment:'       => '<strong class="gray">Comment:</strong>',
    ];
    $ipwhois = trim($tools->checkout($res, 1, 1));
    $ipwhois = strtr($ipwhois, $array);
} else {
    $ipwhois = '';
}

echo $view->render('admin::ip_whois', ['ipwhois' => $ipwhois, 'ip' => $ip]);
